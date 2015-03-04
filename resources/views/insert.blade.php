@extends('master')

@section('page-title')
	DVD Insert
@stop

@section('nav')
	@include('nav-a7')
@stop

@section('content')
	<h2>
		DVD Insert
	</h2>

	@if (Session::has('success'))
		<p class="bg-success">
			{{ Session::get('success') }}
		</p>
	@endif
	@if (Session::has('fail'))
		<p class="bg-danger">
			{{ Session::get('fail') }}
		</p>
	@endif

	<form role="form" method="post" action="/dvds">
		<input type="hidden" name="_token" value="{{ csrf_token() }}">

		<div class="form-group">
			<label for="title">
				DVD Title:
			</label>
			<input
				type="text"
				required
				name="title"
				id="title"
				class="form-control"
			>
		</div>

		<div class="form-group">
			<label for="label">
				Label:
			</label>
			<select name="label" id="label" class="form-control">
				@foreach ($labels as $label)
					<option value="{{$label->id}}">
						{{$label->label_name}}
					</option>
				@endforeach
			</select>
		</div>

		<div class="form-group">
			<label for="sound">
				Sound:
			</label>
			<select name="sound" id="sound" class="form-control">
				@foreach ($sounds as $sound)
					<option value="{{$sound->id}}">
						{{$sound->sound_name}}
					</option>
				@endforeach
			</select>
		</div>

		<div class="form-group">
			<label for="genre">
				Genre:
			</label>
			<select name="genre" id="genre" class="form-control">
				@foreach ($genres as $genre)
					<option value="{{$genre->id}}">
						{{$genre->genre_name}}
					</option>
				@endforeach
			</select>
		</div>

		<div class="form-group">
			<label for="rating">
				Rating:
			</label>
			<select name="rating" id="rating" class="form-control">
				@foreach ($ratings as $rating)
					<option value="{{$rating->id}}">
						{{$rating->rating_name}}
					</option>
				@endforeach
			</select>
		</div>

		<div class="form-group">
			<label for="format">
				Format:
			</label>
			<select name="format" id="format" class="form-control">
				@foreach ($formats as $format)
					<option value="{{$format->id}}">
						{{$format->format_name}}
					</option>
				@endforeach
			</select>
		</div>

		<div class="form-group">
			<input type="submit" name="submit" value="Submit" class="btn btn-primary">
		</div>
	</form>
@stop
@stop