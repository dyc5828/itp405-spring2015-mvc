<?php namespace App\Http\Controllers;

use \App\Models\Dvd;
use \Illuminate\Http\Request;

class DvdController extends Controller {

	public function search() {

		$genres = Dvd::selectTable('genres');
		$ratings = Dvd::selectTable('ratings');

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

		return view('results',[
			'dvds' => $dvds,
			'terms' => $terms
		]);
	}

}