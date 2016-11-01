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
        return view('subject.add_subject');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $requestData)
    {
        //store subject into table
        $subject =new subject;
        $subject->id = $requestData['id'];
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
         $allSubject = $this->subject
                ->select('subject.*', 'subject')
                ->orderBy('subject.created_at', 'DESC')
                ->get();

        return View('notice.list_notice', compact('allNotice'));
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
         //find result by id and delete 
        \App\Subject::find($id)->delete();

        //Redirecting to index() method
        return Redirect::back();
    }
}
