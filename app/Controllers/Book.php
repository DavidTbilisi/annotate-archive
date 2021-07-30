<?php

namespace App\Controllers;
use CodeIgniter\API\ResponseTrait;
class Book extends BaseController
{
    use ResponseTrait;
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

        $post_data = $this->request->getPost();

        $is_written = yaml_emit_file(WRITEPATH.'/test_yaml.yml', $post_data, YAML_UTF8_ENCODING);
        if ($is_written){
            return $this->respondCreated('File was written');
            die;
        }
	}
}
