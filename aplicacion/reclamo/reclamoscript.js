//el document ready, de Jquery, ya esta cargo por "plantilla.js" del html "rreclamos.html"
var sesion;
var que_bd;
var bd_contrato;
var bd_cliente=0;
var lista_cliente= new Array();
var que_cliente;

var bd_poliza;
$(function() {
    //funcion que se activa despues de presionar (hacer click) el boton "reclamos" en el menu vertical izquierdo
    $('#reclamo').click(function(){
        //alert("haz presionado el boton reclamos");
        $('#reclamo').addClass('active');
        //cargamos grid_reclamo.html en el div con id=contenido de plantilla.html atravez de jquery .load()
        $("#contenido").load('../reclamo/grid_reclamo.html',function(){
            //
            $("#btm_crear_reclamo").click(function(){
            // alert("presionado bten crear");
                $("#contenido").load('../reclamo/busqueda_cliente.html',function(){
                    //$("#grid_reclamos").hide(500);
                    $("#ventana").dialog({
                        width: "auto",
                        height: "auto",
                        show: "scale",
                        hide: "scale",
                        resizable: "false",
                        position:{my: "left top",at: "left top",of: "#contenido"},
                        closeText: "",
                        draggable: "false",
                        modal: "false",
                        color:"black"
                        //hide: { effect: "explode", duration: 1000 }
                    });
                    $("#btm_cancelar_busqueda").click(function(){
                        $("#ventana").dialog( "close" );
                        $("#contenido").empty();
                    });
                    $("#btn_consulta_cliente").click(function(){
                        //alert("presionado bten crear");
                        buscar_cliente();
                    });
                });
                

            });//---FIN de btm_crear_reclamo.click
        });//--FIN de grid_reclamos.load    
    });
    //    
});

function buscar_cliente(){
    $("#grid_consulta").empty();
    que_cliente=$("#input_consulta").val();
    bd_cliente = restJson("../../core/json.php?funcion=restFull&bd="+que_bd+"&t=vista_poliza_corporativa&d=cedula="+que_cliente+"");
    lista_cliente[0]=bd_cliente.infotabla;
    //alert("lista: "+lista_cliente[0][1]);
    if(lista_cliente[0][1]!=0){
    lista_cliente[1]=bd_cliente.idcliente;
    lista_cliente[2]=bd_cliente.cedula;
    lista_cliente[3]=bd_cliente.apellido_cliente;
    lista_cliente[4]=bd_cliente.nom_cliente;
    lista_cliente[5]=bd_cliente.num_poliza;
    //alert("buscando-...."+que_cliente);
    for(i=0;i<lista_cliente[1].length;i++){
        $("#grid_consulta").append("<tr id='columna_consulta"+i+"'></tr>");
        for(j=2;j<lista_cliente.length;j++){
          //alert("lista: "+lista_cliente[j][j]);
            if(j==2){
                $("#columna_consulta"+i).append("<th style='text-align: center'><a id ='btn_resultado_busqueda' data-dismiss='modal' onclick='crear_reclamo()'>"+lista_cliente[j][i]+"</a></th>");
            }else{
                $("#columna_consulta"+i).append("<th style='text-align: center'>"+lista_cliente[j][i]+"</th>");
            }
            
        }
    }
    //
        $("#resltados_busqueda").show(500);
        $("#mensaje").hide(500);
    }
    else{
        $("#mensaje").append("<div class='col-md-12'><i class='alert alert-danger ' style='padding:5px'>No se encotraron resultados</i></div>");
        $("#resltados_busqueda").hide(500);
    }
    
}
function crear_reclamo(){
    $("#grid_reclamos").hide(500);
    $("#form_crear_reclamo").load('../reclamo/form_crear_reclamo.html',function(){
        //alert("holas creando reclamo"+que_cliente);
    $("#input_cedula").val(lista_cliente[2]);
    $("#input_apellido").val(lista_cliente[3]);
    $("#input_nombre").val(lista_cliente[4]);
        
    bd_poliza =restJson("../../core/json.php?funcion=restFull&bd="+que_bd+"&t=vista_poliza&d=cedula="+que_cliente+"");
        $("#input_num_poliza").val(bd_poliza.num_poliza);
        $("#input_nom_aseguradora").val(bd_poliza.nom_aseguradora);
        $("#input_tipo_poliza").val(bd_poliza.tipo_contrato);
        $("#input_fecha_creacion").val(bd_poliza.fecha_creacion);
        $("#input_fecha_vigencia").val(bd_poliza.fecha_vigencia);
        //alert("poliza: "+bd_poliza.num_poliza);
    });
}
