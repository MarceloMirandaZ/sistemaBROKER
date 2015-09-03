$(document).ready(function (){
    /*
     * cundo la pagina login.html se carge
    *enviamos el formulario al div con id="contenido"
    */
   //alert("hola desde login script . js");
        $('#contenido').load('../login/form.html');
        var paramentros;
        paramentros = restJson('../../parametros/personalizacion.json');
        $('#footer').html('<div class="modal-footer">Desarrollado por:   ' + paramentros.footer + '</div>');

});
