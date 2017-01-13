<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<link rel="shortcut icon" href="public/images/document-icon.png">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
	<title>UET Share</title>
	<base href="{{ asset('') }}">

	<!-- Bootstrap -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css">
	<link href="https://fonts.googleapis.com/css?family=Pattaya&amp;subset=vietnamese" rel="stylesheet">
	<link type="text/css" rel="stylesheet" href="{{asset('public/css/style.css')}}">
	<style>
	</style>

</head>
<body>

	<!-- Header-->
	@include('layouts.header')
	<!-- End header-->

	<!-- Content -->
	@yield('content')
	<!-- End content -->

	<!-- Footer -->
	@include('layouts.footer')
	<!-- End footer -->

	<!-- js-->	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>	
	<script src="public/js/jquery.validate.js"></script>
    <script src="public/js/additional-methods.min.js"></script>
    <script type="text/javascript" src="public/js/jsindex.js"></script>
    {{-- <script src="public/js/jquery-3.1.1.min.js"></script> --}}
    {{-- <link rel="stylesheet" href="public/js/example.js"> --}}
    {{-- <script src="https://code.jquery.com/jquery-1.11.3.js"></script> --}}

	@yield('script')

</body>

</html>