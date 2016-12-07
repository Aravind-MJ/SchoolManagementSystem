<?php

namespace App\Http\Controllers;

use App\ClassDetails;
use App\Variables;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use App\User;
use App\Attendance;
use App\StudentDetails;
use Illuminate\Database;
use App\Encrypt;
use App\Http\Requests\SelectBatchRequest;
use App\Http\Requests\AjaxAttendanceRequest;
use App\Http\Requests\DeleteAttendanceRequest;
use App\Http\Requests\RangeAttendanceRequest;
use Mockery\CountValidator\Exception;

class AttendanceController extends Controller
{

    protected $attendance, $batch, $users, $student_details,$variable;

    public function __construct(User $user, Attendance $attendance, ClassDetails $batch, StudentDetails $student_details, Variables $variable)
    {
        $this->middleware('redirectStudentUser', ['except' => ['ofStudent']]);
        $this->middleware('redirectFaculty', ['only' => ['edit', 'update', 'destroy']]);
        $this->users = $user;
        $this->attendance = $attendance;
        $this->batch = $batch;
        $this->student_details = $student_details;
        $this->ay = $variable->get('AY');
    }

    /**
     * Show Page to Select Batch to Mark attendance
     *
     * @return Response
     */
    public function index()
    {
        if (Sentinel::check()) {

            $marked_batches = array();
            $user = Sentinel::getUser();
            $faculty = Sentinel::findRoleByName('Faculty');

            try {

                $marked = $this->attendance
                    ->select('batch_id')
                    ->where('created_at', 'like', date('Y-m-d') . '%')
                    ->distinct()
                    ->get();

                foreach ($marked as $each) {
                    $marked_batches [] = $each['batch_id'];
                }

                if ($user->inRole($faculty)) {
                    $id = $user->getUserId();
                    $batch = $this->batch
                        ->select('id', 'class', 'division')
                        ->where(array(
                            'in_charge' => $id
                        ))
                        ->get();
                    if (count($batch) <= 0) {
                        return redirect()->back()->withFlashMessage('You are not in charge of any Batches to mark attendance!!')->withType('danger');
                    }
                } else {

                    $batch = $this->batch
                        ->select('id', 'class', 'division')
                        ->get();

                    if (count($batch) <= 0) {
                        return redirect()->back()->withFlashMessage('No batch found!!')->withType('danger');
                    }
                }

            } catch (Exception $e) {
                return redirect()->back()->withFlashMessage('Error Selecting batch!!')->withType('danger');
            }

            foreach ($batch as $each_batch) {
                $each_batch['enc_id'] = Encrypt::encrypt($each_batch['id']);
                $each_batch['status'] = (in_array($each_batch['id'], $marked_batches)) ? 'marked' : 'unmarked';
            }

            $batch = $batch->toArray();
            return view('attendance.attendance_in_charge', ['batch' => $batch]);
        }
    }

    /**
     * Show page for entering attendance.
     *
     * @param $id
     * @return Response
     */
    public function mark($id)
    {
        $enc_id = $id;
        $id = Encrypt::decrypt($id);
        if (!is_numeric($id)) {
            return redirect()->back()->withFlashMessage('Invalid Token!')->withType('danger');
        }
        $data = array();

        try {
            $students = $this->student_details
                ->join('users', 'users.id', '=', 'student_details.user_id')
                ->select('users.id', 'users.first_name', 'users.last_name')
                ->where(array(
                    'student_details.batch_id' => $id,
                    'users.deleted_at' => null
                ))
                ->get();
            if (count($students) <= 0) {
                return redirect()->back()->withFlashMessage('No students found for this Batch!')->withType('danger');
            }

            foreach ($students as $each_student) {
                $data[Encrypt::encrypt($each_student['id'])]['name'] = $each_student['first_name'] . ' ' . $each_student['last_name'];
            }

        } catch (Exception $e) {
            return redirect()->back()->withFlashMessage('Error Selecting Students!')->withType('danger');
        }

        return view('attendance.attendance_create', ['id' => $enc_id, 'students' => $data]);

    }

