<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Config extends BaseController

{
	public function index()
	{
        $nominals = $this->db->table('nominals')->get()->getResult();
        $institutions = $this->db->table('institution')->get()->getResult();
        $connection = $this->db->table('connectiontype')->get()->getResult();
		return view('config/index', [
		    'nominals'=>$nominals,
		    'institutions'=>$institutions,
		    'connections'=>$connection,
            ]);
	}

	public function add_nominal(){

        $data = [
            'title' => $this->request->getPost('nominal'),
        ];

        $this->db->table('nominals')->insert($data);
        return redirect("config");
    }

	public function add_institution(){
        $data = [
            'title' => $this->request->getPost('institutions'),
        ];

        $this->db->table('institution')->insert($data);
        return redirect("config");
    }

	public function add_connection(){
        $data = [
            'title' => $this->request->getPost('connection'),
        ];

        $this->db->table('connectiontype')->insert($data);
        return redirect("config");
    }

}
