<?php
require_once 'estudiante.php';
require_once '../layout/layout.php';
require_once '../helpers/utilities.php';
require_once 'serviceSession.php';
require_once 'serviceCookie.php';

$layout = new Layout();
$service = new ServiceCookies();
$utilities = new Utilities();


$estudiante = null;

if (isset($_GET["id"])) {

    $estudiante = $service->GetById($_GET["id"]);
}

if (isset($_POST["estuId"]) && isset($_POST["Name"]) && isset($_POST["Apellido"]) && isset($_POST["CarreraId"]) && isset($_POST["Materia"])) {

    $estudiante = new Estudiante($_POST["estuId"], $_POST["Name"], $_POST["Apellido"], $_POST["CarreraId"], $_POST["Materia"], $_POST["Check"]);

    $service->edit($estudiante);

    header("Location: ../index.php");
}




?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar</title>
</head>

<body>

    <?php echo $layout->printHeader() ?>

    <?php if ($estudiante == null) : ?>

        <h2>No existe Ningun estudiante</h2>

        <?php else : ?>

        <form action="edit.php" method="POST">

            <input type="hidden" name="estuId" value="<?= $estudiante->Id ?>">

            <div class="mb-3">
                <label for="name" class="form-label">Nombre</label>
                <input name="Name" value="<?php echo $estudiante->Name ?>" type="text" class="form-control" id="name">

            </div>

            <div class="mb-3">
                <label for="apellido" class="form-label">Apellido</label>
                <input name="Apellido" value="<?php echo $estudiante->Apellido ?>" type="text" class="form-control" id="apellido">
            </div>

            <div class="mb-3">
                <label for="materias" class="form-label">Materias Favoritas</label>
                <input name="Materia" type="text" class="form-control" id="materia" value="<?php echo $estudiante->Materia ?>">
            </div>

            <div class="mb-3">
                <input  type="radio" id="activo" name="Check" value="1">
                <label for="activo">Marque su Estado</label><br>
            </div>

            <div class="mb-3">
              <label for="photo" class="form-label">Foto de Perfil</label>
              <input name="Photo" type="file" class="form-control" id="photo">
            </div>

            <div class="mb-3">
                <label for="carrera" class="form-label">Genero</label>
                <select name="CarreraId" class="form-select" id="carrera">
                    <option value="">Seleccione una opcion</option>
                    <?php foreach ($utilities->tipo as $value => $text) : ?>

                        <?php if ($value == $estudiante->CarreraId) : ?>

                            <option selected value="<?= $value ?>"><?= $text ?></option>


                        <?php else : ?>

                            <option value="<?= $value ?>"><?= $text ?></option>

                        <?php endif; ?>


                    <?php endforeach ?>
                </select>
            </div>

            <a href="../index.php" class="btn btn-secondary">Volver</a>
            <button type="subtmit" class="btn btn-primary">Guardar</button>

        </form>


    <?php endif ?>


    <?php echo $layout->printFooter() ?>



</body>

</html>