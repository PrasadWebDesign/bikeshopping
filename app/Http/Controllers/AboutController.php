<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\About;
use DB;

class AboutController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->except(['index']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // query builder format;
        // need to import DB or use \DB in code
        // $aboutContent = DB::table('abouts')->get();

        //get all records using eloquent; need to import the class above or use \App\About instead
        // for eloquent table name must bu model+s; e.g. model is about then table name must be abouts
        $aboutContent = About::all();

        //die and dump records
        // dd($aboutContent);

        // same as ->with()
        // return view('about',compact('aboutContent'));

        //passing multiple variables
        // return view('about',compact(array('aboutContent','var1','var2'));
        // OR
        // return view('about',compact(['fixtures', 'teams', 'selections']));
        // OR
        // return view('about')
            // ->with('aboutContent',$aboutContent)
            // ->with('aboutContent',$aboutContent)
            // ->with('aboutContent',$aboutContent);
        // OR
        // return view('about')
            // ->with(compact('aboutContent'));
            // ->with(compact('aboutContent'));
            // ->with(compact('aboutContent'));
        // OR
        // ->with(compact('fixtures', 'teams', 'selections'))

        $team = \DB::table('team')->get();


        return view('about')
            ->with('aboutContent',$aboutContent)
            ->with('team',$team);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $about_id = About::max('id');
        $about_content = About::where('id',$about_id)->pluck('about_content');
        // dd($about_content);
        return view('admin.aboutus',compact('about_content'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $this->validate($request,[
            'content'=>'required'
        ]);
        $about_id = $request->about_id;

        // find the row
        $about = About::find($about_id);

        // set content to update
        $about->about_content = $request->content;
        $about->updated_at = time();

        // update
        $about->update();

        return back()->with('status','About Content Updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
