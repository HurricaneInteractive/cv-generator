<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require('vendor/autoload.php');
require('classes/options.php');
require('classes/cv_header.php');

use Dompdf\Dompdf;
use Dompdf\Options;

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
    public $file_binary;

    function __construct($cv_info) {
        $header = $cv_info['header'];
        $this->cv_header = new CV_Header($header);

        $this->createPDF();
    }

    public function createPDF() {
        $html = '<div>';
        $html .= '<p>Name: ' . $this->cv_header->getName() . '</p>';
        // $html .= '<p>Email: ' . $this->cv_header['email'] . '</p>';
        $html .= '</div>';

        // var_dump($html);
    }
}
