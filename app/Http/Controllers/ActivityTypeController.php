<?php

namespace App\Http\Controllers;

use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\ActivityTypes;
use App\Http\Requests\ActivitytypeRequest;
use App\Encrypt;


class ActivityTypeController extends Controller {

    protected $ActivityTypes, $batch;
    
    public function create()
    {
        return view('Activity.add_activity');
    }
    
    public function store(ActivitytypeRequest $requestData) {
        try{
        //store bus in create bus table
        $activity = new ActivityTypes;
        $activity->activity_type = $requestData['activity_type'];
        $activity->save();
    }
    catch(Exception $e){
         return redirect()->back()
                        ->withFlashMessage('Activity adding failed!')
                        ->withType('danger');
    }
        return redirect()->back()
                        ->withFlashMessage('Activity added Successfully!')
                        ->withType('success');
    }

    public function index()
    {
        $allActivitytype = ActivityTypes::all();     
        foreach( $allActivitytype as $Activitytype ){
        $Activitytype->enc_id = Encrypt::encrypt($Activitytype->id);
        }
        return View('Activity.list_activity', compact('allActivitytype'));
    }

    public function show($id)
    {
        $enc_id=$id;
        $id = Encrypt::decrypt($id);
        $Activitytype = ActivityTypes::find($id);
        return view('Activity.list_activity')->with('Activitytype', $Activitytype);  //
    }

    public function edit($id)
    {
        $enc_id=$id;
        $id = Encrypt::decrypt($id);
        $Activitytype = ActivityTypes::find($id);
        return view('Activity.edit_activity')->with('Activitytype', $Activitytype); //
    }

     public function update($id, ActivitytypeRequest $requestData)
    {

        $Activitytype = ActivityTypes::find($id);
        $Activitytype->activity_type = $requestData['activity_type'];
        $Activitytype->save();
        return redirect()->route('Activity.index')
                         ->withFlashMessage('Examtype updated successfully!')
                         ->withType('success');

    }
    

    public function destroy($id)
    {
        $enc_id=$id;
        $id = Encrypt::decrypt($id);
        ActivityTypes::find($id)->delete();
        return redirect()->route('Activity.index');
    } 
    

}
