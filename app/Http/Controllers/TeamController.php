<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Team;
use File;

class TeamController extends Controller {

	public function __construct() {
		$this->middleware('auth')->except(['index']);
	}


	public function index() {
		$teams = Team::paginate(1);

		return view('teams', compact('teams'));
	}

	public function create() {
		return view('admin.create_team');
	}

	public function store( Request $request) {
		$last_team_id = '';

		$this->validate($request, [
				'name' => 'required',
				'designation' => 'required',
				'experience' => 'required'
			]);

		//upload photo
		if( $request->hasFile('photo')) {
			//get filename with extension
			$fileNameWithExt = $request->file('photo')->getClientOriginalName();

			// get just filename
            $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);

            // GET JUST EXT
            $ext = $request->file('photo')->getClientOriginalExtension();

            // filename to store
            $fileNameToStore = $filename.'_'.time().'.'.$ext;

            // upload image
            $path = $request->file('photo')->storeAs('public/teams',$fileNameToStore);

            // save image name to db
            $team = new Team;
            $team->name = $request->name;
            $team->designation = $request->designation;
            $team->experience = $request->experience;
            $team->photo = $fileNameToStore;

            $team->created_at = time();
            $team->updated_at = time();
            $team->save();

			// get last insert id
            $last_team_id =$team->id;
		}
		return redirect('/all_team')->with('status','Team created successfully.'); 
	}

	public function list_teams()
    {
    	$teams = Team::orderBy('id','desc')->paginate('15');
    	return view('admin.list_team',compact('teams'));
    }

    public function edit($id) {
    	$team = Team::find($id);
    	return view('admin.edit_team',compact('team'));
    }

    public function update(Request $request) {
    	$photo = "";
    	$team_id = $request->team_id;

    	$this->validate($request, [
				'name' => 'required',
				'designation' => 'required',
				'experience' => 'required'
			]);

    	if( $request->hasFile('photo') ) {
    		// get file name with ext
            $fileNameWithExt = $request->file('photo')->getClientOriginalName();

            // get just filename
            $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);

            // GET JUST EXT
            $ext = $request->file('photo')->getClientOriginalExtension();

            // filename to store
            $fileNameToStore = $filename.'_'.time().'.'.$ext;
            $photo = $fileNameToStore;

            // upload image
            $path = $request->file('photo')->storeAs('public/teams',$fileNameToStore);

            // delete prev photo from folder
            $photo_to_delete = Team::where('id',$team_id)->pluck('photo')[0];

            File::delete('stoarge/teams/' . $photo_to_delete );
    	}

    	$team = Team::find($team_id);

    	$team->name = $request->name;
        $team->designation = $request->designation;
        $team->experience = $request->experience;

        if(!empty($photo)) {
        	$team->photo = $photo;
        }

        $team->updated_at = time();

 		$team->save();	

 		$message = 'Team '.$request->name.' Updated';
		return redirect('/all_team')->with('status',$message);

    }

    public function destroy($id) {
    	$team = Team::find($id);

    	$team->delete();

    	return redirect('/all_team')->with('status', 'Team removed');
    }
}