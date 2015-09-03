<?php
require_once'conexionModelo.php';
class bd extends conexion
{



	function selectGeneral($select,$error=true)
	{
		$query=$select;
		if($error)
		{
			return parent::sql($query);
		}else{echo $query."</br>";}
		
	}

}
?>