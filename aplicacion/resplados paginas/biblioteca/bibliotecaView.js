/// <reference path="../../typings/jquery/jquery.d.ts"/>
$(document).ready(function()
{
        var seccion=restJson('core/json.php?funcion=informacion'); //varibales de seccion
        $("#pagina").html('Biblioteca');//pagina
         //componentes que vamos ha cargar del controlador
         vistaCargar('#galeria',"aplicacion/biblioteca/bibliotecacontrolador.php?seccion=grid");
         
         

});