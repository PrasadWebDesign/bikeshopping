@extends('layouts.master')
@section('content')
<!--contact start here-->
<div class="contact">
	<div class="container">
		<div class="contact-main">
			<div class="contact-top">
				<h1>Contact Us</h1>
				<p>The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections Cicero are reproduced.</p>
			</div>
			<div class="col-md-6 contact-left">
				<h2>Information</h2>
				<h4>Cicero are also reproduced in their exact original</h4>
				<p>The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from "de Finibus Bonorum et Malorum" by Cicero are also reproduced in their exact original form, accompanied by English.</p>
			    <ul>
			    	<li><span class="glyphicon glyphicon-map-marker" aria-hidden="true"> </span>Professor at Hampden-Sydney</li>
			    	<li><span class="glyphicon glyphicon-phone" aria-hidden="true"> </span><a href="tel:+1284 485 978">+1284 485 978</a>, <a href="tel:+1284 485 978">+1284 485 978</a>, <a href="tel:+1284 485 978">+1284 485 978</a> </li>			    	
			    	<li><span class="glyphicon glyphicon-envelope" aria-hidden="true"> </span><a href="mailto:support@example.com">support@example.com</a></li>
			    </ul>
			</div>
			<div class="col-md-6 contact-right">
				<h3>Feedback</h3>
			<form id="contact_form" method="POST" action="#">
				<input type="text" placeholder="Name" required="required">
				<input type="text" placeholder="Email" required="required">
				<textarea placeholder="Message" required="required"></textarea>
				<input type="submit" value="send">
			</form>
			</div>
		  <div class="clearfix"> </div>
		</div>
	</div>
</div>
<!--contact end here-->
@endsection