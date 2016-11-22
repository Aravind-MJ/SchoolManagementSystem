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
use Illuminate\Support\Facades\DB;

class ActivityDetailsController extends Controller {

    public function index() {
        $allActivityDetails = new ActivityDetails;
        $allActivityDetails = $allActivityDetails
                ->join('activity_types', 'activity_types.id', '=', 'activity_details.activity_id')
                ->join('class_details', 'class_details.id', '=', 'activity_details.batch_id')
                ->join('users', 'users.id', '=', 'activity_details.student_id')
                ->select('activity_details.*', 'users.first_name', 'users.last_name', 'class_details.class', 'class_details.division', 'activity_types.activity_type')
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
                ->select('id', 'activity_type')
                ->get();
        $data = array();
        foreach ($activity_types as $activity_types) {
            $data[$activity_types->id] = $activity_types->activity_type;
        }

        $activity_types = $data;

        $batch = new ClassDetails;
        $batch = $batch->fetch();
        //$batch_id = null;
        $clasz = Request::input('class');
        $division = Request::input('division');
        if ($division != null) {
            $class = new ClassDetails;
            $class = DB::table('class_details')
                    ->select('id', 'class', 'division')
                    ->where(['class' => $clasz, 'division' => $division])
                    ->first();
            if ($class == true) {
                $batch_id = $class->id;
            } else {
                return redirect::back()
                                ->withFlashMessage($clasz . ' ' . $division . 'Not Found!!')
                                ->withType('danger');
            }
        }

        if (!isset($batch_id)) {
            $users = array();
        } else {
            $users = new User;
            $users = $users
                    ->join('student_details', 'student_details.user_id', '=', 'users.id')
                    ->where(['users.deleted_at' => null, 'student_details.batch_id' => $batch_id])
                    ->select('users.id', 'first_name', 'last_name')
                    ->get();
            $data = array();
            foreach ($users as $each) {
                $data[$each->id] = $each->first_name . ' ' . $each->last_name;
            }
            $users = $data;
        }
        return view('Activitydetails.add_activitydetails', compact('batch', 'batch_id', 'activity_types', 'users', 'clasz', 'division'));
    }

    public function store(ActivityDetailsRequest $requestData) {
        //dd($requestData);
        try {
            //store bus in create bus table
            $ActivityDetails = new ActivityDetails;

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

            $ActivityDetails->activity_id = $requestData['activity_types'];
            $ActivityDetails->batch_id = $batch_id;
            $ActivityDetails->student_id = $requestData['student_id'];
            $ActivityDetails->remark = $requestData['remark'];
            $ActivityDetails->save();
        } catch (Exception $e) {
            return redirect('ActivityDetails')
                            ->withFlashMessage('Activity Detail Addition Failed!')
                            ->withType('danger');
        }
        return redirect('ActivityDetails')
                        ->withFlashMessage('Activity Detail Added Successfully!')
                        ->withType('success');
    }

    public function show($id) {
        //    }
    }

    public function update($id, ActivityDetailsRequest $requestData) {
        try {
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
            $ActivityDetails = ActivityDetails::find($id);
            $ActivityDetails->activity_id = $requestData['activity_types'];
            $ActivityDetails->batch_id = $batch_id;
            $ActivityDetails->student_id = $requestData['student_id'];
            $ActivityDetails->remark = $requestData['remark'];
            $ActivityDetails->save();
        } catch (Exception $e) {
            return redirect()->back()
                            ->withFlashMessage('Activity Detail Updation Failed!')
                            ->withType('danger');
        }
        return redirect()->route('ActivityDetails.index')
                        ->withFlashMessage('ActivityDetails Updated successfully!')
                        ->withType('success');
    }

    public function edit($id) {

        $allActivityDetails = new ActivityDetails;
        $allActivityDetails = $allActivityDetails->find($id);
        $activity_types = new ActivityTypes;
        $activity_types = $activity_types
                ->select('id', 'activity_type')
                ->get();
        $data = array();
        foreach ($activity_types as $activity_types) {
            $data[$activity_types->id] = $activity_types->activity_type;
        }

        $activity_types = $data;

        $batch = new ClassDetails;
        $batch = $batch->fetch();
        $batch_id = $allActivityDetails->batch_id;
        $class = new ClassDetails;
        $class = $class->find($batch_id);
        $clasz = $class->class;
        $division = $class->division;

        if (!isset($batch_id)) {
            $batch_id = $allActivityDetails->batch_id;
        } else {
            $allActivityDetails->batch_id = $batch_id;
        }
        $users = new User;
        $users = $users
                ->join('student_details', 'student_details.user_id', '=', 'users.id')
                ->where(['users.deleted_at' => null, 'student_details.batch_id' => $allActivityDetails->batch_id])
                ->select('users.id', 'first_name', 'last_name')
                ->get();
        $data = array();
        foreach ($users as $each) {
            $data[$each->id] = $each->first_name . ' ' . $each->last_name;
        }
        $users = $data;

        return view('Activitydetails.edit_activitydetails', compact('allActivityDetails', 'activity_id', 'activity_types', 'clasz', 'division', 'id', 'users', 'batch'));
    }

}
