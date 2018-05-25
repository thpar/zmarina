<?php


$format = $_POST['output_format'];
$svg_xml = $_POST['data'];

if ($format == 'svg'){
    header('Content-Type: image/svg+xml');
    header('Content-Disposition: attachment; filename="zostera.svg"');
    print($svg_xml);
} elseif ($format == 'pdf'){
    header('Content-Type: application/x-pdf');
    header('Content-Disposition: attachment; filename="zostera.pdf"');

    //$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
    //$pdf->AddPage();
    //$pdf->ImageSVG('@' . $svg_xml, 15, 30, '', '', '', '', '', 1, false);
    //$pdf->Write(0, $txt='', '', 0, 'L', true, 0, false, false, 0);
    print($pdf);
} elseif ($format == 'png'){
    header('Content-Type: image/png');
    header('Content-Disposition: attachment; filename="zostera.png"');
}


?>