$(document).ready(function()
{
        var seccion=restJson('core/json.php?funcion=informacion'); //varibales de seccion
        $("#pagina").html('Usuarios');//pagina
         //componentes que vamos ha cargar del controlador
         vistaCargar('#galeria',"aplicacion/usuarios/usuarioscontrolador.php?seccion=formulario");

});