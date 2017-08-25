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
		<title>CV Generator</title>
    </head>
    <body>
        <?php
            $cv = new CV_PDF();
            echo $cv->theName();
        ?>
        <script async src="https://unpkg.com/axios/dist/axios.min.js"></script>
    </body>
</html>
