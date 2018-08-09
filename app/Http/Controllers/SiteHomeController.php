<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SiteHome;
use App\Banner;

class SiteHomeController extends Controller
{
    public function index()
    {
    	$banners = Banner::max('id');
		$bannerImg = Banner::where('id',$banners)->pluck('banner');
		$bannerImg =$bannerImg[0];

		return view('index',compact('bannerImg'));
    }
}
