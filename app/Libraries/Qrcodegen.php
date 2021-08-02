<?php
/**
 * Created by PhpStorm.
 * User: dchincharashvili
 * Date: 8/2/2021
 * Time: 5:43 PM
 */

namespace App\Libraries;
require_once APPPATH . "ThirdParty/phpqrcode/qrlib.php";

class Qrcodegen
{
    public function __construct()
    {
//        TODO:http://phpqrcode.sourceforge.net/examples/index.php
        echo Qrcode::png('PHP QR Code :)');
    }


}