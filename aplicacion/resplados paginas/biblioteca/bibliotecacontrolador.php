<?php
 
/**
 * Description of logincontrolador
 *
 * @author dev
 */
require_once '../../core/Controlador.php';
$clase="biblioteca";
class bibliotecacontrolador extends Controlador
{
    //put your code here
    var $modelo;
    var $controlador;
    var $path;
    function modelo($param) 
    {
        $this->controlador=$param."controlador";
        $this->path='aplicacion/'.$param.'/'.$this->controlador.'.php';
        return $this->modelo=$param."modelo";    
    }
    function formulario($valores='') 
    {

        $this->grid();
     
    }
       function formulario2($valores='') 
    {
      
        $this->gridsub($_GET['id']);

    }
    
    
    function gridUsuarios()
    {
        $grid=$this->HelpGridTable();
        $grid->gridTable('directorio');
        $grid->path=  $this->path.'?seccion=gridUsuariosSub';//direccion donde estan los archivos
        $grid->div='galeria';//donde se va cargar en la vista
        $grid->comodin="idcarpetasub='0'";//directorio maestro
        $grid->limit=10;
        $grid->initPage();//iniciamos la paginación de la tabla 
        //carecteristicas del grid o que datos quiero que salgan
        $grid->Titulo='Directorio principal   ';//titulo de la pagina
        $grid->setTitulos('Nombre','nombre'); 
        $grid->setTitulos('Usuario','usuario'); 
        $grid->setTitulos('Fecha de creación  ','fecha'); 
        $funcion[0]=1;//si queremos 
        $funcion[1]='idcarpeta';
        $funcion[2]=''.$grid->path.'';
        $funcion[3]='Abrir';
          $funcion[4]=''.$this->path.'?seccion=eliminarDirectorio';//direccion donde estan los archivos;
        $grid->setTitulos('Acciones','',$funcion); 
        $grid->gridShowWhere();
         
    }
        function gridUsuariosSub()
    {
  $seccion=$this->variablesSeccion();     
        require_once './'.$this->modelo.'.php';
        $modelo= new $this->modelo();
        $dataModelo=$modelo->getAll(@$_GET['id']);
        //---------------------grid-----------------
        $grid=$this->HelpGridTable();
        $grid->gridTable('directorio');
        $grid->path=  $this->path.'?seccion=gridUsuariosSub&id='.@$_GET['id'];//direccion donde estan los archivos
        $grid->comodin='idcarpetasub="'.@$_GET['id'].'"';
        $grid->div='galeria';//donde se va cargar en la vista
        $grid->limit=10;
        $grid->initPage();//iniciamos la paginación de la tabla 
         ?>
<!-- Button trigger modal -->
<script>
DIVMOSTRAR='galeria';
PAGINA='<?php echo $this->path."?seccion=datossub"; ?>';
</script>
<?php
//si el rol de usuario es admin muestre si no  pues no
?>


<button type="button" class="btn btn-success"  onclick="vistaCargar('#galeria','aplicacion/biblioteca/bibliotecacontrolador.php?seccion=gridUsuarios')" >Directorio principal</button>

<!----------------------------Formulario Crear carpeta----------------------->
        <?php
        //carecteristicas del grid o que datos quiero que salgan
        $grid->Titulo='Archivos de la carpeta   '.$dataModelo->nombre;//titulo de la pagina
        $grid->setTitulos('Nombre','nombre'); 
        $grid->setTitulos('Usuario','usuario'); 
        $grid->setTitulos('Fecha de creación  ','fecha'); 
        $funcion[0]=1;//si queremos 
        $funcion[1]='idcarpeta';   
        $funcion[2]=''.$this->path.'?seccion=gridUsuariosSub';//direccion donde estan los archivos
        $funcion[3]='Abrir';
        $funcion[4]=''.$this->path.'?seccion=eliminarDirectorio';//direccion donde estan los archivos;
        $grid->setTitulos('Acciones','',$funcion); 
        $grid->gridShowWhere();  
         
    }
    
