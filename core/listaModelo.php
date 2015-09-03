<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of loginModelo
 *
 * @author dev
 */
require_once 'crudDatos.php';
class listaModelo extends crudDatos
{
    //put your code here
    function cargarDatos($sql,$columna,$que_base)
    {
       //echo 'La base es: '.$que_base;
        //echo 'El SQL es: '.$sql;
        $query=$this->constructorBD()->sql($sql,$que_base);
        //echo 'La base es: '.$query;
        $i=0;
        while ($row = mysql_fetch_object($query)) 
                {
                   $data[$i]=  ''.utf8_encode($row->$columna);
                   //echo $data[$i]."<br>";
                $i++;  
                }
                
                if(sizeof(@$data)==0)
                {
                    $data[0]='Información no disponible';
                }
                 //header('Content-type: application/json');//esta cabecera  nos permite obtener el dato en json
                
                echo json_encode(@$data);
    }
    function getAllDatos($sql,$que_bd)
    {
        //require_once 'conexionModelo.php';
        //echo '$que_base:';
             $jsonData = array();         
             $data = array();
             $nombre_columna="";
            // echo 'el SQL:'.$sql;
        $query=$this->constructorBD()->sql($sql,$que_bd); 
        //echo 'el QUERY--------------------------------------:'.sql($sql,$que_base); 
        //quiero saber cuantas columnas tiene la tabla
        $numero_total_columnas= mysql_num_fields($query);
        $numero_total_filas= (mysql_num_rows($query));
        $jsonData['infotabla'][0]=''.$numero_total_columnas;//numero total de filas 
        $jsonData['infotabla'][1]=''.$numero_total_filas;//numero total de columnas
        //guardamos en un array los nombres de la columna para luego sacarlos
        for($i=0;$i<$numero_total_columnas;$i++)
        { 
          $nombre_columna=''.mysql_field_name($query, $i)."";
          $data[$i]=$nombre_columna;
        }
      //crearemos el arreglo de datos
                  $c=0;
               while ($row = mysql_fetch_array($query)) 
                {
                   for($j=0;$j<$numero_total_columnas;$j++)
                   {
                               $jsonData[''.$data[$j]][$c]=  utf8_encode($row[''.$data[$j]]); 
                               
                   }

                     $c++;
                }
      echo json_encode(@$jsonData);
    }
}
?>