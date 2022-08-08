<?php

require 'vendor/autoload.php';

use Caplaft\PdfDownload\models\Certificate;

$certificate = new Certificate;


$courseID = '60';
$nameFolder = 'Capacitación general en SAGRILAFT - Viva tu credito';
$idCertificateCourse = '666';

/**
 * Parameter 1: Url del curso en formato json
 * Parameter 2: Nombre de la carpeta donde se van a descargar
 * Parameter 3: Id de los certificados de un curso 
 */
$certificate->getCertificates(
    "https://caplaft.com/webservice/rest/server.php?wstoken=d54e552bbbb67360046db48dddb6b6a2&wsfunction=gradereport_user_get_grade_items&courseid=$courseID&moodlewsrestformat=json",
    $nameFolder,
    $idCertificateCourse
);

// ? Tambien toca revisar las cookies en src/config.php

// URL json:
// https://caplaft.com/webservice/rest/server.php?wstoken=d54e552bbbb67360046db48dddb6b6a2&wsfunction=gradereport_user_get_grade_items&courseid=20&moodlewsrestformat=json