    /**
     * Save attendance
     *
     * @param $request
     * @return Response
     */
    public function store(AjaxAttendanceRequest $request)
    {
        if ($request->ajax()) {
            $attendance = array();
            $id = Encrypt::decrypt($request['id']);

            $count = sizeof($request['present']);
            if (empty($request['present'])) {
                $present = '[]';
            } else {
                foreach ($request['present'] as $each) {
                    $attendance [] = (int)Encrypt::decrypt($each);
                }
                $present = json_encode($attendance);
            }
            try {
                $this->attendance->insert(array(
                    'batch_id' => $id,
                    'present_count' => $count,
                    'attendance' => $present,
                    'AY'=>$this->ay
                ));
            } catch (Exception $e) {
                return 'error';
            }

            return 'success';
        } else {
            return '<h1>Invalid Request!! Access Denied</h1>';
        }
    }

    /**
     * Display Batch to select.
     *
     * @return Response
     */
    public function selectBatch()
    {

        try {

            $batch = $this->batch
                ->select('id', 'class', 'division')
                ->get();

        } catch (Exception $e) {
            return redirect('attendance/batch')->withFlashMessage('Error Selecting batch')->withType('danger');
        }

        foreach ($batch as $each_batch) {
            $each_batch['enc_id'] = Encrypt::encrypt($each_batch['id']);
        }

        $batch = $batch->toArray();

        return view('attendance.attendance_select_batch', ['batch' => $batch]);
    }

    /**
     * Display Students to select :- First time.
     *
     * @return Response
     */
    public function selectStudentGet()
    {
        return $this->selectStudentCore('first');
    }

    /**
     * Display Students to select :- Filtered.
     *
     * @param $request
     * @return Response
     */
    public function selectStudentPost(SelectBatchRequest $request)
    {
        return $this->selectStudentCore(Encrypt::decrypt($request['batch']));
    }

    /**
     * Core to Display Students to select.
     *
     * @param $id
     * @return Response
     */
    private function selectStudentCore($id)
    {
        $flag = false;
        $data = array();
        $data['batch'] = array();
        $data['students'] = array();
        if ($id == 'first') {
            $flag = true;
        } else {
            $data['selected']['batch'] = Encrypt::encrypt($id);
        }


        try {
            $batch = $this->batch
                ->select('id', 'class', 'division')
                ->get();

            if (count($batch) <= 0) {
                return redirect()->back()->withFlashMessage('No batches available to display!')->withType('danger');
            }

        } catch (Exception $e) {
            return redirect('attendance/batch')->withFlashMessage('Error Selecting batch')->withType('danger');
        }

        foreach ($batch as $each_batch) {
            if ($flag) {
                $id = $each_batch['id'];
                $data['selected']['batch'] = Encrypt::encrypt($each_batch['id']);
                $flag = false;
            }
            $data['batch'][Encrypt::encrypt($each_batch['id'])] = $each_batch['class'] . ' ' . $each_batch['division'];
        }

        try {
            $students = $this->student_details
                ->join('users', 'users.id', '=', 'student_details.user_id')
                ->select('users.id', 'users.first_name', 'users.last_name')
                ->where(array(
                    'student_details.batch_id' => $id,
                    'users.deleted_at' => null
                ))
                ->get();

            if (count($students) <= 0) {
                return redirect()->back()->withFlashMessage('No students available to display!')->withType('danger');
            }

            foreach ($students as $each_student) {
                $data['students'][Encrypt::encrypt($each_student['id'])]['name'] = $each_student['first_name'] . ' ' . $each_student['last_name'];
            }

        } catch (Exception $e) {
            return redirect()->back()->withFlashMessage('Error Selecting Students!')->withType('danger');
        }

        return view('attendance.attendance_select_student', [
            'batch' => $data['batch'],
            'selected' => $data['selected'],
            'students' => $data['students']
        ]);
    }

