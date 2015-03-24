@extends('master')

@section('page-title')
	DVDs - {{$genre}}
@stop

@section('nav')
	@include('nav-a7')
@stop

@section('content')
<h2>
	DVDs - {{$genre}}
</h2>
<table class="table table-striped">
	<thead>
		<tr>
			<th>Title</th>
			<th>Rating</th>
			<th>Genre</th>
			<th>Label</th>
		</tr>
	</thead>
	<tbody>
	@foreach($dvds as $dvd)
		<tr>
			<td>
				<a href="/dvds/:<?php echo $dvd->id?>">
					{{ $dvd->title }}
				</a>
			</td>
			<td>
				{{ $dvd->rating->rating_name }}
			</td>
			<td>
				{{ $dvd->genre->genre_name }}
			</td>
			<td>
				{{ $dvd->label->label_name }}
			</td>
		</tr>
	@endforeach
	</tbody>
</table>
@stop