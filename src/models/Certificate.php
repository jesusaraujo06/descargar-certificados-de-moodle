<?php

namespace Caplaft\PdfDownload\models;

use Caplaft\PdfDownload\utils\Download;

class Certificate{

    public function getCertificates($urlJson, $nameFolder, $idCertificate){

        $usersJson = file_get_contents($urlJson);
        $usersArray = json_decode($usersJson, true);

        $download = new Download;

        $pathFolder = "src/downloads/".$nameFolder;

        if (!file_exists($pathFolder)) {

            mkdir($pathFolder, 0777, true);

            echo "La carpeta: '".$nameFolder."' ha sido creada con exito. \n";
        }

        if(count($usersArray['usergrades']) > 0){
            for ($i =0; $i  < count($usersArray['usergrades']); $i++) {
                $count = $i;
                $count++;
            
                $notaInFloat = floatval($usersArray['usergrades'][$i]['gradeitems'][0]['gradeformatted']);
            
                if($notaInFloat >= 8){
                    $download->downloadCerticate(
                        'https://caplaft.com/mod/customcert/view.php?id='.$idCertificate.'&downloadissue='.$usersArray['usergrades'][$i]['userid'],
                        $usersArray['usergrades'][$i]['userfullname'],
                        // $count.'. '.$usersArray['usergrades'][$i]['userfullname'],
                        $nameFolder
                    );
                }
            }

            echo "La descarga de los certificados a finalizado. \n";

        }else{
            echo "La url json no tiene valores para iterar.\n";
        }

    }
}