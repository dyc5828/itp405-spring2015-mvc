<?php namespace App\Models;

use \DB;

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
}