    function grid()
    {
        $seccion=$this->variablesSeccion();     
        //echo '--------------->>>';
        $grid=$this->HelpGridTable();
        $grid->gridTable('directorio');
        $grid->path=  $this->path.'?seccion=formulario2';//direccion donde estan los archivos
        $grid->div='galeria';//donde se va cargar en la vista
        $grid->comodin="idcarpetasub='0'";//directorio maestro
        $grid->limit=10;
        $grid->initPage();//iniciamos la paginación de la tabla 
        //carecteristicas del grid o que datos quiero que salgan
        $grid->Titulo='Directorio principal   ';//titulo de la pagina
        ?>
        <!-- Button trigger modal -->
        <script>
        DIVMOSTRAR='galeria';
        PAGINA='<?php echo $this->path."?seccion=datos"; ?>';
        </script>
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#crear_carpeta" data-whatever="@mdo">Crear Carpeta</button>
        <div class="modal fade" id="crear_carpeta" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="exampleModalLabel">Crear carpeta</h4>
              </div>
              <div class="modal-body">
                <form>
                  <div class="form-group">
                    <label for="recipient-name" class="control-label">Nombre:</label>
                    <input type="text" class="form-control" id="element_0">
                    <input type="hidden"  id="element_1" value='<?php echo @date("Y-m-d");?>'>
                    <input type="hidden"  id="element_2" value='<?php echo $seccion->usuario;?>'>
                  </div>
                </form>
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-primary" onclick="enviarPost(3)">crear</button>
              </div>
            </div>
          </div>
        </div>
        <?php
        $grid->setTitulos('Nombre','nombre'); 
        $grid->setTitulos('Usuario','usuario'); 
        $grid->setTitulos('Fecha de creación  ','fecha'); 
        $funcion[0]=1;//si queremos 
        $funcion[1]='idcarpeta';
        $funcion[2]=''.$grid->path.'';
       $funcion[3]='Abrir';
        $funcion[4]=''.$this->path.'?seccion=eliminarDirectorio';//direccion donde estan los archivos;
        $grid->setTitulos('Acciones','',$funcion); 
        $grid->gridShowWhere();
        //echo $grid->sql;
    }
    
            function gridArchivos()
    {
        $sub=''.@$_GET['id'];
              
        $seccion=$this->variablesSeccion();     
        require_once './'.$this->modelo.'.php';
        $modelo= new $this->modelo();
        $dataModelo=$modelo->getAll($sub);
        //---------------------grid-----------------
        $grid=$this->HelpGridTable();
        $grid->gridTable('directorio');
        $grid->path=  $this->path.'?seccion=formulario2&id='.$sub;//direccion donde estan los archivos
        $grid->comodin='idcarpetasub="'.$sub.'"';
        $grid->div='galeria';//donde se va cargar en la vista
        $grid->limit=10;
        $grid->initPage();//iniciamos la paginación de la tabla 
         ?>
<!-- Button trigger modal -->
<script>
DIVMOSTRAR='galeria';
PAGINA='<?php echo $this->path."?seccion=datossub"; ?>';
</script>
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#crear_carpeta" >Crear carpeta</button>
<button type="button" class="btn btn-info"  onclick="vistaCargar('#galeria','aplicacion/biblioteca/bibliotecacontrolador.php?seccion=formularioSubir&id=<?php echo $sub;?>')" >Subir archivo</button>
<button type="button" class="btn btn-success"  onclick="vistaCargar('#galeria','aplicacion/biblioteca/bibliotecacontrolador.php?seccion=grid')" >Directorio principal</button>

<div class="modal fade" id="crear_carpeta" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      
      </div>
      <div class="modal-body">
        <form>
          <div class="form-group">
          <label for="recipient-name" class="control-label">Nombre de la carpeta   :</label>
            <input type="text" class="form-control" id="element_0">
            <input type="hidden"  id="element_1" value='<?php echo @date("Y-m-d");?>'>
            <input type="hidden"  id="element_2" value='<?php echo $seccion->usuario;?>'>
            <input type="hidden"  id="element_3" value='<?php echo $sub;?>'>
          </div>
        </form>
      </div>
      <div class="modal-footer">
          <button type="button" class="btn btn-primary" onclick="submitData('<?php echo $this->path."?seccion=datossub"; ?>','galeria',4)">crear</button>
      </div>
    </div>
  </div>
</div>
<!----------------------------Formulario Crear carpeta----------------------->
        <?php
        //carecteristicas del grid o que datos quiero que salgan
        $grid->Titulo='Archivos de la carpeta   '.$dataModelo->nombre;//titulo de la pagina
        $grid->setTitulos('Nombre','nombre'); 
        $grid->setTitulos('Usuario','usuario'); 
        $grid->setTitulos('Fecha de creación  ','fecha'); 
        $funcion[0]=1;//si queremos 
        $funcion[1]='idcarpeta';   
        $funcion[2]=''.$this->path.'?seccion=formulario2';//direccion donde estan los archivos
           $funcion[3]='Abrir';
        $funcion[4]=''.$this->path.'?seccion=eliminarDirectorio';//direccion donde estan los archivos;
        $grid->setTitulos('Acciones','',$funcion); 
        $grid->gridShowWhere();       
    }
    
