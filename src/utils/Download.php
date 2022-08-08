<?php

namespace Caplaft\PdfDownload\utils;

use Caplaft\PdfDownload\Config;

class Download{

    private $url;
    private $filename;
    private $nameFolder;
    private $pathFolder;

    public function __construct(){
       
    }

    public function downloadCerticate($url, $filename, $nameFolder){

        $this->url = $url;
        $this->filename = $filename;
        $this->nameFolder = $nameFolder;
        $this->pathFolder = 'src/downloads/'.$this->nameFolder.'/'.$this->filename.'.pdf';
        
        // Si el archivo ya existe
        if(file_exists($this->pathFolder)){
            echo $this->filename.".pdf => Ya existe \n";
            return;
        }

        $curl = curl_init();

        curl_setopt($curl, CURLOPT_URL, $this->url); 
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($curl, CURLOPT_ENCODING, 'gzip, deflate');
        curl_setopt($curl, CURLOPT_HTTPHEADER, Config::$headers);
        
        $data = curl_exec($curl);

        curl_close($curl); 
        

        // Descargar pdf
        file_put_contents($this->pathFolder, $data);

        echo $this->filename.".pdf ==> Descargado ✔ \n";
        
    }

}