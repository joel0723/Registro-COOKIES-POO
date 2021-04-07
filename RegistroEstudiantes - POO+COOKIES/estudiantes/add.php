<?php
require_once 'serviceSession.php';
require_once '../helpers/utilities.php';
require_once 'estudiante.php';
require_once 'serviceCookie.php';

$service = new ServiceCookies();

if(isset($_POST["Name"]) && isset($_POST["Apellido"]) && isset($_POST["CarreraId"]) && isset($_POST["Check"]) && isset($_POST["Materia"])){

    $estudiante = new Estudiante(0,$_POST["Name"],$_POST["Apellido"],$_POST["CarreraId"],$_POST["Materia"],$_POST["Check"] );
    
    
    $service->Add($estudiante);


    header("Location: ../index.php");
}
