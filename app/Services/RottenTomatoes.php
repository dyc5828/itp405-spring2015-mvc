<?php namespace App\Services;

use Cache;

class RottenTomatoes {

	public static function search($dvd_title) {
		// var_dump($dvd_title);
		$dvd_title = strtolower($dvd_title);
		$dvd = str_replace(' ', '+', $dvd_title);

		$cacheKey = 'rt-'.$dvd;

		if (Cache::has($cacheKey)) {
			$json = Cache::get($cacheKey);
		} else {
			// http://api.rottentomatoes.com/api/public/v1.0/movies.json?page=1&apikey=6pd7pdu8xn9d998w3d7wtd7e&q=die+hard
			$apiEndpoint = [
				'http://api.rottentomatoes.com/api/public/v1.0/movies.json?page=1&apikey=',
				'&q='
			];
			$apiKey = '6pd7pdu8xn9d998w3d7wtd7e';

			$url = $apiEndpoint[0].$apiKey.$apiEndpoint[1].$dvd;
			$json = file_get_contents($url);

			Cache::put($cacheKey, $json, 60);
		}

		$result = json_decode($json);
		$movies = $result->movies;

		foreach($movies as $movie) {

			$movie_title = strtolower($movie->title);

			if ($movie_title == $dvd_title) {
				return $movie;
			}
		}

		return false;
	}
}