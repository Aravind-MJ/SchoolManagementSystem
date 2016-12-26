<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\ClassDetails;
use App\Faculty;
use App\User;
use App\RoleUsers;
use Input;
use DB;
use App\Encrypt;

class ClassDetailsController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $allBatchdetails = DB::table('class_details')
            ->get();
        foreach ($allBatchdetails as $Batchdetails) {
            $in_charge = DB::table('users')
                ->where('id', $Batchdetails->in_charge)
                ->first();
            $Batchdetails->enc_id = Encrypt::encrypt($Batchdetails->id);
            if (count($in_charge) <= 0) {
                $Batchdetails->name = 'No Incharge Assigned';
            } else {
                $Batchdetails->name = $in_charge->first_name . ' ' . $in_charge->last_name;
            }
        }

        return View('Classdetails.list_Classdetails', compact('allBatchdetails'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $users = DB::table('faculty_details')
            ->join('users', 'users.id', '=', 'faculty_details.user_id')
            ->select('users.*', 'faculty_details.*')
            ->where('faculty_details.deleted_at', NULL)
            ->orderBy('faculty_details.created_at', 'DESC')
            ->get();
        $data = array();
        foreach ($users as $each) {
            $data[$each->id] = $each->first_name . ' ' . $each->last_name;
        }
        $users = $data;
//          
//                \App\User::lists('first_name','last_name', 'id');
//      dd($users);
        return view('Classdetails.add_Classdetails', compact('Batchdetails', 'in_charge', 'users', 'id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Requests\PublishClassdetailsRequest $requestData)
    {

        $Batchdetails = new \App\ClassDetails;
        $Batchdetails->class = $requestData['class'];
        $Batchdetails->division = $requestData['division'];
        $Batchdetails->in_charge = $requestData['in_charge'];


        $claz = $requestData['class'];
        $division = $requestData['division'];

        $class = DB::table('class_details')
            ->select('id')
            ->where(['class' => $claz, 'division' => $division])
            ->first();
        if (count($class) <= 0) {
            $Batchdetails->save();
            return redirect()->route('ClassDetails.create')
                ->with('flash_message', 'New Class  added successfully.')
                ->withType('success');

        } else {
            return redirect()->route('ClassDetails.create')
                ->with('flash_message', 'This class and division has already taken.')
                ->withType('danger');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function show($id)
    {
        $enc_id = $id;
        $time_shift = [1 => 'morning', 2 => 'afternoon', 3 => 'evening'];
        $id = Encrypt::decrypt($id);
        $Batchdetails = DB::table('class_details')
            ->join('users', 'users.id', '=', 'class_details.in_charge')
            ->select('users.*', 'class_details.*')
            ->where('class_details.id', $id)
            ->first();
        //Redirecting to showBook.blade.php with $book variable
        $Batchdetails->time_shift = $time_shift[$Batchdetails->time_shift];


//         dd($Batchdetails);
        return View('Classdetails.Class_details', compact('Classdetails'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function edit($id)
    {
        $enc_id = $id;
        $id = Encrypt::decrypt($id);

        $Batchdetails = DB::table('class_details')
            ->where('class_details.id', $id)
            ->first();

        $Batchdetails->enc_id = Encrypt::encrypt($Batchdetails->id);

        $in_charge = DB::table('users')
            ->where('id',$Batchdetails->in_charge)
            ->first();

        if(count($in_charge)<=0){
            $in_charge = null;
        } else {
            $in_charge = $in_charge->id;
        }

        $users = DB::table('faculty_details')
            ->join('users', 'users.id', '=', 'faculty_details.user_id')
            ->select('users.*', 'faculty_details.*')
            ->where('faculty_details.deleted_at', NULL)
            ->orderBy('faculty_details.created_at', 'DESC')
            ->get();
        $data = array();
        foreach ($users as $each) {
            $data[$each->id] = $each->first_name . ' ' . $each->last_name;
        }
        $users = $data;
        return view('Classdetails.edit_Classdetails', compact('Batchdetails', 'in_charge', 'users', 'enc_id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     * @return Response
     */
    public function update($id, Requests\PublishClassdetailsRequest $requestData)
    {
        $id = Encrypt::decrypt($id);
        $Batchdetails = new ClassDetails;
        $Batchdetails = $Batchdetails->find($id);
        $Batchdetails->class = $requestData['class'];
        $Batchdetails->division = $requestData['division'];
        $Batchdetails->in_charge = $requestData['in_charge'];

        $Batchdetails->save();
        return redirect()->route('ClassDetails.index')
            ->withFlashMessage('ClassDetails Updated successfully!')
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
        $enc_id = $id;
        $id = Encrypt::decrypt($id);
        \App\ClassDetails::find($id)->delete();

        //Redirecting to index() method
        return redirect()->route('ClassDetails.index');
    }

}