    /**
     * Batch wise attendance
     *
     * @param  int $id
     * @return Response
     */
    public function ofBatch($id)
    {
        $enc_id = $id;
        $id = Encrypt::decrypt($id);

        if (!$id) {
            return redirect()->back()->withFlashMessage('Invalid Token!')->withType('danger');
        }
        try {
            $data = $this->attendance
                ->where([
                    'batch_id'=> $id
                ])
                ->get();

            if (count($data) <= 0) {
                return redirect()->back()->withFlashMessage('No attendance available for the batch!')->withType('danger');
            }

        } catch (Exception $e) {
            return redirect()->back()->withFlashMessage('Error Fetching attendance!')->withType('danger');
        }

        return view('attendance.attendance_batch', ['id' => $enc_id]);
    }

    /**
     * Batch wise attendance
     *
     * @param  int $id
     * @param  date $date
     * @return Response
     */
    public function ofBatchDate($id, $date)
    {
        $data = array();
        $id = Encrypt::decrypt($id);
        $date = Encrypt::decrypt($date);

        if (!$id) {
            return redirect()->back()->withFlashMessage('Invalid Batch Token!')->withType('danger');
        }

        if (!$date) {
            return redirect()->back()->withFlashMessage('Invalid Date Token!')->withType('danger');
        }
        try {
            $attendance = $this->attendance
                ->select('attendance')
                ->whereRaw("batch_id = " . $id . " AND created_at = '" . $date . "'")
                ->first();

            if (count($attendance) <= 0) {
                return redirect()->back()->withFlashMessage('No attendance available for this date!')->withType('danger');
            }

            $attendance = json_decode($attendance->attendance);
            if (!is_array($attendance)) {
                $attendance = array();
            }

        } catch (Exception $e) {
            return redirect()->back()->withFlashMessage('Error Fetching attendance!')->withType('danger');
        }

        try {
            $students = $this->student_details
                ->join('users', 'users.id', '=', 'student_details.user_id')
                ->select('users.id', 'users.first_name', 'users.last_name')
                ->where(array(
                    'student_details.batch_id' => $id,
                    'users.deleted_at' => null
                ))
                ->get();

            if (count($students) <= 0) {
                return redirect()->back()->withFlashMessage('No students available to display!')->withType('danger');
            }

            foreach ($students as $each_student) {
                $enc_std_id = Encrypt::encrypt($each_student->id);
                $data[$enc_std_id] = new \stdClass();
                $data[$enc_std_id]->name = $each_student->first_name . ' ' . $each_student->last_name;
                $data[$enc_std_id]->status = (in_array($each_student->id, $attendance)) ? 'present' : 'absent';
            }
        } catch (Exception $e) {
            return redirect()->back()->withFlashMessage('Error Fetching Students!')->withType('danger');
        }

        return view('attendance.attendance_batch_date', ['data' => $data]);
    }

