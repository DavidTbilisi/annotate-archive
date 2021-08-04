<?php

namespace App\Controllers;
use chillerlan\QRCode\QRCode;
use chillerlan\QRCode\QROptions;
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
            return $this->respondCreated(["message"=>'File was written']);
        }
//        return redirect()->to('/book/test');
	}


	public function test()
    {
        $data =  file_get_contents(WRITEPATH.'/test_yaml.yml');

        $options = new QROptions([
//            'outputType' => QRCode::OUTPUT_MARKUP_SVG,
            'eccLevel'   => QRCode::ECC_L,
        ]);

        echo '<img src="'.(new QRCode($options))->render(utf8_encode($data), WRITEPATH.'Book.png').'" alt="'.$data.'" title="'.$data.'" />';
        $parsed = yaml_parse_file(WRITEPATH.'/test_yaml.yml');


        foreach ($parsed as $key => $value){
            echo "\n</br>\n\t" . $key . ": " . $value."";
        }


    }
}
