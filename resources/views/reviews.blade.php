@extends('reviews-layout')


@section('title')
	{{ $dvd->title }}
@stop


@section('msg')
	@if (Session::has('msg'))
			{{ Session::get('msg') }}
	@endif
@stop


@section('info')
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
			<tr>
				<td>
					{{ $dvd->title }}
				</td>
				<td>
					{{ $dvd->rating }}
				</td>
				<td>
					{{ $dvd->genre }}
				</td>
				<td>
					{{ $dvd->label }}
				</td>
				<td>
					{{ $dvd->sound }}
				</td>
				<td>
					{{ $dvd->format }}
				</td>
				<td>
					{{ $dvd->date }}
				</td>
			</tr>

		</tbody>
	</table>
@stop

@section('reviews')
	@if (count($reviews))
		@foreach($reviews as $review)
			<div style="border-bottom: solid 1px #ddd">
				<h4>
					{{ $review->title }}
					<small>
						{{ $review->rating }} out of 10
					</small>
				</h4>
				<p>
					{{ $review->review }}
				</p>
			</div>
		@endforeach
	@else
		<p>No Reviews for {{ $dvd->title }}.</p>
	@endif
@stop


@section('form')
	@foreach ($errors->all() as $errorMessage)
		<p class="bg-danger">
			{{ $errorMessage }}
		</p>
	@endforeach
	<form role="form" method="post" action="">
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
		<input type="hidden" name="dvd" value="{{ $id }}">
		<div class="form-group">
			<label for="title">
				Title:
			</label>
			<input
				type="text"
				required
				name="title"
				id="title"
				class="form-control"
				value="{{ Request::old('title') }}"
			>
		</div>
		<div class="form-group">
			<label for="rate">
				Rate (1 to 10):
			</label>
			<input
				type="number"
				min="1"
				max="10"
				required
				name="rating"
				id="rate"
				class="form-control"
				value="{{ Request::old('rating') }}"
			>
		</div>
		<div class="form-group">
			<label for="review">
				Review:
			</label>
			<textarea
				required rows="4"
				name="review"
				id="review"
				class="form-control"
			>{{ Request::old('review') }}</textarea>
		</div>
		<div class="form-group">
			<input type="submit" name="submit" value="Submit" class="btn btn-primary">
		</div>
	</form>
@stop