<?php
require_once('vendor/tecnickcom/tcpdf/tcpdf.php');

$fontFile = 'vendor\tecnickcom\tcpdf\fonts\Roboto-Regular.ttf'; // Replace this with the actual path to your TTF file

try {
    $fontname = TCPDF_FONTS::addTTFfont($fontFile, 'TrueTypeUnicode', '', 32);
    echo "Font converted and added as: " . $fontname;
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}

// require_once('vendor\tecnickcom\tcpdf\examples\tcpdf_include.php');
// $tcpdf = new TCPDF();
// $fontFile = 'vendor\tecnickcom\tcpdf\fonts\Roboto-Regular.ttf';
// $tcpdf->addTTFfont($fontFile, 'TrueTypeUnicode', '', 32);
?>

