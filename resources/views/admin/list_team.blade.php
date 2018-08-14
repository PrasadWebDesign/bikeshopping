@extends('layouts.app')

@section('header')
	
@endsection

@section('content')
	
	<div class="container">
	    <div class="row justify-content-center">
	        <div class="col-md-10">
	            <div class="card">
	                <div class="card-header">All Teams</div>

	                <div class="card-body">
	                    @include('layouts.messages')


	                    <br><br>
	                    <table class="table table-bordered table-striped">
	                    	<tr>
	                    		<th>Sr. NO.</th>
	                    		<th>Name</th>
	                    		<th>Designation</th>
	                    		<th>Experience</th>
	                    		<th>Added at</th>
	                    		<th>Action</th>
	                    	</tr>
	                    	<?php $i=0; ?>
	                    	@forelse ($teams as $team)
	                    		<tr>
	                    			<td>{{++$i}}</td>
	                    			<td>{{$team->name}}</td>
	                    			<td>{{$team->designation}}</td>
	                    			<td>{{$team->experience}}</td>
	                    			<td>{{$team->created_at}}</td>
	                    			<td>
	                    				<form method="get" action="{{ URL::to('/team') }}/{{$team->id}}/edit">
	                    					{{csrf_field()}}
	                    					
	                    					<button type="submit" class="btn btn-warning btn-sm"><i class="fa fa-pencil"></i></button>
	                    				</form>
	                    				

	                    				<form method="post" action="{{ URL::to('/team') }}/{{$team->id}}/delete">
	                    					{{csrf_field()}}
	                    					<input type="hidden" name="_method" value="DELETE">
	                    					<button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
	                    				</form>
	                    				
	                    			</td>
	                    		</tr>
	                    	@empty
	                    		No team(s) found.
	                    	@endforelse
	                    </table>
	                    <div class="clearfix"> </div>

	                    {{$teams->links()}}
	                    
	                </div>
	            </div>
	        </div>
	    </div>
	</div>
@endsection
