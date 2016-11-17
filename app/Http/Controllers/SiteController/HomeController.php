<?php

namespace App\Http\Controllers\SiteController

use App\SiteModels\Blog;
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
        $banner = new Banner;
        $banner = $banner->get();
        $data= new Event;
        $data = $data->orderBy('created_at','DESC')
            ->limit(4)
            ->get();
        return view('frontend.home')->with('data',$data)->with('banner',$banner);
    }

    public function gallery($id){
        $event = new Event;
        $event = $event->find($id);
        $images= new Images;
        $data = $images->where([
            'event_id'=>$id,
            'deleted_at'=>null
        ])
            ->get();

        return view('frontend.gallery')->with('data',$data)->with('event',$event);
    }
    public function events(){
        $events= new Event;
        $data = $events
            ->orderBy('created_at','DESC')
            ->get();
        return view('frontend.events')->with('data',$data);
    }
    public function blogs(){
        $blogs= new Blog;
        $data = $blogs
            ->orderBy('created_at','DESC')
            ->get();
        foreach($data as $blog){
            $blog->blog_cont = strip_tags($blog->blog_cont);
        }
        return view('frontend.blogs')->with('data',$data);
    }
}
