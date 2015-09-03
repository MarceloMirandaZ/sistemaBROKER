var bd_sesion;
var que_bd;
var personal_bd;
var lista_personal = new Array;

var bd_cargo;
var lista_cargo= new Array;

var bd_estado;
var lista_estado= new Array;

var dato_insert= new Array();
function cargar_personal(){
    //alert("hola");
     $("#btn_personal").click(function(){
            //
            $("#btn_personal").addClass('active');
            //
            $("#contenedor_tabla").load('../configuraciones/personal/personal.html',function(){
                //
                    bd_sesion=restJson("../../core/json.php?funcion=informacion");
                    que_bd=bd_sesion.alias;
                    personal_bd=restJson("../../core/json.php?funcion=Query&bd="+que_bd+"&t=vista_personal");
                    lista_personal[0]=personal_bd.idpersonal;
                    lista_personal[1]=personal_bd.nom_personal;
                    lista_personal[2]=personal_bd.cedula_personal;
                    lista_personal[3]=personal_bd.email_personal;
                    lista_personal[4]=personal_bd.telefono_personal;
                    lista_personal[5]=personal_bd.direccion_personal;
                    lista_personal[6]=personal_bd.cargo;
                    lista_personal[7]=personal_bd.usuario;
                    lista_personal[8]=personal_bd.estado;
                    // alert("lista 222: "+lista_personal[0]);
                    for(i=0;i<lista_personal[0].length;i++){
                        $("#datos_personal").append("<tr id='columna_"+i+"'></tr>");
                        for(j=1;j<lista_personal.length;j++){
                           // alert("lista: "+lista_personal[j][j]);
                            $("#columna_"+i).append("<th style='text-align: center'>"+lista_personal[j][i]+"</th>");
                        }
                    }
                    //
                    $("#form_personal").hide();
                    $("#form_filtro2").hide();
                    //
                    $("#btn_crear").click(function(){
                       // alert("presionado bten crear");
                       //
                       bd_cargo=restJson("../../core/json.php?funcion=Query&bd="+que_bd+"&t=cargo");
                       lista_cargo = bd_cargo.cargo;
                       //
                       bd_estado=restJson("../../core/json.php?funcion=Query&bd="+que_bd+"&t=estado");
                       lista_estado = bd_estado.estado;
                       //
                       for(k=0;k<lista_cargo.length;k++){
                           lista_cargo[k]=lista_cargo[k].toUpperCase();
                           $("#elemento_2").append("<option>"+lista_cargo[k]+"</option>");
                       }
                       for(l=0;l< lista_estado.length;l++){
                           lista_estado[l]=lista_estado[l].toUpperCase();
                           $("#elemento_8").append("<option>"+lista_estado[l]+"</option>");
                       }
                       //
                        $("#btn_crear").hide(500);
                        $("#btn_filtro").hide(500);
                        $("#form_personal").show(500);
                        $("#form_filtro2").hide();
                    });
                    $("#btn_filtro").click(function(){
                       // alert("presionado bten crear");
                        $("#btn_filtro").hide(500);
                        $("#form_personal").hide();
                        $("#form_filtro2").show(500);
                    });
                    $("#btn_ver_todos").click(function(){
                       // alert("presionado bten crear");
                        $("#btn_filtro").show(500);
                        $("#form_personal").hide();
                        $("#form_filtro2").hide(500);
                    });
                    $("#btm_cancelar").click(function(){
                       // alert("presionado bten crear");
                        $("#btn_crear").show(500);
                        $("#btn_filtro").show(500);
                        $("#form_personal").hide(500);
                        $("#form_filtro2").hide();
                    });
                    $("#btm_guardar").click(function(){
                       // alert("presionado bten crear");
                       
                        for(l=0;l<9;l++){
                            //obtengo los datos para isertalos en la bd
                           dato_insert[l]=$("#elemento_"+l).val();
                            
                           //alert("datos obtenidos:"+dato_insert[l]);
                           //crear vedificacion de datos vacios
                       }
                       $.ajax({
                                type: "POST",
                                url: "personal_controlador.php",
                                data: "d="+dato_insert+"",
                                success: function(datos){
                                alert( "Se guardaron los datos: "+datos);
                                },
                                error:function(){Alert("noooo");}
                        });
                        /*$("#btn_crear").show(500);
                        $("#btn_filtro").show(500);
                        $("#form_personal").hide(500);
                        $("#form_filtro2").hide();*/
                    });
            });
    });
}


