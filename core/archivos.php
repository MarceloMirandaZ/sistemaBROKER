<?php
/**
 * Description of archivos
 *
 * @author dev
 */
class archivos 
{
    //put your code here
    function carpetaCrear($estructura) 
    {
        @chmod($estructura,'0777');  // octal; valor de modo correcto
        @mkdir($estructura,'0777',true);
    }
    function  carpetaEliminar($estructura)
    {
        @rmdir($estructura);
    }
    function subirArchivo($param) {
        //echo $param."<br>";
          $target_dir = "".$param;
          $target_file = $target_dir . basename($_FILES["file"]["name"]);
          @move_uploaded_file($_FILES["file"]["tmp_name"], $target_file);
    }
    function leerJson($archivo='')
    {
        $str_datos = file_get_contents("".$archivo);
        $datos = json_decode($str_datos,true);
        return $datos;
    }
    function escribirJson($archivo='',$data='')
    {
        
 
$fh = fopen("".$archivo, 'w')
      or die("Error al abrir fichero de salida");
fwrite($fh, json_encode($data,JSON_UNESCAPED_UNICODE));
fclose($fh);
    }
}
