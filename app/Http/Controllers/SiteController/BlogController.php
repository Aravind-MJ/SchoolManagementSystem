<?php

namespace App\Http\Controllers\SiteController;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Requests\SiteRequest\BlogRequest;
use App\Http\Controllers\Controller;
use App\Http\Controllers\SiteController;
use App\SiteModels\Blog;
use Illuminate\Support\Facades\ Input;
use Carbon\Carbon;
use Illuminate\Contracts\Filesystem\Factory as Storage;
use Illuminate\Filesystem\Filesystem;


class BlogController extends Controller
{
    public function new_blog() {
	return view("backend.blog.new_blog");
	}
	
    
    public function index(){
        $allblog = new Blog;
        $allblog = $allblog
               ->get();
                return view('backend.blog.list_blog',compact('allblog'));  
     }   
  

	public function store(Storage $storage,BlogRequest $request)
	{
		$blog = new blog;
		$blog->blog_title = $request->input('blog_title');
		$blog->blog_cont = $request->input('blog_cont');
		$image = $request->file( 'featured_image' );
        $timestamp = $this->getFormattedTimestamp();
        $savedImageName = $this->getSavedImageName( $timestamp, $image );
        $savedImageName = 'blog/'.$savedImageName;
        $imageUploaded = $this->uploadImage( $image, $savedImageName, $storage );
		if ( $imageUploaded )
            {
				$blog->blog_img = $savedImageName;
				$blog->save();
				return redirect('blog/new')
				        ->withFlashMessage('Blog Added Succesfully')
				        ->withType('success');
            }

                 return redirect('blog/new')
				        ->withFlashMessage('Blog Addition Failed!')
				        ->withType('danger');		
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
        return str_replace( ['-',' ', ':'], '', Carbon::now()->toDateTimeString() );
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
        $blog=Blog::find($id);
        return View('backend.blog.edit_blog')
        ->with('id',$id)
        ->with('blog',$blog);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     * @return Response
     */
    public function update($id, Requests\BlogUpdateRequest $request,Storage $storage) {
        //update values in notice
        $blog=Blog::find($id);
        $blog->blog_title = $request->input('blog_title');
        $blog->blog_cont = $request->input('blog_cont');
        if($request->file('blog_img')!=null){
            $image = $request->file( 'blog_img' );
            $timestamp = $this->getFormattedTimestamp();
            $savedImageName = $this->getSavedImageName( $timestamp, $image );
            $savedImageName = 'blog/'.$savedImageName;
            $imageUploaded = $this->uploadImage( $image, $savedImageName, $storage );   
            if ( $imageUploaded )
            {
                $blog->blog_img = $savedImageName;
            }else{
                return redirect('blog/list')
                        ->withFlashMessage('Image upload failed!')
                        ->withType('danger');
            }      
        }
        $blog->save();
        return redirect('blog/list')
                        ->withFlashMessage('Blog Updated successfully!')
                        ->withType('success');
    }

public function show($id)
    {
        $blog = Blog::find($id);
        $date= date_create($blog->created_at);
        $month=date_format($date,'M');
        $day=date_format($date,'d');
    
        return \View::make('frontend.blog')
            ->with('blog', $blog)
            ->with('month', $month)
            ->with('day',$day);
    }


    public function destroy($id) {
      $blog= new Blog;
      $blog=Blog::find($id);
      unlink(public_path('images/'.$blog->blog_img));
      $blog->delete();
      return redirect('blog/list')
                ->withFlashMessage('Blog deleted successfully!')
                ->withType('success');
    }

}


