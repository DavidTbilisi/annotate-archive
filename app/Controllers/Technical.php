<?php

namespace App\Controllers;

use chillerlan\QRCode\QRCode;
use chillerlan\QRCode\QROptions;
use CodeIgniter\API\ResponseTrait;


class Technical extends BaseController
{
    use ResponseTrait;

    public function index()
	{
		$data = [
			'page_title' => 'Technical Separation Sheet',
		];

        yaml_emit_file(WRITEPATH.'/tech.yml', ["type"=>'ts', "name"=>'stop'], YAML_UTF8_ENCODING);
		return view('technical/index', $data);
	}


    public function qrcode()
    {

        $post_data = $this->request->getPost();

        $is_written = yaml_emit_file(WRITEPATH.'/qrcode_tech.yml', $post_data, YAML_UTF8_ENCODING);
        if ($is_written){
            return $this->respondCreated(["message"=>'File was written']);
        } return $this->respondNoContent(["message"=>'File was not written']);

    }


    public function show(){
        $data =  file_get_contents(WRITEPATH.'/qrcode_tech.yml');

        $options = new QROptions([
//            'outputType' => QRCode::OUTPUT_MARKUP_SVG,
            'eccLevel'   => QRCode::ECC_L,
        ]);

        $qrcode = new QRCode($options);
        $parsed = yaml_parse_file(WRITEPATH.'/qrcode_tech.yml');
        $qrcode->render($data, 'images/Technical.png');


        return view('technical/generated',[ 'image' => $data, "data"=>$parsed]);
    }

}
