<script src="https://use.fontawesome.com/75736561a5.js"></script>

<meta name="csrf-token" content="{{ csrf_token() }}">
<h3>Existing Cover Image</h3>
<img src="{{ asset('storage/bikes').'/'.$bike->cover_image }}" width="200px" class="img-responsive">
<br><br>
<h3>Other Images</h3>
<table class="table">
	<tr>
		@foreach ($bike_other_images as $other_image)
			<td class="text-center">
				<img src="{{ asset('storage/bikes').'/'.$other_image->image }}" width="200px" class="img-responsive"><br>
				<a href="javascript:void(0)" class="btn btn-danger" data-id="{{$other_image->id}}" id="btnDelete" style="margin-top: 10px;" onclick="delete_link({{$other_image->id}},{{$other_image->bike_id}})"><i class="fa fa-trash" ></i></a>
			</td>
		@endforeach
	</tr>

</table>
<script type="text/javascript">

	function delete_link(row_id,bike_id) {
		
		// alert(bike_id);
		$.ajaxSetup({
		  headers: {
		    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		  }
		});
		$.ajax({
			type:'delete',
			url:'{{URL::to('/remove_bike_other_image')}}',
			data:{row_id:row_id,bike_id:bike_id,"_token": "{{ csrf_token() }}"},
			dataType:'html',
			success:function(resp){
				// alert(resp);
				// get_bike_other_images_partials();
				$('.ajaxImages').html(resp);
			}
		});
	}
	// $('#btnDelete').on('click',function(){
	// 	alert($(this).data('id'));
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
	// });
	
</script>