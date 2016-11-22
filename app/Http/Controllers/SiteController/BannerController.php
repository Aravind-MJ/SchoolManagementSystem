<?php

namespace App\Http\Controllers\SiteController;

use Illuminate\Http\Request;
use App\SiteModels\Banner;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Contracts\Filesystem\Factory as Storage;
use Illuminate\Filesystem\Filesystem;

class BannerController extends Controller

{

    public function edit()
    {
        $banner = new Banner;
        $banner = $banner->get();
        return view('backend.banner.banner')->with('banner',$banner);
    }

    public function update(Request $request,Storage $storage)
    {
        if ($request->file('image') != null) {
            $banner = new Banner;
            $image = $request->file('image');
            $timestamp = $this->getFormattedTimestamp();
            $savedImageName = $this->getSavedImageName($timestamp, $image);
            $savedImageName = 'banner/' . $savedImageName;
            $imageUploaded = $this->uploadImage($image, $savedImageName, $storage);
            if ($imageUploaded) {
                $banner->name = $savedImageName;
                $banner->save();
                return redirect('banner')
                    ->withFlashMessage('Image Uploaded successfully!')
                    ->withType('success');
            } else {
                return redirect('banner')
                    ->withFlashMessage('Image upload failed!')
                    ->withType('danger');
            }
        }else{
        return redirect()->back()
            ->withFlashMessage('Please Choose an Image!')
            ->withType('info');
    }
    }

    public function destroy($id){
        $banner = Banner::find($id)->delete();
        return redirect('banner')
            ->withFlashMessage('Image Deleted successfully!')
            ->withType('success');
    }

    public function uploadImage($image, $imageFullName, $storage)
    {
        $filesystem = new Filesystem;
        return $storage->disk('image')->put($imageFullName, $filesystem->get($image));
    }

    /**
     * @return string
     */
    protected function getFormattedTimestamp()
    {
        return str_replace([' ', ':', '-'], '', Carbon::now()->toDateTimeString());
    }

    /**
     * @param $timestamp
     * @param $image
     * @return string
     */
    protected function getSavedImageName($timestamp, $image)
    {
        return $timestamp . '-' . $image->getClientOriginalName();
    }
} 