<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use App\Timetable;
use App\Batch;
use App\Faculty;
use App\Subject;
use App\TimeTableConfig;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class TimetableController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {        
        return view('timetable.timetable');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        if($id=='config'){
            return view('timetable.tableconfig');
        }else if($id=='init'){
            $batch = new Batch;
            $batch = $batch
                ->get();
            $data = array();
            foreach ($batch as $each_batch) {
                $data[$each_batch->id] = $each_batch->batch;
            }
            $batch = $data;
            
            $faculty = new Faculty;
            $faculty = $faculty
				->join('users','users.id','=','faculty_details.user_id')
				->get();
            $data = array();
            foreach ($faculty as $each_faculty) {
            $data[$each_faculty->id] = $each_faculty->first_name.' '.$each_faculty->last_name;
            }
            $faculty = $data;

            $subject = new Subject;
            $subject = $subject
              ->get();
            $data = array();
            foreach ($subject as $each_subject) {
                $data[$each_subject->id] = $each_subject->subject_name;
     }
            $subject = $data;

            return view('timetable.tableinit',compact('batch','faculty','subject'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
    public function timetable_config(Request $requestData)
    {
       $timetable_config = new TimeTableConfig;
        $timetable_config->no_of_days_week= $requestData['no_of_days_week'];
         $timetable_config->no_of_hours_day  = $requestData['no_of_hours_day'];
         $timetable_config->save();
        return Redirect::back()
                        ->withFlashMessage('Timetable Configuration Added successfully!')
                        ->withType('success');
  
    }
}
