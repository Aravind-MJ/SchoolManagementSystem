<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\StoreType;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;

class StoreTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $AllStoreType = new StoreType;
        $AllStoreType = $AllStoreType
                      ->get();
        return View('StoreType.list_storetype', compact('AllStoreType'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
           return View('StoreType.add_storetype');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $requestData)
    {
        $StoreType = new StoreType;
        $StoreType->store_type = $requestData['store_type'];
        $StoreType->save();
        return redirect('StoreType')
             ->withFlashMessage('Store Type added Successfully!')
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
         $StoreType = new StoreType;
         $StoreType = $StoreType
                    ->find($id);
        return view('StoreType.edit_StoreType')->with('StoreType', $StoreType);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id, Request $requestData)
    {
        $StoreType = new StoreType;
        $StoreType = $StoreType
                   ->find($id);
        $StoreType->store_type = $requestData['store_type'];
        $StoreType->save();
        return redirect()->route('StoreType.index')
                         ->withFlashMessage('Store Type updated successfully!')
                         ->withType('success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
    
    $StoreType = new StoreType;
    $StoreType = $StoreType->find($id)->delete(); 

    return redirect('StoreType')
             ->withFlashMessage('Store Type Deleted Successfully!')
             ->withType('success');
    }
}
