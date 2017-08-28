<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request as Request;
use Illuminate\Htpp\Response as Response;

class ResumeController extends Controller
{
    public function __construct() {
        
    }

    public function makeResume(Request $request) {

        $class = new MyClass;
        $is_ok($class->is_ok());
        // $is_ok = ($cv->is_ok());
        $name = $request->input('header')['name'];

        return json_encode(array( 'name' => $name, 'cv' => 'yay' ));
    }

}
