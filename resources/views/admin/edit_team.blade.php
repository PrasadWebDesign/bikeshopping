@extends('layouts.app')

@section('header')
<meta name="csrf-token" content="{{ csrf_token() }}">
	<script type="text/javascript" src="{{ asset('theme_assets/js/jquery-1.11.0.min.js') }}"></script>
@endsection

@section('content')
	<div class="container">
	    <div class="row justify-content-center">
	        <div class="col-md-8">
	            <div class="card">
	                <div class="card-header">Update Team Details</div>

	                <div class="card-body">
	                    @include('layouts.messages')

	                    <form id="update_bike_form" method="post" action="{{ URL::to('/team') }}/{{$team->id}}/edit" enctype="multipart/form-data">
	                        {{csrf_field()}}
							<input type="hidden" name="_method" value="put">
							<input type="hidden" name="team_id" value="{{$team->id}}">
	                        <div class="form-group">
	                            <input type="text" name="name" id="name" class="form-control" required="required" placeholder='Name' value="{{$team->name}}">
	                        </div>

	                        <div class="form-group">
	                            <input type="text" name="designation" id="designation" class="form-control" required="required" placeholder='Designation'  value="{{$team->designation}}">
	                        </div>

	                        <div class="form-group">
	                            <input type="text" name="experience" id="experience" class="form-control" required="required" placeholder='Experience' value="{{$team->experience}}">
	                            
	                        </div>

	                        <div class="form-group">
	                            <input type="file" name="photo" id="photo" class="form-control" >
	                        </div>

	                        <div class="form-group">
	                            <button type="submit" class="btn btn-primary">Submit</button>
	                        </div>
	                    </form>

	                    <div class="row">
	                    	<div class="col-md-12 ajaxImages">
	                    		<h3>Existing Photo</h3>
	                    		<img src="{{ asset('storage/teams').'/'.$team->photo }}" width="200px" class="img-responsive">
	                    	</div>	
	                    </div>
	                </div>
	            </div>
	        </div>
	    </div>
	</div>

@endsection
