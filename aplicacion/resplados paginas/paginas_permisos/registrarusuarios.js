
var bd_cargo=restJson('../core/json.php?funcion=Query&t=roles');
var bd_estado=restJson('../core/json.php?funcion=Query&t=estados');
var lista_cargos= new Array;
var lista_estados= new Array;
var getCosulta="'../aplicacion/registrousuarios/registrocontrolador.php?seccion=datos', 'mensaje', '7', 'registro'";
$(document).ready(function ()
{
    
   // bd_cargo=restJson('../core/json.php?funcion=recordSet&t="roles"&c="*"&w=""');
    
    //creamos el formulario
    //$('#componente').append('<div class="row"><div class="col-lg-12"><h1 class="page-header">Crear Usuarios</h1></div></div>');
    //$('#componente').append('<form role="form" id ="formRegistro" name="registroUsuarios"></form>');
    $('#formRegistro').append('<div class="form-group has-success"><label class="control-label" for="inputSuccess">Nombre</label><input id="registro_0 name="registro_0" type="text" class="form-control" "></div>');
    $('#formRegistro').append('<div class="form-group has-success"><label class="control-label" for="inputSuccess">Email / <small>correo electrónico</small></label><input id="registro_1" name="registro_1" type="text" class="form-control"></div>');
    $('#formRegistro').append('<div class="form-group has-success"><label class="control-label" for="inputSuccess">Usuario / <small>Nombre con el que igresará al sistema</small></label><input id="registro_2" name="registro_2" type="text" class="form-control"></div>');
    $('#formRegistro').append('<div class="form-group has-success"><label class="control-label" for="inputSuccess">Calve / <small>Contraseña para ingresar al sistema</small></label><input id="registro_3" name="registro_3" type="text" class="form-control"></div>');
    $('#formRegistro').append('<div class="form-group has-success"><label class="control-label" for="inputSuccess">Cargo</label> <select id="registro_4"  name ="registro_4" class="form-control"></select></div>');
    $('#formRegistro').append('<div class="form-group has-success" id="checkbox"><label class="control-label" for="inputSuccess">Estado</label></div>');
    //$('#formRegistro').append('<div class="form-group has-success"><input id="btsubmit" class="btn btn-primary" name="btsubmit" type="button" onclick="submitData('+getCosulta+')" value="Guardar"></div>');
    if (bd_cargo.cargo == '')
    {alert("hola registro:"+bd_cargo.cargo);
        $('#mensaje').html('Sus credenciales no son validas  |   <a href="entrar.html" onclick="salir();">Regresar al login</a>');
    }
    else
    {

        //obtner todos los cargos registrdos en la bd
        lista_cargos = bd_cargo.cargo;
        for(i=0;i<lista_cargos.length;i++){
            //var patron=' ';
            //lista_cargos= lista_cargos.replace(patron,'');
            //lista_cargos[i]=lista_cargos[i].toLowerCase();
            //lista_cargos[i]= lista_cargos[i].toUpperCase();
            //alert ("lista: "+lista_cargos[i]);
            $('#registro_4').append('<option value="'+lista_cargos[i]+'">'+lista_cargos[i]+'</option>'); 
            
        }
         //obtner todos los estados registrdos en la bd
        lista_estados = bd_estado.estado;
        for(i=0;i<lista_estados.length;i++){
            //var patron=' ';
            //nomCargo[i]= listaOpciones[i].replace(patron,'');
            //lista_cargos[i]=lista_cargos[i].toLowerCase();
            lista_estados[i]= lista_estados[i].toUpperCase();
            //alert ("lista: "+lista_estados[i]);
            $('#checkbox').append('<div class="checkbox"><label><input name="registro_'+i+5+'" type="checkbox" value="">'+lista_estados[i]+'</label></div>'); 
            
        }
        
    }
});