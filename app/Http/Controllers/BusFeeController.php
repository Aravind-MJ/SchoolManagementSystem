<?php
namespace App\Http\Controllers;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Support\Facades\Request;
use App\Http\Controllers\Controller;
use App\Buses;
use App\Busfee;
use App\Http\Student;
use App\User;
use App\ClassDetails;
use DB;
use App\Http\Requests\CreateBusFeeRequest;
class BusFeeController extends Controller {

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
    
        return view('transport.add_fee', compact('batch','batch_id','users','buses','clasz','division'));
 
   } 
   public function store(CreateBusFeeRequest $requestData) {
        //dd($requestData);
        try{
        //store bus in create bus table
        $busfee = new Busfee;
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

        $busfee->batch = $batch_id;
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
                ->join('class_details','class_details.id','=','bus_fee.batch')
                ->select('bus_fee.*','class_details.class','class_details.division','users.first_name','users.last_name','buses.bus_no')
                ->orderBy('bus_fee.id')
                ->get();
        return View('transport.list_fee', compact('busfee'));
    }
    public function edit($id) {
        $busfees = new Busfee;
        $busfees = $busfees->find($id);
        $batch = new ClassDetails;
        $batch = $batch->fetch();
        $batch_id = $busfees->batch;
        $class = new ClassDetails;
        $class = $class->find($batch_id);
        $clasz = $class->class;
        $division = $class->division;
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
        
        $buses = DB::table('buses')
                  ->select('id','bus_no')
                  ->get();
        $data=array();         
        foreach($buses as $allbuses){
            $data[$allbuses->id]=$allbuses->bus_no;
        }
        $buses = $data;
    return view('transport.edit_fee', compact('batch','clasz','division','users','buses','busfees'));
    }
    public function update($id, CreateBusFeeRequest $requestData) {
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
        $busfee = BusFee::find($id);
        $busfee->batch = $batch_id;
        $busfee->student_id = $requestData['student_id'];
        $busfee->bus_id = $requestData['bus_id'];
        $busfee->fee = $requestData['fee'];
        $busfee->save();
      }catch(Exception $e){
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