    /**
     * Attendance in the range
     *
     * @param $request
     * @return Response
     */
    public function rangeAttendance(RangeAttendanceRequest $request)
    {
        if ($request->ajax()) {
            $enc_id = $request['id'];
            $id = Encrypt::decrypt($request['id']);
            if (!$id) {
                return 'Invalid Token!';
            }
            $start_date = $request['start_date'] . ' 00:00:00';
            $end_date = $request['end_date'] . ' 23:59:59';

            try {
                $data = $this->attendance
                    ->whereRaw('batch_id = ' . $id . ' AND created_at > "' . $start_date . '" AND created_at < "' . $end_date . '"')
                    ->orderBy('created_at', 'ASC')
                    ->get();

                if (count($data) <= 0) {
                    return 'No attendance Available!';
                }

            } catch (Exception $e) {
                return 'Error Fetching attendance!';
            }

            $chartObject = new \stdClass();
            $chartObject->element = 'attendance-chart';
            $chartObject->resize = true;
            $chartObject->data = array();
            $chartObject->xkey = 'date';
            $chartObject->ykeys = array('present');
            $chartObject->labels = array('Present');
            $chartObject->lineColors = array('#3c8dbc');
            $chartObject->hideHover = 'auto';
            $chartObject->parseTime = false;
            $chartObject->xLabelAngle = 60;
            $chartObject->stacked = true;

            $max = 0;
            foreach ($data as $each_data) {
                $date = date_create($each_data->created_at);
                $enc_date = Encrypt::encrypt($each_data->created_at);
                $temp = new \stdClass();
                $temp->date = '<a href="' . url('attendance/batch/' . $enc_id . '/' . $enc_date) . '">' . date_format($date, 'M d - D') . '</a>';
                //$temp->date = date_format($date, 'd/m/Y');
                $temp->present = $each_data->present_count;
                if ($max < $each_data->present_count + 3) {
                    $max = $each_data->present_count + 3;
                }
                $chartObject->data [] = $temp;
            }

            $chartObject->ymax = $max;

            return json_encode($chartObject);

        } else {
            return '<h1>Invalid Request!! Access Denied!</h1>';
        }
    }

    /**
     * Student wise Attendance
     *
     * @param  int $id
     * @return Response
     */
    public function ofStudent($id)
    {
        $enc_id = $id;
        $id = Encrypt::decrypt($id);
        $ay = Request::input('AY');
        $academic_year = $this->attendance
            ->select(DB::raw('DISTINCT AY'))
            ->orderBy('AY')
            ->get();
        $AY = array();
        foreach($academic_year as $each){
            $AY[$each['AY']] = $each['AY'].' - '.($each['AY']+1);
        }
        if($ay!=null){
            $this->ay = $ay;
        }
        $data = array();

        if (!is_numeric($id)) {
            if (Sentinel::getUser()->inRole('student')) {
                return redirect()->back();
            }
            return redirect()->back()->withFlashMessage('Invalid Token!')->withType('danger');
        }

        try {
            $user = Sentinel::findById($id);
            if ($user == null) {
                return redirect()->back()->withFlashMessage('Oops Looks like the User doesn\'t exist!')->withType('danger');
            }
        } catch (Exception $e) {
            return redirect()->back()->withFlashMessage('Invalid Token!')->withType('danger');
        }

        if (!$user->inRole('student')) {
            return redirect()->back()->withFlashMessage('Invalid Reference Token!')->withType('danger');
        }

        try {

            $last_month = date('F - Y');
            $working_days = array();
            $absent = array();

            $batch_id = $this->student_details
                ->select('batch_id')
                ->where('user_id', $id)
                ->first();

            $months = $this->attendance
                ->select('created_at')
                ->where([
                    'batch_id'=> $batch_id['batch_id'],
                    'AY'=>$this->ay
                    ])
                ->get()
                ->toArray();

            if (count($months) <= 0) {
                return redirect()->back()->withFlashMessage('No attendance available!')->withType('danger');
            }

            foreach ($months as $month) {
                $date = date_create($month['created_at']);
                if (!in_array(date_format($date, 'F-Y'), $data)) {
                    $data [] = date_format($date, 'F-Y');
                    $last_month = date_format($date, 'F-Y');
                }
                $working_days[date_format($date, 'F-Y')][] = date_format($date, 'd');
            }

            $months = $data;
            $attendance = $this->attendance
                ->orwhere('attendance', 'like', '%[' . $id . ',%')
                ->orWhere('attendance', 'like', '%,' . $id . ']%')
                ->orWhere('attendance', 'like', '%,' . $id . ',%')
                ->orWhere('attendance', 'like', '%[' . $id . ']%')
                ->where('AY',$this->ay)
                ->get()
                ->toArray();

            if (count($months) <= 0) {
                return redirect()->back()->withFlashMessage('No attendance available!')->withType('danger');
            }

            $data = '';
            foreach ($attendance as $each_attendance) {
                $date = date_create($each_attendance['created_at']);
                $data[date_format($date, 'F-Y')][] = date_format($date, 'd');
            }

            $present = $data;

            foreach ($months as $month) {
                if (isset($present[$month])) {
                    $absent[$month] = array_diff($working_days[$month], $present[$month]);
                } else {
                    $absent[$month] = $working_days[$month];
                }
            }

        } catch (Exception $e) {
            return redirect()->back()->withFlashMessage('Error Fetching attendance!')->withType('danger');
        }

        return view('attendance.attendance_student', [
            'months' => $months,
            'last_month' => $last_month,
            'present' => $present,
            'absent' => $absent,
            'working_days' => $working_days,
            'AY'=>$AY,
            'ay'=>$this->ay,
            'std_id'=>$enc_id
        ]);
    }

