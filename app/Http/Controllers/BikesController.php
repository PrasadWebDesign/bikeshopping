<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

use App\Bike;
use App\bike_other_image;
use App\Booking;
use App\Http\Requests\BookingRequest;
use Carbon\Carbon;
use Mail;
use App\Mail\BookingRequestMail;

use File;
use View;



class BikesController extends Controller
{

	public function __construct()
	{
		// except index, every function requires login
		$this->middleware('auth')->except(['index','show_single_bike','booking_request', 'get_bike_filter', 'get_bike_price_filter']);


		// except create and store, everything can be accessed without login; create and store requires login.
		// just another way to code :)
		// $this->middleware('guest')->except(['create','store']);
	}

	public function index()
	{
		//paginate(per_page) will fetch the records and create numbered links
    	$bikes = Bike::paginate(10);
      $min_rate = Bike::min('hourly_rate')-50;
       $max_rate = Bike::max('hourly_rate')+50;

    	//simplePaginate(per_page) will fetch the records and create next/prev links
    	// $bikes = Bike::simplePaginate(1);

    	//in view call $result->links() to generate markup for pagination

    	return view('bikes',compact('bikes', 'min_rate', 'max_rate'));
	}


	public function show_single_bike($id)
	{
		$bike = Bike::findOrFail($id);
		// return $bike;
		$cover_image = $bike->cover_image;
		$bike_other_images = bike_other_image::where('bike_id',$id)->pluck('image');
		$bike_other_images->push($cover_image);
		return view('bike_single',compact(['bike','bike_other_images']));
	}

