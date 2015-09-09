

var cliente_empresa_bd;
var lista_cliente_empresa = new Array;
var dato_insert= new Array;                
/*
function cargar_varibles_cliente(){
    bd_sesion=restJson("../../core/json.php?funcion=informacion");
    que_bd=bd_sesion.alias;
    //alert("la base:"+que_bd);
    //lsta de estados nesesaria para llenar los formularios
    bd_estado=restJson("../../core/json.php?funcion=Query&bd="+que_bd+"&t=estado");;
    lista_estado = bd_estado.estado;
}
*/
function cargar_cliente_empresa(){
var elemento; 
var valor_optenido = new Array;
var cliente_elejido = new Array();

 //alert("la bd es :"+que_bd);
    //--***GRID CLIENTE_PERSONA***--
        //al hacer click en el boton "btn_permiso_personal" borramos el nodo "contenedor_formularios" y su nodos hijos 
    $("#contenedor_formularios").empty();
    $("#contenedor_formularios").remove();
    $("#grid_permiso_personal").remove();
     $("#grid_personal").remove();
    //creamos en el DOM id ="contenedor_formularios" que almacenará a todos los formularios (modulos)

    $("#contenido").append('<div class="panel panel-default" id ="contenedor_formularios"><div id ="grid_cliente_empresa" class="panel-body"></div></div>');
    $("#grid_cliente_empresa").load('../configuraciones/cliente/grid_cliente_empresa.html',function(){ 
        //obtengo los datos de la tabla vista_personal
        cliente_empresa_bd=restJson("../../core/json.php?funcion=Query&bd="+que_bd+"&t=vista_cliente_empresa"); 
        //alert(cliente_empresa_bd.infotabla[1]);
        if(cliente_empresa_bd.infotabla[1]>0){
             //alert(cliente_empresa_bd.estado);
            //lista_cliente_empresa[1].length=0;
            lista_cliente_empresa[0]=cliente_empresa_bd.idcliente_empresa;
            lista_cliente_empresa[1]=cliente_empresa_bd.ruc;
            lista_cliente_empresa[2]=cliente_empresa_bd.nombre;
            lista_cliente_empresa[3]=cliente_empresa_bd.razon_social;
            lista_cliente_empresa[4]=cliente_empresa_bd.direccion;
            lista_cliente_empresa[5]=cliente_empresa_bd.telefono;
            lista_cliente_empresa[6]=cliente_empresa_bd.email;
            lista_cliente_empresa[7]=cliente_empresa_bd.estado;
            lista_cliente_empresa[8]=cliente_empresa_bd.nombre_contacto;
            lista_cliente_empresa[9]=cliente_empresa_bd.telefono_fijo;
            lista_cliente_empresa[10]=cliente_empresa_bd.telefono_movil;

            // alert("comprobando dato nombre: "+lista_cliente_empresa[1]);
            //cargo en el grid los datos de la tabla vista_personal
            var contador=0;
            for(i=0;i<lista_cliente_empresa[1].length;i++){
                //creo primero la  columna
               //alert("TAMAÑO: "+lista_cliente_empresa[1].length);  
                contador=contador+1;
                $("#datos_cliente_empresa").append("<tr id='columna_"+i+"'></tr>");
                for(j=0;j<lista_cliente_empresa.length;j++){
                    //creo las celdas que irán en la columna
                   if(j===1){
                       //alert("empresas : "+lista_cliente_empresa[j][i]); 
                       //creo un link para los valores de la segunda columna de la tabla (la cedula)
                       $("#columna_"+i).append("<th style='text-align: center'><a id='link_cliente_"+i+"' href='#'>"+lista_cliente_empresa[j][i]+"</a></th>");
                   }
                   else{
                       if(j===0){
                            $("#columna_"+i).append("<th style='text-align: center'>"+contador+"</th>");
                       }
                       else{
                           $("#columna_"+i).append("<th style='text-align: center'>"+lista_cliente_empresa[j][i]+"</th>");
                       }
                   }

                }
            }

        }//--/FIN if
        else{
            alert("no exiten datos");  
        }
        //--***BOTON CREAR CLIENTE***--
         $("#btn_crear_cliente").click(function(){
             insertar_cliente_empresa();
         });
         //--***EVENTO PRESIONANDO CEDULA CLEINTE***--                
         //cundo se presionde un tag <a> dentro "datos_permiso_personal" obtenemos su id y gurdamos el valor que contenga
         $("#datos_cliente_empresa a").click(function(e){
             //alert("presionado bten crear");
             //obtenemos la cedula del personal seleccionado
             elemento=e.target.id; 
             valor_optenido= $("#"+elemento+"").text();
             update_cliente_empresa(valor_optenido);
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
                 $("#form_filtro").insertBefore("#grid_cliente_empresa");
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

}//FIN funcion cargar_cliente
//variable tipo obejeto global para almacenar los datos de los input 
var datos_obtenidos= new Object();
function insertar_cliente_empresa(){
       // datos_obtenidos="";
        //alert("presionado btn crear cleinte");
        //ocultamos temporalmente el grid del presonal
        $("#form_crear_empresa").empty();
        $("#form_filtro").hide(500);
        $("#grid_cliente_empresa").hide(500);
        $("#form_crear_empresa").show(500);
        $("#contenedor_formularios").append("<div id='form_crear_empresa' class='panel-body'></div>");
        $("#form_crear_empresa").load('../configuraciones/cliente/form_crear_empresa.html',function(){
           //
            $('html,body').animate({
                scrollTop: $("#contenido").offset().top
            }, 500);
            //alert("que estado : "+lista_estado);
            //
            for(k=0;k<lista_estado.length;k++){
                lista_estado[k]=lista_estado[k].toUpperCase();
                //alert("lista de estados: "+lista_estado[k]);
                $("#elemento_6").append("<option>"+lista_estado[k]+"</option>");
            }
                //alert("funcion isertar");
            
            
            //cancelar creacion 
            $("#btm_cancelar_registro").click(function(){
               //alert("presionado btn crear");
                $("#form_filtro").hide();
                $("#form_crear_empresa").hide(500);
                $("#grid_cliente_empresa").show(500);
                $("#btn_filtro").show(500);
                $("#form_crear_empresa").remove();
           });
            //--**GUARDAR INSERT**--
            $("#btm_guardar").click(function(){
                ////alert("presionado boton crear");
                for(i=0;i<12;i++){
                    //cuando sea elemento_2 tengo que cambiar su valor en texo por su llave primaria (idcargo de la tabla cargo)
                    if(i===6){
                        datos_obtenidos["elemento_"+i+""] = $("#elemento_"+i+"").val();
                        datos_obtenidos["elemento_"+i+""]=restJson("../../core/json.php?funcion=recordSetSincronizado&bd="+que_bd+"&t=estado&c=idestado&w=where&dato=estado='"+datos_obtenidos["elemento_"+i+""]+"'");
                    }
                    else{
                        //cuando sea elemento_8 tengo que cambiar su valor en texo por su llave primaria (idestado de la tabla estado)
                       datos_obtenidos["elemento_"+i+""] = $("#elemento_"+i+"").val();
                      
                    } 
                    //alert("que datos envio: "+datos_obtenidos["elemento_"+i+""]);
                }//---/FIN for
                //alert("que datos envio: "+datos_obtenidos["elemento_11"]);
                ajax_insertar_cliente_empresa(datos_obtenidos); 
                
                $("#form_crear_empresa").hide(500);
                $("#form_filtro").hide();
                $("#grid_cliente_empresa").show(500);
                $("#btn_filtro").show(500);
                $("#form_crear_empresa").remove();

            });//--/FIN boton guardar 

       });

}//--/FIN funcion
function update_cliente_empresa(que_elejido){
    //limpiamos todo el contenedor_formularios, para cargar el nuevo formulario
    //alert("cedula: "+que_elejido);
    var cliente_elejido= new Array;
    var lista_cliente= new Array;
    $("#form_crear_empresa").remove();
    $("#form_filtro").hide(500);
    $("#grid_cliente_empresa").hide(500);

    $("#form_crear_empresa").show(500);
   //Cargamos el nuevo formulario
    $("#contenedor_formularios").append("<div id='form_crear_empresa' class='panel-body'></div>");
    $("#form_crear_empresa").load('../configuraciones/cliente/form_crear_empresa.html',function(){
       //animacion que nos ubica en el principio del formulario
        $('html,body').animate({
            scrollTop: $("#contenido").offset().top
        }, 500);
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
            lista_cliente[9]=cliente_elejido.nombre_contacto;
            lista_cliente[10]=cliente_elejido.telefono_fijo;
            lista_cliente[11]=cliente_elejido.telefono_movil;
            //alert("tamaño: "+lista_cliente.length);
            for(j=0;j<(lista_cliente.length);j++){
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
                $("#form_crear_empresa").hide(500);
                $("#grid_cliente_empresa").show(500);
                $("#btn_filtro").show(500);
                $("#form_crear_empresa").remove();
            });
            //--**GUARDAR UPDATE**--
            $("#btm_guardar").click(function(){
                //alert("presionado bten crear");
                $("#form_crear_empresa").hide(500);
                $("#form_filtro").hide();
                $("#grid_cliente_empresa").show(500);
                $("#btn_filtro").show(500);
                $("#form_crear_empresa").remove();
                            //OBTENIENDO DATOS CAMBIADOS
                for(i=0;i<8;i++){
                    //cuando sea elemento_2 tengo que cambiar su valor en texo por su llave primaria (idcargo de la tabla cargo)
                    if(i===7){
                        datos_obtenidos["elemento_"+i+""] = $("#elemento_"+i+"").val();
                        datos_obtenidos["elemento_"+i+""]=restJson("../../core/json.php?funcion=recordSetSincronizado&bd="+que_bd+"&t=estado&c=idestado&w=where&dato=estado='"+datos_obtenidos["elemento_"+i+""]+"'");
                    }
                    else{
                        //cuando sea elemento_8 tengo que cambiar su valor en texo por su llave primaria (idestado de la tabla estado)
                       datos_obtenidos["elemento_"+i+""] = $("#elemento_"+i+"").val();
                       // alert("obteniendo datos--->: "+datos_obtenidos["elemento_"+i+""]);
                    }
                    //alert("que_datos: "+datos_obtenidos["elemento_"+i+""]);
                }//---/FIN for
                ajax_update_cliente_empresa(datos_obtenidos);
            });//--/FIN boton guardar 

   });
}
function ajax_insertar_cliente_empresa(que_datos){
        //$("#contenedor_formularios").append('<div id="loading"></div>');
        //$("#loading").html('<div id="loading" class="preloader sk-spinner sk-spinner-rotating-plane"><img src="images/loading.png" alt=""/></div>');
    
    var datos_pasados=new Object();
    datos_pasados=que_datos;   
    //alert("en ajax isert: "+datos_pasados["elemento_0"]);
    $.ajax({
        url : '../configuraciones/cliente/insertar_cliente_empresa.php',
        type: 'POST',
        data : datos_pasados,
        cache:false,
        error:function(data ){alert("error: "+data);},
        success:function( data )
               {
                   // Estamos utilizando el método .done(), pero debo apuntar que jQuery nos provee de varios métodos callback para distintos fines
                   // En data además viene la respuesta del PHP
                   alert("los datos han sido guarados: "+data);
                 //$("#loading").remove();
                   //$("#loading").html('<div id="loading" class="preloader sk-spinner sk-spinner-rotating-plane"><img src="images/loading.png" alt=""/></div>');
               }
    });  
    
}
function ajax_update_cliente_empresa(que_datos){
        $("#contenedor_formularios").append('<div id="loading" class=""></div>');
        $("#loading").html('<div id="loading" class="preloader sk-spinner sk-spinner-rotating-plane"><img src="images/loading.png" alt=""/></div>');
    var datos_pasados=new Object();
    datos_pasados=que_datos;   
   // alert("en ajax: "+datos_pasados);
    $.ajax({
        url : '../configuraciones/cliente/update_cliente_empresa.php',
        type: 'POST',
        data : datos_pasados,
        cache:false,
        error:function(data ){alert("error");},
        success:function( data )
               {
                   // Estamos utilizando el método .done(), pero debo apuntar que jQuery nos provee de varios métodos callback para distintos fines
                   // En data además viene la respuesta del PHP
                 alert("los datos han sido guarados: "+data);
               }
    });  
    
}