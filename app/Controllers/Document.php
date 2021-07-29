<?php

namespace App\Controllers;

class Document extends BaseController
{
	public function index()
	{
		$data = [
		    'nominals' => $nominals = $this->db->table('nominals')->get()->getResult(),
            "institutions" => $this->db->table('institution')->get()->getResult(),
            "connections" => $this->db->table('connectiontype')->get()->getResult(),
			'page_title' => 'Document Annotation Sheet'
		];

		return view('document/index', $data);
	}
}
