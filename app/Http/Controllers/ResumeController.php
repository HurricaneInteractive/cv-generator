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
        $layout = $request->input('layout');
        $header = $request->input('header');
        $social_mediia = $request->input('social_media');
        $skills = $request->input('skills');

        $cv_header = array(
            'name' => $header['name'],
            'email' => $header['email'],
            'phone_number' => $header['phone_number'],
            'address' => $header['address'],
            'personal_website' => $header['personal_website']
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
