<?php

namespace App\Controllers;

class Technical extends BaseController
{
	public function index()
	{
		$data = [
			'page_title' => 'Technical Separation Sheet'
		];
		return view('book_separation/index', $data);
	}
}
