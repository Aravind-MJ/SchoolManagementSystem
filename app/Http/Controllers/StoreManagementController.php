<?php

namespace App\Http\Controllers;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use App\StoreType;
use App\StoreManagement;
use App\Http\Requests\StoreManagementRequest;
use Illuminate\Support\Facades\Request;
use App\Encrypt;


class StoreManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $AllStore = new StoreManagement;
        $AllStore = $AllStore
                  ->join('store_type','store_type.id','=','store_detail.type_id')
                  ->select('store_detail.*','store_type.store_type')
                  ->get();

        return View('StoreManagement.list_store', compact('AllStore'));

                 
         
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $store_type = new StoreType;
        $store_type = $store_type
                     ->select('id','store_type')
                     ->get();
           $data = array();
           foreach ($store_type as $store_type) {
         $data[$store_type->id] = $store_type->store_type;
                 }

        $store_type = $data;
        return view('StoreManagement.add_store')
                    ->with('store_type', $store_type);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(StoreManagementRequest $requestData)
    {
        $Store = new StoreManagement;
        $Store->type_id = $requestData['store_type'];
        $Store->item_brand = $requestData['item_brand'];
        $Store->item_cost = $requestData['item_cost'];
        $Store->item_detail = $requestData['item_detail'];
        $Store->item_stock = $requestData['item_stock'];
        $Store->item_limit = $requestData['item_limit'];
        $Store->save();
        return redirect('StoreManagement')
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
        $Store = new StoreManagement;
        $Store = $Store->find($id);
        $store_type = new StoreType;
        $store_type = $store_type
                     ->select('id','store_type')
                     ->get();
           $data = array();
        foreach ($store_type as $store_type) {
        $data[$store_type->id] = $store_type->store_type;
                 }

        $store_type = $data;

       return view('StoreManagement.edit_store',compact('Store','type_id','store_type','id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id,StoreManagementRequest $requestData)
    {
        try{
              $Store = StoreManagement::find($id);
              $Store->type_id = $requestData['store_type'];
              $Store->item_brand = $requestData['item_brand'];
              $Store->item_cost = $requestData['item_cost'];
              $Store->item_detail = $requestData['item_detail'];
              $Store->item_stock = $requestData['item_stock'];
              $Store->item_limit = $requestData['item_limit'];
              $Store->save();
        }

       catch(Exception $e){
             return redirect()->back()
                              ->withFlashMessage('Item Detail Updation Failed!')
                              ->withType('danger');
      }
             return redirect()->route('StoreManagement.index')
                          ->withFlashMessage('Item Detail Updated successfully!')
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
    $Store = new StoreManagement;
    $Store = $Store->find($id)->delete(); 

    return redirect('StoreManagement')
             ->withFlashMessage('Details Deleted Successfully!')
             ->withType('success');
    }
}
