<?php
require_once 'estudiante.php';
require_once '../helpers/utilities.php';
require_once 'serviceSession.php';
require_once 'serviceCookie.php';


$service = new ServiceCookies();


$estudiante = isset($_GET["id"]);


if($estudiante){

    
    
    
    $service->Delete($estudiante);

     

}

header("Location: ../index.php");
exit();



?>
