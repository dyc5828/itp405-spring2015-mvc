<!DOCTYPE html>
<html>
<head>
	<title>
		@yield('page-title')
	</title>

	<!--bootstrap js-->
	<script defer src="//ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script defer src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
	
	<!--bootstrap css-->
	<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
</head>
<body>
@yield('nav')
<div class="container-fluid">

	<!-- CONTENT -->
	<div class="row">
		<div class="col-lg-8 col-lg-offset-2">
			@yield('content')
		</div><!--div.col 8 offset 2-->
	</div><!--div.row-->
	
</div><!--div.container-fluid-->
</body>
</html>