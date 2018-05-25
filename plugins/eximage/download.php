<?php


$format = $_POST['output_format'];
$svg_xml = $_POST['data'];

if ($format == 'svg'){
    header('Content-Type: image/svg+xml');
    header('Content-Disposition: attachment; filename="zostera.svg"');
    print($svg_xml);
} else {

}


?>