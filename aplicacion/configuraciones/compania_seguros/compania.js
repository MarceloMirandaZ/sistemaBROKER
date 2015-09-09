//variable globales
var bd_sesion;
var que_bd;
var personal_bd;
var lista_personal = new Array;
var todos_los_permisos = new Array;

var bd_cargo;
var lista_cargo= new Array;

var bd_estado;
var lista_estado= new Array;

var dato_insert= new Array();
function cargar_compania_seguros(){

    //al hacer click en el boton "btn_permiso_personal" borramos el nodo "contenedor_formularios" y su nodos hijos 
    $("#contenedor_formularios").empty();
    $("#contenedor_formularios").remove();
    $("#grid_permiso_personal").remove();
     $("#grid_personal").remove();
    //creamos en el DOM id ="contenedor_formularios" que almacenará a todos los formularios (modulos)

    $("#contenido").append('<div class="panel panel-default" id ="contenedor_formularios"><div id ="grid_compania_seguros" class="panel-body"></div></div>');
    $("#grid_compania_seguros").load('../configuraciones/cliente/grid_grid_compania_seguros.html',function(){ 
        //obtengo el nombre de la bd
        bd_sesion=restJson("../../core/json.php?funcion=informacion");
        que_bd=bd_sesion.alias;

        //obtengo los datos de la tabla personal
        personal_bd=restJson("../../core/json.php?funcion=Query&bd="+que_bd+"&t=vista_personal"); 

        //alert(personal_bd.nombre);
        //lista_personal[0]="";
        lista_personal[0]=personal_bd.idpersonal;
        lista_personal[1]=personal_bd.cedula;
        lista_personal[2]=personal_bd.nombre;
        lista_personal[3]=personal_bd.apellido;
        lista_personal[4]=personal_bd.email;
        lista_personal[5]=personal_bd.telefono;
        lista_personal[6]=personal_bd.direccion;
        lista_personal[7]=personal_bd.cargo;
        lista_personal[8]=personal_bd.usuario;
        lista_personal[9]=personal_bd.estado;

        // alert("comprobando dato nombre: "+lista_personal[1]);
        //cargo en el grid los datos de la tabla personal
        var contador=0;
        for(i=0;i<lista_personal[1].length;i++){
            //creo primero la  columna
            // alert("lista celda: "+lista_personal[j][i]);  

            contador=contador+1;
            $("#datos_personal").append("<tr id='columna_"+i+"'></tr>");
            for(j=0;j<lista_personal.length;j++){
                //creo las celdas que irán en la columna


               if(j===1){
                   $("#columna_"+i).append("<th style='text-align: center'><a id='personal_"+i+"' href='#'>"+lista_personal[j][i]+"</a></th>");
               }
               else{
                   if(j===0){
                        $("#columna_"+i).append("<th style='text-align: center'>"+contador+"</th>");
                   }
                   else{
                       $("#columna_"+i).append("<th style='text-align: center'>"+lista_personal[j][i]+"</th>");
                   }
               }

            }
        }
        $("#btn_crear").click(function(){
            //alert("presionado bten crear");
            //ocultamos temporalmente el grid del presonal
            $("#form_crear_personal").empty();
            $("#btn_filtro").hide(500);
            $("#form_filtro").hide(500);
            $("#grid_personal").hide(500);
            $("#form_crear_personal").show(500);
            $('html,body').animate({
                scrollTop: $("#contenido").offset().top
            }, 500);
           //
           $("#contenedor_formularios").append("<div id='form_crear_personal' class='panel-body'></div>");
           $("#form_crear_personal").load('../configuraciones/personal/form_crear_personal.html',function(){
                bd_cargo=restJson("../../core/json.php?funcion=Query&bd="+que_bd+"&t=cargo");
                lista_cargo = bd_cargo.cargo;
                //
                bd_estado=restJson("../../core/json.php?funcion=Query&bd="+que_bd+"&t=estado");
                lista_estado = bd_estado.estado;
                //
                for(k=0;k<lista_cargo.length;k++){
                    lista_cargo[k]=lista_cargo[k].toUpperCase();
                    $("#elemento_6").append("<option>"+lista_cargo[k]+"</option>");
                }
                for(l=0;l< lista_estado.length;l++){
                    lista_estado[l]=lista_estado[l].toUpperCase();
                    $("#elemento_9").append("<option>"+lista_estado[l]+"</option>");
               }
                //
               //
                $("#btm_cancelar_registro").click(function(){
                   // alert("presionado bten crear");
                    $("#form_filtro").hide();
                    $("#form_crear_personal").hide(500);
                    $("#grid_personal").show(500);
                    $("#btn_filtro").show(500);
                    $("#form_crear_personal").remove();
                });
                $("#btm_guardar").click(function(){
                     //alert("presionado bten crear");
                     insertar_personal();
                     $("#form_crear_personal").hide(500);
                     $("#form_filtro").hide();
                     $("#grid_personal").show(500);
                     $("#btn_filtro").show(500);
                     $("#form_crear_personal").remove();
                });//--/FIN boton guardar personal
           });
        });//--/FIN boton crear Registro

        $("#btn_filtro").click(function(){
          //alert("presionado bten crear");
            $("#btn_filtro").hide(500);
            //$("#grid_personal").hide(500);
            $("#form_filtro").show(500);
            $("#contenedor_formularios").append('<div id="form_filtro"></div>');
            $("#form_filtro").load("../configuraciones/personal/filtro_personal.html",function(){
                 $("#form_filtro").insertBefore("#grid_personal");
                 $("#form_filtro").show(500);
                 $("#btn_ver_todos").click(function(){
                    // alert("presionado bten crear");
                     $("#btn_filtro").show(500);
                     //$("#form_personal").hide();
                     $("#form_filtro").hide(500);
                 });
            });
        });
    });               
}//FIN funcion personal
//variable tipo obejeto global para almacenar los datos de los input 
var datos_obtenidos= new Object();
function insertar_personal(){
    //recorro todos los input con nombre elemnto_x, donde x es un número, y almaceno su valor
    for(i=0;i<18;i++){
        //cuando sea elemento_2 tengo que cambiar su valor en texo por su llave primaria (idcargo de la tabla cargo)
        if(i===6){
            datos_obtenidos["elemento_"+i+""] = $("#elemento_"+i+"").val();
            datos_obtenidos["elemento_"+i+""]=restJson("../../core/json.php?funcion=recordSetSincronizado&bd="+que_bd+"&t=cargo&c=idcargo&w=where&dato=cargo='"+datos_obtenidos["elemento_"+i+""]+"'");
        }
        else{
            //cuando sea elemento_8 tengo que cambiar su valor en texo por su llave primaria (idestado de la tabla estado)
                if(i===9){
                datos_obtenidos["elemento_"+i+""] = $("#elemento_"+i+"").val();
                datos_obtenidos["elemento_"+i+""]= restJson("../../core/json.php?funcion=recordSetSincronizado&bd="+que_bd+"&t=estado&c=idestado&w=where&dato=estado='"+datos_obtenidos["elemento_"+i+""]+"'");
            }
            else{
                datos_obtenidos["elemento_"+i+""] = $("#elemento_"+i+"").val();
            }
           // alert("obteniendo datos--->: "+datos_obtenidos["elemento_"+i+""]);
        }
        //$("#form_enviar_datos").click(function(){

        //});
    }//---/FIN for
    
    $("#contenedor_formularios").append('<div id="loading"></div>');
    $("#loading").html('<div id="loading" class="preloader sk-spinner sk-spinner-rotating-plane"><img src="images/loading.png" alt=""/></div>');
    $.ajax({
      url : '../configuraciones/personal/insertar_datos.php',
      type: 'POST',
      data : datos_obtenidos,
      error:function(){alert("error: "+data);},
      success:function( data )
             {
                 // Estamos utilizando el método .done(), pero debo apuntar que jQuery nos provee de varios métodos callback para distintos fines
                 // En data además viene la respuesta del PHP
                 //alert("los datos han sido guarados");
               $("#loading").remove();
                 //$("#loading").html('<div id="loading" class="preloader sk-spinner sk-spinner-rotating-plane"><img src="images/loading.png" alt=""/></div>');
             }
    });
}//--/FIN funcion



