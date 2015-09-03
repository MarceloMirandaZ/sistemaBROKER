var bd_sesion;
//empresa
var bd_empresa;
var estado_empresa= new Array;
var estado_E= new Array;

var id_personal= new Array;
var usuario= new Array;
var estado_usuario= new Array();
var nombre= new Array;
var cargo=new Array;

var permisos;
var lista_permisos= new Array;
var paramentros;
var etado_empresa;
$(document).ready(function (){
    paramentros = restJson('../../parametros/personalizacion.json');
    $('#footer').html('<div class="modal-footer">Desarrollado por:   ' + paramentros.footer + '</div>');
    //informacion de sesion cundo ingresa el usuario, obtengo el alias de la empresa
    bd_sesion=restJson("../../core/json.php?funcion=informacion");
    //obtengo la fk del estado
    bd_empresa = restJson("../../core/json.php?funcion=recordSetSincronizado&t=empresa&c=estado&w=where&dato=alias='"+bd_sesion.alias+"'");
    //transformo la fk en palabras
    estado_empresa= restJson("../../core/json.php?funcion=recordSetSincronizado&t=estados_actividad&c=estado&w=where&dato=idestados_actividad='"+bd_empresa+"'");
    estado_E= estado_empresa;
    estado_E[0]=estado_E[0].toUpperCase();
    //ESTADO DEL USUARIO
    estado_usuario = bd_sesion.estado;
    estado_usuario = restJson("../../core/json.php?funcion=recordSetSincronizado&t=estados_actividad&c=estado&w=where&dato=idestados_actividad='"+estado_usuario+"'");
    //alert("alias:  "+bd_sesion.alias);
    estado_usuario[0]=estado_usuario[0].toUpperCase();
    //alert("alias:  "+estado_usuario[0]);
    //si la empresa esta activa continuar
    if(estado_E[0]=="ACTIVO" || estado_usuario[0]=="ACTIVO"){
        
        usuario = bd_sesion.usuario;
        
        if (usuario==''){
            $('#page-wrapper').html('Sus credenciales no son validas  |   <a href="login.html" onclick="salir();">Regresar al login</a>');
            restJson('../../core/json.php?funcion=cerrarSeccion');
        }
        else{
            nombre = bd_sesion.nombre;
            cargo = bd_sesion.cargo;
            //trasfromo la fk en palabras
            cargo=restJson("../../core/json.php?funcion=recordSetSincronizado&t=cargo&c=cargo&w=where&dato=idroles='"+cargo+"'");
            nombre[0] = nombre[0].toUpperCase();
            cargo[0] =cargo[0].toUpperCase();
            id_personal=bd_sesion.id;
            permisos = restJson("../../core/json.php?funcion=recordSetSincronizado&t=permisos_personal&c=permiso&w=where&dato=personal='"+id_personal+"'");
            permisos = restJson("../../core/json.php?funcion=recordSetSincronizado&t=permisos&c=permiso&w=where&dato='"+permisos+"'");
            lista_permisos = permisos;
           
            ///alert("alias:  "+permisos.length);
               $('#nombre_rol').append('<i>'+cargo[0]+'</i>');
               $('#credenciales').append('<i>Bienvenido  '+nombre+'<a href="login.html" onclick="salir();"> | Cerrar Sesión</a></i>');
               if(lista_permisos == ""){
                    $('#nombre_rol').append('<i>  / No tiene permisos asignados, porfavor comuniquese con el Administrador | <a href="login.html" onclick="salir();">Regresar al login</a></i>');
                    //restJson('../../core/json.php?funcion=cerrarSeccion');
               }
               else{
                    for(j=0;j<=permisos.length;j++){
                        lista_permisos[j] = lista_permisos[j].toUpperCase();
                        $('#menu').append('<li class="active"><a href="'+lista_permisos[j]+'.html">'+lista_permisos[j]+'</a></li>');
                    }

                }
            //getHtml('form.html', '#componente', '');

        }       
    }//cierre del primer if
    else{
        $('#nombre_rol').append('<i>Su estado esta inactivo, porfavor comuniquese con el Administrador | <a href="login.html" onclick="salir();">Regresar al login</a></i>');
               restJson('../../core/json.php?funcion=cerrarSeccion');
            
    }
         
});
