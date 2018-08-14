@extends('layouts.app')

@section('header')
	{{-- expr --}}
@endsection

@section('content')
	<div class="container">
	    <div class="row justify-content-center">
	        <div class="col-md-8">
	            <div class="card">
	                <div class="card-header">Add New Member</div>

	                <div class="card-body">
	                    @include('layouts.messages')

	                    <form id="create_bike_form" method="post" action="{{ route('team.store') }}" enctype="multipart/form-data">
	                        {{csrf_field()}}

	                        <div class="form-group">
	                            <input type="text" name="name" id="name" class="form-control" placeholder="Name" required="required">

	                        </div>

	                        <div class="form-group">
	                            <input type="text" name="designation" id="designation" class="form-control" placeholder="Designation" required="required">

	                        </div>

	                        <div class="form-group">
	                           	<input type="text" name="experience" id="experience" class="form-control" placeholder="Experience" required="required">
	                        </div>

	                        <div class="form-group">
	                            <input type="file" name="photo" id="photo" class="form-control" placeholder="Photo" required="required">
	                        </div>

	                        <div class="form-group">
	                            <button type="submit" class="btn btn-primary">Submit</button>

	                        </div>
	                        {{-- <input name="_method" type="hidden" value="PUT"> --}}
	                        {{-- <input name="team_id" type="hidden" value="{{$banners}}"> --}}
	                    </form>

	                    
	                </div>
	            </div>
	        </div>
	    </div>
	</div>
@endsection


