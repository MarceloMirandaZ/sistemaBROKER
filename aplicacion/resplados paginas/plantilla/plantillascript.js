var bd_personal= restJson('../../core/json.php?funcion=Query&t=personal');
var paramentros = restJson('../../parametros/personalizacion.json');
var nombre= new Array;
var cargo=new Array;
var usuario= new Array;
var permisos= new Array;
var lista_permisos= new Array;
var estado_empresa = restJson("../../core/json.php?funcion=recordSetSincronizado&t=empresa&c=estado&w=where&dato=alias='tat'");

$(document).ready(function (){
    $('#footer').html('Desarrollado por:   ' + paramentros.footer + '');
    nombre = bd_personal.nombre;
    cargo = bd_personal.cargo;
    usuario = bd_personal.usuario;
    permisos = bd_personal.permisos;
       nombre[0] = nombre[0].toUpperCase();
        cargo[0] =cargo[0].toUpperCase();
    lista_permisos=permisos[0].split(',');
alert ("lista: "+permisos.length);
    for(i=0;i<=permisos.length;i++){

        lista_permisos[i]= lista_permisos[i].toUpperCase();


    }
    if (usuario== '')
    {
        $('#page-wrapper').html('Sus credenciales no son validas  |   <a href="../login/index.html" onclick="salir();">Regresar al login</a>');
        restJson('../../core/json.php?funcion=cerrarSeccion');
    }
    else
    {
        if(credenciales.estado == 'inactivo' || estado_empresa == 'inactivo' || credenciales.estado == ''){
           $('#nombre_rol').append('<i>Su estado esta inactivo, porfavor comuniquese con el Administrador | <a href="../login/index.html" onclick="salir();">Regresar al login</a></i>');
           restJson('../../core/json.php?funcion=cerrarSeccion');
        }
        else{
           $('#nombre_rol').append('<i>'+cargo[0]+'</i>');
           $('#credenciales').append('<i>Bienvenido  '+nombre[0]+'<a href="../login/index.html" onclick="salir();"> | Cerrar Sesión</a></i>');
           if(lista_permisos == ""){
                $('#nombre_rol').append('<i>No tiene permisos asignados, porfavor comuniquese con el Administrador | <a href="../login/index.html" onclick="salir();">Regresar al login</a></i>');
           restJson('../../core/json.php?funcion=cerrarSeccion');
           }
           else{
               for(j=0;j<=permisos.length;j++){
                   $('#menu').append('<li class="active"><a>'+lista_permisos[j]+'</a></li>');
               }
              
           }
        //getHtml('form.html', '#componente', '');
        } 
     }
         
});
