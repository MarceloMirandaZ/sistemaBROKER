
var bd_permisos=restJson('../core/json.php?funcion=Query&t=permisos');
var bd_personal=restJson('../core/json.php?funcion=Query&t=personal');
var lista_permisos= new Array;
var lista_personal= new Array;
var getCosulta="'../aplicacion/registrousuarios/registrocontrolador.php?seccion=datos', 'mensaje', '3', 'registro'";
$(document).ready(function ()
{
    
   // bd_cargo=restJson('../core/json.php?funcion=recordSet&t="roles"&c="*"&w=""');
    
    //creamos el formulario
    $('#componente').append('<div class="form-group has-success"><input id="btsubmit" class="btn btn-primary" name="btsubmit" type="button" onclick="submitData('+getCosulta+')" value="Crear"></div>');
    $('#componente').append('<div class="col-lg-6"></div>');
    $('#componente').append('<h2>Lista de permisos</h2>');
    $('#componente').append('<div class="table-responsive"><table id="tabla_permisos" class="table table-bordered table-hover table-striped"></table></div>');
    $('#tabla_permisos').append('<thead id="titulo_c"></thead>');
    
    
    //obtner todos los cargos registrdos en la bd
        lista_permisos = bd_permisos.permiso;
        for(i=0;i<lista_permisos.length;i++){
            //var patron=' ';
            //lista_permisos[i]= lista_permisos[i].replace(patron,'');
            lista_permisos[i]= lista_permisos[i].toUpperCase();
            //alert ("lista: "+lista_cargos[i]);
            
             $('#titulo_c').append('<tr><th>'+lista_permisos[i]+'</th></tr>'); 
           
            //$('#tabla_permisos').append('<option value="'+lista_cargos[i]+'">'+lista_cargos[i]+'</option>'); 
            
        }
});