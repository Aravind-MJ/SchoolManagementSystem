<?php

namespace App\Http\Controllers;

use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Buses;
use App\Http\Requests\CreateBusRequest;


class BusesController extends Controller {
	
	public function create()
    {
        return view('transport.create_bus');
    }
    
    public function store(CreateBusRequest $requestData) {
    	//dd($requestData);
    	try{
        //store bus in create bus table
        $buses = new Buses;
        $buses->bus_no = $requestData['bus_no'];
        $buses->number_plate = $requestData['number_plate'];
        $buses->driver = $requestData['driver'];
        $buses->cleaner = $requestData['cleaner'];
        $buses->route = $requestData['route'];

        $buses->save();
    	}
    catch(Exception $e){
    	 return redirect()->back()
                        ->withFlashMessage('Bus Creation Failed!')
                        ->withType('danger');
    	}
        return redirect()->back()
                        ->withFlashMessage('Bus Created Successfully!')
                        ->withType('success');
    }

    public function show($id) {
    }

    public function index(){

    	$allbuses = new Buses;
    	$allbuses = $allbuses
                ->get();

        return View('transport.list_bus', compact('allbuses'));
    }

    public function edit($id) {

        $buses = new Buses;
        $buses = $buses->find($id);

        return View('transport.edit_bus', compact('buses'));
    }

    public function update($id, CreateBusRequest $requestData) {
        //update values in notice
    	try{
        $buses = new Buses;
        $buses = $buses->find($id);
        $buses->bus_no = $requestData['bus_no'];
        $buses->number_plate = $requestData['number_plate'];
        $buses->driver = $requestData['driver'];
        $buses->cleaner = $requestData['cleaner'];
        $buses->route = $requestData['route'];

        $buses->save();
   		}

        catch(Exception $e){
    	 return redirect()->route('transportation.index')
                        ->withFlashMessage('Bus Edition Failed!')
                        ->withType('danger');
    	}
        return redirect()->route('transportation.index')
                        ->withFlashMessage('Bus Edited Successfully!')
                        ->withType('success');
    }


    public function destroy($id) { 
        $buses = new Buses;
        $buses = $buses->find($id)->delete();

        return redirect()->back()
                        ->withFlashMessage('Bus Deleted Successfully!')
                        ->withType('success');
    }

}
