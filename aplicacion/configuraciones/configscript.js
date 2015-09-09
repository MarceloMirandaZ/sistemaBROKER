//este js es invocado en plantilla.html, todo directorio debe ser localizado como si estuvieramos en ese archivo
/*            
*/
$(function() {

    //Cuando hagan click en el boton configuraciones (menu izquierdo)    
    $('#configuracion').click(function(){//<--INICIO click configuraciones
    //añadimos la propieda css al boton para que este activo
    $('#configuracion').addClass('active');
    //limpiamos los nodos hijos del div con "id=contenido"
    $("#contenido").empty();

        //añadimos un nuevo elemento al DOM, donde guardarmos el menu_top.html
        $("#contenido").append("<div id='menu_top'></div>");
        $("#menu_top").load('../configuraciones/menu_top.html',function(){//<--INICIO load menu_top
           // cargar_botones_top();
              //--***BOTON PERSONAL**--
            $("#btn_personal").click(function(){
                //alert("boton personal");
                //llamamos a la funcion cargar_personal() de personal/personalscript.js
                $("#btn_personal").addClass('active');
                $("#btn_cliente").removeClass('active');
                cargar_personal();
            });//<--FIN btn_personal
            //--***BOTON PERMISOS PERSONAL**--
            $("#btn_permiso_personal").click(function(){
                $("#btn_permiso_personal").addClass('active');
                $("#btn_personal").removeClass('active');
                $("#btn_cliente").removeClass('active');
                //alert("boton personal");
                //llamamos a la funcion cargar_personal() de personal/personalscript.js
                cargar_permiso_personal();  
            });//<--FIN btn_permiso_personal_personal
            //--***BOTON CLIENTE**--
            $("#btn_cliente").click(function(){
                $("#btn_cliente").addClass('active');
                $("#btn_permiso_personal").removeClass('active');
                $("#btn_cliente").removeClass('active');
                cargar_varibles_cliente();
            });//<--FIN btn_permiso_cliente
            //--***BOTON CLIENTE_PERSONA**--
            $("#btn_cliente_persona").click(function(){
                $("#btn_cliente").addClass('active');
                $("#btn_permiso_personal").removeClass('active');
                $("#btn_personal").removeClass('active');
                //alert("boton personal");
                //llamamos a la funcion cargar_personal() de personal/personalscript.js
                cargar_cliente_persona();
            });//<--FIN btn_cliente_PERSONAL
            //--***BOTON CLIENTE_EMPRESA**--
            $("#btn_cliente_empresa").click(function(){
                $("#btn_cliente").addClass('active');
                $("#btn_permiso_personal").removeClass('active');
                $("#btn_personal").removeClass('active');
                //alert("boton empresa");
                //llamamos a la funcion cargar_personal() de personal/personalscript.js
                cargar_cliente_empresa();
                
            });//<--FIN btn_cliente_empresa
            //--***BOTON COMPAÑIA DE SEGUROS**--
            $("#btn_compania_seguros").click(function(){
                //alert("funcion cargar personal");
                $("#btn_cliente").addClass('active');
                $("#btn_permiso_personal").removeClass('active');
                $("#btn_personal").removeClass('active');
                cargar_compania_seguros();
                
            });//<--FIN btn_compania
        });//<--FIN load menu_top
    });//<--FIN click configuraciones            
});
   
                