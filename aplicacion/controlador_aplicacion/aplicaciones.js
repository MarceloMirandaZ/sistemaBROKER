//sonidos
function notificacion(aviso)
{
    document.getElementById('' + aviso).play();
}
//
function Reloj() {
    momentoActual = new Date()
    hora = momentoActual.getHours()
    minuto = momentoActual.getMinutes()
    segundo = momentoActual.getSeconds()

    horaImprimible = hora + " : " + minuto + " : " + segundo
    return horaImprimible;
}

function utf8_decode(str_data) {
    //  discuss at: http://phpjs.org/functions/utf8_decode/
    // original by: Webtoolkit.info (http://www.webtoolkit.info/)
    //    input by: Aman Gupta
    //    input by: Brett Zamir (http://brett-zamir.me)
    // improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
    // improved by: Norman "zEh" Fuchs
    // bugfixed by: hitwork
    // bugfixed by: Onno Marsman
    // bugfixed by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
    // bugfixed by: kirilloid
    // bugfixed by: w35l3y (http://www.wesley.eti.br)
    //   example 1: utf8_decode('Kevin van Zonneveld');
    //   returns 1: 'Kevin van Zonneveld'

    var tmp_arr = [],
            i = 0,
            c1 = 0,
            seqlen = 0;

    str_data += '';

    while (i < str_data.length) {
        c1 = str_data.charCodeAt(i) & 0xFF;
        seqlen = 0;

        // http://en.wikipedia.org/wiki/UTF-8#Codepage_layout
        if (c1 <= 0xBF) {
            c1 = (c1 & 0x7F);
            seqlen = 1;
        } else if (c1 <= 0xDF) {
            c1 = (c1 & 0x1F);
            seqlen = 2;
        } else if (c1 <= 0xEF) {
            c1 = (c1 & 0x0F);
            seqlen = 3;
        } else {
            c1 = (c1 & 0x07);
            seqlen = 4;
        }

        for (var ai = 1; ai < seqlen; ++ai) {
            c1 = ((c1 << 0x06) | (str_data.charCodeAt(ai + i) & 0x3F));
        }

        if (seqlen == 4) {
            c1 -= 0x10000;
            tmp_arr.push(String.fromCharCode(0xD800 | ((c1 >> 10) & 0x3FF)), String.fromCharCode(0xDC00 | (c1 & 0x3FF)));
        } else {
            tmp_arr.push(String.fromCharCode(c1));
        }

        i += seqlen;
    }

    return tmp_arr.join("");
}
function utf8_encode(argString) {
    //  discuss at: http://phpjs.org/functions/utf8_encode/
    // original by: Webtoolkit.info (http://www.webtoolkit.info/)
    // improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
    // improved by: sowberry
    // improved by: Jack
    // improved by: Yves Sucaet
    // improved by: kirilloid
    // bugfixed by: Onno Marsman
    // bugfixed by: Onno Marsman
    // bugfixed by: Ulrich
    // bugfixed by: Rafal Kukawski
    // bugfixed by: kirilloid
    //   example 1: utf8_encode('Kevin van Zonneveld');
    //   returns 1: 'Kevin van Zonneveld'

    if (argString === null || typeof argString === 'undefined') {
        return '';
    }

    // .replace(/\r\n/g, "\n").replace(/\r/g, "\n");
    var string = (argString + '');
    var utftext = '',
            start, end, stringl = 0;

    start = end = 0;
    stringl = string.length;
    for (var n = 0; n < stringl; n++) {
        var c1 = string.charCodeAt(n);
        var enc = null;

        if (c1 < 128) {
            end++;
        } else if (c1 > 127 && c1 < 2048) {
            enc = String.fromCharCode(
                    (c1 >> 6) | 192, (c1 & 63) | 128
                    );
        } else if ((c1 & 0xF800) != 0xD800) {
            enc = String.fromCharCode(
                    (c1 >> 12) | 224, ((c1 >> 6) & 63) | 128, (c1 & 63) | 128
                    );
        } else {
            // surrogate pairs
            if ((c1 & 0xFC00) != 0xD800) {
                throw new RangeError('Unmatched trail surrogate at ' + n);
            }
            var c2 = string.charCodeAt(++n);
            if ((c2 & 0xFC00) != 0xDC00) {
                throw new RangeError('Unmatched lead surrogate at ' + (n - 1));
            }
            c1 = ((c1 & 0x3FF) << 10) + (c2 & 0x3FF) + 0x10000;
            enc = String.fromCharCode(
                    (c1 >> 18) | 240, ((c1 >> 12) & 63) | 128, ((c1 >> 6) & 63) | 128, (c1 & 63) | 128
                    );
        }
        if (enc !== null) {
            if (end > start) {
                utftext += string.slice(start, end);
            }
            utftext += enc;
            start = end = n + 1;
        }
    }

    if (end > start) {
        utftext += string.slice(start, stringl);
    }

    return utftext;
}

