@extends('layouts.app')

@section('header')
	
@endsection

@section('content')
	
	<div class="container">
	    <div class="row justify-content-center">
	        <div class="col-md-10">
	            <div class="card">
	                <div class="card-header">All Bikes</div>

	                <div class="card-body">
	                    @include('layouts.messages')


	                    <br><br>
	                    <table class="table table-bordered table-striped">
	                    	<tr>
	                    		<th>Sr. NO.</th>
	                    		<th>Name</th>
	                    		<th>Rate</th>
	                    		<th>Added at</th>
	                    		<th>Action</th>
	                    	</tr>
	                    	<?php $i=0; ?>
	                    	@forelse ($bikes as $bike)
	                    		<tr>
	                    			<td>{{++$i}}</td>
	                    			<td>{{$bike->bike_title}}</td>
	                    			<td>&#8377; {{$bike->hourly_rate}}</td>
	                    			<td>{{$bike->created_at}}</td>
	                    			<td>
	                    				<form method="get" action="{{ URL::to('/bikes') }}/{{$bike->id}}/edit">
	                    					{{csrf_field()}}
	                    					
	                    					<button type="submit" class="btn btn-warning btn-sm"><i class="fa fa-pencil"></i></button>
	                    				</form>
	                    				

	                    				<form method="post" action="{{ URL::to('/bikes') }}/{{$bike->id}}/delete">
	                    					{{csrf_field()}}
	                    					<input type="hidden" name="_method" value="DELETE">
	                    					<button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
	                    				</form>
	                    				
	                    			</td>
	                    		</tr>
	                    	@empty
	                    		No bike(s) found.
	                    	@endforelse
	                    </table>
	                    <div class="clearfix"> </div>

	                    {{$bikes->links()}}
	                    
	                </div>
	            </div>
	        </div>
	    </div>
	</div>
@endsection
