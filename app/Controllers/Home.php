<?php

namespace App\Controllers;

class Home extends BaseController
{
	public function index()
	{
		// var_dump($_ENV);

		$data = [
			'page_title' => 'Your title'
		];
		return view('home', $data);
	}


	public function test() {
	    return "Test passed";
    }
}