	public function booking_request(BookingRequest $request)
	{

		// $validator = \Validator::make($request->all(),[
		// 	'name'=>'required',
		// 	'email'=>'required|email',
		// 	'mobile'=>'required|max:10',
		// 	'age'=>'required|max:2',
		// 	'ride_start_date'=>'required',
		// 	'ride_end_date'=>'required',
		// 	'address'=>'required'
		// ]);
		// $this->validate($request,[
		// 	'name'=>'required',
		// 	'email'=>'required|email',
		// 	'mobile'=>'required|max:10',
		// 	'age'=>'required|max:2',
		// 	'ride_start_date'=>'required',
		// 	'ride_end_date'=>'required',
		// 	'address'=>'required'
		// ]);

		// if ($validator->fails())
  //       {
  //           return response()->json(['errors'=>$validator->errors()->all()]);
  //       }
		// return response()->json(['errors'=>$errors->all()]);

		// dd($request->all());

		$hour_diff = round(round((strtotime($request->ride_end_date) - strtotime($request->ride_start_date))/3600, 1));
		// dd($hour_diff);

		// using diff function
		// $start  = date_create($request->ride_start_date);
		// $end 	= date_create($request->ride_end_date);
		// $diff  	= date_diff( $start, $end );
		// var_dump($diff);
		// $temp = $diff->h.':'.$diff->i;
		// dd($temp);

		// using carbon
		// $dt = new Carbon();
		// $dt = Carbon::parse($request->ride_end_date)->diffInHours(Carbon::parse($request->ride_start_date));
		// dd($dt);
// dd(date('Y-m-d H:i:s',strtotime($request->ride_start_date)));
		$total_amount = $hour_diff * $request->bike_hourly_rate;
		// dd($total_amount);

		$booking_request = new Booking;
		$booking_request->name = $request->name;
		$booking_request->email = $request->email;
		$booking_request->mobile = $request->mobile;
		$booking_request->age = $request->age;
		$booking_request->ride_start_date = date('Y-m-d H:i:s',strtotime($request->ride_start_date));
		$booking_request->ride_end_date = date('Y-m-d H:i:s',strtotime($request->ride_end_date));
		$booking_request->address = $request->address;
		$booking_request->created_at = time();

		// laravel requires, we must add both the timestapms to the database
		$booking_request->updated_at = time();
		$booking_request->total_amount = $total_amount;
		$booking_request->total_hours = $hour_diff;
		$booking_request->bike_id = $request->bike_id;
		$booking_request->save();


		// prepare data to be sent to email message
		$bike = Bike::findOrFail($request->bike_id);
		// $data = array(
		// 	'name'=>$bike->bike_title,
		// 	'hourly_rate'=>$bike->hourly_rate,
		// 	'image'=>$bike->cover_image,
		// 	'ride_start_date'=>$request->ride_start_date,
		// 	'ride_end_date'=>$request->ride_end_date,

		// 	'ride_duration'=>$hour_diff,
		// 	'total_amount'=>$total_amount
		// );
		$email = new BookingRequestMail($bike);
		$email->ride_start_date = Carbon::parse($request->ride_start_date)->toDayDateTimeString();
		$email->ride_end_date = Carbon::parse($request->ride_end_date)->toDayDateTimeString();
		$email->ride_duration = $hour_diff;
		$email->total_amount = $total_amount;
		// send email
		Mail::to($request->email)->send($email);

		return response()->json(['status'=>'Booking Request Submitted.']);

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

    public function update(Request $request)
    {
    	$cover_image = "";
    	$bike_id = $request->bike_id;

    	$this->validate($request,[
    		'bike_name'=>'required',
    		'description'=>'required',
    		'rate'=>'required'
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
            $cover_image = $fileNameToStore;

            // upload image
            $path = $request->file('cover_image')->storeAs('public/bikes',$fileNameToStore);

            // delete prev cover_image from folder
            $cover_image_to_delete = Bike::where('id',$bike_id)->pluck('cover_image')[0];
            // dd($cover_image_to_delete) ;
            File::delete('storage/bikes/'.$cover_image_to_delete); 
        } 

        // upload other_images
    	if ($request->hasFile('other_images')) 
    	{

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
	            $other_image->bike_id = $bike_id;
	            $other_image->image = $fileNameToStore;

	            $other_image->created_at = time();
	            $other_image->updated_at = time();
	            $other_image->save();   
    		}
        }

        // update bike details in db
        $bike = Bike::find($bike_id);
		$bike->bike_title = $request->bike_name;
		$bike->description = $request->description;
		$bike->hourly_rate = $request->rate;
		if (!empty($cover_image)) {
			$bike->cover_image = $cover_image;
		}
		

		// $bike->created_at = time();
		$bike->updated_at = time();
		$bike->save();

		$message = 'Bike '.$request->bike_name.' Updated';
		return redirect('/all_bikes')->with('status',$message);
    }

    public function get_bike_image_partial(Request $request)
    {
    	$bike_id = $request->bike_id;
    	$bike = Bike::find($bike_id);
    	$bike_other_images = bike_other_image::where('bike_id',$bike_id)->get();
		return view('admin.edit_images_partial',compact(['bike','bike_other_images']))->render();

    }

    public function get_bike_image_partials($bike_id)
    {
    	// copy of above function with param bike_id
    	$bike = Bike::find($bike_id);
    	$bike_other_images = bike_other_image::where('bike_id',$bike_id)->get();
    	// dd($bike);

    	// to pass view to ajax response, we need to render it using ->render()
		return view('admin.edit_images_partial',compact(['bike','bike_other_images']))->render();

    }

    public function remove_bike_other_image(Request $request)
    {
    	// return $request->bike_id;

    	if(isset($request->row_id)){
			// find, findOrFail needs primary key
			// $todo = bike_other_image::findOrFail($request->row_id);
			// $todo->delete();

			// delete other_image from folder
			$other_image_to_delete = bike_other_image::where('id',$request->row_id)->pluck('image')[0];
			File::delete('storage/bikes/'.$other_image_to_delete); 

			// delete from db
			$todo = bike_other_image::findOrFail($request->row_id);
			$todo->delete();
			
			return $this->get_bike_image_partials($request->bike_id);

			// create response
			// $resp = array(
			// 	'status'=>'success'
			// );
			// return response()->json($resp);
			
        }
    	
    }

    public function get_bike_filter(Request $request) {

        $bikes = Bike::sort_by_bikes($request['sort_by_bikes']);

        return view('/ajax_bikes_sort_filter', compact('bikes'))->render();
    }

    public function get_bike_price_filter(Request $request) {
        $arr_range = explode(',', $request['price_range']);
        $min_price = $arr_range[0];

        $max_price = $arr_range[1];

        $bikes = Bike::sort_by_price($min_price, $max_price);

        return view('/ajax_bikes_sort_filter', compact('bikes'))->render();

    }
}
