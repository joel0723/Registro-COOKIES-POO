$(document).ready(function(){
   // peliculas/delete.php?id=<?= $estudiante->Id ?>

$("#btn-delete").on("click", function(){

    let id = $(this).data("id");

    if(confirm("Estas seguro que quieres eliminar a este estudiante?"))
    {
        if(id !== null && id !== undefined && id !== null )
        {
            window.location.href = "estudiantes/delete.php?id=" + id;

        
        }
       
    }


})



})