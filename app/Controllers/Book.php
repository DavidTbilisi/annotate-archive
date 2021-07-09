<?php

namespace App\Controllers;

class Book extends BaseController
{
	public function index()
	{
		$data = [
			'page_title' => 'Book Separation Sheet'
		];
		return view('book_separation/index', $data);
	}
}
