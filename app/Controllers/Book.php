<?php

namespace App\Controllers;

class Book extends BaseController
{
	public function index()
	{
		$data = [
			'page_title' => 'Book Separation Sheet'
		];
        $db = \Config\Database::connect();
        dd($db);
		return view('book_separation/index', $data);
	}
}
