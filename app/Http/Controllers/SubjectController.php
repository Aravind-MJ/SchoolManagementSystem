<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use App\Subject;

class SubjectController extends Controller
{	
	protected $subject;
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {       
         $allSubject = new Subject;
         $allSubject = $allSubject
                ->orderBy('subject.created_at', 'DESC')
                ->get();

        return View('subject.list_subject', compact('allSubject'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('subject.add_subject');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Requests\SubjectRequest $requestData)
    {
        //store subject into table
        $subject =new subject;
       // $subject->id = $requestData['id'];
        $subject->subject_name = $requestData['subject'];
        $subject->save();
        return Redirect::back()
                        ->withFlashMessage('Subject Added successfully!')
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
		$enc_id = $id;
        $id = Encrypt::decrypt($id);
        //Fetch Subject Details
        $subject = DB::table('subject')
                ->select('subject.*')
                ->where('subject', $id)
                ->first();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {	//Fetch Student Details
        $subject = new Subject;
		$subject = $subject
                ->where('id', $id)
                ->first();

        //Redirecting to edit_student.blade.php 
        return View('subject.edit_subject', compact('id', 'subject'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id,Request\SubjectRequest $requestData)
    {
        //update student_details data
        $subject = Subject::find($id);
        $subject->subject_name = $requestData['subject'];

        if ($subject->save()) {
            return redirect('Subject')
                            ->withFlashMessage('Subject Details Updated successfully!')
                            ->withType('success');
        } else {
            return redirect('Subject')
                            ->withFlashMessage('Subject Details Update Failed!')
                            ->withType('danger');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
         //find result by id and delete 
        \App\Subject::find($id)->delete();

        //Redirecting to index() method
        return Redirect::back();
    }
}
