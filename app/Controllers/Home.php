<?php

namespace App\Controllers;

class Home extends BaseController
{
	public function index()
	{
		// var_dump($_ENV);


		$parser = \Config\Services::parser();
		$data = [
			'page_title' => 'Your title'
		];
		return view('home', $data);
	}
}
