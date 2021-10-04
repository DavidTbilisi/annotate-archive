<?php

namespace App\Controllers;

use chillerlan\QRCode\QRCode;
use chillerlan\QRCode\QROptions;
use CodeIgniter\API\ResponseTrait;

class Document extends BaseController
{
    use ResponseTrait;

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


    public function qrcode()
    {

        $post_data = $this->request->getPost();

        $is_written = yaml_emit_file(WRITEPATH.'/document.yml', $post_data, YAML_UTF8_ENCODING);
        if ($is_written){
            return $this->respondCreated(["message"=>'File was written']);
        } return $this->respondNoContent(["message"=>'File was not written']);

    }


    public function show(){
        $data =  file_get_contents(WRITEPATH.'/document.yml');

        $options = new QROptions([
//            'outputType' => QRCode::OUTPUT_MARKUP_SVG,
            'eccLevel'   => QRCode::ECC_L,
        ]);

        $qrcode = new QRCode($options);
        $parsed = yaml_parse_file(WRITEPATH.'/document.yml');
        $qrcode->render($data, 'images/Document.png');
//
//        foreach ($parsed as $key => $value){
//            echo "\n</br>\n\t" . $key . ": " . $value."";
//        }
        return view('document/generated',[ 'image' => $data, "data"=>$parsed]);
    }
}
