<?php

namespace App\Http\Controllers;

use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Support\Facades\Request;
use App\Http\Controllers\Controller;
use App\Buses;
use App\Busfee;
use App\Http\Student;
use App\User;
use App\Batch;
use DB;
use App\Http\Requests\CreateBusFeeRequest;


class BusFeeController extends Controller {

   public function create() {
   		$batch_id = Request::input('param1');	
   		$batch = DB::table('batch_details')
                ->select('id', 'batch')
                ->orderBy('batch_details.created_at', 'ASC')
                ->get();

        $data = array();
        foreach ($batch as $batch) {
           $data[$batch->id] = $batch->batch;
        }
        $batch = $data;

        $users = DB::table('users')
                  ->join('student_details','student_details.user_id', '=','users.id')
                  ->where(['users.deleted_at'=>null,'student_details.batch_id'=>$batch_id])         
                  ->select('users.id','first_name','last_name')
                  ->orderBy('users.created_at', 'ASC')
                  ->get();
          $data=array();
          foreach($users as $each){
              $data[$each->id]=$each->first_name.' '.$each->last_name;
          }
        $users=$data;	

   		if($batch_id==null){

      
   		}else{
   			$users = DB::table('users')
                  ->join('student_details','student_details.user_id', '=','users.id')
                  ->where(['users.deleted_at'=>null,'student_details.batch_id'=>$batch_id])         
                  ->select('users.id','first_name','last_name')
                  ->get();
        	$data=array();
        	foreach($users as $each){
            	$data[$each->id]=$each->first_name.' '.$each->last_name;
        	}
        $users=$data;
   		}
        
       	$buses = DB::table('buses')
                  ->select('id','bus_no')
                  ->get();
        $data=array();         
        foreach($buses as $buses){
            $data[$buses->id]=$buses->bus_no;
        }
        $buses = $data;

 		return view('transport.create_fee', compact('batch','batch_id','users','buses'));
 
   }

   public function store(CreateBusFeeRequest $requestData) {
    	//dd($requestData);
    	try{
        //store bus in create bus table
        $busfee = new Busfee;
        $busfee->batch = $requestData['param1'];
        $busfee->student_id = $requestData['student_id'];
        $busfee->bus_id = $requestData['bus_id'];
        $busfee->fee = $requestData['fee'];

        $busfee->save();
    	}
    catch(Exception $e){
    	 return redirect()->back()
                        ->withFlashMessage('Bus Fee Creation Failed!')
                        ->withType('danger');
    	}
        return redirect()->back()
                        ->withFlashMessage('Bus Fee Created Successfully!')
                        ->withType('success');
    }

    public function show($id) {
    }

    public function index(){

    	$busfee = DB::table('bus_fee')
    			->join('users','users.id','=','bus_fee.student_id')
    			->join('student_details','student_details.user_id', '=','users.id')
    			->join('buses','buses.id','=','bus_fee.bus_id')
    			->join('batch_details','batch_details.id','=','bus_fee.batch')
    			->select('bus_fee.*','batch_details.batch','users.first_name','users.last_name','buses.bus_no')
                ->get();


        return View('transport.list_fee', compact('busfee'));
    }

    public function edit($id) {
        $busfees = new Busfee;
        $busfees = $busfees->find($id);
        $batch_id = Request::input('param1');

        $batch = DB::table('batch_details')
                ->select('id', 'batch')
                ->orderBy('batch_details.created_at', 'ASC')
                ->get();
//        $batch = Batch::lists('batch', 'id')->prepend('Select Batch', '');
        $data = array();
        foreach ($batch as $batch) {
           $data[$batch->id] = $batch->batch;
        }
        $batch = $data;
          

      if($batch_id==null){
        $batch_id = $busfees->batch;

        $users = DB::table('users')
                  ->join('student_details','student_details.user_id', '=','users.id')
                  ->where(['users.deleted_at'=>null,'student_details.batch_id'=>$busfees->batch])         
                  ->select('users.id','first_name','last_name')
                  ->get();
          $data=array();
          foreach($users as $each){
              $data[$each->id]=$each->first_name.' '.$each->last_name;
          }
        $users=$data;
        $data=array();
      }else{
        $batch_id = $busfees->batch;
        $users = DB::table('users')
                  ->join('student_details','student_details.user_id', '=','users.id')
                  ->where(['users.deleted_at'=>null,'student_details.batch_id'=>$batch_id])         
                  ->select('users.id','first_name','last_name')
                  ->get();
          $data=array();
          foreach($users as $each){
              $data[$each->id]=$each->first_name.' '.$each->last_name;
          }
        $users=$data;
      }
        
        $buses = DB::table('buses')
                  ->select('id','bus_no')
                  ->get();
        $data=array();         
        foreach($buses as $allbuses){
            $data[$allbuses->id]=$allbuses->bus_no;
        }
        $buses = $data;
    return view('transport.edit_fee', compact('batch','batch_id','users','buses','busfees'));
    }

    public function update($id, CreateBusFeeRequest $requestData) {
        //update values in notice
      try{
        $buses = new Busfee;
        $buses = $buses->find($id);
        $buses->batch = $requestData['param1'];
        $buses->student_id = $requestData['student_id'];
        $buses->bus_id = $requestData['bus_id'];
        $buses->fee = $requestData['fee'];

        $buses->save();
      }

        catch(Exception $e){
       return redirect()->route('BusFee.index')
                        ->withFlashMessage('Bus Fee Edition Failed!')
                        ->withType('danger');
      }
        return redirect()->route('BusFee.index')
                        ->withFlashMessage('Bus Fee Edited Successfully!')
                        ->withType('success');
    }

    public function destroy($id) { 
        $busfee = new Busfee;
        $busfee = $busfee->find($id)->delete();

        return redirect()->back()
                        ->withFlashMessage('Deleted Successfully!')
                        ->withType('success');
    }


}