function saludar()
{
    alert('saludo');
}

function submitData(pagina, div, dato,nombre)
{
    //alert('hola desde paicacion.js');
    
    var n_elementos = dato;// numero de elementos que exiten en el formulario
    var data = new Array();
    for (i = 0; i < n_elementos; i++)
    {
        data[i] = document.getElementById(nombre+"_" + i).value;
        //document.getElementById('procesar').innerHTML=''+data[i];
    }
    //alert(ejemplo['element_0']);
    //construiremos el for para alimentar el numero de elementos que vamos ha enviar
    var dato = new Array();
    var paquetes = new Array();
//entregamos datos la informacion
    dato = data;
    var elementos = 0;
    for (j = 0; j < dato.length; j++)
    {
        paquetes[j] = nombre+'_' + j + '=' + dato[j] + '';
        elementos = elementos + 1;
    }
    var envoltura = paquetes.join('&');

    //----------------------->>>
    //alert(envoltura+"&elementos="+elementos);
    envoltura = envoltura + "&elementos=" + elementos+"&input="+nombre;
    
    $('#cargando').html('Cargando...<img style="margin-left:400px; " src="../images/loader.gif">');
    $.ajax({
        type: "POST",
        url: pagina,
        data: envoltura
    })
            .done(function (html) {
                $("#"+div).html('' + html);

            });
}

function enviarPost(dato)
{
    var n_elementos = dato;// numero de elementos que exiten en el formulario
    var data = new Array();
    for (i = 0; i < n_elementos; i++)
    {
        data[i] = document.getElementById("element_" + i).value;
        //document.getElementById('procesar').innerHTML=''+data[i];
    }
    //alert(ejemplo['element_0']);
    //construiremos el for para alimentar el numero de elementos que vamos ha enviar
    var dato = new Array();
    var paquetes = new Array();
//entregamos datos la informacion
    dato = data;
    var elementos = 0;
    for (j = 0; j < dato.length; j++)
    {
        paquetes[j] = 'element_' + j + '=' + dato[j] + '';
        elementos = elementos + 1;
    }
    var envoltura = paquetes.join('&');

    //----------------------->>>
    //alert(envoltura+"&elementos="+elementos);
    envoltura = envoltura + "&elementos=" + elementos;
    $("#" + DIVMOSTRAR).html('Cargando...<img style="margin-left:400px; " src="aplicacion/loader.gif">');
    $.ajax({
        type: "POST",
        url: PAGINA,
        data: envoltura
    })
            .done(function (html) {
                $("#" + DIVMOSTRAR).html('' + html);

            });
}

function ms_aviso(div)
{
    $("#" + div).dialog({
        modal: true,
        buttons: {
            Ok: function () {
                $(this).dialog("close");
            }
        }
    });

}


function retornaPagina()
{
    var pagina = self.location.href.match(/\/([^/]+)$/)[1];//en que pagina estoy actualmente
    return pagina;
}

function getHtml(url, div, ms)
{

    //alert(url);

    if (ms == '')
    {
        $("" + div).load(url);
    } else {
        if (!confirm("" + ms)) {
            $("" + div).html('Cargando...<img style="margin-left:400px; " src="../../vista/images/loader.gif">');
        }
        else {

            $("" + div).load(url);
            return true;
        }
    }


}

function restJson(fuenteData)
{
    //json captura
    //alert("hola des aplicacion js");
    var json = null;
    $.ajax({
        'async': false,
        'global': false,
        'url': fuenteData,
        'dataType': "json",
        'error':function(){alert("error:"+url);},
        'success': function (data) {
            json = data;
        }
    });
    return json;

}

function mostrarResultados(pagina, div, dato)
{
    $(div).html('Cargando...<img style="margin-left:400px; " src="../../vista/images/apliacion/loader.gif">');
    $(div).load(pagina + "" + dato);
}
function menuActivo(fuente,cargo, div)
{
//primero consultamos
    var opciones = restJson(fuente+'"' + cargo + '"');

    for (i = 0; i < opciones.modulo.length; i++)
    {
        alert("hola");
        $("" + div).append('<li><a href="' + opciones.pagina[i] + '">' + opciones.modulo[i] + '</a></li>');
    }

}
function paginaActiva(funcion, dato)
{
    var pagina = self.location.href.match(/\/([^/]+)$/)[1];//en que pagina estoy actualmente
    //alert(pagina);
    mostrarResultados('../controlador/Control' + pagina + '?funcion=' + funcion, '#monitoreoDatos', '' + dato);
}


