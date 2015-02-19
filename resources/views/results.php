<!DOCTYPE html>
<html>
<head>
	<title>DVDs</title>

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
</head>
<body>
<div class="container">

<ul class="nav nav-pills">
	<li role="presentation"><a href="/">Home</a></li>
	<li role="presentation"><a href="/dvds/search">DVD Search</a></li>
	<li role="presentation" class="active"><a href="/dvds">DVDs</a></li>
</ul>

<h2>DVDs</h2>
<?php if (isset($terms['submit'])) : ?>
	<p>
		You search for

		<?php if($terms['title'] != '') : ?>
			title "<?php echo $terms['title'] ?>"
		<?php else : ?>
			titles
		<?php endif ?>
		
		from <?php echo $terms['genre'] ?> genre
		and <?php echo $terms['rating'] ?> rating.
	</p>
<?php else : ?>
	<p>
		<?php echo $terms ?>
	</p>
<?php endif ?>

</div>
<table class="table table-striped">
	<thead>
		<tr>
			<th>Title</th>
			<th>Rating</th>
			<th>Genre</th>
			<th>Label</th>
			<th>Sound</th>
			<th>Format</th>
			<th>Release Date</th>
		</tr>
	</thead>
	<tbody>
<?php foreach($dvds as $dvd) : ?>
	<?php
		$date = new DateTime($dvd->release_date);
	?>
	<tr>
		<td>
			<?php echo $dvd->title?>
		</td>
		<td>
			<?php echo $dvd->rating_name?>
		</td>
		<td>
			<?php echo $dvd->genre_name?>
		</td>
		<td>
			<?php echo $dvd->label_name?>
		</td>
		<td>
			<?php echo $dvd->sound_name?>
		</td>
		<td>
			<?php echo $dvd->format_name?>
		</td>
		<td>
			<?php echo date_format($date, 'F jS Y g:ia')?>
		</td>
	</tr>
<?php endforeach ?>

	</tbody>
</table>

</div>
</body>
</html>