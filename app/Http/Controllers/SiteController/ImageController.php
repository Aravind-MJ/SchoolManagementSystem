<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\SiteModels\Images;
use App\SiteModels\Event;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Filesystem\Factory as Storage;
use Illuminate\Filesystem\Filesystem;

class ImageController extends Controller {

    /**
     * Show Page to Upload Images for gallery
     * @return View
     */
    public function create($eventid)
    {
        $images = new Images;
        $images = $images->where('event_id',$eventid)->get();

        return view( 'backend.event_gallery.upload_images',['eventid'=>$eventid,'images'=>$images]);
    }

    /**
     * Function to upload images and populate database via XMLHTTPRequest
     *
     * @param Storage $storage
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|string
     */
	  public function store(Storage $storage, Request $request )
    {
		
		$images= new Images;
       
        if ( $request->isXmlHttpRequest() )
        {
            $id = $request->input('eventid');
            $image = $request->file( 'image' );
            $timestamp = $this->getFormattedTimestamp();
            $savedImageName = $this->getSavedImageName( $timestamp, $image );
			$evtname = Event::find($id);
			$savedImageName = 'event/'.$evtname->name.'/'.$savedImageName;
            $imageUploaded = $this->uploadImage( $image, $savedImageName, $storage );

            if ( $imageUploaded )
            {
				$images->event_id = $id;
                $images->name = $savedImageName;
				$images->save();
				return 'Uploaded Succesfully';
            }
            return "uploading failed";
        }

    }	
		
     /**
     * @param $image
     * @param $imageFullName
     * @param $storage
     * @return mixed
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function uploadImage( $image, $imageFullName, $storage )
    {
        $filesystem = new Filesystem;
        return $storage->disk( 'image' )->put( $imageFullName, $filesystem->get( $image ) );
    }

    /**
     * @return string
     */
    protected function getFormattedTimestamp()
    {
        return str_replace( [' ', ':','-'], '', Carbon::now()->toDateTimeString() );
    }
	
	 /**
     * @param $timestamp
     * @param $image
     * @return string
     */
    protected function getSavedImageName( $timestamp, $image )
    {
        return $timestamp . '-' . $image->getClientOriginalName();
    }

    public function toggle($id,Request $request){
        $image = new Images;
        $image = $image->find($id);

        $stat = trim($request->input('status'));

        if($stat=='Disable'){
            $image->deleted_at = date('Y-m-d h:i:s');
            $status = 'Enable';
        }else{
            $image->deleted_at = null;
            $status = 'Disable';
        }
        $image->save();
        return $status;
    }
    public function caption($id,Request $request){
        $image = new Images;
        $image = $image->find($id);
        $image->caption = $request->input('caption');
        $image->save();
        return redirect('event/gallery/'.$request->input('event_id'))
            ->withFlashMessage('Caption Updated SuccessFully!')
            ->withtype('success');
    }
}
