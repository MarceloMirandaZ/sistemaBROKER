<?php

/**
 * Description of formularios
 *
 * @author Chris
 */
class formularios {

    var $fomulario;
    var $dato;
    var $componente;
    var $cadena;
    var $posicion = 0;
    var $boton;
    var $tipocomponente;
    var $lista;
    var $valores;
    var $div;
    var $restricion;
    var $objecto;
    //--------------->>variables usadas para select anidados
    var $idcomponente; //id del componente padre
    var $selectPadre;
    var $selectHijo;
    var $patronBusqueda;
    var $TituloForm;
    var $fuentepagina; //fuente json donde cargar los datos

    function variablesSeccion() {
        require_once '../../core/enrutamiento.php';
        $grid = new enrutamiento;
        $seccion['usuario'] = $grid->get('usuario');
        $seccion['cargo'] = $grid->get('cargo');
        $seccion['empresa'] = $grid->get('empresa');
        $seccion['id'] = $grid->get('id');
        return (object) $seccion;
    }

    /**
     * tomado: http://geekytheory.com/json-iv-ejemplo-practico-de-uso-de-json-con-openweathermap/
     */
    function leer_contenido_completo($url) {
        $html = file_get_contents("" . $url);
        $json = json_decode($html);
        return $json;
    }

    function cargarContenido($div = "", $pagina = "") {
        ?>
        <script>
            vistaCargar('<?php echo $div; ?>', '<?php echo $pagina; ?>');
        </script>
        <?php
    }

    function loadGrid($div = "", $pagina = "", $tiempo = "10") {
        $tiempo = ($tiempo * 1000);
        ?>
        <script>
            setInterval(function () {
                vistaCargar('<?php echo $div; ?>', '<?php echo $pagina; ?>');
            },<?php echo $tiempo; ?>);
        </script>
        <?php
    }

    function loadModelo($modelo) {
        require_once './' . $modelo . '.php';
        $object = new $modelo();
        return $object;
    }

    function fuenteDatos() {
        require_once '../../core/entrada.php';
        $recibirDatos = new entrada();
        return $recibirDatos;
    }

    function mensajesUi() {
        require_once '../../core/mensajes.php';
        $recibirDatos = new mensajes();
        return $recibirDatos;
    }

    function eSms($mensaje, $celular) {

        //http://api.clickatell.com/http/sendmsg?user=kruben84ec&password=crmz4989$&api_id=3516675&to=593979725149&text=Voucher%20generado%20Nro:%201,%20Retirar%20al%20cliente,%20Desde:%20Akros%20,%20Hasta:6%20de%20diciembre%20,%20Valor%20Total:$7%20&mo=1&from=17863295410
        //$this->link(TRUE, "http://api.clickatell.com/http/sendmsg?user=kruben84ec&password=crmz4989$&api_id=3516675&to=".$celular."&text=".$mensaje."&mo=1&from=17863295410",'');
        ?>
        <script>

            $.ajax({
                type: "GET",
                url: "http://api.clickatell.com/http/sendmsg?user=kruben84ec&password=crmz4989$&api_id=3516675",
                data: {to: "<?php echo $celular; ?>", text: "<?php echo $mensaje; ?>", mo: "1", from: "17863295410"}
            })
                    .done(function (msg) {
        //alert( "Data Saved: " + msg );
                    });



        </script>
        <?php
        return true;
    }

    function fuenteJson($pagina = "", $funcion = "") {
        $this->fuentepagina = "" . $pagina;
        $this->patronBusqueda = "" . $funcion;
    }

    function elementosAjax($pagina = "", $div = "", $titulo = '') {

        $this->div = $div;
        ?>
        <script>
            DIVMOSTRAR = '<?php echo $div; ?>';
            PAGINA = '<?php echo $pagina; ?>';
        </script>
        <h1><?php echo utf8_encode($titulo); ?></h1>
        <?php
    }

    function componente($tipo_componente, $label, $value = '', $posicion = "") {
        $this->getPosicion();
        $this->tipoElemento($tipo_componente, $label, $this->getPosicion(), utf8_encode($value));
        $this->setPosicion($this->getPosicion() + 1);
    }

    function setTipoComponente($tipo_componente, $i) {
        return $this->tipocomponente[$i] = $tipo_componente;
    }

