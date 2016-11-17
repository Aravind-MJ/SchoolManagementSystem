<?php

namespace App\Http\Controllers;

use App\Blog;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\SiteModels\Event;
use App\SiteModels\Images;
use App\SiteModels\Banner;
use Illuminate\Support\Facades\DB;
 
class HomeController extends Controller
 {
    /**
     * Create a new controller instance.
     *
     * @return void
     */
     public function __construct()
     {
        $this->middleware('auth',['only'=>['index']]);
     }
 
     /**
      * Show the application dashboard.
      *
      * @return \Illuminate\Http\Response
      */
     public function index()
     {

        $title = 'Admin | Home';
        $data = DB::table('blog')->where('deleted_at', '=', NULL)->count();
        $eventCount = DB::table('event')->where('deleted_at', '=', NULL)->count();
       
        return view('backend.home')->with('data',$data)->with('eventCount',$eventCount);
       
    }

    public function root(){
       
        return view('frontend.index');
    }

    public function gallery(){
        return view('frontend.gallery');
    }
    
    public function blogs(){
       return view('frontend.blogs');
    }

     public function about(){
       return view('frontend.about');
    }

    public function contact(){
       
        return view('frontend.contact');
    }

    public function login(){
       
        return view('frontend.index');
    }
}
