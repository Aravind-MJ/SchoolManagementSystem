<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use App\Assignment;
use App\Notice;
use App\ClassDetails;

class NoticeController extends Controller
{

    protected $notice, $batch, $claz;

    public function __construct(Notice $notice, ClassDetails $claz)
    {
        $this->notice = $notice;
        $this->claz = $claz;
    }

    public function index()
    {

        //Select all records from notice table    
        $allNotice = $this->notice
            ->orderBy('notice.created_at', 'DESC')
            ->get();

        return View('notice.list_notice', compact('allNotice'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Re
    sponse
     */
    public function create()
    {
        $batch = new ClassDetails;
        $batch = $batch->singleDropdownClass();
        //Redirecting to add_notice.blade.php 

        return view('notice.add_notice', compact('batch'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Requests\PublishNoticeRequest $requestData)
    {

        //store notice in notice table
        $class = $requestData['class'];
        $notice = new Notice;
        $notice->message = $requestData['message'];
        $notice->batch_id = json_encode($class);
        $notice->save();
        return Redirect::back()
            ->withFlashMessage('Notice Added successfully!')
            ->withType('success');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function edit($id)
    {
        $notice = $this->notice
            ->where('notice.id', $id)
            ->first();

        //Fetch Batch Details
        $batch = new ClassDetails;
        $batch = $batch->singleDropdownClass();

        return View('notice.edit_notice', compact('notice', 'batch', 'id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     * @return Response
     */
    public function update($id, Requests\PublishNoticeRequest $requestData)
    {
        //update values in notice


        $notice = $this->notice->find($id);
        $notice->message = $requestData['message'];
        $notice->batch_id = json_encode($requestData['batch_id']);
        $notice->save();
        return Redirect::back()
            ->withFlashMessage('Notice Updated successfully!')
            ->withType('success');

    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id)
    {
        //find result by id and delete 
        \App\Notice::find($id)->delete();

        //Redirecting to index() method
        return Redirect::back()
            ->withFlashMessage('Notice Deleted successfully!')
            ->withType('success');;
    }

}
