<?php

namespace App\Http\Controllers\SiteController;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Requests\EventRequest;
use App\Http\Controllers\Controller;
use App\Http\Controllers\SiteController\ImageController;
use App\SiteModels\Event;
use Carbon\Carbon;
use Illuminate\Contracts\Filesystem\Factory as Storage;
use Illuminate\Filesystem\Filesystem;

class EventGalleryController extends Controller
{
	
	protected $event;
	public function __construct(Event $event){
		$this->event=$event;
	}
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
		$allevent = $this->event
               ->get();
			   
		return view('backend.event_gallery.list_event',compact('allevent'));  
		
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('backend.event_gallery.new_eventgallery');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(EventRequest $request,Storage $storage)
    {
		
		$event= new Event;
        $event->name = $request->input('evtname');
        $event->description  = $request->input('descrp');
		
		$image = $request->file( 'img' );
            $timestamp = $this->getFormattedTimestamp();
            $savedImageName = $this->getSavedImageName( $timestamp, $image );
			$savedImageName = 'event/'.$request->input('evtname').'/'.$savedImageName;
            $imageUploaded = $this->uploadImage( $image, $savedImageName, $storage );

            if ( $imageUploaded )
            {				
		    $event->image  = $savedImageName;
            $event->save();
			$event_id = $event->id;
		
		   return redirect('event/gallery/'.$event_id);
			//return view( 'backend.event_gallery.upload_images',['eventid'=>$event_id]);
            }
			return "uploading failed";
			
			
    }
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

        public function edit($id) {
        $event=Event::find($id);
        return View('backend.event_gallery.edit_event')
                ->with('id',$id)
                ->with('event',$event);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     * @return Response
     */
    public function update($id, Requests\EventUpdateRequest $request,Storage $storage) {
        //update values in notice
        $event=Event::find($id);
        $event->name = $request->input('evtname');
        $event->description = $request->input('descrp');
        if($request->file('img')!=null){
            $image = $request->file( 'img' );
            $timestamp = $this->getFormattedTimestamp();
            $savedImageName = $this->getSavedImageName( $timestamp, $image );
            $savedImageName = 'event/'.$savedImageName;
            $imageUploaded = $this->uploadImage( $image, $savedImageName, $storage );   
            if ( $imageUploaded )
            {
                $event->image = $savedImageName;
            }else{
                return redirect('event')
                        ->withFlashMessage('Image upload failed!')
                        ->withType('danger');
            }      
        }
        $event->save();
        return redirect('event')
                        ->withFlashMessage('Event Updated successfully!')
                        ->withType('success');
    }
			
			
		public function destroy($id) {
			 $event= Event::find($id);
			 unlink(public_path('images/'.$event->image));
			 $event->delete();
			 return redirect('event');
    }
}
        