<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;

use App\Assignment;
use App\ClassDetails;
class AssignmentController extends Controller {

    protected $assignment,  $claz;

    public function __construct(Assignment $assignment,  ClassDetails $claz ) {
        $this->assignment = $assignment;
       
		$this->claz = $claz;
    }

    public function index() {

        //Select all records from assignment table    
        $allAssignment = $this->assignment
                ->join('class_details', 'class_details.id', '=', 'assignment.batch_id')
                ->select('assignment.*', 'class_details.class', 'class_details.division')
                ->orderBy('assignment.submit', 'DESC')
                ->get();
				//dd($allAssignment);

        return View('Assignment.list_assignment', compact('allAssignment'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {

        //Fetch Batch Details
         $batch = new ClassDetails;
		$batch = $batch->fetch();
        //Redirecting to add_notice.blade.php 


        return view('assignment.add_assignment', compact('id', 'batch'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */

    public function store(Requests\AssignmentRequest $requestData) {

        //store assignment in assignment table
        $assignment = $this->assignment;
       $class = $requestData['class'];
		$division = $requestData['division'];
		$clazdiv = $this->claz
		->select('id')
		->where(['class' =>$class, 'division' => $division])
		->first();
        $assignment->question = $requestData['question'];
        $assignment->submit = $requestData['submit']; 
		$assignment->batch_id = $clazdiv->id;
		
        $assignment->save();
        return Redirect::back()
                        ->withFlashMessage('assignment Added successfully!')

                        ->withType('success');
    }

    /**
     * Display the specified resource.

     * @param  int $id
     * @return Response
     */
    public function show() {
		/*
          $allAssignment = $this->assignment
                ->join('class_details', 'class_details.id', '=', 'assignment.batch_id')
                ->select('assignment.*', 'class_details.class', 'class_details.division')
                ->orderBy('assignment.sdate', 'DESC')
                ->get();

        return View('assignment.user_assignment', compact('allAssignment'));
*/
    }

    /**
     * Show the form for editing the specified resource.
     *

     * @param  int $id
     * @return Response
     */
    public function edit($id) {

        $assignment = $this->assignment
                ->join('class_details', 'class_details.id', '=', 'assignment.batch_id')
                ->select('assignment.*', 'class_details.class', 'class_details.division')
                ->where('assignment.id', $id)
                ->first();

        //Fetch Batch Details
       $batch = new ClassDetails;
		$batch = $batch->fetch();

        return View('assignment.edit_assignment', compact('assignment', 'batch', 'id'));

    }

    /**
     * Update the specified resource in storage.
     *

     * @param  int $id
     * @return Response
     */
    public function update($id, Requests\AssignmentRequest $requestData) {
        //update values in assignment

        $assignment = \App\assignment::find($id);
        $assignment->batch_id = $requestData['batch_id'];
        $assignment->question = $requestData['question'];
        $assignment->submit = $requestData['submit'];
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
