<?php


$format = $_POST['output_format'];
$svg_xml = $_POST['data'];

if ($format == 'svg'){
    header('Content-Type: image/svg+xml');
    header('Content-Disposition: attachment; filename="zostera.svg"');
    print($svg_xml);
} else {
    if ($format == 'pdf'){
        $mime_type = 'application/x-pdf';
        $output_file = "zostera.pdf";
        $zoom = 1;
    } elseif ($format == 'png'){
        $mime_type = 'image/png';
        $output_file = "zostera.png";
        $zoom = 4;
    }

    header('Content-Type: '.$mime_type);
    header('Content-Disposition: attachment; '."filename=$output_file");    

    require_once(realpath(__DIR__.'/config.php'));
    $rsvg_convert = $eximage_plugin_config['rsvg-convert'];
    
    $tmp_svg = tmpfile();
    fwrite($tmp_svg, $svg_xml);
    $tmp_svg_path = stream_get_meta_data($tmp_svg)['uri'];
        
    passthru("$rsvg_convert "
           . "--background-color white "
           . "-z $zoom "
           . "-f $format "
           . "$tmp_svg_path");

    fclose($tmp_svg);
    
}


?>