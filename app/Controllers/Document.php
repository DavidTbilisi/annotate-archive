<?php

namespace App\Controllers;

class Document extends BaseController
{
	public function index()
	{
		$data = [
			'page_title' => 'Document Annotation Sheet'
		];
		return view('book_separation/index', $data);
	}
}