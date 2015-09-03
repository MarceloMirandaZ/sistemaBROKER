<?php
require_once '../../core/crudDatos.php';
class usuariosmodelo extends crudDatos
{
    var $bandera;
    var $data;
    function loadData($bandera="",$data="")
    {
        $this->bandera=$bandera;
        $this->data=$data;
   
    }
    function registrar()
    {
        //var_dump($this->data);
        if($this->bandera)
        {
        $comodin=' nombre=?';
        $data[0]=@$this->data[0];
        $bandera[0]=$this->helpValidar()->validarRegistro($data, $this->bandera,'personal',$comodin);
        //echo "--------->>1=".$bandera[0]."<br>";
        $comodin=' usuario=?';
        $data[0]=@$this->data[1];
        $bandera[1]=$this->helpValidar()->validarRegistro($data, $this->bandera,'personal',$comodin);
        //echo "--------->>2=".$bandera[1]."<br>";
        $comodin=' email=?';
        $data[0]=@$this->data[3];
        $bandera[2]=$this->helpValidar()->validarRegistro($data, $this->bandera,'personal',$comodin);
        //echo "--------->>3=".$bandera[2]."<br>";
        if(($bandera[0]==1)&&($bandera[1]==1)&&($bandera[2]==1))
        {
          $comodin="values (Null,?,?,?,?,?,?,'operador','habilitado')";
          $this->preparar('insert into personal  '.$comodin);
          $this->autoSetParametros($this->data);
          $this->ejecutarSql();
            
            $bandera=1;
        }
        else{
            $bandera=0;
        }
        
        $this->mensajesUi()->mensajeBooleam($bandera, 'Datos correctos', 'Error usuario ya exite');
        }else{}
    }
}
