<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Config extends BaseController
{
	public function index()
	{
		return view('config/index');
	}
}
