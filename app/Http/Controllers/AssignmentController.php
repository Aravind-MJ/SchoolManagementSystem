<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use App\Batch;
use App\Assignment;

class AssignmentController extends Controller {

    protected $assignment, $batch;

    public function __construct(Assignment $assignment, Batch $batch) {
        $this->assignment = $assignment;
        $this->batch = $batch;
    }

    public function index() {

        //Select all records from assignment table    
        $allAssignment = $this->assignment
                ->join('batch_details', 'batch_details.id', '=', 'assignment.batch_id')
                ->select('assignment.*', 'batch_details.batch')
                ->orderBy('assignment.sdate', 'DESC')
                ->get();

        return View('assignment.list_assignment', compact('allAssignment'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {

        //Fetch Batch Details
        $batch =$this->batch
                ->select('id', 'batch')
                ->get();
        $data = array();
        foreach ($batch as $batch) {
            $data[$batch->id] = $batch->batch;
        }
        $batch = $data;
        //Redirecting to add_notice.blade.php 

        return view('assignment.add_assignment', compact('id', 'batch'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $requestData) {

        //store assignment in assignment table
        $assignment = $this->assignment;
        $assignment->batch_id = $requestData['batch_id'];
        $assignment->question = $requestData['question'];
        $assignment->sdate = $requestData['sdate'];
        $assignment->save();
        return Redirect::back()
                        ->withFlashMessage('assignment Added successfully!')
                        ->withType('success');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function show() {
          $allAssignment = $this->assignment
                ->join('batch_details', 'batch_details.id', '=', 'assignment.batch_id')
                ->select('assignment.*', 'batch_details.batch')
                ->orderBy('assignment.sdate', 'DESC')
                ->get();

        return View('assignment.user_assignment', compact('allAssignment'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function edit($id) {

        $assignment = $this->assignment
                ->join('batch_details', 'batch_details.id', '=', 'assignment.batch_id')
                ->select('assignment.*', 'batch_details.batch')
                ->where('assignment.id', $id)
                ->first();

        //Fetch Batch Details
        $batch = $this->batch
                ->select('id', 'batch')
                ->get();
        $data = array();
        foreach ($batch as $batch) {
            $data[$batch->id] = $batch->batch;
        }
        $batch = $data;

        return View('assignment.edit_assignment', compact('assignment', 'batch', 'id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     * @return Response
     */
    public function update($id, Request $requestData) {
        //update values in assignment

        $assignment = \App\assignment::find($id);
        $assignment->batch_id = $requestData['batch_id'];
        $assignment->question = $requestData['question'];
        $assignment->sdate = $requestData['sdate'];
        $assignment->save();
        return redirect()->route('Assignment.index')
                        ->withFlashMessage('assignment Updated successfully!')
                        ->withType('success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id) {
        //find result by id and delete 
        \App\assignment::find($id)->delete();

        //Redirecting to index() method
        return Redirect::back();
    }

}
