//variable globales
var bd_sesion;
var que_bd;
var personal_bd;
var lista_personal_permiso = new Array;
var todos_los_permisos = new Array;
var mis_permisos = new Array;
var bd_cargo;
var lista_cargo= new Array;

var bd_estado;
var lista_estado= new Array;

var dato_insert= new Array;

var elemento; 
var valor_optenido = new Array;
var personal_elejido = new Array();
//lista_personal_permiso="";
function cargar_permiso_personal(){

//alert("funcion cargar permiso_personal");
//--***GRID PERMISOS PERSONAL***--

    //al hacer click en el boton "btn_permiso_personal" borramos el nodo "contenedor_formularios" y su nodos hijos 
    $("#contenedor_formularios").empty();
    $("#contenedor_formularios").remove();
    $("#grid_permiso_personal").remove();
     $("#grid_personal").remove();
    //creamos en el DOM id ="contenedor_formularios" que almacenará a todos los formularios (modulos)
    $("#contenido").append('<div class="panel panel-default" id ="contenedor_formularios"><div id ="grid_permiso_personal" class="panel-body"></div></div>');
    $("#grid_permiso_personal").load('../configuraciones/permiso_personal/grid_permiso_personal.html',function(){ 
               //obtengo el nombre de la bd
        bd_sesion=restJson("../../core/json.php?funcion=informacion");
        que_bd=bd_sesion.alias;
       //--***GRID PERMISOS_PERSONAL***--
        //obtengo los datos de la tabla vista_personal
        personal_bd=restJson("../../core/json.php?funcion=Query&bd="+que_bd+"&t=vista_personal"); 

        //alert(personal_bd.nombre);
        //lista_personal_permiso[1].length=0;
        lista_personal_permiso[0]=personal_bd.idpermiso_personal;
        lista_personal_permiso[1]=personal_bd.cedula;
        lista_personal_permiso[2]=personal_bd.nombre;
        lista_personal_permiso[3]=personal_bd.apellido;
        lista_personal_permiso[4]=personal_bd.cargo;
        lista_personal_permiso[5]=personal_bd.usuario;
        lista_personal_permiso[6]=personal_bd.estado;

        // alert("comprobando dato nombre: "+lista_personal_permiso[1]);
        //cargo en el grid los datos de la tabla vista_personal
        var contador=0;
        for(i=0;i<lista_personal_permiso[1].length;i++){
            //creo primero la  columna
           //alert("TAMAÑO: "+lista_personal_permiso[1].length);  
            contador=contador+1;
            $("#datos_permiso_personal").append("<tr id='columna_"+i+"'></tr>");
            for(j=0;j<lista_personal_permiso.length;j++){
                //creo las celdas que irán en la columna
               if(j===1){
                   //creo un link para los valores de la segunda columna de la tabla (la cedula)
                   $("#columna_"+i).append("<th style='text-align: center'><a id='link_permiso_personal_"+i+"' href='#'>"+lista_personal_permiso[j][i]+"</a></th>");
               }
               else{
                   if(j===0){
                        $("#columna_"+i).append("<th style='text-align: center'>"+contador+"</th>");
                   }
                   else{
                       $("#columna_"+i).append("<th style='text-align: center'>"+lista_personal_permiso[j][i]+"</th>");
                   }
               }

            }
        }
        //cundo se presionde un tag <a> dentro "datos_permiso_personal" obtenemos su id y gurdamos el valor que contenga
        $("#datos_permiso_personal a").click(function(e){
            //alert("presionado bten crear");
            //obtenemos la cedula del personal seleccionado
            elemento=e.target.id; 
            valor_optenido= $("#"+elemento+"").text();
            //alert("la cedula: "+valor_optenido);
            //limpiamos todo el contenedor_formularios, para cargar el nuevo formulario
            $("#contenedor_formularios").empty();
            $("#form_crear_permiso_personal").remove();
            $("#btn_flitro").hide();
            $("#form_filtro").hide();
            $("#grid_permiso_personal").hide(500);
            $("#form_crear_permiso_personal").show(500);
           //Cargamos el nuevo formulario
           $("#contenedor_formularios").append("<div id='form_crear_permiso_personal' class='panel-body'></div>");
           $("#form_crear_permiso_personal").load('../configuraciones/permiso_personal/form_permiso_personal.html',function(){
               //animacion que nos ubica en el principio del formulario
                $('html,body').animate({
                    scrollTop: $("#contenido").offset().top
                }, 500);

                //--***DATOS DEL PERSONAL SELECIONADO***--
                personal_elejido = restJson("../../core/json.php?funcion=restFull&bd="+que_bd+"&t=vista_personal&d=cedula='"+valor_optenido+"'");     
                //alert("el lejido :O/-->"+personal_elejido.nombre);
                lista_personal_permiso[0]=personal_elejido.idpersonal;
                lista_personal_permiso[1]=personal_elejido.cedula;
                lista_personal_permiso[2]=personal_elejido.nombre;
                lista_personal_permiso[3]=personal_elejido.apellido;
                lista_personal_permiso[4]=personal_elejido.cargo;
                lista_personal_permiso[5]=personal_elejido.usuario;
                lista_personal_permiso[6]=personal_elejido.estado;
                for(j=0;j<(lista_personal_permiso.length);j++){
                //creo las celdas que irán en la columna
                    //alert("lista personal elejido: "+lista_personal_permiso[j]);
                    $("#elemento_"+j+"").val(""+lista_personal_permiso[j+1]+"");

               }
                //--***LISTA DE PERMISOS***--
                //limpiamos la varible global mis_permisos
                mis_permisos = "";
                //conusltamos si tiene permisos 
                mis_permisos = restJson("../../core/json.php?funcion=recordSetSincronizado&bd="+que_bd+"&t=vista_permiso_personal&c=permiso&w=where&dato=cedula='"+valor_optenido+"'"); 
                //alert("mis permisos consultaods: "+mis_permisos);
                //obtenemos todos los permisos para comprarlos
                todos_los_permisos = restJson("../../core/json.php?funcion=Query&bd="+que_bd+"&t=permiso"); 
               //si tiene permisos, los compramos y en los que sean iguales ponemos el estado checked en el checkbox
                if(mis_permisos!=="Información no disponible"){
                    //alert("todos los permisos"+todos_los_permisos.permiso);
                    var tamaño = (todos_los_permisos.permiso.length)+6;
                    for(k=6;k<tamaño;k++){
                        todos_los_permisos.permiso[k-6]=todos_los_permisos.permiso[k-6].toUpperCase();
                       // alert("todos disponibles: "+todos_los_permisos.permiso[k-6]);
                        for(i=6;i<(mis_permisos.length)+6;i++){ 
                            mis_permisos[i-6]=mis_permisos[i-6].toUpperCase();
                           // alert("mios disponibles: "+mis_permisos[i-6]);
                            if(todos_los_permisos.permiso[k-6] === mis_permisos[i-6] ){
                                //alert("iguales");
                                $("#listadado_permisos").append('<div class="row"><label class="checkbox-inline col-xs-5 col-md-5 col-md-offset-2"> <input type="checkbox" id="elemento_'+k+'" value="'+todos_los_permisos.permiso[k-6]+'" checked>'+todos_los_permisos.permiso[k-6]+'</label></div>');
                            }
                            else{
                                $("#listadado_permisos").append('<div class="row"><label class="checkbox-inline col-xs-5 col-md-5 col-md-offset-2"> <input type="checkbox" id="elemento_'+k+'" value="'+todos_los_permisos.permiso[k-6]+'">'+todos_los_permisos.permiso[k-6]+'</label></div>');
                            }

                        }//---/FIN form i
                    }//---/FIN form k
                }//---/FIN if informacion no disponible
                //no tien permisos cargamos todos los permisos sin estado checked
                else{
                    for(k=6;k<tamaño;k++){
                        todos_los_permisos.permiso[k-6]=todos_los_permisos.permiso[k-6].toUpperCase();
                       // alert("todos del esle: "+todos_los_permisos.permiso[k-6]);
                            $("#listadado_permisos").append('<div class="row"><label class="checkbox-inline col-xs-5 col-md-5 col-md-offset-2">  <input type="checkbox" id="elemento_'+k+'" value="'+todos_los_permisos.permiso[k-6]+'">'+todos_los_permisos.permiso[k-6]+'</label></div>');
                    }//---/FIN form k
                }

                /*for(l=0;l< lista_estado.length;l++){
                    lista_estado[l]=lista_estado[l].toUpperCase();
                    $("#elemento_9").append("<option>"+lista_estado[l]+"</option>");
               }*/
               //
                $("#btm_cancelar_registro").click(function(){
                   // alert("presionado bten crear");
                    $("#form_filtro").hide();
                    $("#form_crear_permiso_personal").hide(500);
                    $("#grid_permiso_personal").show(500);
                    $("#btn_filtro").show(500);
                    $("#form_crear_permiso_personal").remove();
                });
                $("#btm_guardar").click(function(){
                     //alert("presionado bten crear");
                     insertar_permiso_personal();
                     $("#form_crear_permiso_personal").hide(500);
                     $("#form_filtro").hide();
                     $("#grid_permiso_personal").show(500);
                     $("#btn_filtro").show(500);
                     $("#form_crear_permiso_personal").remove();
                });//--/FIN boton guardar permiso_personal
           });
        });//--/FIN boton crear Registro

        $("#btn_filtro").click(function(){
          //alert("presionado bten crear");
            $("#btn_filtro").hide(500);
            //$("#grid_permiso_personal").hide(500);
            $("#form_filtro").show(500);
            $("#contenedor_formularios").append('<div id="form_filtro"></div>');
            $("#form_filtro").load("../configuraciones/permiso_personal/filtro_permiso_personal.html",function(){
                 $("#form_filtro").insertBefore("#grid_permiso_personal");
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

}//FIN funcion permiso_personal
//variable tipo obejeto global para almacenar los datos de los input 
var datos_obtenidos= new Object();
function insertar_permiso_personal(){
    //alert("funcion isertar");
    var tamaño_datos=todos_los_permisos.permiso.length;
    //alert("tamaño: "+tamaño_datos);
    //recorro todos los input con nombre elemnto_x, donde x es un número, y almaceno su valor
    for(i=5;i<(tamaño_datos)+6;i++){
        //cuando sea elemento_2 tengo que cambiar su valor en texo por su llave primaria (idcargo de la tabla cargo)
            if(i===5){
                datos_obtenidos["elemento_"+i+""]=lista_personal_permiso[0];
                //alert("valor idpersonal: "+datos_obtenidos["elemento_"+i+""]);
            }else{
                if( $("#elemento_"+i+"").is(':checked') ) {
                    datos_obtenidos["elemento_6"] = $("#elemento_"+i+"").val();
                    datos_obtenidos["elemento_6"]=restJson("../../core/json.php?funcion=recordSetSincronizado&bd="+que_bd+"&t=permiso&c=idpermiso&w=where&dato=permiso='"+datos_obtenidos["elemento_6"]+"'");
                    ajax_insertar(datos_obtenidos);
                    // alert("valor: "+datos_obtenidos["elemento_"+i+""]);
                }
            }  
        
           // alert("obteniendo datos--->: "+datos_obtenidos["elemento_"+i+""]);

        //$("#form_enviar_datos").click(function(){

        //});
    }//---/FIN for
    
    
}//--/FIN funcion
function ajax_insertar(que_datos){
        //$("#contenedor_formularios").append('<div id="loading"></div>');
        //$("#loading").html('<div id="loading" class="preloader sk-spinner sk-spinner-rotating-plane"><img src="images/loading.png" alt=""/></div>');
    var datos_pasados=que_datos;   
    $.ajax({
        url : '../configuraciones/permiso_personal/insertar_datos.php',
        type: 'POST',
        data : datos_pasados,
        error:function(data ){alert("error: "+data);},
        success:function( data )
               {
                   // Estamos utilizando el método .done(), pero debo apuntar que jQuery nos provee de varios métodos callback para distintos fines
                   // En data además viene la respuesta del PHP
                   alert("los datos han sido guarados: "+data);
                 $("#loading").remove();
                   //$("#loading").html('<div id="loading" class="preloader sk-spinner sk-spinner-rotating-plane"><img src="images/loading.png" alt=""/></div>');
               }
    });  
    
}



