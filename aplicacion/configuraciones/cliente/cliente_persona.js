
    //variable globales
//**obtengo el nombre de la bd
var bd_sesion= new Array();
var que_bd;
//lsta de estados nesesaria para llenar los formularios
var bd_estado = new Array;
var lista_estado= new Array;
var cliente_persona_bd;
var lista_cliente_persona = new Array;
var todos_los_permisos = new Array;
var mis_permisos = new Array;
var bd_cargo;
var lista_cargo= new Array;
var dato_insert= new Array;                
//lista_cliente_persona="";

function cargar_varibles_cliente(){
    bd_sesion=restJson("../../core/json.php?funcion=informacion");
    que_bd=bd_sesion.alias;
    //alert("la base:"+que_bd);
    //lsta de estados nesesaria para llenar los formularios
    bd_estado=restJson("../../core/json.php?funcion=Query&bd="+que_bd+"&t=estado");;
    lista_estado= new Array;
    lista_estado = bd_estado.estado;
}
function cargar_cliente_persona(){
    
var elemento; 
var valor_optenido = new Array;
var cliente_elejido = new Array();  
 
    //--***GRID CLIENTE_PERSONA***--
    //al hacer click en el boton "btn_permiso_personal" borramos el nodo "contenedor_formularios" y su nodos hijos 
    $("#contenedor_formularios").empty();
    $("#contenedor_formularios").remove();
    $("#grid_permiso_personal").remove();
     $("#grid_personal").remove();
    //creamos en el DOM id ="contenedor_formularios" que almacenará a todos los formularios (modulos)
    $("#contenido").append('<div class="panel panel-default" id ="contenedor_formularios"><div id ="grid_cliente_persona" class="panel-body"></div></div>');
    $("#grid_cliente_persona").load('../configuraciones/cliente/grid_cliente_persona.html',function(){ 
        //obtengo los datos de la tabla vista_personal
        cliente_persona_bd=restJson("../../core/json.php?funcion=Query&bd="+que_bd+"&t=vista_cliente_persona"); 
        //alert(cliente_persona_bd.infotabla[1]);
        if(cliente_persona_bd.infotabla[1]>0){
             //alert(cliente_persona_bd.estado);
            //lista_cliente_persona[1].length=0;
            lista_cliente_persona[0]=cliente_persona_bd.idcliente_persona;
            lista_cliente_persona[1]=cliente_persona_bd.cedula;
            lista_cliente_persona[2]=cliente_persona_bd.nombre;
            lista_cliente_persona[3]=cliente_persona_bd.apellido;
            lista_cliente_persona[4]=cliente_persona_bd.email;
            lista_cliente_persona[5]=cliente_persona_bd.direccion;
            lista_cliente_persona[6]=cliente_persona_bd.telefono_fijo;
            lista_cliente_persona[7]=cliente_persona_bd.telefono_movil;
            lista_cliente_persona[8]=cliente_persona_bd.estado;

            // alert("comprobando dato nombre: "+lista_cliente_persona[1]);
            //cargo en el grid los datos de la tabla vista_personal
            var contador=0;
            for(i=0;i<lista_cliente_persona[1].length;i++){
                //creo primero la  columna
               //alert("TAMAÑO: "+lista_cliente_persona[1].length);  
                contador=contador+1;
                $("#datos_cliente").append("<tr id='columna_"+i+"'></tr>");
                for(j=0;j<lista_cliente_persona.length;j++){
                    //creo las celdas que irán en la columna
                   if(j===1){
                       //creo un link para los valores de la segunda columna de la tabla (la cedula)
                       $("#columna_"+i).append("<th style='text-align: center'><a id='link_cliente_"+i+"' href='#'>"+lista_cliente_persona[j][i]+"</a></th>");
                   }
                   else{
                       if(j===0){
                            $("#columna_"+i).append("<th style='text-align: center'>"+contador+"</th>");
                       }
                       else{
                           $("#columna_"+i).append("<th style='text-align: center'>"+lista_cliente_persona[j][i]+"</th>");
                       }
                   }

                }
            }

        }//--/FIN if
        else{}
        //--***BOTON CREAR CLIENTE***--
         $("#btn_crear_cliente").click(function(){
             insertar_cliente_persona();
         });
         //--***EVENTO PRESIONANDO CEDULA CLEINTE***--                
         //cundo se presionde un tag <a> dentro "datos_permiso_personal" obtenemos su id y gurdamos el valor que contenga
         $("#datos_cliente a").click(function(e){
            // alert("presionado bten editar");
             //obtenemos la cedula del personal seleccionado
             elemento=e.target.id; 
             valor_optenido= $("#"+elemento+"").text();
             update_cliente_persona(valor_optenido);
             //alert("la cedula: "+valor_optenido);               
         });//--/FIN boton crear Registro
        //--**BOTON FLITRO**--
        $("#btn_filtro").click(function(){
        //alert("presionado bten crear");
             $("#btn_filtro").hide(500);
             //$("#grid_permiso_personal").hide(500);
             $("#form_filtro").show(500);
             $("#contenedor_formularios").append('<div id="form_filtro"></div>');
             $("#form_filtro").load("../configuraciones/cliente/filtro_cliente.html",function(){
                 $("#form_filtro").insertBefore("#grid_cliente_persona");
                 $("#form_filtro").show(500);
                 $("#btn_ver_todos").click(function(){
                     // alert("presionado bten crear");
                      $("#btn_filtro").show(500);
                      //$("#form_permiso_personal").hide();
                      $("#form_filtro").hide(500);
                 });
             });
        });
    });
    //
        
                 
}//FIN funcion cargar_cliente
//variable tipo obejeto global para almacenar los datos de los input 
var datos_obtenidos= new Object();
function insertar_cliente_persona(){
       // datos_obtenidos="";
        //alert("presionado btn crear cleinte");
        //--***GRID CLIENTE***--
        //ocultamos temporalmente el grid del presonal
        $("#form_crear_cliente").empty();
        $("#form_filtro").hide(500);
        $("#grid_cliente_persona").hide(500);
        $("#form_crear_cliente").show(500);
        $("#contenedor_formularios").append("<div id='form_crear_cliente' class='panel-body'></div>");
        $("#form_crear_cliente").load('../configuraciones/cliente/form_crear_cliente.html',function(){
           //
            $('html,body').animate({
                scrollTop: $("#contenido").offset().top
            }, 500);
            //alert("que estado : "+lista_estado);
            //
            for(k=0;k<lista_estado.length;k++){
                lista_estado[k]=lista_estado[k].toUpperCase();
                //alert("lista de estados: "+lista_estado[k]);
                $("#elemento_7").append("<option>"+lista_estado[k]+"</option>");
            }
                //alert("funcion isertar");
            
            
            //cancelar creacion 
            $("#btm_cancelar_registro").click(function(){
               //alert("presionado btn crear");
                $("#form_filtro").hide();
                $("#form_crear_cliente").hide(500);
                $("#grid_cliente_persona").show(500);
                $("#btn_filtro").show(500);
                $("#form_crear_cliente").remove();
           });
            //--**GUARDAR INSERT**--
            $("#btm_guardar").click(function(){
                //alert("presionado boton crear");
                for(i=0;i<8;i++){
                    //cuando sea elemento_2 tengo que cambiar su valor en texo por su llave primaria (idcargo de la tabla cargo)
                    if(i===7){
                        datos_obtenidos["elemento_"+i+""] = $("#elemento_"+i+"").val();
                        datos_obtenidos["elemento_"+i+""]=restJson("../../core/json.php?funcion=recordSetSincronizado&bd="+que_bd+"&t=estado&c=idestado&w=where&dato=estado='"+datos_obtenidos["elemento_"+i+""]+"'");
                    }
                    else{
                        //cuando sea elemento_8 tengo que cambiar su valor en texo por su llave primaria (idestado de la tabla estado)
                       datos_obtenidos["elemento_"+i+""] = $("#elemento_"+i+"").val();
                      
                    } 
                    
                }//---/FIN for
                //alert("que datos envio: "+datos_obtenidos["elemento_0"]);
                ajax_insertar_cliente_persona(datos_obtenidos); 
                
                $("#form_crear_cliente").hide(500);
                $("#form_filtro").hide();
                $("#grid_cliente_persona").show(500);
                $("#btn_filtro").show(500);
                $("#form_crear_cliente").remove();

            });//--/FIN boton guardar 
       });

}//--/FIN funcion
function update_cliente_persona(que_elejido){
    //limpiamos todo el contenedor_formularios, para cargar el nuevo formulario
    //alert("cedula: "+que_elejido);
    var cliente_elejido= new Array;
    var lista_cliente= new Array;
    $("#form_crear_cliente").remove();
    $("#form_filtro").hide(500);
    $("#grid_cliente_persona").hide(500);

    $("#form_crear_cliente").show(500);
   //Cargamos el nuevo formulario
    $("#contenedor_formularios").append("<div id='form_crear_cliente' class='panel-body'></div>");
    $("#form_crear_cliente").load('../configuraciones/cliente/form_crear_cliente.html',function(){
       //animacion que nos ubica en el principio del formulario
        $('html,body').animate({
            scrollTop: $("#contenido").offset().top
        }, 500);
        //buscamos al cliente elejido y su id en la tabla vista_cliente_persona de la bd
        cliente_elejido = restJson("../../core/json.php?funcion=restFull&bd="+que_bd+"&t=vista_cliente_persona&d=cedula="+que_elejido+"");        
            lista_cliente[0]=cliente_elejido.idcliente_persona;
            lista_cliente[1]=cliente_elejido.cedula;
            lista_cliente[2]=cliente_elejido.nombre;
            lista_cliente[3]=cliente_elejido.apellido;
            lista_cliente[4]=cliente_elejido.direccion;
            lista_cliente[5]=cliente_elejido.telefono_fijo;
            lista_cliente[6]=cliente_elejido.telefono_movil;
            lista_cliente[7]=cliente_elejido.email;
            lista_cliente[8]=cliente_elejido.estado;
            //alert("tamaño: "+lista_cliente.length);
            for(j=0;j<=(lista_cliente.length);j++){
            //creo las celdas que irán en la columna
               //alert("lista cliente elejido: "+lista_cliente[j]);
                if(j===8){
                     
                    for(k=0;k<lista_estado.length;k++){
                        //alert("estado: "+lista_estado.length);
                        $("#elemento_7").append("<option>"+lista_estado[k]+"</option>");
                    }
                }
                else{
                   
                    $("#elemento_"+j+"").val(""+lista_cliente[j+1]+"");
                }

            }
            //cancelar edicion 
            $("#btm_cancelar_registro").click(function(){
               //alert("presionado btn crear");
                $("#form_filtro").hide();
                $("#form_crear_cliente").hide(500);
                $("#grid_cliente_persona").show(500);
                $("#btn_filtro").show(500);
                $("#form_crear_cliente").remove();
            });
            //--**GUARDAR UPDATE**--
            $("#btm_guardar").click(function(){
                //alert("presionado bten guardar edision");
                //OBTENIENDO DATOS CAMBIADOS
                for(i=0;i<9;i++){
                    //cuando sea elemento_7 tengo que cambiar su valor en texo por su llave primaria (idcargo de la tabla cargo)
                    if(i===7){
                        datos_obtenidos["elemento_"+i+""] = $("#elemento_"+i+"").val();
                        datos_obtenidos["elemento_"+i+""]=restJson("../../core/json.php?funcion=recordSetSincronizado&bd="+que_bd+"&t=estado&c=idestado&w=where&dato=estado='"+datos_obtenidos["elemento_"+i+""]+"'");
                    }
                    else{
                        //cuando sea elemento_8 tengo que cambiar su valor en texo por su llave primaria (idestado de la tabla estado)
                         if(i===8){
                            //alert("reconocido 8");
                           datos_obtenidos["elemento_"+i+""] = (""+lista_cliente[0]+"");
                         }else{
                             //alert("memoriznado "+$("#elemento_"+i+"").val());
                             datos_obtenidos["elemento_"+i+""] = $("#elemento_"+i+"").val();
                         }
                    }
                    
                }//---/FIN for
                //alert("que_datos editados : "+datos_obtenidos["elemento_0"]);
                ajax_update_cliente_persona(datos_obtenidos);
                $("#form_crear_cliente").hide(500);
                $("#form_filtro").hide();
                $("#grid_cliente_persona").show(500);
                $("#btn_filtro").show(500);
                $("#form_crear_cliente").remove();
                
            });//--/FIN boton guardar 

   });
}
function ajax_insertar_cliente_persona(que_datos){
        //$("#contenedor_formularios").append('<div id="loading"></div>');
        //$("#loading").html('<div id="loading" class="preloader sk-spinner sk-spinner-rotating-plane"><img src="images/loading.png" alt=""/></div>');
    
    var datos_pasados=new Object();
    datos_pasados=que_datos;   
    //alert("en ajax isert: "+datos_pasados["elemento_0"]);
    $.ajax({
        url : '../configuraciones/cliente/insertar_cliente_persona.php',
        type: 'POST',
        data : datos_pasados,
        cache:false,
        error:function(data ){alert("error: "+data);},
        success:function( data )
               {
                     cargar_cliente_persona();
               }
    });  
    
}
function ajax_update_cliente_persona(que_datos){

    var datos_pasados=new Object();
    datos_pasados=que_datos;   
    //alert("en ajax: "+datos_pasados);
    $.ajax({
        url : '../configuraciones/cliente/update_cliente_persona.php',
        type: 'POST',
        data : datos_pasados,
        cache:false,
        error:function(data){alert("error");},
        success:function( data )
               {
                   cargar_cliente_persona();
                   // Estamos utilizando el método .done(), pero debo apuntar que jQuery nos provee de varios métodos callback para distintos fines
                   // En data además viene la respuesta del PHP
               }
    });  
    
}