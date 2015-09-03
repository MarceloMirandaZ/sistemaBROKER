//el document ready, de Jquery, ya esta cargo por "plantilla.js" del html "crearreclamos.html"

$(function() {
    $('#configuraciones').addClass('active');
    //
    
    //
    $("#contenedor_manu").load('../configuraciones/menu.html',function(){
        //

        //
        cargar_personal();
    });
              
});
   
