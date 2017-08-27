<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require('vendor/autoload.php');
require('options.php');
require('cv_header.php');

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
        $email = '<p><strong>Email: </strong>' . $this->cv_header->getEmail() . '</p>';

        ob_start();
        ?>
            <html>
                <head>
                    <meta charset='utf-8'>
                    <style>
                        strong {
                            color: #d20962;
                        }
                        .section-title {
                            width: 100%;
                            padding: 15px 20px;
                            color: white;
                            background-color: #F54D67;
                            font-size: 18px;
                            margin: 0 0 20px 0;
                        }
                    </style>
                </head>
                <body>
                    <div>
                        <h2 class="section-title">Details</h2>
                        <?php 
                            echo $name;
                            echo $email; 
                        ?>
                    </div>
                </body>
            </html>
        <?php
        $html = ob_get_clean();

        $resumeFilename = $this->cv_header->getName() . '-resume.pdf';

        $options = new Options();
        $options->set('isPhpEnabled', true);
        $options->set('defaultFont', 'helvetica');

        $dompdf = new Dompdf($options);
        $dompdf->load_html($html);
        $dompdf->render();
        $dompdf->stream($resumeFilename);
    }
}
