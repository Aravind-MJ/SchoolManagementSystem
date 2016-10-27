<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Batch;
use App\Assignment;

class AssignmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
	 
	 public function __construct(Assignment $assignment, Batch $batch) {
        $this->assignment = $assignment;
        $this->batch = $batch;
    } 
    public function index()
    {
		//
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

        return view('Assignment.create' compact('id', 'batch'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $requestData)
    {
        $assignment = $this->assignment;
		$assignment->question = $requestData['question'];
        $assignment->batch_id = $requestData['batch_id'];
        $assignment->submit = $requestData['submit'];
        $assignment->save();
        return view('Assignment.create')
                        ->withFlashMessage('Notice Added successfully!')
                        ->withType('success');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
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
