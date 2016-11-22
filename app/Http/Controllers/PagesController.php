<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Sentinel;
use Illuminate\Support\Facades\Redirect;
use DB;
use App\Encrypt;

class PagesController extends Controller {

    public function getLogin() {
        return view('pages.index');
    }

    public function getHome() {
        if (Sentinel::check()) {
            $id = Sentinel::getUser()->id;
            //Get results by targeting id
            $student = DB::table('student_details')
                    ->join('users', 'users.id', '=', 'student_details.user_id')
                    ->join('class_details', 'class_details.id', '=', 'student_details.batch_id')
                    ->select('users.*', 'student_details.*', 'class_details.class','class_details.division')
                    ->where('users.id', $id)
                    ->first();
                    //dd($student);
            $student->enc_userid = Encrypt::encrypt($student->user_id);
            unset($student->user_id);
            return View('protected.standardUser.home', compact('student'));
        }
    }

    public function getNotice() {
        //Select all records from notice table
        $users = Sentinel::getUser();
        if(!$users->inRole('users')){
            return redirect('/');
        }
        $id = $users->id;
        $student = DB::table('student_details')
                ->select('batch_id')->where('user_id', $id)
                ->first();
        $allNotice = DB::table('notice')
                ->join('class_details', 'class_details.id', '=', 'notice.batch_id')
                ->where('batch_id', $student->batch_id)
                ->select('notice.*', 'class_details.class','class_details.division')
                ->orderBy('created_at','DESC')
                ->limit(10)
                ->get();
        return View('protected.standardUser.notice', compact('allNotice'));
//        return view('pages.about');
    }

    public function getAssignment() {
        //Select all records from assignment table
        
        $users = Sentinel::getUser();
        if(!$users->inRole('users')){
            return redirect('/');
        }
        $id = $users->id;
        $student = DB::table('student_details')
                ->select('batch_id')->where('user_id', $id)
                ->first();
        $allAssignment = DB::table('assignment')
                ->join('class_details', 'class_details.id', '=', 'assignment.batch_id')
                ->where('batch_id', $student->batch_id)
                ->select('assignment.*', 'class_details.class','class_details.division')
                ->orderBy('sdate','DESC')
                ->limit(10)
                ->get();
        
        return View('Assignment.list_assignment', compact('allAssignment'));
//        return view('pages.about');
    }

    public function getContact() {
        return view('pages.contact');
    }
    public function pageconstruction()
    {
        return view ('construction');
    }


}
