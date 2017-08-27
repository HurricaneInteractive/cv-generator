<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require('vendor/autoload.php');
require('classes/options.php');
require('classes/cv_header.php');

use Dompdf\Dompdf;
use Dompdf\Options;

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

        $name = '<p><strong>Name: </strong>' . $this->cv_header->getName() . '</p>';
        $email = '<p><strong>Name: </strong>' . $this->cv_header->getEmail() . '</p>';

        ob_start();
        ?>
            <html>
                <head>
                    <meta charset='utf-8'>
                    <style>
                        strong {
                            color: #d20962;
                        }
                    </style>
                </head>
                <body>
                    <?php 
                        echo $name;
                        echo $email; 
                    ?>
                </body>
            </html>
        <?php
        $html = ob_get_clean();

        $resumeFilename = $this->cv_header->getName() . '-resume.pdf';

        $options = new Options();
        $options->set('isPhpEnabled', true);

        $dompdf = new Dompdf($options);
        $dompdf->load_html($html);
        $dompdf->render();
        $dompdf->stream($resumeFilename);
    }
}
