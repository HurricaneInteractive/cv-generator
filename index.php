<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    require('init.php');
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://fonts.googleapis.com/css?family=Nunito|Playfair+Display:400,700" rel="stylesheet">
		<title>CV Generator</title>

        <link rel="stylesheet" href="style.css" />
    </head>
    <body>
        <aside class="options-sidebar">
            <ul class="sidebar-nav">
                <li>
                    <a href="#" id="generate">Generate</a>
                </li>
            </ul>
        </aside>
        <div id="resume" class="page-a4">
            <div class="header">
                <div class="row">
                    <div class="col-md-3">
                        <p><strong>Name: </strong></p>
                    </div>
                    <div class="col-md-9" id="resume--name">
                        <p><em contentEditable="true">Aj</em></p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <p><strong>Email: </strong></p>
                    </div>
                    <div class="col-md-9" id="resume--email">
                        <p><em contentEditable="true">hello@email.com</em></p>
                    </div>
                </div>
            </div>
        </div>
        <!-- <script src="https://unpkg.com/axios/dist/axios.min.js"></script> -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script>
            $('#generate').on('click', function(e) {
                e.preventDefault();
                generate();
            });

            function generate() {
                let name = jQuery('#resume--name em').text();
                let email = jQuery('#resume--email em').text();

                let header = {
                    'name': name,
                    'email': email
                };

                $.ajax({
                    type: "POST",
                    url: 'initGeneration.php',
                    data: {
                        header: header
                    },
                    success: function(response, status, xhr) {
                        // check for a filename
                        var filename = "";
                        var disposition = xhr.getResponseHeader('Content-Disposition');
                        if (disposition && disposition.indexOf('attachment') !== -1) {
                            var filenameRegex = /filename[^;=\n]*=((['"]).*?\2|[^;\n]*)/;
                            var matches = filenameRegex.exec(disposition);
                            if (matches != null && matches[1]) filename = matches[1].replace(/['"]/g, '');
                        }

                        var type = xhr.getResponseHeader('Content-Type');
                        var blob = new Blob([response], { type: type });

                        if (typeof window.navigator.msSaveBlob !== 'undefined') {
                            // IE workaround for "HTML7007: One or more blob URLs were revoked by closing the blob for which they were created. These URLs will no longer resolve as the data backing the URL has been freed."
                            window.navigator.msSaveBlob(blob, filename);
                        } else {
                            var URL = window.URL || window.webkitURL;
                            var downloadUrl = URL.createObjectURL(blob);

                            if (filename) {
                                // use HTML5 a[download] attribute to specify filename
                                var a = document.createElement("a");
                                // safari doesn't support this yet
                                if (typeof a.download === 'undefined') {
                                    window.location = downloadUrl;
                                } else {
                                    a.href = downloadUrl;
                                    a.download = filename;
                                    document.body.appendChild(a);
                                    a.click();
                                }
                            } else {
                                window.location = downloadUrl;
                            }

                            setTimeout(function () { URL.revokeObjectURL(downloadUrl); }, 100); // cleanup
                        }
                    }
                });

            }
        </script>
    </body>
</html>
