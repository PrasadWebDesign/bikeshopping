@extends('layouts.app')

@section('header')
	{{-- expr --}}
@endsection

@section('content')
	<div class="container">
	    <div class="row justify-content-center">
	        <div class="col-md-8">
	            <div class="card">
	                <div class="card-header">Update Bike Details</div>

	                <div class="card-body">
	                    @include('layouts.messages')

	                    <form id="update_bike_form" method="post" action="{{ URL::to('/bikes') }}/{{$bike->id}}/edit" enctype="multipart/form-data">
	                        {{csrf_field()}}
							<input type="hidden" name="_method" value="put">
	                        <div class="form-group">
	                            <input type="text" name="bike_name" id="bike_name" class="form-control" required="required" value="{{$bike->bike_title}}">

	                        </div>

	                        <div class="form-group">
	                            <textarea class="form-control" name="description" id="description" required="required">{{$bike->description}}</textarea>

	                        </div>

	                        <div class="form-group">
	                            <input type="text" name="rate" id="rate" class="form-control" required="required" onkeypress="return isNumber(event)" value="{{$bike->hourly_rate}}">
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

	                    <div class="row">
	                    	<div class="col-md-12">
	                    		<h3>Existing Cover Image</h3>
	                    		<img src="{{ asset('storage/bikes').'/'.$bike->cover_image }}" width="200px" class="img-responsive">
	                    		<br>
	                    		<h3>Other Images</h3>
	                    		<table class="table">
	                    			<tr>
		                    			@foreach ($bike_other_images as $other_image)
		                    				<td>
		                    					<img src="{{ asset('storage/bikes').'/'.$other_image->image }}" width="200px" class="img-responsive">

		                    				</td>
		                    			@endforeach
	                    			</tr>

	                    		</table>
	                    	</div>	
	                    </div>
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