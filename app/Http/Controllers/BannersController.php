<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Banner;

class BannersController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }

    public function create()
    {
    	$banners = Banner::max('id');
    	$bannerImg = Banner::where('id',$banners)->pluck('banner');
    	$bannerImg =$bannerImg[0];
    	// dd($bannerImg);
    	return view('admin.banner',compact(['banners','bannerImg']));
    }

    public function update(Request $request)
    {
        // dd($request);
        $this->validate($request, [
            'file_banner'=>'image|max:1999|required'
        ]);

		$banner_id = $request->banner_id;
		// dd($banner_id);

        if ($request->hasFile('file_banner')) {
            // get file name with ext
            $fileNameWithExt = $request->file('file_banner')->getClientOriginalName();

            // get just filename
            $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);

            // GET JUST EXT
            $ext = $request->file('file_banner')->getClientOriginalExtension();

            // filename to store
            $fileNameToStore = $filename.'_'.time().'.'.$ext;

            // upload image
            $path = $request->file('file_banner')->storeAs('public/banners',$fileNameToStore);

            // save image name to db
            $banner = Banner::find($banner_id);
            $banner->banner = $fileNameToStore;
            // $banner->created_at = time();
            $banner->updated_at = time();
            $banner->update();

            $banners = Banner::max('id');
    		$bannerImg = Banner::where('id',$banners)->pluck('banner');
			$bannerImg =$bannerImg[0];

            return view('admin.banner')
            	->with('status','Banner Image Uploaded!')
            	->with('bannerImg',$bannerImg)
            	->with('banners',$banners);
        } else {
            
        }
        
        
    }

    public function show()
    {
    	
    }
}
