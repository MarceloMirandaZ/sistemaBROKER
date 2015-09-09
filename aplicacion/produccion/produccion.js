//el document ready, de Jquery, ya esta cargo por "plantilla.js" del html "crearreclamos.html"
$(function() {
    $('#configuracion').click(function(){
        $('#configuracion').addClass('active');
        $("#contenido").empty();
        $("#contenido").append("<div id='menu_top'></div>");
        $("#menu_top").load('../configuraciones/menu_top.html',function(){
                $("#btn_personal").click(function(){
                    $("#contenedor_formularios").remove();
                    $("#contenido").append('<div class="panel panel-default" id ="contenedor_formularios"><div id ="grid_personal" class="panel-body"></div></div>');
                    $("#grid_personal").load('../configuraciones/personal/grid_personal.html',function(){
                            $("#btn_personal").addClass('active');
                            cargar_personal();         
                    });
                });
        });
    });
   
              
});
   
                