<?php
/**
 * Description of crudDatos
 *
 * @author Chris
 * @example :   Como realizar las consultas más eficientes
 * $crud->bandera=true;//si es true, se ejecuta caso contrario no 
   $crud->preparar('insert into personal values(null,?,?,?,?,?)');//escribimos la sentencia sql y con el signo '?', los datos que van a reemplazar
   $crud->setParamentros(1,'Christian Miranda Zambrano','texto');//escribimos la posicion de busqueda de izquierda a derecha, luego el dato, y el tipo de dato
   $crud->ejecutarSql();//para que la sentecia se ejecute 
 */

class crudDatos 
{
    /**
     * @name variable usada para guradar los datos para hacer los sql
     */
    var $parametro;
    /**
     * @name $tipoDato: variable de dos tipos texto "", y número
     */
    var $tipodeDato;
    var $numeroParametros;
    var $sql;
    var $bandera;
    var $salida;
    var $entrada;
    var $query;
    var $objecto;
    var $SQL_a;
     
    function helpValidar()
    {
        require_once '../../core/validarData.php';
        $recibirDatos= new validarData();
        return $recibirDatos;
    }
    function ToStringDatos($param) 
    {
            for($i=0;$i<count($param);$i++)
            {
                echo '('.$i.')--->'.utf8_encode($param[$i]).'<br>';
            }
    }
    function validarDatos($array)
    {
        if(count($array)>0)
        {
            return true;
        }else{
            return false;
        }
    }
     function insert($tabla='',$n_paramentros) 
     {
         $insert= "insert into ".$tabla." ";
         $cadena=$this->pushData($this->entrada,$n_paramentros);
         $this->SQL_a=$insert." values( ".$cadena.");";
         return $this->SQL_a;
     }
     function getSQL_a() {
         return $this->SQL_a;
     }
   
      function autoSetParametros($data)
      {
         // $this->mensajesUi()->mensaje(count($data));
          for($i=1;$i<=count($data);$i++)
          {
                        $this->setParamentros($i,"".$data[$i-1],'texto');
          }
      }
    
    function variablesSQl($elementos="")
    {
        //echo $elementos;
        $dat= array();
        array_push($dat,''.$elementos);
        $this->objecto=$dat;
        return $this->objecto;
    }
    function getVariablesSql()
    {
        return join($this->objecto,'  ');
    }
    
    function pushData($param,$limite) 
    {
        //$nro_elementos=''.count($param);//contamos cuantos elementos nos envian
        $array=array();
        for($i=0;$i<=($limite);$i++)
        {
            if($i==0)
            {
                array_push($array,'Null');
            }  else {
                array_push($array,'?');
            }
        }
       $cadena= ''.join($array,',');
       return $cadena;
    }

   function constructorBD()
   {
       require_once 'conexionModelo.php';
       $bd= new conexion();
       return $bd;
   }
       function mensajesUi() 
    {
        require_once '../../core/mensajes.php';
        $recibirDatos= new mensajes();
        return $recibirDatos;
    }
   /**
    * @name Funcion que permite preparar el sql
    */
   function preparar($sql) 
   {
       $this->sql=$sql;//guardo en el sistema
     
   }
   function setParamentros($posicion,$dato,$tipo='')
   {
       $this->parametro[$posicion]=$dato;
       $this->tipodeDato[$posicion]=$tipo;
       //echo ''.$this->parametro[$posicion]."<br>";
         return $this->parametro;
   }
   function ejecutarSql($que_base) 
   {
     //echo $this->sql."<br>";
       //echo $this->parametro[1]."<br>";
       $c=1;
       $this->numeroParametros=  substr_count($this->sql, '?');
       $veces= ($this->numeroParametros);
        //echo 'cuantas veces de repeti'.$veces."<br>";
      for($i=0;$i<$veces;$i++)
      {
           
                    //echo 'Número de veces:'.$c."<br>";
            if($this->tipodeDato[$c]=='texto')
                {
                  $this->sql=$this->str_replace_once('?', "'".$this->parametro[$c]."'", $this->sql);
                  $this->numeroParametros=  substr_count($this->sql, '?');
                }else{
                     $this->sql=$this->str_replace_once('?',$this->parametro[$c], $this->sql);
                  $this->numeroParametros=  substr_count($this->sql, '?');
                }
                  
                  $c++;
                   //echo "--->>".$this->numeroParametros."<br>";
      }
       //echo  $this->sql."<br>";
       $this->query=$this->constructorBD()->sql(utf8_decode($this->sql),$que_base);
   }
   
   function GetdatosSql()
   {
       //echo $this->query;
       //header("Content-Type: text/html;charset=utf-8");
       while ($row = mysql_fetch_object($this->query)) 
                {
           $this->salida=$row;
                }
                return $this->salida;
   }

   /**
    * @name funcion que solo cambia la primera aparicion, del simbolo que le indiquemos
    * @param $str_pattern: simbolo a buscar por ejmeplo '?', $str_replacement:cadena que deseamos reemplazar por el caracter, $string: cadena que enviamos
    * @return nos devuelve la cadena con el cambio
    * @author http://sinplanes.com/articulo/web/como-hacer-un-strreplaces-en-php-pero-solo-cambiar-la-primera-aparicion
    */   
   function str_replace_once($str_pattern, $str_replacement, $string)
                {
 
                    if (strpos($string, $str_pattern) !== false)
                                    {
                    $occurrence = strpos($string, $str_pattern);
                    return substr_replace($string, $str_replacement, strpos($string, $str_pattern), strlen($str_pattern));
                    }

                    return $string;
                    } 
}
