<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request as Request;
use Illuminate\Htpp\Response as Response;
use JavaScript;
use Illuminate\Support\Facades\Auth;

use App\Libraries\CV_PDF as CV_PDF;

class ResumeController extends Controller
{
    public function __construct() {
        // $this->middleware('auth');
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

    public function create()
    {
        JavaScript::put([
            'id' => Auth::user()->id
        ]);
        return view('cv')->with('nav', 'false');
    }

}
