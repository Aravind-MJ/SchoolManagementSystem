<?php

namespace App\Http\Controllers;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use App\Batch;
use App\Http\Requests\ActivityDetailsRequest;
use App\ActivityTypes;
use App\ActivityDetails;
use App\User;
use Illuminate\Support\Facades\Request;
use App\Encrypt;
use App\ClassDetails;

class ActivityDetailsController extends Controller {

   public function index() {
        $allActivityDetails = new ActivityDetails;
        $allActivityDetails = $allActivityDetails
                            ->join('activity_types','activity_types.id', '=', 'activity_details.activity_id')
                            ->join('class_details', 'class_details.id', '=', 'activity_details.batch_id')
                            ->join('users','users.id', '=','activity_details.student_id')
                            ->select('activity_details.*','users.first_name','users.last_name','class_details.class','class_details.division','activity_types.activity_type')

                            ->get();
                           // dd($allActivityDetails);
                            
        return view('Activitydetails.list_activitydetails', compact('allActivityDetails'));
    }

     public function destroy($id) { 
      $activity_details = new ActivityDetails;
      $activity_details = $activity_details->find($id)->delete(); 

      return redirect('ActivityDetails')
             ->withFlashMessage('Activity Detail Deleted Successfully!')
             ->withType('success');
    }

    public function create() {
           $activity_types = new ActivityTypes;
           $activity_types = $activity_types
                          ->select('id','activity_type')
                          ->get();
           $data = array();
           foreach ($activity_types as $activity_types) {
                  $data[$activity_types->id] = $activity_types->activity_type;
                 }

        $activity_types = $data;
       
        $batch_id = Request::input('class');
        //dd($batch_id);
        //$batch = new Batch;
        $batch = new ClassDetails;
        $batch = $batch->fetch();
        
   

        if($batch_id==null){
            $users = array();
        }else{
          $users = new User;
            $users = $users
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
            return view('Activitydetails.add_activitydetails', compact('batch','batch_id','activity_types','users'));
 
   }

 public function store(ActivityDetailsRequest $requestData) {
      //dd($requestData);
      try{
        //store bus in create bus table
          $ActivityDetails = new ActivityDetails;

    $class = $requestData['class'];
    $division = $requestData['division'];
    $clazdiv = $this->claz
    ->select('id')
    ->where(['class' =>$class, 'division' => $division])
    ->first();

          $ActivityDetails->activity_id = $requestData['activity_types'];
          $ActivityDetails->batch_id = $requestData['param1'];
          $ActivityDetails->student_id = $requestData['student_id'];
          $ActivityDetails->remark = $requestData['remark'];
          $ActivityDetails->save();
      }
    catch(Exception $e){
             return redirect('ActivityDetails')
                              ->withFlashMessage('Activity Detail Addition Failed!')
                              ->withType('danger');
      }
             return redirect('ActivityDetails')
                              ->withFlashMessage('Activity Detail Added Successfully!')
                              ->withType('success');
    }
    public function show($id)
    {
        //    }
    }

    public function update($id,ActivityDetailsRequest $requestData)
      {
         try{
          $ActivityDetails = ActivityDetails::find($id);
          $ActivityDetails->activity_id = $requestData['activity_types'];
          $ActivityDetails->batch_id= $requestData['param1'];
          $ActivityDetails->student_id = $requestData['student_id'];
          $ActivityDetails->remark = $requestData['remark'];
          $ActivityDetails->save();
        

      }
       catch(Exception $e){
             return redirect()->back()
                              ->withFlashMessage('Activity Detail Updation Failed!')
                              ->withType('danger');
      }
             return redirect()->route('ActivityDetails.index')
                          ->withFlashMessage('ActivityDetails Updated successfully!')
                          ->withType('success');
    }

    public function edit($id)
      {
          $allActivityDetails = new ActivityDetails; 
          $allActivityDetails =  $allActivityDetails->find($id);       
          $activity_types = new ActivityTypes;
           $activity_types = $activity_types
                          ->select('id','activity_type')
                          ->get();
           $data = array();
           foreach ($activity_types as $activity_types) {
                  $data[$activity_types->id] = $activity_types->activity_type;
                 }

        $activity_types = $data;
          $batch_id = Request::input('param1');
          $batch = new Batch;
          $batch = $batch
                ->select('id','batch')
                ->get();
        $data = array();
        foreach ($batch as $batch) {
           $data[$batch->id] = $batch->batch;
        }
        $batch = $data;
            

        if($batch_id==null){
            $batch_id = $allActivityDetails->batch_id;
        }else{
            $allActivityDetails->batch_id = $batch_id;
        }
            $users = new User;
            $users = $users
                  ->join('student_details','student_details.user_id', '=','users.id')
                  ->where(['users.deleted_at'=>null,'student_details.batch_id'=>$batch_id])         
                  ->select('users.id','first_name','last_name')
                  ->get();
            $data=array();
            foreach($users as $each){
                $data[$each->id]=$each->first_name.' '.$each->last_name;
            }
        $users=$data;

        return view('ActivityDetails.edit_activitydetails',compact('allActivityDetails','activity_id','activity_types','batch_id','batch','id','users'));
   
      }

  }



