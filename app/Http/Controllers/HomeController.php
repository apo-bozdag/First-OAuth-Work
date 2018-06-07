<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \Softon\LaravelFaceDetect\Facades\FaceDetect;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function face(){
        return $crop_params = FaceDetect::extract("https://vignette.wikia.nocookie.net/theamazingworldofgumball/images/3/35/Face_will_smith.png/revision/latest?cb=20131010204620")->face_found;
    }
}