    /**
     * Select batch to Edit.
     *
     * @return Response
     */
    public function edit()
    {
        $marked_batches = array();

        try {

            $batch = $this->batch
                ->select('id', 'class', 'division')
                ->get();

        } catch (Exception $e) {
            return redirect()->back()->withFlashMessage('Error Selecting batch!!')->withType('danger');
        }

        foreach ($batch as $each_batch) {
            $each_batch['enc_id'] = Encrypt::encrypt($each_batch['id']);
            $each_batch['status'] = (in_array($each_batch['id'], $marked_batches)) ? 'marked' : 'unmarked';
        }

        $batch = $batch->toArray();

        return view('attendance.attendance_edit_select_batch', ['batch' => $batch]);
    }

    /**
     * List dates of selected batch to Edit attendance.
     *
     * @param  int $id
     * @return Response
     */
    public function selectDate($id)
    {
        $enc_id = $id;
        $id = Encrypt::decrypt($id);
        $ay = Request::input('AY');
        $academic_year = $this->attendance
            ->select(DB::raw('DISTINCT AY'))
            ->orderBy('AY')
            ->get();
        $AY = array();
        foreach($academic_year as $each){
            $AY[$each['AY']] = $each['AY'].' - '.($each['AY']+1);
        }
        if($ay!=null){
            $this->ay = $ay;
        }
        $data = array();

        if (!is_numeric($id)) {
            return redirect()->back()->withFlashMessage('Invalid Token!')->withType('danger');
        }

        try {
            $dates = $this->attendance
                ->select('created_at')
                ->where('batch_id', $id)
                ->where('AY',$this->ay)
                ->orderBy('created_at', 'DESC')
                ->get()->toArray();

            if (count($dates) <= 0) {
                return redirect()->back()->withFlashMessage('No attendance available for this batch!!')->withType('danger');
            }

            foreach ($dates as $each_date) {
                $date = date_create($each_date['created_at']);
                $enc_date = Encrypt::encrypt(date_format($date, 'Y-m-d'));
                $data [$enc_date] = date_format($date, 'd/m/Y - D');
            }

            $dates = $data;
        } catch (Exception $e) {
            return redirect()->back()->withFlashMessage('Error Selecting date!!')->withType('danger');
        }

        return view('attendance.attendance_select_date', [
            'dates' => $dates,
            'id' => $enc_id,
            'AY'=>$AY,
            'ay'=>$this->ay
        ]);
    }

