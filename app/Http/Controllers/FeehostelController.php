<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use App\ClassDetails;
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

class FeehostelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $allStudents = DB::table('student_details')
                ->join('users', 'users.id', '=', 'student_details.user_id')
                
                ->join('class_details', 'class_details.id', '=', 'student_details.batch_id')
                
                ->select('users.*', 'student_details.*','class_details.*')
                ->where('student_details.hostelfee', 'Yes')
                ->orderBy('student_details.created_at', 'DESC')
                ->get();
        foreach ($allStudents as $student) {
            $student->enc_id = Encrypt::encrypt($student->id);
            $student->enc_userid = Encrypt::encrypt($student->user_id);
        
        }
        //Fetch Batch Details
         $batch = new ClassDetails;
        $batch = $batch->fetch();
        return View('hostel.add_feedetails_for hostel', compact('allStudents', 'batch', 'id'));
    
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
          $batch = new ClassDetails;
        $batch = $batch->fetch();
       return view('hostel.add_feedetails_for hostel', compact('student_id', 'Feedetails','batch', 'users','id'));

         
    }
    /**
>>>>>>> Stashed changes
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Requests\RegisterStudentRequest $requestData)
    {
        
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
//       
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
    
     
    public function hostelfeesearch() {

        // Gets the query string and batch from our form submission 

        $batch = Request::input('batch');
       $division = Request::input('division');

        // Returns an array of articles that have the query string located somewhere within 

        $query = DB::table('student_details')
                ->join('users', 'users.id', '=', 'student_details.user_id')
                ->join('class_details', 'class_details.id', '=', 'student_details.batch_id')
                ->select('users.*', 'student_details.*','class_details.*')
                ->where('student_details.hostelfee','yes')
                ->orderBy('student_details.created_at', 'DESC');
       
        if (isset($batch)) {
            $query->where('class_details.class', $batch);
        }
        if (isset($division)) {
            $query->where('class_details.division', $division);
        }
              
        $allStudents = $query->get();
        foreach ($allStudents as $student) {
            $student->enc_id = Encrypt::encrypt($student->id);
            $student->enc_userid = Encrypt::encrypt($student->user_id);
                
        }
        //Fetch Batch Details
       $batch = new ClassDetails;
       $batch = $batch->fetch();
        // returns a view and passes the view the list of articles and the original query.
//        return route('Student.index');
        return View('hostel.add_feedetails_for hostel', 
            ['allStudents' => $allStudents, 
            'batch' => $batch,'division' => $division]
        );
    }

}
