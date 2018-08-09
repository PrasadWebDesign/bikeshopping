@extends('layouts.app')

@section('header')
	{{-- expr --}}
@endsection

@section('content')
	<div class="container">
	    <div class="row justify-content-center">
	        <div class="col-md-8">
	            <div class="card">
	                <div class="card-header">Update Home Banner</div>

	                <div class="card-body">
	                    @include('layouts.messages')

	                    <form id="create_bike_form" method="post" action="{{ route('bikes.store') }}" enctype="multipart/form-data">
	                        {{csrf_field()}}

	                        <div class="form-group">
	                            <input type="text" name="bike_name" id="bike_name" class="form-control" required="required">

	                        </div>

	                        <div class="form-group">
	                            <textarea class="form-control" name="description" id="description" required="required"></textarea>

	                        </div>

	                        <div class="form-group">
	                            <input type="text" name="rate" id="rate" class="form-control" required="required" onkeypress="return isNumber(event)">
	                        </div>

	                        <div class="form-group">
	                            <input type="file" name="cover_image" id="cover_image" class="form-control" required="required">
	                        </div>

	                        <div class="form-group">
	                            <input type="file" name="other_images[]" id="other_images" class="form-control" required="required" multiple>
	                        </div>

	                        <div class="form-group">
	                            <button type="submit" class="btn btn-primary">Submit</button>

	                        </div>
	                        {{-- <input name="_method" type="hidden" value="PUT"> --}}
	                        {{-- <input name="banner_id" type="hidden" value="{{$banners}}"> --}}
	                    </form>

	                    
	                </div>
	            </div>
	        </div>
	    </div>
	</div>
@endsection

@section('footer')
	<script src="https://cdn.ckeditor.com/4.10.0/standard/ckeditor.js"></script>
    <script>
            CKEDITOR.replace( 'description' );

            function isNumber(evt) {
			    evt = (evt) ? evt : window.event;
			    var charCode = (evt.which) ? evt.which : evt.keyCode;
			    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
			        return false;
			    }
			    return true;
			}
    </script>
@endsection