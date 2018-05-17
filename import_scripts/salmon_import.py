#!/usr/bin/env python3
import click
import mysql.connector as myc
from statistics import mean

def parse_col_map(col_map_file):
    '''
    Read salmon sample to db tissue mapping.
    '''
    col_map = {}
    with open(col_map_file) as col_map_in:
        for line in col_map_in:
            (sample, tissue) = line.strip().split()
            col_map[sample] = tissue

    return col_map


def parse_salmon(salmon_file, col_map):
    '''
    Iterate over the salmon file and average expression values for each gene per tissue.

    :param str salmon_file: Path to the salmon input file
    :param dict col_map: maps salmon columns onto tissues

    :return list: list of dicts containing gene name, tissue (sample) name and averaged expression value
    '''
    with open(salmon_file) as salmon:
        header = salmon.readline().strip().split()[3:]
        
        ## List the salmon column indexes we need for each tissue
        tissue_map = {}
        for mapping in col_map.items():
            (sample, tissue) = mapping
            if sample in header:
                if tissue not in tissue_map:
                    tissue_map[tissue] = []
                tissue_map[tissue].append(header.index(sample))

        ## Read salmon entries
        entries = []
        for line in salmon:
            cols = line.strip().split()
            name = cols[0]
            values = [float(f) for f in cols[3:]]
            for tissue in tissue_map:
                salmon_cols = tissue_map[tissue]
                selected_values = [values[n] for n in salmon_cols]
                avg_value = sum(selected_values) / len(selected_values)
                entries.append({
                    'id': name,
                    'sample': tissue,
                    'log2': avg_value
                })
    return entries

def write_entries(entries, db_config, experiment):
    '''
    Iterate the expression entries and INSERT them into the database.
    Given table will be truncated and created if needed.

    Table name is the experiment prefixed with 'expression_exatlas_'
    '''
    table = 'expression_exatlas_'+experiment
    print("Writing expression data to {}.{}".format(db_config['host'],table))

    ## Mimicking the existing expression tables a used by _GenIECMS_
    sql_create_table = ("CREATE TABLE `{}` ("
                 "  `id` varchar(60) NOT NULL,"
                 "  `sample` varchar(60) NOT NULL,"
                 "  `log2` double(20,14) DEFAULT NULL,"
                 "  `sample_i` mediumint(11) DEFAULT NULL,"
                 "  `gene_i` mediumint(11) DEFAULT NULL,"
                 "  KEY `id` (`id`)"
                 ") ENGINE=MyISAM DEFAULT CHARSET=latin1")

    
    cnx = myc.connect(**db_config)
    cursor = cnx.cursor()

    cursor.execute("DROP TABLE IF EXISTS {}".format(table))
    cursor.execute(sql_create_table.format(table))
    
    for entry in entries:
        sql_insert = ("INSERT INTO {} "
                      "  (`id`, `sample`, `log2`) "
                      "  VALUES ('{}', '{}', '{}')")
        sql = sql_insert.format(table, entry['id'], entry['sample'], entry['log2'])
        cursor.execute(sql)

    cursor.close()
    cnx.close()




    
@click.command()
@click.option('-h', '--host', 'db_host',
              required=True,
              help='Database server hostname')
@click.option('-u', '--user', 'db_user',
              required=True,
              help='Database user')
@click.option('-p', '--password', 'db_password',
              prompt='Password',
              hide_input=True,
              help='Database password')
@click.option('-d', '--database', 'db_name',
              required=True,
              help='GenIECMS database name')
@click.option('-e', '--experiment', 'experiment',
              required=True,
              help='Experiment name (a table based on this name will be used/created)')
@click.argument('salmon_file',
                type=click.Path(exists=True))
@click.argument('col_map_file',
                type=click.Path(exists=True))
def main(db_host, db_user, db_password, db_name, experiment, salmon_file, col_map_file):
    '''
    Read a salmon file, merge the experimenty replicates, and write the resulting 
    entries to the database.

    SALMON_FILE: 

      Output file from Salmon

    COL_MAP_FILE: 

      A two column tab delimited file with in the first column a sample name and in the 
      second column the tissue name as it should exist in the database. Multiple samples can be
      mapped onto the same tissue and will be averaged.

      Only columns mentioned in this list will be processed
    '''
    db_config = {
        'host':  db_host,
        'user': db_user,
        'password': db_password,
        'database': db_name
    }
    col_map = parse_col_map(col_map_file)
    entries = parse_salmon(salmon_file, col_map)
    
    write_entries(entries, db_config, experiment)


if __name__  == '__main__':
    main()
