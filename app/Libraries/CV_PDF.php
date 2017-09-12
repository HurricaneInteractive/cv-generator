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

        $header = $cv_info['header'];
        $this->cv_header = new CV_Header($header);

        $this->createPDF();
    }

    public function createPDF() {

        $personal_website = $this->cv_header->getPersonalWebsite();

        ob_start();
        ?>
            <html>
                <head>
                    <meta charset='utf-8'>
                    <style>
                        body {
                            font-family: 'Open Sans', sans-serif;
                        }
                        .highlight, a {
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
                        tr {
                            margin-bottom: 30px;
                        }
                        td {
                            padding: 0 0 35px;
                            margin: 0;
                        }
                        p {
                            margin: 0;
                            line-height: 1;
                        }
                        .bt {
                            border-top: 3px solid #000;
                            padding-top: 15px;
                        }
                        .vertt {
                            vertical-align: top;
                        }
                        .sub-heading h3 {
                            display: inline-block;
                            border-color: #00D3A2;
                            font-size: 18px;
                            padding-top: 10px;
                            margin: 0;
                            font-weight: normal;
                        }
                    </style>
                </head>
                <body>
                    <table>
                        <tbody>
                            <tr>
                                <td style="width: 50%;" class="vertt">
                                    <h1><?php echo $this->cv_header->getName(); ?></h1>
                                </td>
                                <td style="width: 50%;" class="bt vertt">
                                    <p><?php echo $this->cv_header->getAddress(); ?></p>
                                    <p class="highlight"><?php echo $this->cv_header->getPhoneNumber(); ?></p>
                                    <p class="highlight"><?php echo $this->cv_header->getEmail(); ?></p>
                                    <?php 
                                        if ($personal_website != null && $personal_website != '') {
                                            echo '<p class="highlight">' . $personal_website . '</p>';
                                        }
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 50%" class="vertt sub-heading">
                                    <h3 class="bt">Skills</h3>
                                </td>
                                <td style="width: 50%" class="bt vertt">

                                </td>
                            </tr>
                            <tr>
                                <td style="width: 50%" class="vertt sub-heading">
                                    <h3 class="bt">Experience</h3>
                                </td>
                                <td style="width: 50%" class="bt vertt">

                                </td>
                            </tr>
                            <tr>
                                <td style="width: 50%" class="vertt sub-heading">
                                    <h3 class="bt">Education</h3>
                                </td>
                                <td style="width: 50%" class="bt vertt">

                                </td>
                            </tr>
                            <tr>
                                <td style="width: 50%" class="vertt sub-heading">
                                    <h3 class="bt">Awards</h3>
                                </td>
                                <td style="width: 50%" class="bt vertt">

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
