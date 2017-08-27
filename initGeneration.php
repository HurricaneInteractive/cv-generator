<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require('generatePDF.php');

// Get "$_POST" object from data passed to axios call
$data = json_decode(file_get_contents("php://input"), true);
$header = $data['header'];

$cv_header = array(
    'name' => $header['name'],
    'email' => $header['email']
);

$cv = new CV_PDF(array(
    'header' => $cv_header
));

var_dump($cv->cv_header);
die();

die();