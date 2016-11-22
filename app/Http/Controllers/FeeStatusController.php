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
        
        $buses = DB::table('buses')
                  ->select('id','bus_no')
                  ->get();
        $data=array();         
        foreach($buses as $buses){
            $data[$buses->id]=$buses->bus_no;
        }
        $buses = $data;
        return view('transport.add_feestatus', compact('batch','batch_id','users','buses'));
 
   } 
   public function store(CreateFeeStatusRequest $requestData) {
        try{
        //store bus in create bus table
        $feestatus = new Feestatus;
        $feestatus->batch = $requestData['param1'];
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
                ->join('batch_details','batch_details.id','=','fee_status.batch')
                ->select('fee_status.*','batch_details.batch','users.first_name','users.last_name')
                ->orderBy('fee_status.id')
                ->get();
        return View('transport.list_feestatus', compact('feestatus'));   
    }
   
    public function edit($id){
       $feestats = new Feestatus;
        $feestats = $feestats->find($id);
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
        $batch_id = $feestats->batch;
        $users = DB::table('users')
                  ->join('student_details','student_details.user_id', '=','users.id')
                  ->where(['users.deleted_at'=>null,'student_details.batch_id'=>$feestats->batch])         
                  ->select('users.id','first_name','last_name')
                  ->get();
          $data=array();
          foreach($users as $each){
              $data[$each->id]=$each->first_name.' '.$each->last_name;
          }
        $users=$data;
        $data=array();
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
        foreach($buses as $allbuses){
            $data[$allbuses->id]=$allbuses->bus_no;
        }
        $buses = $data;
    return view('transport.edit_feestatus', compact('batch','batch_id','users','buses','busfees'));
    }
    public function destroy($id) { 
        $feestatus = new Feestatus;
        $feestatus = $feestatus->find($id)->delete();
        return redirect()->back()
                        ->withFlashMessage('Deleted Successfully!')
                        ->withType('success');
    }
}