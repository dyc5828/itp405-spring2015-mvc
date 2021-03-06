<!DOCTYPE html>
<html>
<head>
	<title>Search</title>

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
</head>
<body>

<div class="container-fluid">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<ul class="nav nav-pills">
				<li role="presentation"><a href="/">Home</a></li>
				<li role="presentation" class="active"><a href="/dvds/search">DVD Search</a></li>
				<li role="presentation"><a href="/dvds">DVDs</a></li>
			</ul>
		</div>
	</div>

	<div class="row">
		<div class="col-xs-9 col-md-8 col-md-offset-1">
			<h2>DVD Search</h2>
			<form method="get" action="/dvds">
				<div class="form-group">
					<label for="title">
						DVD Title:
					</label>
					<input type="text" name="title" id="title" class="form-control">
				</div>
				<div class="form-group">
					<label for="genre">
						Genre:
					</label>
					<select name="genre" id="genre" class="form-control">
						<option value="all">
							ALL
						</option>
						<?php foreach($genres as $genre) : ?>
							<option value="<?php echo $genre->id ?>">
								<?php echo $genre->genre_name ?>
							</option>
						<?php endforeach ?>
					</select>
				</div>
				<div class="form-group">
					<label for="rating">
						Rating:
					</label>
					<select name="rating" id="rating" class="form-control">
						<option value="all">
							ALL
						</option>
						<?php foreach($ratings as $rating) : ?>
							<option value="<?php echo $rating->id ?>">
								<?php echo $rating->rating_name ?>
							</option>
						<?php endforeach ?>
					</select>
				</div>
				<div class="form-group">
					<input type="submit" name="submit" value="Search" class="btn btn-primary">
				</div>
			</form>
		</div>
		<div class="col-xs-3 col-md-2 list-group">
			<a class="list-group-item active" href="#">
				<strong>Genres</strong>
			</a>
			<?php foreach($genres as $genre) : ?>
				<a class="list-group-item" href="/genres/<?php echo $genre->genre_name ?>/dvds">
					<?php echo $genre->genre_name ?>
				</a>
			<?php endforeach ?>
		</div>
	</div>
</div>

</body>
</html>