//--------------->>Validacion
function validar(RegExPattern, campo, errorMessage, donde)
{
    if ((campo.value.match(RegExPattern)) && (campo.value != ''))
    {
        document.getElementById('' + donde).innerHTML = '';
        return true;
    } else {
       
        document.getElementById('' + donde).innerHTML = '' + errorMessage;
        campo.focus();
        return false;
    }
}
function validarInterno(RegExPattern, campo)
{
    if ((campo.match(RegExPattern)) && (campo != '')) {
        return true;
    } else {

        campo.focus();
        return false;
    }
}
function validarString(campo, donde) {
    var RegExPattern = /([a-zA-Z])$/;
    var errorMessage = '<p><div class=" alert alert-danger" style="width:80%"  >Tipo de caracter no  adecuado</div></p>';
    return validar(RegExPattern, campo, errorMessage, donde);
}


function validarEnteros(campo, donde)
{
    var RegExPattern = /(^(?:\+|-)?\d+)$/;
    var errorMessage = '<p><div class="alert alert-danger" style="width:100%"  >Solo permite números </div></p>';
    return	validar(RegExPattern, campo, errorMessage, donde);
}
function validarDecimales(campo, donde)
{
    var RegExPattern = /^\d+(?:\.\d{0,2})$/;
    var errorMessage = '<p><div class="alert alert-danger" style="width:100%"  >Unicamnete numeros decimales</div></p>';
    return	validar(RegExPattern, campo, errorMessage, donde);
}

function validarCorreo(campo, donde)
{
    var RegExPattern = /[\w-\.]{3,}@([\w-]{2,}\.)*([\w-]{2,}\.)[\w-]{2,4}/;
    var errorMessage = '<p><div class="alert alert-danger" style="width:100%"  >Correo eléctronico no adecuado</div></p>';
    return	validar(RegExPattern, campo, errorMessage, donde);
}
function autoCompletado(elemento,tabla,registro)
{
    var componente = elemento;
    var datos = restJson('../core/json.php?funcion=Query&t='+tabla+'&w=where '+registro+'="'+componente.value +'"');
   var size='';
    size = datos['infotabla'][1];
    
    //alert(size);
    if(componente.value=='')
    {
        $('#'+registro+'_spam').html('<i><div class="alert alert-danger" style="width:100%" >Campo no puede estar en blnaco</div></i>');
           $('#'+registro+'_spam').fadeOut(4500);  
                componente.focus();
    }else
    {
              if(size==0)
      {
          //registrar
          componente.style.backgroundColor = '#6B8E23';
       
      $('#'+registro+'_spam').html('<i><div class="alert alert-success" style="width:100%"  >Registro disponible</div></i>');
           $('#'+registro+'_spam').fadeOut(4500);
      }else{
          //ya exite la informacion
          componente.style.backgroundColor = '#87CEFA';
  
     
        $('#'+registro+'_spam').html('<i><div class="alert alert-danger" style="width:100%"  >Registro ya esta siendo usado</div></i>');
           $('#'+registro+'_spam').fadeOut(4500);  
         componente.focus();  
    }
    }

    //componente.value = "" + datos['operacion'][0];
    // document.getElementById('nombre_spam').innerHTML = '' +datos['operacion'][0] ;
       
}
function busquedaJson(elemento, div)
{
    var componente = elemento;
    var datos = restJson('core/json.php?funcion=Query&t=vaucher&w=where idvaucher=' + componente.value + ' ');
    // alert(""+datos.cliente[0]);
    $("#" + div).html("Dirección " + datos.hasta_salida[0]);
    $("#" + div).append("<p>Cliente " + datos.cliente[0] + "</p>");
    $("#" + div).append("<p><a href='cotizar.php?vaucher=" + datos.idvaucher[0] + "'>Asiganar unidad para el voucher " + datos.idvaucher[0] + "</a></p>");
}

function autoCompletadoDirecciones(elemento, i)
{
    var componente = elemento;
    //$('#resultados_5').append(''+elemento);
    //alert(i);
    var datos = restJson('core/json.php?funcion=Query&t=directorio&w=where empresa like "%' + componente.value + '%" ');
    document.getElementById("element_6").value = " " + datos.calle_principal[0] + "";
    document.getElementById("element_7").value = " " + datos.calle_seundaria[0] + "";
}
function salir()
{
    restJson('../core/json.php?funcion=cerrarSeccion');
}