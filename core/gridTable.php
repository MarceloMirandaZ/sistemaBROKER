<?php
/**
 * Description of gridTable
 *
 * @author dev
 */
require_once '../../core/crudDatos.php';
class gridTable extends crudDatos
{
    //put your code here
    var $tabla;//tabla
    var $Titulo;//titulo del reporte
    var $sqlTabla;//sql  que se lo puede editar
    var $recordSet;//query ejecutado
    var $where;
    var $limit;
    var $inicio;
    var $totalRegistros;
    var $pagina;
    var $path;
    var $columnas = array();//columnas
    var $filas=array();//filas
    var $div;
    var $funcion;//datos
    var $comodin;//where usado en el grid 
    
    
     function setFuncion($funcion)
     {
         $this->funcion=$funcion;
         return $this->funcion;
     }
     function getFuncion()
     {
         return $this->funcion;
     }
    /**
         * @name $setTitulos:  guardamos los nombres de columnas
         * $funcion es igual buscador=      buscador
         * $funcion es igual formularios=   formularios
         * $funcion es igual link=          link a otras secciones
         */         
    function setTitulos($titulo="",$campo="",$funcion="") 
    {      
        if(@$funcion[0]==1)
        {
              $this->setColumnasAccion(utf8_decode($titulo),$campo);
              $this->setFuncion($funcion);
              $this->setFilas($funcion[1]);
        }else
            { 
          
             $this->setColumnas(utf8_decode($titulo),$campo, $funcion);
             $this->setFilas($campo);
            }
       
        
    }
       function setColumnas($dato="",$campo="",$funcion='')
    {
           //echo $this->path;
        $columna="buscarWhere('".$campo."','".$this->path."','".$this->div."');";
        if($funcion=='')
        {
             $param= '<th>'.$dato.'</th>';
        }else{
               $param= '<th>'.$dato.'<p><input type="text" value="" onchange="'.$columna.'" name="'.$campo.'" id="'.$campo.'"></p></th>';
             }
         array_push($this->columnas, $param);  
    }
     function setColumnasAccion($dato="",$campo="")
    {
        //$columna="buscarWhere('".$campo."','".$this->path."','".$this->div."');"; 
        array_push($this->columnas, '<th>'.$dato.'</th>');  
    }
    function getColumnas()
    {
        return $this->columnas;
    }
    function getFilas()
    {
        return $this->filas;
    }
    function setFilas($dato)
    {
        array_push($this->filas,$dato);  
    }
 function cabeceraTabla()
    {
        $array= array();
        $array=  $this->columnas;
        ?>
        <thead>
          <tr>
           <?php
           for($i=0;$i<count($array);$i++)
            {
                echo utf8_encode($array[$i]);
            }
           ?>
          </tr>
        </thead>
        <?php
        
        
    }
    function  gridTable($tabla='',$limit=0)
    {
        $this->tabla=$tabla;
        $this->limit=$limit;
    }
    function getAllTable()
    {
        $sql='select * from  ? ';
        $this->sqlTabla=  $sql;
    }
    /**
     * @name initPage iniciamos la paginacion
     */
    function initPage()
    {
        if(@$_GET['w']=='')
         {
             
         }
            else {
                $this->where='where '.@$_GET['w'].' like "%'.@$_GET['comodin'].'%"';
            }
          $this->pagina=@$_GET['page'];
                 if (!$this->pagina) 
            {
            $this->inicio=0;
            $this->pagina=1;
            }
            else {
                    $this->inicio=abs(($this->pagina*-1)*$this->limit);
                 } 
    }
    function getQuery() 
    {
        $this->preparar($this->sqlTabla.'  '.$this->where.'  limit '.$this->inicio.' ,'.$this->limit);
        $this->setParamentros(1,$this->tabla);
        $this->ejecutarSql();
        $this->recordSet=  $this->query;
    }
    function datosCount() 
    {
    $this->preparar($this->sqlTabla);
    $this->setParamentros(1, $this->tabla);
    $this->ejecutarSql();
    $numEmpleados=@mysql_num_rows($this->query);     
    $this->totalRegistros=$numEmpleados;
    }
        
