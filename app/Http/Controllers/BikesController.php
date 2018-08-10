<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Bike;
use App\bike_other_image;

class BikesController extends Controller
{

	public function __construct()
	{
		$this->middleware('auth')->except(['index']);
	}

	public function index()
	{
		//paginate(per_page) will fetch the records and create numbered links
    	$bikes = Bike::paginate(1);

    	//simplePaginate(per_page) will fetch the records and create next/prev links
    	// $bikes = Bike::simplePaginate(1);

    	//in view call $result->links() to generate markup for pagination

    	return view('bikes',compact('bikes'));
	}

	// show form to create a new bike
    public function create()
    {
    	return view('admin.create_bike');
    }

    public function store(Request $request)
    {
    	$last_bike_id="";



    	// below: other_images is an array of files
    	// to validate array itself use--> other_images
    	// to validate contents of array use--> other_images.* in rules
    	$this->validate($request,[
    		'bike_name'=>'required',
    		'description'=>'required',
    		'rate'=>'required',
    		'cover_image'=>'required|image|max:1999',
    		'other_images.*'=>'required|image|max:1999'
    	]);

    	// upload cover image
    	if ($request->hasFile('cover_image')) {
            // get file name with ext
            $fileNameWithExt = $request->file('cover_image')->getClientOriginalName();

            // get just filename
            $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);

            // GET JUST EXT
            $ext = $request->file('cover_image')->getClientOriginalExtension();

            // filename to store
            $fileNameToStore = $filename.'_'.time().'.'.$ext;

            // upload image
            $path = $request->file('cover_image')->storeAs('public/bikes',$fileNameToStore);

            // save image name to db
            $bike = new Bike;
            $bike->bike_title = $request->bike_name;
            $bike->description = $request->description;
            $bike->hourly_rate = $request->rate;
            $bike->cover_image = $fileNameToStore;

            $bike->created_at = time();
            $bike->updated_at = time();
            $bike->save();

			// get last insert id
            $last_bike_id =$bike->id;  
        } 

        // upload other_images
    	if ($request->hasFile('other_images')) {

    		foreach ($request->other_images as $file) 
    		{
    			// get file name with ext
	            $fileNameWithExt = $file->getClientOriginalName();

	            // get just filename
	            $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);

	            // GET JUST EXT
	            $ext = $file->getClientOriginalExtension();

	            // filename to store
	            $fileNameToStore = $filename.'_'.time().'.'.$ext;

	            // upload image
	            $path = $file->storeAs('public/bikes',$fileNameToStore);

	            // save to database
	            $other_image = new bike_other_image;
	            $other_image->bike_id = $last_bike_id;
	            $other_image->image = $fileNameToStore;

	            $other_image->created_at = time();
	            $other_image->updated_at = time();
	            $other_image->save();   
    		}
            

            
        }

        // return view('admin.list_bike')->with('status','Bike created successfully.');
        return redirect('/all_bikes')->with('status','Bike created successfully.'); 

    }

    public function list_bikes()
    {
    	$bikes = Bike::orderBy('id','desc')->paginate('15');
    	return view('admin.list_bike',compact('bikes'));
    }

    public function destroy($id)
    {
    	// delete a row from bikes table
    	$bike = Bike::find($id);
    	// return $bike;
    	$bike->delete();

    	// // delete rows from bike_other_images table
    	$bike_other_image = bike_other_image::where('bike_id',$id)->delete();
    	// return $bike_other_image = bike_other_image::where('bike_id',$id)->get();

    	return redirect('/all_bikes')->with('status','Bike removed.');
    }

    public function edit($id)
    {
    	$bike = Bike::find($id);
    	$bike_other_images = bike_other_image::where('bike_id',$id)->get();

    	return view('admin.edit_bike',compact(['bike','bike_other_images']));
    }
}
