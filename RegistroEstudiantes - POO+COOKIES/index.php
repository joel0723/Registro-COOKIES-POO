<?php
require_once 'estudiantes/estudiante.php';
require_once 'helpers/utilities.php';
require_once 'layout/layout.php';
require_once 'estudiantes/serviceSession.php';
require_once 'estudiantes/serviceCookie.php';

$layout = new Layout(true);
$service = new ServiceCookies();
$utilities = new Utilities();

$estudiantes = $service->GetList();

if (!empty($estudiantes)) {

  if (isset($_GET['CarreraId'])) {

    $estudiantes = $utilities->searchProperty($estudiantes, 'CarreraId', $_GET['CarreraId']);
  }
}


?>




<?php echo $layout->printHeader() ?>




<div class="row">



  <div class="col-md-10"></div>
  <div class="col-md-2">




    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#nuevo-heroe-modal">
      Nuevo Estudiante

    </button>
    

  </div>
</div>


<div class="row">
  <div class="col-md-6"></div>
  <div class="col-md-6">

    <div class="btn-group">

      <a href="index.php" class="btn btn-primary">Todos</a>
      <a href="index.php?CarreraId=1" class="btn btn-primary">Software</a>
      <a href="index.php?CarreraId=2" class="btn btn-primary">Redes</a>
      <a href="index.php?CarreraId=3" class="btn btn-primary">Multimedia</a>
      <a href="index.php?CarreraId=4" class="btn btn-primary">Mecatronica</a>
      <a href="index.php?CarreraId=5" class="btn btn-primary">Seguridad Informatica</a>

    </div>


  </div>



  <div class="row">

    <?php if (count($estudiantes) == 0) : ?>



      <h2>No hay estudiantes, Inserte alguno</h2>

    <?php else : ?>


      <?php foreach ($estudiantes as $key => $estudiante) : ?>

        <div class="col-md-3">

          <div class="card">

            <div class="card-body">
              <h5 class="card-title"><?php echo $estudiante->Name ?></h5>
              <p class="card-text"><?= $estudiante->Apellido ?></p>
              <p class="card-text"><?= $estudiante->Materia ?></p>
              <p class="card-text"><?= $utilities->tipo[$estudiante->CarreraId] ?></p>

              <?php if (isset($estudiante->Check)) : ?>

                <input checked disabled type="radio" id="activo" name="Check">
                <label for="activo" class="bg-success text-white">Estado Activo</label><br>

              <?php else : ?>

                <input disabled type="radio" id="activo" name="Check">
                <label for="activo" class="bg-danger text-white">Estado Inactivo</label><br>


              <?php endif; ?>


            </div>

            <div class="card-body">
              <a href="estudiantes/edit.php?id=<?= $estudiante->Id ?>" class="btn btn-primary">Editar</a>
              <a href="#" id="btn-delete" data-id="<?= $estudiante->Id ?>" class="btn btn-danger ">Eliminar</a>
            </div>
          </div>

        </div>
      <?php endforeach; ?>

    <?php endif; ?>





  </div>











  <div class="modal fade" id="nuevo-heroe-modal" tabindex="-1" aria-labelledby="nuevo-heroe-modal" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header back">
          <h5 class="modal-title" id="nuevo-heroe-modal">Agregar Estudiante</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">

          <form action="estudiantes/add.php" method="POST">

            <div class="mb-3">
              <label for="name" class="form-label">Nombre</label>
              <input name="Name" type="text" class="form-control" id="name" placeholder="Nombre">

            </div>

            <div class="mb-3">
              <label for="apellido" class="form-label">Apellido</label>
              <input name="Apellido" type="text" class="form-control" id="apellido" placeholder="Apellido">
            </div>

            <div class="mb-3">
              <label for="materia" class="form-label">Materias Favoritas</label>
              <input name="Materia" type="text" class="form-control" id="materia" placeholder="Separadas por comas (,)">
            </div>


            <div class="mb-3">
              <input checked type="radio" id="activo" name="Check" value="1">
              <label for="activo">Estado</label><br>
            </div>

            <div class="mb-3">
              <label for="photo" class="form-label">Foto de Perfil</label>
              <input name="Photo" type="file" class="form-control" id="photo">
            </div>

            <div class="mb-3">
              <label for="carrera" class="form-label">Carrera</label>
              <select name="CarreraId" class="form-select" id="carrera">
                <option value="">Seleccione una opcion</option>
                <?php foreach ($utilities->tipo as $value => $text) : ?>

                  <option value="<?= $value ?>"><?= $text ?></option>

                <?php endforeach; ?>
              </select>
            </div>

        </div>
        <div class="modal-footer ">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Volver</button>
          <button type="subtmit" class="btn btn-primary">Guardar</button>
        </div>
        </form>
      </div>
    </div>
  </div>
</div>

<?php echo $layout->printFooter() ?>

<script src="assets/js/index/indexJquery.js" ></script>
