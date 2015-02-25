<!DOCTYPE html>
<html>
<head>
	<title>DVD Review -
		@yield('title')
	</title>

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
</head>
<body>
<div class="container-fluid">
	<div class="col-md-8 col-md-offset-2">
		<!--NAV-->
		<ul class="nav nav-pills">
			<li role="presentation"><a href="/">Home</a></li>
			<li role="presentation"><a href="/dvds/search">DVD Search</a></li>
			<li role="presentation"><a href="/dvds">DVDs</a></li>
		</ul>
		<!--HEADER-->
		<h2>DVD Review -
			@yield('title')
		</h2>
		@yield('info')
	</div>
</div><!--div.container-fluid-->

<div class="container-fluid">
	<div class="row">
		<!--REVIEWS-->
		<div class="col-md-5 col-md-offset-2">
			<h3 style="border-bottom:solid 2px #428bca">@yield('title') Reviews</h3>
			@yield('reviews')
		</div>
		<!--FORM-->
		<div class="col-md-3">
			<h3 style="border-bottom:solid 2px #428bca">
				Write a Review
				<small>
					@yield('msg')
				</small>
			</h3>
			@yield('form')
		</div>
	</div><!--div.row-->
</div><!--div.container-fluid-->
</body>
</html>