    /**
     * Page to edit Attendance
     *
     * @param  int $id
     * @param  int $date
     * @return Response
     */
    public function editBatch($id, $date)
    {
        $enc_id = $id;
        $enc_date = $date;
        $id = Encrypt::decrypt($id);
        $date = Encrypt::decrypt($date);
        if (!is_numeric($id)) {
            return redirect()->back()->withFlashMessage('Invalid Batch Token!')->withType('danger');
        }
        if ($date === false) {
            return redirect()->back()->withFlashMessage('Invalid Date Token!')->withType('danger');
        }
        $data = array();

        try {
            $students = $this->student_details
                ->join('users', 'users.id', '=', 'student_details.user_id')
                ->select('users.id', 'users.first_name', 'users.last_name')
                ->where(array(
                    'student_details.batch_id' => $id,
                    'users.deleted_at' => null
                ))
                ->get();
            if (count($students) <= 0) {
                return redirect()->back()->withFlashMessage('No students found for this Batch!')->withType('danger');
            }

            foreach ($students as $each_student) {
                $data[Encrypt::encrypt($each_student['id'])]['name'] = $each_student['first_name'] . ' ' . $each_student['last_name'];
            }
            $students = $data;
        } catch (Exception $e) {
            return redirect()->back()->withFlashMessage('Error Selecting Students!')->withType('danger');
        }

        try {
            $attendanceData = $this->attendance
                ->select('attendance')
                ->whereRaw("batch_id = " . $id . " AND created_at LIKE '" . $date . "%'")
                ->first()->toArray();

            $data = [];
            $attendance = json_decode($attendanceData['attendance']);
            if (!is_array($attendance)) {
                return redirect()->back()->withFlashMessage('Attendance Data Corrupted!')->withType('danger');
            }
            foreach ($attendance as $each_attendance) {
                $data [] = Encrypt::encrypt($each_attendance);
            }
            $attendance = $data;

        } catch (Exception $e) {
            return redirect()->back()->withFlashMessage('Error Fetching Attendance!')->withType('danger');
        }

        return view('attendance.attendance_edit', ['id' => $enc_id, 'students' => $students, 'attendance' => $attendance, 'created_at' => $enc_date]);
    }

    /**
     * Update attendance.
     *
     * @param  AjaxAttendanceRequest $request
     * @return Response
     */
    public function update(AjaxAttendanceRequest $request)
    {
        if ($request->ajax()) {
            $attendance = array();
            $id = Encrypt::decrypt($request['id']);
            $date = Encrypt::decrypt($request['date']);
            $count = sizeof($request['present']);
            if (empty($request['present'])) {
                $present = '[]';
            } else {
                foreach ($request['present'] as $each) {
                    $attendance [] = (int)Encrypt::decrypt($each);
                }
                $present = json_encode($attendance);
            }
            try {
                $attendance = $this->attendance
                    ->whereRaw("batch_id = " . $id . " AND created_at like '" . $date . "%'")
                    ->first();
                $attendance->present_count = $count;
                $attendance->attendance = $present;
                $attendance->save();
            } catch (Exception $e) {
                return 'error';
            }

            return 'success';
        } else {
            return '<h1>Invalid Request!! Access Denied</h1>';
        }
    }

    /**
     * Remove attendance.
     *
     * @param  $request
     * @return Response
     */
    public function destroy(DeleteAttendanceRequest $request)
    {
        $enc_id = $request['id'];
        $id = Encrypt::decrypt($request['id']);
        $date = Encrypt::decrypt($request['date']);
        if (!$id) {
            return redirect('edit/attendance/' . $enc_id)->withFlashMessage('Invalid Batch token!')->withtype('danger');
        }
        if (!$date) {
            return redirect('edit/attendance/' . $enc_id)->withFlashMessage('Invalid Date token')->withtype('danger');
        }
        try {
            $attendance = $this->attendance
                ->whereRaw("batch_id = " . $id . " AND created_at like '" . $date . "%'")
                ->first();

            $attendance->deleted_at = 1;
            $attendance->save();

        } catch (Exception $e) {
            return redirect('edit/attendance/')->withFlashMessage('Failed to delete Attendance!!')->withtype('danger');
        }
        return redirect('edit/attendance/')->withFlashMessage('Attendance Deleted Successfully!')->withtype('success');
    }
}