    function gridShow() 
    {
        $this->getAllTable();
        $this->getQuery();//obtener los query
        $this->datosCount(); 
        $this->ToStringGrid();//imprimimos
    
    }
       function gridShowWhere() 
    { 
        $this->sqlTabla=" select * from ".$this->tabla." where ".$this->comodin." ";
        //echo $this->sqlTabla."<br>";
        $this->preparar($this->sqlTabla);
        $this->setParamentros(1, $this->tabla);
        $this->ejecutarSql();
        $numEmpleados=@mysql_num_rows($this->query);     
        $this->totalRegistros=$numEmpleados;
        $this->ToStringGrid();//imprimimos
    
    }
    function ToStringGrid()
    {
        ?>    
                <div>  
                    <div><h1><?php echo utf8_encode($this->Titulo);?></h1></div>
                   <!-- <h3>Exportar en : <a href='../ayudadores/excel/index.php?like=matriz_general<?php echo '_'.date('Ymd');?>'>Excel</a> </h3> -->
                   <?php
                   echo '<p> Registros:'.$this->totalRegistros.' | Páginas:'.ceil($this->totalRegistros/$this->limit).' | Página Actual: '.$this->pagina.'</p>';
                   ?>
                    <ul class="pager">
                    <li class="previous"><a href="#" onclick=" getHtml('<?php echo $this->path;?>&page=<?php echo ((0));?>','#<?php echo $this->div; ?>'); ">Primera</a></li>
                    <li class="previous"><a href="#" onclick=" getHtml('<?php echo $this->path;?>&page=<?php echo (($this->pagina-1));?>','#<?php echo $this->div; ?>'); ">&larr; Anterior</a></li>
                   <?php
                   for($i=  $this->pagina;$i<=($this->limit+$this->pagina);$i++)
                   {
                   ?>
                    <li>
                        <a href="#" onclick=" getHtml('<?php echo $this->path;?>&page=<?php echo $i;?>','#<?php echo $this->div; ?>'); "><?php echo $i;?></a>
                    </li>
                   <?php
                   }
                   ?>
                    <li class="next"><a href="#" onclick=" getHtml('<?php echo $this->path;?>&page=<?php echo (ceil($this->totalRegistros/$this->limit)-1);?>','#<?php echo $this->div; ?>'); ">Última</a></li>
                    <li class="next"><a href="#" onclick=" getHtml('<?php echo $this->path;?>&page=<?php echo ($this->pagina+1);?>','#<?php echo $this->div; ?>'); ">Siguiente &rarr;</a></li>
                    </ul>
                    <!----inicio---->
                    <table class="table">
                            <?php
                              $this->cabeceraTabla();
                            ?>
                        <tbody class="table-hover">
                            <?php
                            $data=  $this->getFuncion();
                            $accion=$data[1];
                            $this->recordSet=  $this->query;
                                    while ($row = @mysql_fetch_array($this->recordSet)) 
                                            {
                                            echo '<tr>';
                                            $campos= array();
                                            $campos=  $this->getFilas();
                                           
                                            for($i=0;$i<count($campos);$i++)
                                            {
                                                if(@$campos[$i]==$accion)
                                                {
                                                  //  echo $this->funcion[2]."<br>";
                                                    if(@$row['tipo_archivo']=='archivo')
                                                    {
                                                           ?>                                                  
                                                        <td>
                                                            <a href='<?php echo  @$row['link']; ?>' target="_blank"  ><span class='glyphicon glyphicon-list-alt' style="color: #449d44;" aria-hidden='true'>   Descargar</span></a>         ||           <a onclick="getHtml('<?php echo $this->funcion[4];?>&id=<?php echo (@$row[''.@$campos[$i]]); ?>','#<?php echo $this->div; ?>');"  style="color: red;" target="_blank"  ><span class='glyphicon glyphicon-remove' aria-hidden='true'>   Eliminar</span></a>
                                                        </td> 
                      
                                                        <?php
                                                    }else
                                                        {
                                                        ?>
                                                        <td><a href='#' onclick="getHtml('<?php echo $this->funcion[2];?>&id=<?php echo (@$row[''.@$campos[$i]]); ?>','#<?php echo $this->div; ?>');" ><span class='glyphicon glyphicon-folder-close' aria-hidden='true'> <?php echo $this->funcion[3];?></span></a></td> 
                                                        <?php
                                                        }
                                                
                                                
                                                
                                                }else{ echo '<td>'.utf8_encode(@$row[''.@$campos[$i]]).'</td>';  }
                                                            
                                            }
                                            echo '</tr>';
                                            } 
                            ?>
                        </tbody>
                      </table>
                    <!----fin---->
                            <ul class="pager">
                               <li class="previous"><a href="#" onclick=" getHtml('<?php echo $this->path;?>&page=<?php echo (($this->pagina-1));?>','#<?php echo $this->div; ?>'); ">&larr; Anterior</a></li>
                             <?php
                             for($i=  $this->pagina;$i<=($this->limit+$this->pagina);$i++)
                             {
                                 ?>
                               <li>
                                   <a href="#" onclick=" getHtml('<?php echo $this->path;?>&page=<?php echo $i;?>','#<?php echo $this->div; ?>'); "><?php echo $i;?></a>
                               </li>
                                 <?php
                             }
                             ?>
                             <li class="next"><a href="#" onclick=" getHtml('<?php echo $this->path;?>&page=<?php echo ($this->pagina+1);?>','#<?php echo $this->div; ?>'); ">Siguiente &rarr;</a></li>
                           </ul>
                 </div>
    <?php
    }
    

    
    
}
