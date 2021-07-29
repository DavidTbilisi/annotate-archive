<?php

namespace App\Controllers;

class Book extends BaseController
{
	public function index()
	{
		$data = [
			'page_title' => 'Book Separation Sheet',
            'nominals' => $this->db->table('nominals')->get()->getResult(),

        ];

		return view('book_separation/index', $data);
	}


    public function to_yaml()
    {
        yaml_emit_file(WRITEPATH.'/test_yaml.yml', ["name"=>"David"]);
	}
}
