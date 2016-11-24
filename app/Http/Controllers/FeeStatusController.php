<?php
namespace App\Http\Controllers;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Support\Facades\Request;
use App\Http\Controllers\Controller;
use App\Buses;
use App\Feestatus;
use App\Http\Student;
use App\User;
use App\Batch;
use App\ClassDetails;
use DB;
use App\Http\Requests\CreateBusFeeRequest;
use App\Http\Requests\CreateFeeStatusRequest;
class FeeStatusController extends Controller {
   public function create() {

           $batch = new ClassDetails;
        $batch = $batch->fetch();
        //$batch_id = null;
        $clasz = Request::input('class'); 
        $division =Request::input('division');
        if($division!=null){
           $class = new ClassDetails;
                $class = DB::table('class_details') 
                      ->select('id')
                      ->where(['class'=> $clasz,'division'=> $division])
                      ->first();
                if($class != null){
                  $batch_id = $class->id; 
                }else{
                 return redirect()->back()
                              ->withFlashMessage(''.$clasz.' '.$division.' Not Found !!')
                              ->withType('danger');   
                }

        }  
        

        if(!isset($batch_id)){
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
        
        return view('transport.add_feestatus', compact('batch','batch_id','users','buses','clasz','division'));
 
   } 
   public function store(CreateFeeStatusRequest $requestData) {
        try{
        //store bus in create bus table
        $feestatus = new Feestatus;
        $class = $requestData['class'];
        $division = $requestData['division'];
        $claz = new ClassDetails;
        $clazdiv = $claz
          ->select('id')
          ->where(['class' =>$class, 'division' => $division])
          ->first();
        if($clazdiv == TRUE){
          $batch_id = $clazdiv->id;
        }

        $feestatus->batch = $batch_id;
        $feestatus->student = $requestData['student_id'];
        $feestatus->month = $requestData['month'];
        $feestatus->year = $requestData['year'];
        $feestatus->status = $requestData['fee_status'];

        $feestatus->save();
        }
    catch(Exception $e){
         return redirect()->back()
                        ->withFlashMessage('Fee Status Creation Failed!')
                        ->withType('danger');
        }
        return redirect()->back()
                        ->withFlashMessage('Fee Status Created Successfully!')
                        ->withType('success');
    }
    public function show($id) {
    }
    public function index(){
        
      $feestatus = DB::table('fee_status')
                ->join('users','users.id','=','fee_status.student')
                ->join('student_details','student_details.user_id', '=','users.id')
                ->join('class_details','class_details.id','=','fee_status.batch')
                ->select('fee_status.*','class_details.class','class_details.division','users.first_name','users.last_name')
                ->orderBy('fee_status.id')
                ->get();
        return View('transport.list_feestatus', compact('feestatus'));   
    }
   
    public function edit($id){
        $feestatus = new Feestatus;
        $feestatus = $feestatus->find($id);
        $batch = new ClassDetails;
        $batch = $batch->fetch();
        $batch_id = $feestatus->batch;
        $class = new ClassDetails;
        $class = $class->find($batch_id);
        $clasz = $class->class;
        $division = $class->division;
        $users = DB::table('users')
                  ->join('student_details','student_details.user_id', '=','users.id')
                  ->where(['users.deleted_at'=>null,'student_details.batch_id'=>$feestatus->batch])         
                  ->select('users.id','first_name','last_name')
                  ->get();
          $data=array();
          foreach($users as $each){
              $data[$each->id]=$each->first_name.' '.$each->last_name;
          }
        $users=$data;
        $data=array();
      
    return view('transport.edit_feestatus', compact('batch','clasz','division','users','feestatus'));
    }
        public function update($id, CreateFeeStatusRequest $requestData) {
        //update values in notice
      try{
            $class = $requestData['class'];
            $division = $requestData['division'];
            $claz = new ClassDetails;
            $clazdiv = $claz
                    ->select('id')
                    ->where(['class' => $class, 'division' => $division])
                    ->first();
             if ($clazdiv == TRUE) {
                $batch_id = $clazdiv->id;
            }
        $feestatus = FeeStatus::find($id);
        $feestatus->batch = $batch_id;
        $feestatus->student = $requestData['student_id'];
        $feestatus->month = $requestData['month'];
        $feestatus->year = $requestData['year'];
        $feestatus->status = $requestData['fee_status'];
        $feestatus->save();
      }catch(Exception $e){
       return redirect()->route('FeeStatus.index')
                        ->withFlashMessage('Fee Status Edition Failed!')
                        ->withType('danger');
      }
        return redirect()->route('FeeStatus.index')
                        ->withFlashMessage('Fee Status Edited Successfully!')
                        ->withType('success');
    }
    public function destroy($id) { 
        $feestatus = new Feestatus;
        $feestatus = $feestatus->find($id)->delete();
        return redirect()->back()
                        ->withFlashMessage('Deleted Successfully!')
                        ->withType('success');
    }
}