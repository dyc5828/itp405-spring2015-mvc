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

		// echo '<pre>';
		// var_dump($dvds);

		return view('results',[
			'dvds' => $dvds,
			'terms' => $terms
		]);
	}

	public function review($id, Request $request) {

		// var_dump($id);
		// var_dump($request->all());

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

		$dvds = Dvd::getDvd($id);
		// var_dump($dvds);

		$dvd = $dvds[0];
		$dvd->date = Dvd::formatDate($dvd->release_date);
		// var_dump($dvd);

		$reviews = Dvd::getReviews($id);
		// var_dump($reviews);

		return view('reviews', [
			'id' => $id,
			'dvd' => $dvd,
			'reviews' => $reviews
		]);
	}

}