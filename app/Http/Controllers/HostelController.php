<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use App\Batch;
use App\Student;
use App\User;
use App\Feetypes;
use App\Feedetails;
use Input;
use Validator;
use Sentinel;
Use Auth;
use DB;
use App\Encrypt;
use Illuminate\Support\Facades\Request;
use DateTime;
class HostelController extends Controller {

    
    public function index() {
        //select list of student
        $allStudents = DB::table('student_details')
                ->join('users', 'users.id', '=', 'student_details.user_id')
                
                ->join('batch_details', 'batch_details.id', '=', 'student_details.batch_id')
                
                ->select('users.*', 'student_details.*','batch_details.*')
                ->where('student_details.hostel', 'Yes')
                ->orderBy('student_details.created_at', 'DESC')
                ->get();
        foreach ($allStudents as $student) {
            $student->enc_id = Encrypt::encrypt($student->id);
            $student->enc_userid = Encrypt::encrypt($student->user_id);
        
        }
        //Fetch Batch Details
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
        return View('hostel.list_hostel', compact('allStudents', 'batch', 'id'));
    }

    public function create() {
        $allStudents = DB::table('student_details')
                ->join('users', 'users.id', '=', 'student_details.user_id')
                
                ->join('batch_details', 'batch_details.id', '=', 'student_details.batch_id')
                
                ->select('users.*', 'student_details.*','batch_details.*')
                ->where('student_details.hostel', 'no')
                ->orderBy('student_details.created_at', 'DESC')
                ->get();
        foreach ($allStudents as $student) {
            $student->enc_id = Encrypt::encrypt($student->id);
            $student->enc_userid = Encrypt::encrypt($student->user_id);
        
        }
        //Fetch Batch Details
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
        return View('hostel.list_day scholars', compact('allStudents', 'batch', 'id'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Requests\RegisterStudentRequest $requestData) {

        //store student data to student_details table
        $user = new User;
        $user->first_name = $requestData['first_name'];
        $user->last_name = $requestData['last_name'];
        $user->email = $requestData['email'];
        $user->password = \Hash::make($requestData['dob']);

        $input = array('email' => $user->email, 'password' => $requestData['dob'], 'first_name' => $user->first_name, 'last_name' => $user->last_name);

        $user = Sentinel::registerAndActivate($input);

        // Find the role using the role name
        $usersRole = Sentinel::findRoleByName('Users');

        // Assign the role to the users
        $usersRole->users()->attach($user);

        $student = new Student;
        $student->batch_id = $requestData['batch_id'];
//        $student->user_id = $user['id'];
//        $student->gender = $requestData['gender'];
//        $student->dob = date('Y-m-d', strtotime($requestData['dob']));
//        
//          $feetypes->total_fee= $requestData['total_fee'];

//        $this->validate($requestData['photo'], [
//
//            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
//        ]);

    }

    public function selectStudentPost(SelectBatchRequest $request)
    {
        return $this->selectStudentCore(Encrypt::decrypt($request['batch']));
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function show($id) {

	
	$queryhostel = DB::table('student_details')->where('user_id', $id)->update(['hostel' => 'yes']);
      
        if ($queryhostel==1) {
            return redirect()->route('Hostel.index')
                            ->withFlashMessage('student Turned into Hostelate  !')
                            ->withType('success');
        } else {
            return redirect()->route('Hostel.index')
                            ->withFlashMessage('Student Transfer Failed!')
                            ->withType('danger');
        }
        
    }

    public function edit($id) {

		$queryhDBostel = DB::table('student_details')->where('user_id', $id)->update(['hostel' => 'no']);
      
        if ($queryhDBostel==1) {
            return redirect()->route('Hostel.index')
                            ->withFlashMessage('student Turned into Day scholars  !')

                            ->withType('success');
        } else {
            return redirect()->route('Hostel.index')
                            ->withFlashMessage('Student Transfer Failed!')
                            ->withType('danger');
        }
        

     
    }
    public function update($id) {
        

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id) {
//        $enc_id = $id;
//        $now = new DateTime();
//        DB::table('users')->where('id', $user_id)->skip(1)->take(1)->update(['deleted_at' => $now]);
//        Student::find($id)->delete();
//        $id = Encrypt::decrypt($id);
//        //find result by id and delete 
//       $student = DB::table('student_details')
//                ->select('user_id')
//                ->join('fee_types','fee_types.id','=', 'fee_types.id')
//                ->where('student_details.id','fee_types.*', $id)
//                ->first();
//
//        $user_id = $student->user_id;
////        User::find($user_id)->delete();
//        //Redirecting to index() method
//        return Redirect::back();
    }

    public function search() {

        // Gets the query string and batch from our form submission 

        $search = Request::input('param2');
       $selectedBatch = $batch = Request::input('param1');

        // Returns an array of articles that have the query string located somewhere within 

        $query = DB::table('student_details')
                ->join('users', 'users.id', '=', 'student_details.user_id')
                
                ->join('batch_details', 'batch_details.id', '=', 'student_details.batch_id')
                
                ->select('users.*', 'student_details.*','batch_details.*')
                ->where('student_details.hostel', 'no')
                ->orderBy('student_details.created_at', 'DESC');
          
        //Fetch Batch Details
   

        if ($batch != 0) {
            $query->where('student_details.batch_id', $batch);
        }
              
        $allStudents = $query->get();
        foreach ($allStudents as $student) {
            $student->enc_id = Encrypt::encrypt($student->id);
            $student->enc_userid = Encrypt::encrypt($student->user_id);
                
        }
        //Fetch Batch Details
        $batch = DB::table('batch_details')
                ->select('id', 'batch')              
                ->get();
        $data = array();
        foreach ($batch as $batch) {
           $data[$batch->id] = $batch->batch;
        }
        $batch = $data;
        
        // returns a view and passes the view the list of articles and the original query.
//        return route('Student.index');
        return View('hostel.list_day scholars', 
            ['allStudents' => $allStudents, 
            'batch' => $batch, 'selbatch' => $selectedBatch]
        );
    }
    
    
    public function hostelsearch() {

        // Gets the query string and batch from our form submission 

        $search = Request::input('param2');
      $selectedBatch = $batch = Request::input('param1');

        // Returns an array of articles that have the query string located somewhere within 

        $query = DB::table('student_details')
                ->join('users', 'users.id', '=', 'student_details.user_id')
                
                ->join('batch_details', 'batch_details.id', '=', 'student_details.batch_id')
                
                ->select('users.*', 'student_details.*','batch_details.*')
                ->where('student_details.hostel', 'yes')
                ->orderBy('student_details.created_at', 'DESC');
               
//        foreach ($allStudents as $student) {
//            $student->enc_id = Encrypt::encrypt($student->id);
//            $student->enc_userid = Encrypt::encrypt($student->user_id);
        
        
        //Fetch Batch Details
   

        if ($batch != 0) {
            $query->where('student_details.batch_id', $batch);
        }
              
        $allStudents = $query->get();
        foreach ($allStudents as $student) {
            $student->enc_id = Encrypt::encrypt($student->id);
            $student->enc_userid = Encrypt::encrypt($student->user_id);
                
        }
        //Fetch Batch Details
        $batch = DB::table('batch_details')
                ->select('id', 'batch')              
                ->get();
        $data = array();
        foreach ($batch as $batch) {
           $data[$batch->id] = $batch->batch;
        }
        $batch = $data;
        
        // returns a view and passes the view the list of articles and the original query.
//        return route('Student.index');
        return View('hostel.list_hostel', 
            ['allStudents' => $allStudents, 
            'batch' => $batch, 'selbatch' => $selectedBatch]
        );
    }


}

