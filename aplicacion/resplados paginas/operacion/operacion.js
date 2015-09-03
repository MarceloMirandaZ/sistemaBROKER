$(document).ready(function ()
{
    //$('#menu').css('height','10px');
    var credenciales = restJson('../core/json.php?funcion=informacion');
    $('#c-izquierdo').css('padding-top', '2%');
    $('#c-izquierdo').css('padding-bottom', '2%');
    $('#c-izquierdo').css('padding-left', '2%');
    var paramentros = restJson('../parametros/personalizacion.json');
    $('header').css('padding-top', '2%');
    $('header').html('<h1>' + paramentros.aplicacion + '</h1>');
    $('footer').html('Desarrollado por:   ' + paramentros.footer + '');
    if (credenciales.usuario == '')
    {
        $('#menu').html('Sus credenciales no son validas  |   <a href="entrar.html" onclick="salir();">Regresar al login</a>');
    }
    else
    {
        $('#credenciales').append("En línea: "+credenciales.usuario+'  |   <a href="index.html" onclick="salir();">Cerrar seción</a>');
        menuActivo('../core/json.php?funcion=Query&t=permisos&w=where cargo=',credenciales.cargo, '#menu');
       
        //leer los datos y validar los datos de form registro
        //operaciones




    }
    ///-------

    ///------
});

