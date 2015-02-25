<?php namespace App\Models;

use \DB;
use \DateTime;
use \Validator;

class Dvd {

	public static function selectTable($table) {

		return DB::table($table)->get();
	}

	public static function checkValue($table,$id) {

		$query = DB::table($table)->where('id','=',$id);

		return $query->get();
	}

	public static function getGenre($id) {

		if($id == 'all') {
			return $id;
		}

		$genres = self::checkValue('genres',$id);

		return $genres[0]->genre_name;
	}

	public static function getRating($id) {

		if($id == 'all') {
			return $id;
		}

		$ratings = self::checkValue('ratings',$id);

		return $ratings[0]->rating_name;
	}

	public static function searchDvd() {

		$query = DB::table('dvds')
			->select(
				array(
					'dvds.id as id',
					'dvds.title as title',
					'dvds.release_date as release_date',
					'ratings.rating_name as rating',
					'genres.genre_name as genre',
					'labels.label_name as label',
					'sounds.sound_name as sound',
					'formats.format_name as format'
				)
			  )
			->join('genres', 'genres.id', '=', 'dvds.genre_id')
			->join('ratings', 'ratings.id', '=', 'dvds.rating_id')
			->join('labels', 'labels.id', '=', 'dvds.label_id')
			->join('sounds', 'sounds.id', '=', 'dvds.sound_id')
			->join('formats', 'formats.id', '=', 'dvds.format_id');

		if (func_get_args()) {

			$term = func_get_arg(0);

			if ($term['title']) {
				$query->where('title', 'LIKE', '%'.$term['title'].'%');
			}

			if ($term['genre'] != 'all') {
				$query->where('dvds.genre_id', '=', $term['genre']);
			}

			if ($term['rating'] != 'all') {
				$query->where('dvds.rating_id', '=', $term['rating']);
			}

		}
		
		return $query->get();
	}

	public static function getDvd($id) {

		$query = DB::table('dvds')
			->select(
				array(
					'dvds.id as id',
					'dvds.title as title',
					'dvds.release_date as release_date',
					'ratings.rating_name as rating',
					'genres.genre_name as genre',
					'labels.label_name as label',
					'sounds.sound_name as sound',
					'formats.format_name as format'
				)
			  )
			->join('genres', 'genres.id', '=', 'dvds.genre_id')
			->join('ratings', 'ratings.id', '=', 'dvds.rating_id')
			->join('labels', 'labels.id', '=', 'dvds.label_id')
			->join('sounds', 'sounds.id', '=', 'dvds.sound_id')
			->join('formats', 'formats.id', '=', 'dvds.format_id')
			->where('dvds.id', '=', $id);

		return $query->get();
	}

	public static function getReviews($id) {

		$query = DB::table('reviews')
			->select(
				array(
					'reviews.title as title',
					'reviews.rating as rating',
					'reviews.description as review'
				)
			  )
			->where('reviews.dvd_id', '=', $id);

		return $query->get();
	}

	public static function formatDate($date) {

		$dateTime = new DateTime($date);
		
		return date_format($dateTime, 'F jS Y g:ia');
	}

	public static function validId($id) {

		$isValid = false;

		$query = DB::table('dvds')
			->where('dvds.id', '=', $id);
		
		$dvd = $query->get();

		if (count($dvd) == 1) {
			$isValid = true;
		}

		return $isValid;
	}

	public static function validateReview($input) {

		return Validator::make($input, [
			'title' => 'required|string|min:5',
			'rating' => 'required|integer|min:1|max:10',
			'review' => 'required|string|min:20',
			'dvd' => 'required|integer'
		]);
	}

	public static function createReview($data) {

		return DB::table('reviews')->insert($data);
	}
}