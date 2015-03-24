<?php namespace App\Http\Controllers;

use \App\Models\Dvd;
use \App\Models\Format;
use \App\Models\Genre;
use \App\Models\Label;
use \App\Models\Rating;
use \App\Models\Sound;

use \App\Services\RottenTomatoes as RT;

use \Illuminate\Http\Request;

class DvdController extends Controller {

	// A7 - search() A5
	public function create() {
		$labels = Label::all();
		$sounds = Sound::all();
		$genres = Genre::all();
		$ratings = Rating::all();
		$formats = Format::all();

		return view('insert', [
			'labels' => $labels,
			'sounds' => $sounds,
			'genres' => $genres,
			'ratings' => $ratings,
			'formats' => $formats,
		]);
	}

	public function insert(Request $request) {

		if ($request->input('submit')) {
			//dd($request->all());
			$dvd = new Dvd();
			$dvd->label_id = $request->input('label');
			$dvd->sound_id = $request->input('sound');
			$dvd->genre_id = $request->input('genre');
			$dvd->rating_id = $request->input('rating');
			$dvd->format_id = $request->input('label');

			$saved = $dvd->save();
			//dd($saved);

			if ($saved) {
				return redirect('/dvds/create')->with('success','DVD have been successfully added!');
			}
			else {
				return redirect('/dvds/create')->with('fail','There was a problem. The DVD was not added');
			}
		}

		return redirect('/dvds/create');
	}

	public function genreDvds($genre_name) {
		//dd($genre_name);

		$dvds = Dvd::with('genre','rating','label')
		->whereHas('genre', function($query) use ($genre_name) {
			$query->where('genre_name','=',$genre_name);
		})
		->get();
		//dd($dvds);

		return view('genreDvds', [
			'genre' => $genre_name,
			'dvds' => $dvds
		]);
	}

	// A6 - A8 updated
	public function review($id, Request $request) {

		// valid
		if (!Dvd::validId($id)) {
			return redirect('/dvds/search');
		}

		if ($request->input('submit')) {
			var_dump($request->all());

			$validation = Dvd::validateReview($request->all());

			if($validation->passes()) {
				Dvd::createReview([
					'title' => $request->input('title'),
					'description' => $request->input('review'),
					'dvd_id' => $request->input('dvd'),
					'rating' => $request->input('rating'),
				]);

				return redirect('/dvds/:'.$id)->with('msg','Review successfully submitted!');
			}
			else {
				return redirect('/dvds/:'.$id)
					->with('msg','Review was not submitted.')
					->withInput()
					->withErrors($validation);
			}
		}

		// dvd info
		$dvds = Dvd::getDvd($id);
		// var_dump($dvds);

		$dvd = $dvds[0];
		$dvd->date = Dvd::formatDate($dvd->release_date);
		// var_dump($dvd);

		// dvd reviews
		$reviews = Dvd::getReviews($id);
		// var_dump($reviews);

		// rt data
		$rt = RT::search($dvd->title);
		// echo '<pre>';
		// var_dump($rt);

		return view('details', [
			'id' => $id,
			'dvd' => $dvd,
			'reviews' => $reviews,
			'rt' => $rt
		]);
	}

	// A5 - A7 updated
	public function search() {

		$genres = Genre::all();
		$ratings = Rating::all();

		return view('search', [
			'genres' => $genres,
			'ratings' => $ratings
		]);
	}

	public function results(Request $request) {

		if ($request->input('submit')) {

			$dvds = Dvd::searchDvd($request->all());

			$terms = $request->all();

			$genre = Dvd::getGenre($request->input('genre'));
			$rating = Dvd::getRating($request->input('rating'));
			
			$terms['genre'] = $genre;
			$terms['rating'] = $rating;
		} else {

			$dvds = Dvd::searchDvd();
			$terms = 'Displaying All DVDs.';
		}

		// echo '<pre>';
		// var_dump($dvds);

		return view('results',[
			'dvds' => $dvds,
			'terms' => $terms
		]);
	}
}