<?php

namespace App\Libraries;

// require('vendor/autoload.php');
// require('options.php');
// require('cv_header.php');

use Dompdf\Dompdf;
use Dompdf\Options;

use App\Libraries\CV_Header as CV_Header;

class CV_PDF
{
    public $cv_header;
    public $file_binary;

    function __construct($cv_info) {
        // var_dump($cv_info);
        // die();

        $header = $cv_info['header'];
        $this->cv_header = new CV_Header($header);

        // var_dump($this->cv_header);
        // die();

        $this->createPDF();
    }

    public function createPDF() {

        $name = '<p><strong>Name: </strong>' . $this->cv_header->getName() . '</p>';
        $email = '<p><strong>Email: </strong>' . $this->cv_header->getEmail() . '</p>';
        $phone_number = '<p><strong>Phone Number: </strong>' . $this->cv_header->getPhoneNumber() . '</p>';
        $address = '<p><strong>Address: </strong>' . $this->cv_header->getAddress() . '</p>';

        ob_start();
        ?>
            <html>
                <head>
                    <meta charset='utf-8'>
                    <style>
                        body {
                            font-family: 'Open Sans', sans-serif;
                        }
                        .highlight {
                            color: #00D3A2;
                        }
                        h1 {
                            font-size: 25px;
                            margin: 0 0 10px 0;
                            max-width: 60%;
                        }
                        table {
                            table-layout: fixed;
                            width: 100%;
                        }
                        td {
                            padding: 0;
                            margin: 0;
                        }
                        p {
                            margin: 0;
                        }
                        .bt {
                            border-top: 3px solid #000;
                            padding-top: 15px;
                        }
                    </style>
                </head>
                <body>
                    <table>
                        <tbody>
                            <tr>
                                <td style="width: 50%;">
                                    <h1><?php echo $this->cv_header->getName(); ?></h1>
                                </td>
                                <td style="width: 50%;" class="bt">
                                    <p><?php echo $this->cv_header->getAddress(); ?></p>
                                    <p class="highlight"><?php echo $this->cv_header->getPhoneNumber(); ?></p>
                                    <p class="highlight"><?php echo $this->cv_header->getEmail(); ?></p>
                                </td>
                            </tr>
                        </tbody>
                    </table>
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
