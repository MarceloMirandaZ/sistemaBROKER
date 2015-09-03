<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of grid
 *
 * @author dev
 */
require_once 'crudDatos.php';
class grid extends crudDatos
{
    //put your code here
    var $columnas = array();//columnas
    var $filas=array();//filas
   
    function gridRecordSet($tabla="",$where="")
    {
        $this->preparar('select * from ?  ?');//select para buscar  los datos
        $this->setParamentros(1,''.$tabla);//nombre de la tabla
        $this->setParamentros(2,''.$where);//nombre de la tabla
        $this->ejecutarSql();//generar el query
    }
    function setTitulos($titulo="",$campo="",$funcion="") 
    {
        $this->setColumnas($titulo);
        $this->setFilas($campo);
    }
    function gridPrint() 
    {
        $this->table();
        $this->cabeceraTabla();
        $this->tr();
        $this->tbody();
        while ($row = mysql_fetch_array($this->query)) 
        {
         $this->tr();
        //<td><td>
         $campos= array();
         $campos=  $this->getFilas();
         for($i=0;$i<count($campos);$i++)
         {
                   echo '<td>'.utf8_encode($row[''.$campos[$i]]).'</td>';
         }
         $this->ftr();
        } 
        $this->ftbody();
        $this->ftable();    
    }
    
    function tbody() 
    {
         echo '<tbody>';
    }
        function ftbody() 
    {
         echo '</tbody>';
    }
    function cabeceraTabla()
    {
        $array= array();
        $array=  $this->columnas;
        $this->cabecera();
        $this->tr();
        for($i=0;$i<count($array);$i++)
        {
            echo $array[$i];
        }
        $this->ftr();
        $this->fcabecera();
    }
    
    function tr()
    {
        echo '<tr>';
    }
    function ftr()
    {
        echo '</tr>';
    }
    function cabecera()
    {
        echo '<thead>';
    }
     function fcabecera()
    {
        echo '</thead>';
    }
    function table()
    {
        echo '<table class="table">';
    }
    function ftable()
    {
        echo '<table class="table">';
    }
    function getColumnas()
    {
        return $this->columnas;
    }
    function setColumnas($dato)
    {
        array_push($this->columnas, "<th>".$dato."</th>");  
    }
    function getFilas()
    {
        return $this->filas;
    }
    function setFilas($dato)
    {
        array_push($this->filas,$dato);  
    }
}
