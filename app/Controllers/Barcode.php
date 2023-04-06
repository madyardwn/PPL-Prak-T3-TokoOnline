<?php

namespace App\Controllers;

use Picqer;

class Barcode extends BaseController
{

    public function index()
    {
        $str = $this->request->getGet('text');
        $tipe = $this->request->getGet('tipe') ? $this->request->getGet('tipe') : "";
        $this->generateBarcode($str, $tipe);
    }


    private function generateBarcode($string, $tipe = "HTML")
    {

        switch ($tipe) {
            case "HTML":
                $generator = new Picqer\Barcode\BarcodeGeneratorHTML();
                break;
            case "JPG":
                header('Content-type: image/jpeg');
                $generator = new Picqer\Barcode\BarcodeGeneratorJPG();
                break;
            case "PNG":
                $generator = new Picqer\Barcode\BarcodeGeneratorPNG();
                break;
            case "SVG":
                $generator = new Picqer\Barcode\BarcodeGeneratorSVG();
                break;
            default:
                $generator = new Picqer\Barcode\BarcodeGeneratorHTML();
        }

        $barcode   = $generator->getBarcode($string, $generator::TYPE_CODE_128);
        echo view("barang/v_barcode", ["barcode" => $barcode, "text" => $string, "tipe" => $tipe]);
    }
}
