//variables globales
//variable ("bd_sesion") que almacenara los datos de sesion de quien ingrese
var bd_sesion;
var bd_empresa;
var estado_empresa= new Array;
var estado_E= new Array;

var id_personal= new Array;
var usuario= new Array;
var estado_usuario= new Array();
var nombre= new Array;
var  apellido= new Array;
var cargo=new Array;

var permisos;
var nom_bd;
var lista_permisos= new Array;
var lista_pagina = new Array;
var etado_empresa;
$(document).ready(function (){
 $.ajax({cache: false});      
        $(document).ajaxStart(function(){   
            $.LoadingOverlaySetup({
                color           : "rgba(253, 253, 253, 0.9)",
                image           : "images/loading.gif",
                maxSize         : "50px",
                minSize         : "20px",
                resizeInterval  : 0,
                size            : "50%"
            });
            $.LoadingOverlay("show");

        });
        $(document).ajaxStop(function(){
            setTimeout(function(){
                $.LoadingOverlay("hide");
            }, 500);
        }); 
    //alert("hola desde platilla script");
    //informacion de sesion cundo ingresa el usuario obtenidas con json
    bd_sesion=restJson("../../core/json.php?funcion=informacion");
    //***ESTADO DEL USUARIO***
    estado_usuario = bd_sesion.estado;
   //transformo en mayusculas el estado de usurio con: ".toUpperCase()"
    estado_usuario=estado_usuario.toUpperCase();
     //alert("alias:  "+estado_usuario);
     
    //si el usuario SI esta ACTIVO continuar
    if(estado_usuario=="ACTIVO"){//inicio del PRIMER (1º) if
        //***NOMBRE DEL USUARIO***
        nombre = bd_sesion.nombre;
        apellido = bd_sesion.apellido;
        //alert("el apellido: "+apellido);
        //comprobando que no este vacio el nobre del usuario
        if (nombre===' '){
            $('#page-wrapper').html('Sus credenciales no son validas  |   <a href="login.html" onclick="salir();"> Regresar al login</a>');
            restJson('../../core/json.php?funcion=cerrarSeccion');
        }
        else{
             //***CARGO DEL USUARIO***
            cargo = bd_sesion.cargo;
            //transformo en mayusculas el nobre de usurio y cargo con: ".toUpperCase()"
            nombre= nombre.toUpperCase();
            apellido= apellido.toUpperCase();
            cargo =cargo.toUpperCase();
            ///alert("alias:  "+permisos.length);
            //envio a los elementos del DOM el corgo (#nombre_rol) y el nombre(#credenciales) del usurio
               $('#nombre_rol').append('<i>'+cargo+'</i>');
               $('#credenciales').html('<li class="dropdown"><a href="login.html" onclick="salir();"><span class="glyphicon glyphicon-user"></span> | Bienvenido  '+nombre+" "+apellido+ ' |   Regresar al login</a></li>');
            //nombre de la base de datos
            nom_bd= bd_sesion.alias;
            id_personal= bd_sesion.id;
             //***PERMISOS DEL USUARIO***
            permisos = restJson("../../core/json.php?funcion=recordSetSincronizado&bd="+nom_bd+"&t=vista_permiso_personal&c=permiso&w=where&dato=idpersonal='"+id_personal+"'");
            lista_permisos = permisos;
               if(lista_permisos == " "){
                    $('#nombre_rol').append('<i>  / No tiene permisos asignados, porfavor comuniquese con el Administrador | <a href="login.html" onclick="salir();">Regresar al login</a></i>');
                    restJson('../../core/json.php?funcion=cerrarSeccion');
               }
               else{
                   lista_pagina=restJson("../../core/json.php?funcion=recordSetSincronizado&bd="+nom_bd+"&t=vista_permiso_personal&c=nombre_modulo&w=where&dato=idpersonal='"+id_personal+"'");
                   //alert("hola");
                    for(j=0;j<permisos.length;j++){
                        //alert("esto es lsita pagina:  "+lista_pagina[j]);
                        var id_elem=lista_pagina[j];
                        //id_elem=id_elem.replace(".html","");
                        lista_permisos[j] = lista_permisos[j].toUpperCase();
                        $('#menu').append('<li id="'+id_elem+'" class=""><a href="#">'+lista_permisos[j]+'</a></li>');
                    }
                }
            //getHtml('form.html', '#componente', '');

        }       
    }//cierre del PRIMER (1º) if
    else{ //si el usuario NO esta activo continuar
        $('#nombre_rol').append('<i>Su estado esta inactivo, porfavor comuniquese con el Administrador | <a href="login.html" onclick="salir();">Regresar al login</a></i>');
               restJson('../../core/json.php?funcion=cerrarSeccion');
            
    }     
});

