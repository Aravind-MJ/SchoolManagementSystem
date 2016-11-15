<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use App\ClassDetails;
use DB;

class FeehostelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
         $users = DB::table('users')
                  ->join('student_details','student_details.user_id', '=','users.id')              
                  ->select('users.id','first_name','last_name')
                  ->get();
        $data=array();
     
        foreach($users as $each){
            $data[$each->id]=$each->first_name.' '.$each->last_name;
           
        }
        $users=$data;
          $batch = new Batch;
        $batch = $batch->fetch();
       return view('hostel.add_feedetails_for hostel', compact('student_id', 'Feedetails','batch', 'users','id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        
        $user = new \App\User;
        $user->first_name = $requestData['first_name'];
        $user->last_name  =$requestData['last_name'];
        
        
        // Assign the role to the users
        {
            $Batchdetails = new \App\Classdetails;
            $Batchdetails->class = $requestData['class'];
            $Batchdetails->year = date("Y/m/d", strtotime($requestData['year']));
            $Batchdetails->month = $requestData['month'];
          
            $Batchdetails->in_charge = $requestData['in_charge'];
        
        $Batchdetails->save();
        }
 
      if ($Batchdetails->save()) {
            return redirect()->route('BatchDetails.create')
                             ->with('flash_message', 'New Batch added successfully.')
                             ->withType('success');
        } else {
            return redirect()->route('BatchDetails.create')
                             ->with('flash_message', 'New Batch could not be succeeded.')
                             ->withType('Danger');
        }
    }
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