    function gridsub($sub)
    {
        $seccion=$this->variablesSeccion();     
        require_once './'.$this->modelo.'.php';
        $modelo= new $this->modelo();
        $dataModelo=$modelo->getAll($sub);
        //---------------------grid-----------------
        $grid=$this->HelpGridTable();
        $grid->gridTable('directorio');
        $grid->path=  $this->path.'?seccion=formulario2&id='.$sub;//direccion donde estan los archivos
        $grid->comodin='idcarpetasub="'.$sub.'"';
        $grid->div='galeria';//donde se va cargar en la vista
        $grid->limit=10;
        $grid->initPage();//iniciamos la paginación de la tabla 
         ?>
<!-- Button trigger modal -->
<script>
DIVMOSTRAR='galeria';
PAGINA='<?php echo $this->path."?seccion=datossub"; ?>';
</script>
<?php
//si el rol de usuario es admin muestre si no  pues no
?>
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#crear_carpeta" >Crear carpeta</button>
<button type="button" class="btn btn-info"  onclick="vistaCargar('#galeria','aplicacion/biblioteca/bibliotecacontrolador.php?seccion=formularioSubir&id=<?php echo $sub;?>')" >Subir archivo</button>
<button type="button" class="btn btn-success"  onclick="vistaCargar('#galeria','aplicacion/biblioteca/bibliotecacontrolador.php?seccion=grid')" >Directorio principal</button>
<!--<button type="button" class="btn btn-danger"  onclick=" alert('Desea borrar este archivo'); //vistaCargar('#galeria','aplicacion/biblioteca/bibliotecacontrolador.php?seccion=grid')" >Eliminar Directorio</button>-->
<div class="modal fade" id="crear_carpeta" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      
      </div>
      <div class="modal-body">
        <form>
          <div class="form-group">
          <label for="recipient-name" class="control-label">Nombre de la carpeta   :</label>
            <input type="text" class="form-control" id="element_0">
            <input type="hidden"  id="element_1" value='<?php echo @date("Y-m-d");?>'>
            <input type="hidden"  id="element_2" value='<?php echo $seccion->usuario;?>'>
            <input type="hidden"  id="element_3" value='<?php echo $sub;?>'>
          </div>
        </form>
      </div>
      <div class="modal-footer">
          <button type="button" class="btn btn-primary" onclick="submitData('<?php echo $this->path."?seccion=datossub"; ?>','galeria',4)">crear</button>
      </div>
    </div>
  </div>
</div>
<!----------------------------Formulario Crear carpeta----------------------->
        <?php
        //carecteristicas del grid o que datos quiero que salgan
        $grid->Titulo='Archivos de la carpeta   '.$dataModelo->nombre;//titulo de la pagina
        $grid->setTitulos('Nombre','nombre'); 
        $grid->setTitulos('Usuario','usuario'); 
        $grid->setTitulos('Fecha de creación  ','fecha'); 
        $funcion[0]=1;//si queremos 
        $funcion[1]='idcarpeta';   
        $funcion[2]=''.$this->path.'?seccion=formulario2';//direccion donde estan los archivos
        $funcion[3]='Abrir';
        $funcion[4]=''.$this->path.'?seccion=eliminarDirectorio';//direccion donde estan los archivos;
        $grid->setTitulos('Acciones','',$funcion); 
        $grid->gridShowWhere();       
    }
    function datos()
    {
        $data = $this->fuenteDatos();//recibo los datos
        $modelo= $this->HelpModelos($this->modelo);//cargamos los modelo
        //creo el path para  las carpetas
        $estructura = 'biblioteca/'.$data->salida[0];
        $data->salida[3]='carpeta';
        $data->salida[4]=''.$this->HelpParametros()->limpia_espacios($estructura);
        $this->HelpArchivos()->carpetaCrear($data->salida[4]);
        //cargamos  los datos en el modelo
        $modelo->loadData($data->bandera, $data->salida);
        $modelo->registrar();
        //crearemos la carpeta en nuestro servidor
     
        
        //cargamos el componente 
        $this->formulario($data->salida);
    }
    function eliminarDirectorio()
    {
                 $sub=''.@$_GET['id'];
                 $modelo= $this->HelpModelos($this->modelo);//cargamos los modelo
               $seccion=$this->variablesSeccion(); 
               if($this->HelpParametros()->validarVariable($seccion->usuario) || ($seccion->cargo=='usuario'))
               {
                   $this->HelpGridTable()->mensajesUi()->mensajesProceso('error', 'No tienes permisos para eliminar');
                      $this->gridUsuariosSub();
               }else{
                    $carpeta=$modelo->getAll($sub);
                    $this->HelpGridTable()->mensajesUi()->mensajesProceso('correcto', 'Se elimino correctamnete  el registro '.$carpeta->nombre);
                    $modelo->eliminar($carpeta->idcarpeta);
                    $this->gridsub($carpeta->idcarpetasub);
               }
     
        
        //cargamos el componente 
     
    }
        function datossub()
    {
        $data = $this->fuenteDatos();//recibo los datos
        $modelo= $this->HelpModelos($this->modelo);//cargamos los modelo
        //buscamos el link de la carpeta
        $modelo->loadData($data->bandera, $data->salida); 
        $datos_carpeta=$modelo->getAll(''.$data->salida[3]);
        $estructura = $datos_carpeta->link.'/'.$data->salida[0];
        //tenenos  que buscar el link de carpeta y luego adjuntar el nuevo link   
        $data->salida[4]='carpeta';
        $data->salida[5]=''.$this->HelpParametros()->limpia_espacios($estructura);;
        $modelo->loadData($data->bandera, $data->salida);
        //var_dump($data->salida);
        $modelo->registrarsub();       
        $estructura=$data->salida[5];
        $this->HelpArchivos()->carpetaCrear($estructura);
        
        $this->gridsub($data->salida[3]);
    }
    function formularioSubir() 
    {
        $sub=''.@$_GET['id'];
               $seccion=$this->variablesSeccion(); 
    ?>
<div>
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="exampleModalLabel">Subir archivos</h4>
    
      </div>
      <div class="modal-body">
          <form  method="post" action="gestor.php" enctype="multipart/form-data">
          <div class="form-group">
           <label for="recipient-name" class="control-label" required >Descripción del Archivo :</label>
            <input type="text"   name="element_0"  id="element_0" value=''>
            <input type="hidden" name="element_1"  id="element_1" value='<?php echo @date("Y-m-d");?>'>
            <input type="hidden" name="element_2" id="element_2" value='<?php echo $seccion->usuario;?>'>
            <input type="hidden" name="element_3" id="element_3" value='<?php echo $sub;?>' la>
            <input type="file" name="file" id="file" required />
          </div>
                    <div class="modal-footer">
                        <input type="submit" name="submit"  value="Subir" class="submit" />
      </div>
        </form>
      </div>

    </div>
  </div>
</div>
    <?php
    $this->gridsub($sub);
    
    }
    
   
    
}

$controlador=$clase."controlador";
$objecto = new $controlador();
$funcion="".@$_GET['seccion'];
if($funcion=="")
{}  else {
    $objecto->modelo($clase);
$objecto->$funcion();    
}
?>