@extends('master')

@section('page-title')
	DVDs Details - {{$dvd->title}}
@stop

@section('nav')
	@include('nav-a8')
@stop

@section('content')

	{{-- dvd info --}}
	<div class="row">
		<div class="col-md-12">
			<h2>DVDs Details - {{$dvd->title}}</h2>
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
		</div><!--/.col-->
	</div><!--div.row-->

	{{-- RT data --}}
	@if($rt)
		<div class="row">
			<div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
				<h4>Rotten Tomatoes Data:</h4>
				<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
					<img class="img-responsive" src="{{ $rt->posters->thumbnail }}"/>
				</div><!--/.col-->
				<div class="col-lg-8 col-md-8 col-sm-8 cold-xs-8">
				Critics Score: {!! $rt->ratings->critics_score !!}<br>
				Audience Score: {!! $rt->ratings->audience_score !!}<br>
				Runtime: {!! $rt->runtime !!} minutes
				</div><!--/.col-->
			</div><!--/.col-->
			<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
				<h4>Cast:</h4>
				<ul>
				@foreach($rt->abridged_cast as $cast)
					<li>{{ $cast->name }}</li>
				@endforeach
				</ul>
			</div><!--/.col-->
		</div><!--/.row-->
	@endif

	{{-- dvd reivew --}}
	<div class="row">

		<!--REVIEWS-->
		<div class="col-md-8">
			<h3 style="border-bottom:solid 2px #428bca">@yield('title') Reviews</h3>

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

		</div><!--/.col-->

		<!--FORM-->
		<div class="col-md-4">
			<h3 style="border-bottom:solid 2px #428bca">
				Write a Review
				<small>

				@if (Session::has('msg'))
						{{ Session::get('msg') }}
				@endif

				</small>
			</h3>
			
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
		</div><!--/.col-->

	</div><!--div.row-->
@stop