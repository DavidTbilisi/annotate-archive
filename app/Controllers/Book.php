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

        $is_written = yaml_emit_file(WRITEPATH.'/book.yml', $post_data, YAML_UTF8_ENCODING);
        if ($is_written){
            return $this->respondCreated(["message"=>'File was written']);
        }
//        return redirect()->to('/book/test');
	}


	public function test()
    {
        $data =  file_get_contents(WRITEPATH.'/book.yml');

        $options = new QROptions([
//            'outputType' => QRCode::OUTPUT_MARKUP_SVG,
            'eccLevel'   => QRCode::ECC_L,
        ]);

        $qrcode = new QRCode($options);
        $parsed = yaml_parse_file(WRITEPATH.'/book.yml');
        $qrcode->render($data, 'images/Book.png');

        return view('book_separation/generated',[ 'image' => $data, "data"=>$parsed]);
    }



}
