<?php namespace App\Http\Controllers;

class NavController extends Controller {

	public function index() {
		return view('nav');
	}

	public function toIndex() {
		return redirect('/');
	}
}