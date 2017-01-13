<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin - @yield('title')</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css">  
    <link rel="shortcut icon" href="public/images/document-icon.png">
    
    <base href="{{ asset('') }}">
    <style type="text/css">
        tr th {
            text-align: center;
        }
        .nav-menu li a {
            background-color: #ecf0f1;
        }
        .menu {
            margin-top: 0px;
            margin-left: 20px;
            margin-right: 20px;
            padding: 110px 10px;
        }
        .menu .nav li {
            padding: 2px;
        }
        .menu .nav li a {
            padding: 15px;
        }
        .validation-message {
            color: red;
            font-style: italic;
            font-weight: normal;
        }
    </style>
</head>
<body>
    <div class="wrapper">
    	<!-- Navbar -->
    	@include('admin.layouts.header')
    	<!-- ./ Navbar -->

		<div class="row">
			<!-- Menu -->
			@include('admin.layouts.menu')
			<!-- ./ Menu -->

			<!-- Page content -->
			@yield('content')
			<!-- ./ Page content -->
		</div>

	</div>

    <!-- script -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> 
    <script src="public/js/jquery.validate.js"></script>
    <script src="public/js/additional-methods.min.js"></script>

    @yield('script')
</body>
</html>