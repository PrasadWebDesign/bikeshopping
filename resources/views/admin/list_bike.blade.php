@extends('layouts.app')

@section('header')
	<script src="https://use.fontawesome.com/75736561a5.js"></script>
@endsection

@section('content')
	
	<div class="container">
	    <div class="row justify-content-center">
	        <div class="col-md-8">
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
	                    				<a href="#"><i class="fa fa-pencil"></i></a>
	                    				<a href="#"><i class="fa fa-trash"></i></a>
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
