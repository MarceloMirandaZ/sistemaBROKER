 <?php
/**
 * clase  escrita 2014-09-07
 * autor:Christian Miranda Zambrano
 */
class conexion
{	
var $rsReporte;	 
var $conexion;  
function _constructer()
{$this->rsReporte= array();}

function configuraciones($que_base)
{
    include_once'configuraciones.php';

	$cn= new config();
        //$this->mensajesUi()->mensaje('esta es la base'.$que_base);
        $cn->que_base($que_base);
	return $cn->index();
}

public function config_local()
{
     include_once'configuraciones.php';
	$cn= new config();
        $dato=$cn->conexion_local();
        return $dato;
}

	/**
	 * funcion que te permite conectarte
	 * @return clave de conexion 
	 */
	 function conectar($que_base)
	{
		$dato=$this->configuraciones($que_base);
                //mysql_set_charset('utf8');
		$this->conexion = @mysql_connect($dato[0],$dato[2],$dato[3])or die('error de conexion');
		$bandera=  $this->conexion;
                if($bandera=="")
                {
                    //echo 'Conección local</br>';
                    $dato=$this->config_local();  
                    $this->conexion = @mysql_connect($dato[0],$dato[2],$dato[3]) or die('error conexion');
                }else{
                     //echo 'En linea</br>';
                }
                @mysql_select_db($dato[1],$this->conexion)or die('No se encontro la Empresa: '.$dato[1]);
               
		return $this->conexion;	

	}
	 function terminar()
	{
		@mysql_close($this->conexion);
	}

	 function query($sql,$cn,$sms)
	{
		$query = @mysql_query($sql,$cn)or die('Error:'.$sms);
		if($query){return $query;
                $this->terminar();
                }
                    
		else{
                    $this->terminar();
			return 0;
		
		}
		
	}
	 
	/**
	* sql:funcion que se la utiliza para realizar los sql insert, update, select
	* @return el query
	*/
	 function sql($sql, $que_base)
	{
            // echo 'cx-que base:'.$que_base;
		$cn = $this->conectar($que_base);
		$sms = $sql;

		return   $this->query($sql,$cn,$sms);
	}
}
?>