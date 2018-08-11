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
	                <div class="card-header">Update Bike Details</div>

	                <div class="card-body">
	                    @include('layouts.messages')

	                    <form id="update_bike_form" method="post" action="{{ URL::to('/bikes') }}/{{$bike->id}}/edit" enctype="multipart/form-data">
	                        {{csrf_field()}}
							<input type="hidden" name="_method" value="put">
							<input type="hidden" name="bike_id" value="{{$bike->id}}">
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
	                            <input type="file" name="cover_image" id="cover_image" class="form-control" >
	                        </div>

	                        <div class="form-group">
	                            <input type="file" name="other_images[]" id="other_images" class="form-control"  multiple>
	                        </div>

	                        <div class="form-group">
	                            <button type="submit" class="btn btn-primary">Submit</button>

	                        </div>
	                        {{-- <input name="_method" type="hidden" value="PUT"> --}}
	                        {{-- <input name="banner_id" type="hidden" value="{{$banners}}"> --}}
	                    </form>

	                    <div class="row">
	                    	<div class="col-md-12 ajaxImages">
	                    		{{-- <h3>Existing Cover Image</h3>
	                    		<img src="{{ asset('storage/bikes').'/'.$bike->cover_image }}" width="200px" class="img-responsive">
	                    		<br><br>
	                    		<h3>Other Images</h3>
	                    		<table class="table">
	                    			<tr>
		                    			@foreach ($bike_other_images as $other_image)
		                    				<td>
		                    					<img src="{{ asset('storage/bikes').'/'.$other_image->image }}" width="200px" class="img-responsive">

		                    				</td>
		                    			@endforeach
	                    			</tr>

	                    		</table> --}}
	                    	</div>	
	                    </div>
	                </div>
	            </div>
	        </div>
	    </div>
	</div>
	<script type="text/javascript">
		$('document').ready(function(){
			get_bike_other_images_partials();

			function get_bike_other_images_partials(){
				$.ajaxSetup({
				  headers: {
				    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				  }
				});
				$.ajax({
					type:'POST',
					url:'{{URL::to('/bike_images_partial')}}',
					data:{bike_id:{{$bike->id}} },
					dataType:'html',
					success:function(resp){
						// alert(resp);
						$('.ajaxImages').html(resp);
					}
				});
			}
			// $('#btnDelete').click(function(){
			// 	alert('1');
			// 	$.ajaxSetup({
			// 	  headers: {
			// 	    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			// 	  }
			// 	});
			// 	$.ajax({
			// 		type:'post',
			// 		url:'{{URL::to('/remove_bike_other_image')}}',
			// 		data:{_method:'DELETE',bike_id:$(this).data('id')},
			// 		dataType:'html',
			// 		success:function(resp){
			// 			alert(resp);
			// 			// $('.ajaxImages').html(resp);
			// 		}
			// 	});
			// })
		});
	</script>
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