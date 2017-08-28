<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request as Request;
use Illuminate\Htpp\Response as Response;

use App\Libraries\CV_PDF as CV_PDF;

class ResumeController extends Controller
{
    public function __construct() {
        
    }

    public function makeResume(Request $request) 
    {   
        $header = $request->input('header');

        $cv_header = array(
            'name' => $header['name']
        );

        $cv = new CV_PDF(array(
            'header' => $cv_header
        ));

        // return json_encode(array( 'name' => 'Adriaan', 'cv' => $cv ));
        die();
    }

}
