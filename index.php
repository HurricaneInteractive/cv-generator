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
        <link href="https://fonts.googleapis.com/css?family=Playfair+Display:400,700" rel="stylesheet">
		<title>CV Generator</title>

        <link rel="stylesheet" href="style.css" />
    </head>
    <body>
        <div id="output"></div>
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
        <button onClick="generate()">Generate Resume</button>
        <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script>
            function generate() {
                let name = jQuery('#resume--name em').text();
                let email = jQuery('#resume--email em').text();

                let header = {
                    'name': name,
                    'email': email
                };

                axios({
                    url: 'initGeneration.php',
                    method: 'post',
                    data: {
                        header: header
                    }
                })
                .then(function(response) {
                    $('#output').append('<pre>' + response.data + '</pre>');
                    console.log(response.data);
                })
                .catch(function(error) {
                    alert(error);
                });

            }
        </script>
    </body>
</html>
