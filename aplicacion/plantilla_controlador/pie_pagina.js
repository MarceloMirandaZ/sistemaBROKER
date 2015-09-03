$(function(){
    var paramentros;
    paramentros = restJson('../../parametros/personalizacion.json');
    $('#footer').html('<div class="modal-footer">Desarrollado por:   ' + paramentros.footer + '</div>');
});
