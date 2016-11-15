<?php

namespace App\Http\Controllers;

use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Support\Facades\Request;
use App\Http\Controllers\Controller;
use App\Buses;
use App\Busfee;
use App\Http\Student;
use App\User;
use App\Batch;
use DB;
use App\Http\Requests\CreateBusFeeRequest;
use App\Http\Requests\UpdateBusFeeRequest;

class BusFeeController extends Controller
{

    public function create()
    {
        $batch_id = Request::input('param1');
        $batch = new Batch;
        $batch = $batch->fetch();

        if ($batch_id == null) {
            $users = [null => 'Select a batch to view students'];
        } else {
            $users = DB::table('users')
                ->join('student_details', 'student_details.user_id', '=', 'users.id')
                ->where(['users.deleted_at' => null, 'student_details.batch_id' => $batch_id])
                ->select('users.id', 'first_name', 'last_name')
                ->get();

            $data = array();
            foreach ($users as $each) {
                $data[$each->id] = $each->first_name . ' ' . $each->last_name;
            }
            $users = $data;

        }

        $buses = DB::table('buses')
            ->select('id', 'bus_no')
            ->get();
        $data = array();
        foreach ($buses as $buses) {
            $data[$buses->id] = $buses->bus_no;
        }
        $buses = $data;
        return view('transport.create_fee', compact('batch', 'users', 'buses', 'selected_user', 'selected_batch', 'batch_id'));
    }

    public function store(CreateBusFeeRequest $requestData)
    {
        //dd($requestData);

        try {
            //store bus in create bus table
            $busfee = new Busfee;
            $busfee->batch = $requestData['param1'];
            $busfee->student_id = $requestData['student_id'];
            $busfee->bus_id = $requestData['bus_id'];
            $busfee->fee = $requestData['fee'];

            $busfee->save();
        } catch (Exception $e) {
            return redirect()->back()
                ->withFlashMessage('Bus Fee Creation Failed!')
                ->withType('danger');
        }
        return redirect()->back()
            ->withFlashMessage('Bus Fee Created Successfully!')
            ->withType('success');
    }


    public function show($id)
    {
    }

    public function index()
    {
        $busfee = DB::table('bus_fee')
            ->join('users', 'users.id', '=', 'bus_fee.student_id')
            ->join('student_details', 'student_details.user_id', '=', 'users.id')
            ->join('buses', 'buses.id', '=', 'bus_fee.bus_id')
            ->join('batch_details', 'batch_details.id', '=', 'bus_fee.batch')
            ->select('bus_fee.*', 'batch_details.batch', 'users.first_name', 'users.last_name', 'buses.bus_no')
            ->orderBy('bus_fee.id')
            ->get();


        return View('transport.listall_fee', compact('busfee'));
    }


    public function edit($id)
    {
        $busfees = new Busfee;
        $busfees = $busfees->find($id);
        $batch_id = Request::input('param1');

        $batch = new Batch;
        $batch = $batch->fetch();

        if ($batch_id == null) {
            $users = [null => 'Select a batch to view students'];
        } else {
            $users = DB::table('users')
                ->join('student_details', 'student_details.user_id', '=', 'users.id')
                ->where(['users.deleted_at' => null, 'student_details.batch_id' => $batch_id])
                ->select('users.id', 'first_name', 'last_name')
                ->get();

            foreach ($users as $user) {
                $bus_id = DB::table('bus_fee')->where('student_id', $user->id)->first();
                if ($bus_id == null) {
                    $user->bus_id = null;
                    $user->bus_fee = null;
                    $user->table_id = null;
                } else {
                    $user->bus_id = $bus_id->bus_id;
                    $user->bus_fee = $bus_id->fee;
                    $user->table_id = $bus_id->id;
                }
            }
        }

        $buses = DB::table('buses')
            ->select('buses.id', 'bus_no')
            ->get();
        $data = array();
        foreach ($buses as $buses) {
            $data[$buses->id] = $buses->bus_no;
        }
        $buses = $data;

        return view('transport.add_fee', compact('batch', 'batch_id', 'users', 'buses'));
    }

    public function update($id, UpdateBusFeeRequest $requestData)
    {
        //update values in notice
        try {
            $buses = new Busfee;
            $buses = $buses->find($id);
            $buses->batch = $requestData['param1'];
            $buses->student_id = $requestData['student_id'];
            $buses->bus_id = $requestData['bus_id'];
            $buses->fee = $requestData['fee'];

            $buses->save();
        } catch (Exception $e) {
            return redirect()->route('BusFee.index')
                ->withFlashMessage('Bus Fee Edition Failed!')
                ->withType('danger');
        }
        return redirect()->route('BusFee.index')
            ->withFlashMessage('Bus Fee Edited Successfully!')
            ->withType('success');
    }

    public function destroy($id)
    {
        $busfee = new Busfee;
        $busfee = $busfee->find($id)->delete();

        return redirect()->back()
            ->withFlashMessage('Deleted Successfully!')
            ->withType('success');
    }


}