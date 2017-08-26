<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require('classes/options.php');
require('classes/cv_header.php');

/*
    use Dompdf\Dompdf;
    use Dompdf\Options;

    $html = '<div>Hello</div>';

    if ( get_magic_quotes_gpc() )
        $html = stripslashes($html);

    $dompdf = new Dompdf();
    $dompdf->load_html($html);
    $dompdf->render();
    $dompdf->stream("sample.pdf");
*/

class CV_PDF
{
    public $cv_header;

    function __construct($cv_headerInformation = null) {
        $this->cv_header = new CV_Header();
    }
}
