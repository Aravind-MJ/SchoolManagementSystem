<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\ClassDetails;
use App\Faculty;
use App\User;
use App\RoleUsers;
use Input;
use DB;
use App\Encrypt;

class ClassDetailsController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        $time_shift = [1=>'Morning',2=>'Afternoon',3=>'Evening'];
        $allBatchdetails = DB::table('class_details')
                ->join('users','users.id','=', 'class_details.in_charge')
                 ->join('faculty_details','faculty_details.user_id', '=','users.id')     
                ->select('users.*', 'class_details.*')
                ->get();
        foreach($allBatchdetails as $Batchdetails){
             $Batchdetails->enc_id = Encrypt::encrypt($Batchdetails->id);
//             $Batchdetails->time_shift = $time_shift[$Batchdetails->time_shift];
        }

        return View('Classdetails.list_Classdetails', compact('allBatchdetails'));
    }

        
    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {
        $users = DB::table('users')
                  ->join('faculty_details','faculty_details.user_id', '=','users.id')              
                  ->select('users.id','first_name','last_name')
                  ->get();
        $data=array();
        foreach($users as $each){
            $data[$each->id]=$each->first_name.' '.$each->last_name;
        }
        $users=$data;
//          
//                \App\User::lists('first_name','last_name', 'id');
//      dd($users);
        return view('Classdetails.add_Classdetails', compact('Batchdetails','in_charge','users','id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Requests\PublishClassdetailsRequest $requestData) {
        $user = new \App\User;
        $user->first_name = $requestData['first_name'];
        $user->last_name  =$requestData['last_name'];
        $time_shift = ['morning'=>1,'afternoon'=>2,'evening'=>3];



        // Assign the role to the users
        {
            $Batchdetails = new \App\ClassDetails;
            $Batchdetails->class = $requestData['class'];
              $Batchdetails->division = $requestData['division'];
//            $Batchdetails->time_shift = $time_shift[strtolower($requestData['time_shift'])];
            $Batchdetails->year = $requestData['year'];
            $Batchdetails->in_charge = $requestData['in_charge'];
        
        $Batchdetails->save();
        }
 
      if ($Batchdetails->save()) {
            return redirect()->route('ClassDetails.create')
                             ->with('flash_message', 'New Class  added successfully.')
                             ->withType('success');
        } else {
            return redirect()->route('ClassDetails.create')
                             ->with('flash_message', 'New Classcould not be succeeded.')
                             ->withType('Danger');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id) {
         $enc_id=$id;
        $time_shift = [1=>'morning',2=>'afternoon',3=>'evening'];
        $id = Encrypt::decrypt($id);
          $Batchdetails = DB::table('class_details')
                ->join('users', 'users.id', '=', 'class_details.in_charge')
                ->select('users.*', 'class_details.*')
                ->where('class_details.id', $id)
                ->first();
        //Redirecting to showBook.blade.php with $book variable
            $Batchdetails->time_shift = $time_shift[$Batchdetails->time_shift];
        

//         dd($Batchdetails);
        return View('Classdetails.Class_details', compact('Classdetails'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id) {
    $enc_id=$id;
     $id = Encrypt::decrypt($id);
        
    $Batchdetails = DB::table('class_details')
                ->join('users', 'users.id', '=', 'class_details.in_charge')  
                ->where('class_details.id', $id)
                ->select('users.*', 'class_details.*')
                ->first();
    
    
     $users = DB::table('users')
                  ->join('faculty_details','faculty_details.user_id', '=','users.id')              
                  ->select('users.id','first_name','last_name')
                  ->get();
        $data=array();
        foreach($users as $each){
            $data[$each->id]=$each->first_name.' '.$each->last_name;
        }
        $users=$data;
//        $users = \App\User::lists('first_name', 'id');
        return view('Classdetails.edit_Classdetails', compact('Batchdetails', 'in_charge', 'users', 'id'));
    }
//
////

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id, Requests\PublishClassdetailsRequest $requestData) {
        $time_shift = ['morning'=>1,'afternoon'=>2,'evening'=>3];
        $Batchdetails = \App\ClassDetails::find($id);
        $Batchdetails->class = $requestData['class'];
         $Batchdetails->division = $requestData['division'];
        $Batchdetails->year = $requestData['year'];
        $Batchdetails->in_charge = $requestData['in_charge'];

        $Batchdetails->save();
        return redirect()->route('ClassDetails.index')
                        ->withFlashMessage('ClassDetails Updated successfully!')
                        ->withType('success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id) {
         $enc_id=$id;
        $id = Encrypt::decrypt($id);
        \App\ClassDetails::find($id)->delete();

        //Redirecting to index() method
        return redirect()->route('ClassDetails.index');
    }  

}