<?php

namespace App\Http\Controllers;

use App\ClassDetails;
use App\Examdetails;
use App\MarkDetails;
use App\StudentDetails;
use App\User;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Http\Request;
use DB;

use App\Http\Requests;
use App\Encrypt;
use Mockery\CountValidator\Exception;

use App\Http\Requests\FetchStudentsRequest;
use App\Http\Requests\StoreMarkRequest;
use App\Http\Requests\DeleteMarkRequest;

class MarkDetailsController extends Controller
{

    protected $users, $batch, $student_details, $exam_details, $mark_details;

    public function __construct(User $users, ClassDetails $batch, StudentDetails $student_details, Examdetails $exam_details, MarkDetails $mark_details)
    {
        $this->batch = $batch;
        $this->student_details = $student_details;
        $this->users = $users;
        $this->exam_details = $exam_details;
        $this->mark_details = $mark_details;
    }

    /**
     * Fetch students of given Batch Id
     *
     * @param $request
     * @return Response
     */
    public function fetchStudents(FetchStudentsRequest $request)
    {
        if ($request->ajax()) {
            $class = $request['clasz'];
            $division = $request['division'];

            $batch = new ClassDetails;
            $batch_id = $batch->where([
                'class' => $class,
                'division' => $division
            ])->first();
            if($batch_id == null){
                return '<h4>Batch not found</h4>';
            }
            $batch_id = $batch_id->id;
            $exam_id = $request['exam_id'];
            if ($request['clasz'] == '' || $request['division'] == '') {
                return '<h4>Select a Batch to View students</h4>';
            }

            $exam_id = Encrypt::decrypt($exam_id);
            if (!$exam_id) {
                return 'Invalid Token!';
            }
            $data = array();
            try {
                $students = $this->student_details
                    ->join('users', 'users.id', '=', 'student_details.user_id')
                    ->select('users.id', 'users.first_name', 'users.last_name')
                    ->where(array(
                        'student_details.batch_id'=> $batch_id,
                        'users.deleted_at' => null
                    ))
                    ->get();

                if (count($students) <= 0) {
                    return '<h4>No students Available to display</h4>';
                }

                foreach ($students as $each_student) {
                    $check = $this->mark_details
                        ->where(array(
                            'exam_id' => $exam_id,
                            'user_id' => $each_student->id
                        ))
                        ->get();
                    if (count($check) > 0) {
                        return '<h4>Marks Already Entered!</h4>';
                    }
                    $data[Encrypt::encrypt($each_student['id'])]['name'] = $each_student['first_name'] . ' ' . $each_student['last_name'];
                }

                $students = $data;

            } catch (Exception $e) {
                return 'Error Selecting Students!';
            }

            return view('mark.students_section', ['students' => $students, 'batch_id' => $batch_id]);

        } else {
            return '<h1>Invalid Request!! Access Denied</h1>';
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $data = array();
        try {
            $batch = $this->batch->fetch();

        } catch (Exception $e) {
            return back()->withFlashMessage('Error Selecting batch')->withType('danger');
        }

        try {
            $exams = $this->exam_details
                ->limit(10)
                ->get();
            if(count($exams)<=0){
                return redirect()->back()
                    ->withFlashMessage('No exams found!')->withType('danger');
            }
            foreach ($exams as $exam) {
                $date = date_create($exam['exam_date']);
                $name = DB::table('Exam_type')
                    ->select('name')
                    ->where('id',$exam['type_id'])
                    ->first();
                if(count($name)<=0){
                    return back()->withFlashMessage('Exam data Corrupted..!')->withType('danger');
                }
                $data['exams'][Encrypt::encrypt($exam['id'])] = $name->name . ' - ' . date_format($date, 'd/m/Y');
            }
            $exams = $data['exams'];
        } catch (Exception $e) {
            return back()->withFlashMessage('Error Selecting Exam Details')->withType('error');
        }

        return view('mark.register_mark', ['batch' => $batch, 'exam' => $exams]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param $request
     * @return Response
     */
    public function store(StoreMarkRequest $request)
    {
        try {
            $exam_id = Encrypt::decrypt($request['exam_id']);
            //$id = Encrypt::decrypt($request['batch_id']);
            //$count = count($request['markof']);
            if (!array_filter($request['markof'], 'is_numeric')) {
                return redirect('mark/create')->withFlashMessage('
                    <h4>Error!</h4>
                    <ol>
                        <li>Enter only integers as Mark</li>
                        <li>Enter marks of all students</li>
                    </ol>
                ')->withType('danger');
            }
            foreach ($request['markof'] as $enc_id => $mark) {
                $id = Encrypt::decrypt($enc_id);

                $check = $this->mark_details
                    ->where(array(
                        'exam_id' => $exam_id,
                        'user_id' => $id
                    ))
                    ->get();

                if (count($check) > 0) {
                    return redirect('mark/create')->withFlashMessage('Mark already entered.')->withType('danger');
                }

                $this->mark_details
                    ->insert([
                        ['exam_id' => $exam_id, 'user_id' => $id, 'mark' => $mark]
                    ]);

            }
        } catch (Exception $e) {
            return redirect('mark/create')->withFlashMessage('Error Adding mark to database')->withType('danger');
        }

        return redirect('mark/create')->withFlashMessage('Mark successfully added')->withType('success');

    }

    public function show($id){
            try {
                $id = Encrypt::decrypt($id);
                $marks = $this->mark_details
                    ->select('exam_id', 'mark')
                    ->where(array(
                        'user_id' => $id
                    ))
                    ->get();
                if(count($marks)<=0){
                    return redirect()->back()->withFlashMessage('No marks available to display!')->withType('danger');
                }

                foreach ($marks as $each) {
                    $exam = $this->exam_details
                        ->select('type_id','exam_date')
                        ->where('id', $each->exam_id)
                        ->orderBy('exam_date','DESC')
                        ->first();
                    if (count($exam) <= 0) {
                        return redirect()->back()->withFlashMessage('No marks available to display!')->withType('danger');
                    }

                    $exam->exam_date = date_format(date_create($exam->exam_date),'d/m/Y');
                    $exam_type = DB::table('Exam_type')
                        ->select('name')
                        ->where('id', $exam->type_id)
                        ->first();

                    if (count($exam_type) <= 0) {
                        return redirect()->back()->withFlashMessage('Exam Type Mismatch!')->withType('danger');
                    }
                    unset($exam->type_id);
                    unset($each->exam_id);
                    $exam->type = $exam_type->name;
                    $each->exam = $exam;
                }
            } catch (Exception $e) {
                return redirect()->back()->withFlashMessage('Error Fetching marks!')->withType('danger');
            }

            return view('protected.standardUser.mark',compact('marks'));
    }

    /**
     * Display the specified resource.
     *
     * @return Response
     */
    public function index()
    {
        $data = array();
        try {
            $batch = $this->batch->fetch();

        } catch (Exception $e) {
            return back()->withFlashMessage('Error Selecting batch')->withType('error');
        }

        try {
            $exams = $this->exam_details
                ->get();
            if(count($exams)<=0){
                return redirect()->back()
                    ->withFlashMessage('No exams found!')->withType('danger');
            }
            foreach ($exams as $exam) {
                $date = date_create($exam['exam_date']);
                $name = DB::table('Exam_type')
                    ->select('name')
                    ->where('id',$exam['type_id'])
                    ->first();
                if(count($name)<=0){
                    return back()->withFlashMessage('Exam data Corrupted..!')->withType('danger');
                }
                $data['exams'][Encrypt::encrypt($exam['id'])] = $name->name . ' - ' . date_format($date, 'd/m/Y');
            }
            $exams = $data['exams'];
        } catch (Exception $e) {
            return back()->withFlashMessage('Error Selecting Exam Details')->withType('error');
        }

        return view('mark.view_mark', ['batch' => $batch, 'exam' => $exams]);
    }

    /**
     * Fetch students of given Batch Id
     *
     * @param $request
     * @return Response
     */
    public function fetchMark(FetchStudentsRequest $request)
    {
        if ($request->ajax()) {
            $class = $request['clasz'];
            $division = $request['division'];

            $batch = new ClassDetails;
            $batch = $batch->where([
                'class' => $class,
                'division' => $division
            ])->first();
            if($batch == null){
                return '<h4>Batch not found!</h4>';
            }
            $batch_id = $batch->id;
            $exam_id = $request['exam_id'];
            if ($request['id'] == '0') {
                return '<h4>Select a Batch to View students</h4>';
            }

            $exam_id = Encrypt::decrypt($exam_id);
            if (!$exam_id) {
                return 'Invalid Token!';
            }
            $data = array();
            try {
                $students = $this->student_details
                    ->join('users', 'users.id', '=', 'student_details.user_id')
                    ->select('users.id', 'users.first_name', 'users.last_name')
                    ->where(array(
                        'student_details.batch_id'=> $batch_id,
                        'users.deleted_at' => null
                    ))
                    ->get();

                if (count($students) <= 0) {
                    return '<h4>No students Available to display</h4>';
                }

                foreach ($students as $each_student) {
                    $check = $this->mark_details
                        ->where(array(
                            'exam_id' => $exam_id,
                            'user_id' => $each_student->id
                        ))
                        ->first();
                    if (count($check) <= 0) {
                        return '<h4>No marks available!</h4>';
                    }
                    $check = $check->toArray();
                    $data[Encrypt::encrypt($each_student['id'])]['name'] = $each_student['first_name'] . ' ' . $each_student['last_name'];
                    $data[Encrypt::encrypt($each_student['id'])]['mark'] = $check['mark'];
                }

                $students = $data;
                $batch_id = Encrypt::encrypt($batch_id);

            } catch (Exception $e) {
                return 'Error Selecting Students!';
            }

            return view('mark.mark_section', ['students' => $students, 'batch_id' => $batch_id]);

        } else {
            return '<h1>Invalid Request!! Access Denied</h1>';
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  $request
     * @return Response
     */
    public function update(StoreMarkRequest $request)
    {
        try {
            $exam_id = Encrypt::decrypt($request['exam_id']);
            //$id = Encrypt::decrypt($request['batch_id']);
            //$count = count($request['markof']);
            if (!array_filter($request['markof'], 'is_numeric')) {
                return redirect('mark/create')->withFlashMessage('
                    <h4>Error!</h4>
                    <ol>
                        <li>Enter only integers as Mark</li>
                        <li>Enter marks of all students</li>
                    </ol>
                ')->withType('danger');
            }
            foreach ($request['markof'] as $enc_id => $mark) {
                $id = Encrypt::decrypt($enc_id);
                $check = $this->mark_details
                    ->where(array(
                        'exam_id' => $exam_id,
                        'user_id' => $id
                    ))
                    ->get();

                if (count($check) <= 0) {
                    return redirect('mark')->withFlashMessage('Mark doesn\'t Exist.')->withType('danger');
                }
                $this->mark_details
                    ->where(array(
                        'exam_id' => $exam_id,
                        'user_id' => $id
                    ))
                    ->update(['mark' => $mark]);

            }
        } catch (Exception $e) {
            return redirect('mark')->withFlashMessage('Error Updating mark to database')->withType('danger');
        }

        return redirect('mark')->withFlashMessage('Mark successfully Updated')->withType('success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  $request
     * @return Response
     */
    public function destroy(DeleteMarkRequest $request)
    {
        $batch_id = Encrypt::decrypt($request['batch_id']);
        $exam_id = Encrypt::decrypt($request['exam_id']);
        try {
            $students = $this->student_details
                ->join('users', 'users.id', '=', 'student_details.user_id')
                ->select('users.id', 'users.first_name', 'users.last_name')
                ->where('student_details.batch_id', $batch_id)
                ->get();

            if (count($students) <= 0) {
                return redirect('mark')->withFlashMessage('No students Found!')->withType('danger');
            }

            foreach ($students as $each_student) {
                $this->mark_details
                    ->where(array(
                        'exam_id' => $exam_id,
                        'user_id' => $each_student->id
                    ))
                    ->delete();
            }
        } catch (Exception $e) {
            return redirect('mark')->withFlashMessage('Error Deleting Mark!')->withType('danger');
        }

        return redirect('mark')->withFlashMessage('Mark Successfully Deleted!')->withType('success');
    }

    public function getMark()
    {
        $user = Sentinel::getUser();
        if ($user->inRole('student')) {
            try {
                $id = $user->id;
                $marks = $this->mark_details
                    ->select('exam_id', 'mark')
                    ->where(array(
                        'user_id' => $id
                    ))
                    ->get();

                foreach ($marks as $each) {
                    $exam = $this->exam_details
                        ->select('type_id','exam_date')
                        ->where('id', $each->exam_id)
                        ->orderBy('exam_date','DESC')
                        ->first();
                    if (count($exam) <= 0) {
                        return redirect()->back()->withFlashMessage('No marks available to display!')->withType('danger');
                    }

                    $exam->exam_date = date_format(date_create($exam->exam_date),'d/m/Y');
                    $exam_type = DB::table('Exam_type')
                        ->select('name')
                        ->where('id', $exam->type_id)
                        ->first();

                    if (count($exam_type) <= 0) {
                        return redirect()->back()->withFlashMessage('Exam Type Mismatch!')->withType('danger');
                    }
                    unset($exam->type_id);
                    unset($each->exam_id);
                    $exam->type = $exam_type->name;
                    $each->exam = $exam;
                }
            } catch (Exception $e) {
                return redirect()->back()->withFlashMessage('Error Fetching marks!')->withType('danger');
            }

            return view('protected.studentUser.mark',compact('marks'));
        } else {
            return redirect()->back()->withFlashMessage('Access restricted!')->withType('danger');
        }
    }
}