    function getTipoComponente() {
        return $this->tipocomponente;
    }

    function getTipoComponentePosicion($posicion) {
        return $this->tipocomponente[$posicion];
    }

    function setPosicion($param) {
        return $this->posicion = $param;
    }

    function getPosicion() {
        return $this->posicion;
    }

    function setValores($array) {
        return $this->valores = $array;
    }

    function getValores() {
        return $this->valores;
    }

    function getBoton() {
        return $this->boton;
    }

    function tipoElemento($dato, $label, $i, $value = '') {
        switch ($dato) {
            case 'radioBoton':
                ?>

                <label class="description" for="<?php echo "element_" . $i; ?>"><?php echo $label; ?></label>
                <div>

                    <input type="radio" id="<?php echo "element_" . $i; ?>" name="<?php echo "element_" . $i; ?>" value="SI">SI
                    <input type="radio" id="<?php echo "element_" . $i; ?>" name="<?php echo "element_" . $i; ?>" value="NO">NO


                    <input type="hidden" id="<?php echo'tipo_' . $i; ?>"  name="<?php echo'tipo_' . $i; ?>" value="<?php echo $this->getTipoComponentePosicion($i); ?>"  />
                </div>
                <div id="<?php echo "resultado_" . $i; ?>" title="">

                </div>

                <?php
                break;
            case 'radioBotonListo':
                ?>

                <label class="description" for="<?php echo "element_" . $i; ?>"><?php echo $label; ?></label>
                <div>

                    <input type="radio" id="<?php echo "element_" . $i; ?>" name="<?php echo "element_" . $i; ?>" value="" disabled>
                    <input type="radio" id="<?php echo "element_" . $i; ?>" name="<?php echo "element_" . $i; ?>" value="" disabled>
                    <input type="radio" id="<?php echo "element_" . $i; ?>" name="<?php echo "element_" . $i; ?>" value="" disabled >

                    <input type="hidden" id="<?php echo'tipo_' . $i; ?>"  name="<?php echo'tipo_' . $i; ?>" value="<?php echo $this->getTipoComponentePosicion($i); ?>"  />
                </div>
                <div id="<?php echo "resultado_" . $i; ?>" title="">

                </div>

                <?php
                break;

            case 'check':
                ?>

                <label class="description" for="<?php echo "element_" . $i; ?>"><?php echo $label; ?></label>
                <div>
                    <input type="checkbox"  id="<?php echo "element_" . $i; ?>" name="<?php echo "element_" . $i; ?>" value="1">
                    <input type="hidden" id="<?php echo'tipo_' . $i; ?>"  name="<?php echo'tipo_' . $i; ?>" value="<?php echo $this->getTipoComponentePosicion($i); ?>"  />
                </div>
                <div id="<?php echo "resultado_" . $i; ?>" title="">

                </div>
                </li
                <?php
                break;
            case 'checkListo':
                ?>

                <label class="description" for="<?php echo "element_" . $i; ?>"><?php echo $label; ?></label>
                <div>
                    <input type="checkbox"  id="<?php echo "element_" . $i; ?>" name="<?php echo "element_" . $i; ?>" value="<?php echo $value; ?>" checked >
                    <input type="hidden" id="<?php echo'tipo_' . $i; ?>"  name="<?php echo'tipo_' . $i; ?>" value="<?php echo $this->getTipoComponentePosicion($i); ?>"  />
                </div>
                <div id="<?php echo "resultado_" . $i; ?>" title="">

                </div>

                <?php
                break;
            case 'oculto':
                ?>
                <label class="description" for="<?php echo "element_" . $i; ?>"><?php echo $label; ?></label>
                <input  id="<?php echo "element_" . $i; ?>" name="<?php echo "element_" . $i; ?>" class="element text medium" type="hidden" maxlength="16" value="<?php echo $value; ?>"/> 
                <input type="hidden" id="<?php echo'tipo_' . $i; ?>"  name="<?php echo'tipo_' . $i; ?>" value="<?php echo $this->getTipoComponentePosicion($i); ?>"  />
                <?php
                break;
            case 'botonRun':
                ?>
                <p><input type="hidden" name="elementos" id="elementos" value="<?php echo $this->getPosicion(); ?>" /></p>
                <?php
                $this->boton = '<input id="btsubmit" class="btn btn-primary" style=" width:310px;" name="btsubmit" type="button" onclick="enviarPost(' . $this->getPosicion() . ')" value="' . $value . '"> ';
                echo $this->getBoton();
                ?>
                <div id="<?php echo "" . $this->div; ?>" title="">

                </div>
                <?php
                break;
            case 'subirBoton':
                ?>
                <input type="hidden" id="elementos" name="elementos" value="<?php echo $this->getPosicion(); ?>" />
                <input type="hidden" id="directorio" name="directorio" value="<?php echo $this->donde; ?>"/>
                <?php
                $this->boton = '  <input type="submit" value="Enviar" /> ';
                echo $this->getBoton();

                break;

            case "textoArea":
                ?>

                <label class="description" for="<?php echo "element_" . $i; ?>"><?php echo $label; ?></label>
                <div>

                    <textarea id="<?php echo "element_" . $i; ?>" name="<?php echo "element_" . $i; ?>" cols="40" rows="5" values=""><?php echo $value; ?></textarea>
                    <input type="hidden" id="<?php echo'tipo_' . $i; ?>"  name="<?php echo'tipo_' . $i; ?>" value="<?php echo $this->getTipoComponentePosicion($i); ?>"  />
                </div>
                <div id="<?php echo "resultado_" . $i; ?>" title="">

                </div>

                <?php
                break;
            case "clave":
                ?>

                <label class="description" for="<?php echo "element_" . $i; ?>"><?php echo $label; ?></label>
                <div>
                    <input  id="<?php echo "element_" . $i; ?>" name="<?php echo "element_" . $i; ?>" class="element text medium" type="password" maxlength="16" style=" width:300px;" value="<?php echo $value; ?>"/> 
                    <input type="hidden" id="<?php echo'tipo_' . $i; ?>"  name="<?php echo'tipo_' . $i; ?>" value="<?php echo $this->getTipoComponentePosicion($i); ?>"  />
                </div>
                <div id="<?php echo "resultado_" . $i; ?>" title="">

                </div>

                <?php
                break;
            case "subir":
                ?>

                <label class="description" for="<?php echo "element_" . $i; ?>"><?php echo $label; ?></label>
                <div>

                    <input id="<?php echo "element_" . $i; ?>" name="<?php echo "element_" . $i; ?>" class="element file" type="file"/> 

                </div>

                <div id="<?php echo "resultado_" . $i; ?>" title="">

                </div>

                <?php
                break;



            case "texto":
                ?>

                <label   class="description" for="<?php echo "element_" . $i; ?>"><?php echo $label; ?></label>
                <div>
                    <input class="<?php echo "element_" . $i; ?>" onblur="validarString(this, '<?php echo "resultado_" . $i; ?>')" id="<?php echo "element_" . $i; ?>" name="<?php echo "element_" . $i; ?>" class="element text medium" type="text" style=" width:300px;" maxlength="255" value="<?php echo $value; ?>"/> 
                    <input type="hidden" id="<?php echo'tipo_' . $i; ?>"  name="<?php echo'tipo_' . $i; ?>" value="<?php echo $this->getTipoComponentePosicion($i); ?>"  />
                </div>
                <div id="<?php echo "resultado_" . $i; ?>" title="">

                </div>

                <?php
                break;
            case "alfanumerico":
                ?>

                <label class="description" for="<?php echo "element_" . $i; ?>"><?php echo $label; ?></label>
                <div>
                    <input id="<?php echo "element_" . $i; ?>" name="<?php echo "element_" . $i; ?>" class="element text medium" type="text" maxlength="255" value="<?php echo $value; ?>"/> 
                    <input type="hidden" id="<?php echo'tipo_' . $i; ?>"  name="<?php echo'tipo_' . $i; ?>" value="<?php echo $this->getTipoComponentePosicion($i); ?>"  />
                </div>
                <div id="<?php echo "resultado_" . $i; ?>" title="">

                </div>

                <?php
                break;
            case "numero":
                ?>

                <label class="description" for="<?php echo "element_" . $i; ?>"><?php echo $label; ?></label>
                <div>
                    <input  onblur="validarEnteros(this, '<?php echo "resultado_" . $i; ?>')" id="<?php echo "element_" . $i; ?>" name="<?php echo "element_" . $i; ?>" class="element text medium" type="text" <?php echo '' . $this->restricion; ?> value="<?php echo $value; ?>"/> 
                    <input type="hidden" id="<?php echo'tipo_' . $i; ?>"  name="<?php echo'tipo_' . $i; ?>" value="<?php echo $this->getTipoComponentePosicion($i); ?>"  />
                </div>
                <div id="<?php echo "resultado_" . $i; ?>" title="">

                </div>


                <?php
                break;
            case "email":
                ?>

                <label class="description" for="<?php echo "element_" . $i; ?>"><?php echo $label; ?></label>
                <div>
                    <input onblur="validarCorreo(this, '<?php echo "resultado_" . $i; ?>')" id="<?php echo "element_" . $i; ?>" name="<?php echo "element_" . $i; ?>" class="element text medium" type="text" maxlength="255" value="<?php echo $value; ?>"/> 
                    <input type="hidden" id="<?php echo'tipo_' . $i; ?>"  name="<?php echo'tipo_' . $i; ?>" value="<?php echo $this->getTipoComponentePosicion($i); ?>"  />
                </div>
                <div id="<?php echo "resultado_" . $i; ?>" title="">

                </div>


                <?php
                break;
            case "decimales":
                ?>

                <label class="description" for="<?php echo "element_" . $i; ?>"><?php echo $label; ?></label>
                <div>
                    <input onblur="validarDecimales(this, '<?php echo "resultado_" . $i; ?>')" id="<?php echo "element_" . $i; ?>" name="<?php echo "element_" . $i; ?>" class="element text medium" type="text" maxlength="255" value="<?php echo $value; ?>"/> 
                    <input type="hidden" id="<?php echo'tipo_' . $i; ?>"  name="<?php echo'tipo_' . $i; ?>" value="<?php echo $this->getTipoComponentePosicion($i); ?>"  />
                </div>
                <div id="<?php echo "resultado_" . $i; ?>" title="">

                </div>


                <?php
                break;


            case "fecha":
                ?>

                <input type="hidden" id="<?php echo'tipo_' . $i; ?>"  name="<?php echo'tipo_' . $i; ?>" value="<?php echo $this->getTipoComponentePosicion($i); ?>"  />
                <label class="description" for="element_1"><?php echo $label; ?> </label>
                <script>
                    $(function () {
                        $("<?php echo "#element_" . $i; ?>").datepicker(
                                {
                                    yearRange: "1935:2080",
                                    dateFormat: "yy-mm-dd",
                                    changeMonth: true,
                                    changeYear: true,
                                    showWeek: true,
                                    firstDay: 1
                                }
                        );
                    });
                </script>

                <p> <input  id="<?php echo "element_" . $i; ?>" name="<?php echo "element_" . $i; ?>" type="text" ></p>

                <?php
                break;
            case "busquedaJson":
                ?>

                <label class="description" for="<?php echo "element_" . $i; ?>"><?php echo $label; ?></label>
                <div>
                    <input onblur="busquedaJson(this, '<?php echo "resultado_" . $i; ?>')" id="<?php echo "element_" . $i; ?>" name="<?php echo "element_" . $i; ?>" class="element text medium" type="text" maxlength="255" value="<?php echo $value; ?>"/> 
                    <input type="hidden" id="<?php echo'tipo_' . $i; ?>"  name="<?php echo'tipo_' . $i; ?>" value="<?php echo $this->getTipoComponentePosicion($i); ?>"  />
                </div>
                <div id="<?php echo "resultado_" . $i; ?>" title="">

                </div>

                <?php
                break;
            case "busqueda":
                ?>

                <label class="description" for="<?php echo "element_" . $i; ?>"><?php echo $label; ?></label>
                <div>
                    <input onblur="autoCompletado(this)" id="<?php echo "element_" . $i; ?>" name="<?php echo "element_" . $i; ?>" class="element text medium" type="text" maxlength="255" value="<?php echo $value; ?>"/> 
                    <input type="hidden" id="<?php echo'tipo_' . $i; ?>"  name="<?php echo'tipo_' . $i; ?>" value="<?php echo $this->getTipoComponentePosicion($i); ?>"  />
                </div>
                <div id="<?php echo "resultado_" . $i; ?>" title="">

                </div>

                <?php
                break;
            case "directorio":
                ?>

                <label class="description" for="<?php echo "element_" . $i; ?>"><?php echo $label; ?></label>
                <div>
                    <input onblur="autoCompletadoDirecciones(this, '<?php echo $i; ?>')" id="<?php echo "element_" . $i; ?>" name="<?php echo "element_" . $i; ?>" class="element text medium" type="text" maxlength="255" value="<?php echo $value; ?>"/> 
                    <input type="hidden" id="<?php echo'tipo_' . $i; ?>"  name="<?php echo'tipo_' . $i; ?>" value="<?php echo $this->getTipoComponentePosicion($i); ?>"  />
                </div>
                <div id="<?php echo "resultado_" . $i; ?>" title="">

                </div>

                <?php
                break;
            case "select":
                $this->idcomponente = "element_" . $i;
                ?>
                <label class="description" for="<?php echo "element_" . $i; ?>"><?php echo $label; ?></label>
                <div class="form-group">
                    <select class="form-control input-medium"  id="<?php echo "element_" . $i; ?>" name="<?php echo "element_" . $i; ?>"> </select>
                    <input type="hidden" id="<?php echo'tipo_' . $i; ?>"  name="<?php echo'tipo_' . $i; ?>" value="<?php echo $this->getTipoComponentePosicion($i); ?>"  />
                </div>
                <div id="<?php echo "resultado_" . $i; ?>" title="">
                </div>
                <?php
                break;

            case 'selectJson':
                //cargamos el nombre del componente
                $this->idcomponente = "element_" . $i;
                ?>
                <script>
                    inicioSelect('<?php echo $this->fuentepagina; ?>', '<?php echo '' . $this->patronBusqueda; ?>', '<?php echo "element_" . $i; ?>');  //autocargar los select
                </script>
                <div class="form-group">
                    <label class="description" for="element_1"><?php echo $label; ?> </label>
                    <select class="filtro-select" name="<?php echo "element_" . $i; ?>" id="<?php echo "element_" . $i; ?>"></select>
                </div>
                <?php
                break;
            case 'listapadre':
                //cargamos el nombre del componente
                $this->idcomponente = "element_" . $i;
                ?>
                <script>
                    inicioSelect('busqueda.php', '<?php echo '' . $this->patronBusqueda; ?>', '<?php echo "element_" . $i; ?>');  //autocargar los select
                </script>

                <label class="description" for="element_1"><?php echo $label; ?> </label>
                <select class="filtro-select" name="<?php echo "element_" . $i; ?>" id="<?php echo "element_" . $i; ?>"></select>
                <?php
                break;
            case 'listahijo':
                ?>
                <script>

                    busquedaPatron('busqueda.php', '<?php echo '' . $this->patronBusqueda; ?>', '<?php echo $this->idcomponente; ?>', '<?php echo "element_" . $i; ?>');
                </script>
                <div>
                    <label class="description" for="element_1"><?php echo $label; ?> </label>
                    <select class="filtro-select" name="<?php echo "element_" . $i; ?>" id="<?php echo "element_" . $i; ?>"></select>
                </div>   
                <?php
                $this->idcomponente = "element_" . $i;
                break;
            case 'lista':
                $ajax[0] = "getDato";
                $ajax[1] = "form.element_" . $i . ".value";
                $ajax[2] = "";
                $ajax[3] = "";
                ?>

                <label class="description" for="<?php echo "element_" . $i; ?>"><?php echo $label; ?></label>
                <div>
                <?php
                $this->getCombo()->combox_ajaxGetDato($this->getLista(), 0, 0, "element_" . $i, $ajax);
                ?>
                    <input type="hidden" id="<?php echo'tipo_' . $i; ?>"  name="<?php echo'tipo_' . $i; ?>" value="<?php echo $this->getTipoComponentePosicion($i); ?>"  />
                </div>
                <div id="<?php echo "resultado_" . $i; ?>" title="">

                </div>
                <?php
                break;
            default:

                break;
        }
    }

}
