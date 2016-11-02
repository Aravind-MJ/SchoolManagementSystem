<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Timetable;
use App\Batch;
use App\Faculty;
use App\Subject;
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
            foreach ($batch as $batch) {
                $data[$batch->id] = $batch->batch;
            }
            $batch = $data;
            
            $faculty = new Faculty;
            $faculty = $faculty
              ->get();
            $data = array();
            foreach ($faculty as $faculty) {
            $data[$faculty->id] = $faculty->faculty;
            }
            $subject = $data;

            $subject = new Subject;
            $subject = $subject
              ->get();
            $data = array();
            foreach ($subject as $subject) {
                $data[$subject->id] = $subject->subject;
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
}
