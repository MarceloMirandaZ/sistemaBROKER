<?php
require_once '../../core/crudDatos.php';
class bibliotecamodelo extends crudDatos
{
    var $bandera;
    var $data;
    function loadData($bandera="",$data="")
    {
        $this->bandera=$bandera;
        $this->data=$data;
   
    }
    
    function getAll($data)
    {
        $this->preparar('select * from ? where idcarpeta = ?');
        $this->setParamentros(1,'directorio');
        $this->setParamentros(2,''.$data);
        $this->ejecutarSql();
        return (object)  $this->GetdatosSql();
        
    }
    
    function eliminar($idcarpeta='')
    {
        $sql='delete from directorio where idcarpeta= ?';
        $this->preparar($sql);
        $this->setParamentros(1, ''.$idcarpeta);
        $this->ejecutarSql();
        return true;
    }
    function registrar()
    {
        //var_dump($this->data);
        if($this->bandera)
        {
        $comodin=' nombre=?';
        $data[0]=@$this->data[0];
        $bandera[0]=$this->helpValidar()->validarRegistro($data, $this->bandera,'directorio',$comodin);
        //echo "--------->>1=".$bandera[0]."<br>";
       
        //echo "--------->>3=".$bandera[2]."<br>";
        if(($bandera[0]==1))
        {
          $comodin="values (Null,?,?,?,'0',?,?)";
          $this->preparar('insert into directorio  '.$comodin);
          $this->autoSetParametros($this->data);
          $this->ejecutarSql();
            
            $bandera=1;
        }
        else{
            $bandera=0;
        }
        
        $this->mensajesUi()->mensajeBooleam($bandera, 'Datos correctos', 'Error registro ya exite');
        }else{}
    }
        function registrarsub()
    {
        //var_dump($this->data);
        if($this->bandera)
        {
        $comodin=' nombre=?';
        $data[0]=@$this->data[0];
        $bandera[0]=$this->helpValidar()->validarRegistro($data, $this->bandera,'directorio',$comodin);
        //echo "--------->>1=".$bandera[0]."<br>";
       
        //echo "--------->>3=".$bandera[2]."<br>";
        if(($bandera[0]==1))
        {
          $comodin="values (Null,?,?,?,?,?,?)";
          $this->preparar('insert into directorio  '.$comodin);
          $this->autoSetParametros($this->data);
          $this->ejecutarSql();
            
            $bandera=1;
        }
        else{
            $bandera=0;
        }
        
        $this->mensajesUi()->mensajeBooleam($bandera, 'Datos correctos', 'Error registro ya exite');
        }else{}
    }
}
