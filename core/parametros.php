<?php
/**
 * Description of parametros
 *
 * @author Cristian
 */
class parametros 
{
    //put your code here
    var $obejecto;
    var $key = "JHV";
 
   function encrypt($string) 
{
   $result = '';
   for($i=0; $i<strlen($string); $i++) {
      $char = substr($string, $i, 1);
      $keychar = substr($this->key, ($i % strlen($this->key))-1, 1);
      $char = chr(ord($char)+ord($keychar));
      $result.=$char;
   }
   return base64_encode($result);
}
    function decrypt($string) {
   $result = '';
   $string = base64_decode($string);
   for($i=0; $i<strlen($string); $i++) {
      $char = substr($string, $i, 1);
      $keychar = substr($this->key, ($i % strlen($this->key))-1, 1);
      $char = chr(ord($char)-ord($keychar));
      $result.=$char;
   }
   return $result;
}
         function validarVariable($var) {
    if (empty($var)) {
        return true; // No esta vacia
    } else {
        return false; // Esta Vacia
    }
}

    function validarArray($datos)
    {
        if(sizeof($datos)>0)
        {
                        return true;}else
            {
                return  false;
            }
        
    }
    
    function getPost()
    {
        $nombre = @$_POST['input'];
        if($nombre=='')
        {
            $nombre="element";
        }else{}
         $datosEnviados="";
                        for($i=0;$i<@$_POST['elementos'];$i++)
                {
                    $datosEnviados[$i]=@$_POST[$nombre.'_'.$i];

                }
                 return $datosEnviados;

    }
    function  traceArray($datos)
    {
              echo "</br>Sus datos enviados son: </br>";
            for($i=0;$i<sizeof($datos);$i++)
                {
                    echo "(".$i.")".  utf8_encode($datos[$i])."<br>";
                }
    }
    function imprimirPost()
    {
          echo "<br>Sus datos enviados por post son: </br>";
           for($i=0;$i<@$_POST['elementos'];$i++)
                {
                    $datosEnviados[$i]=@$_POST['element_'.$i];
                    echo "(".$i.")".$datosEnviados[$i]."<br>";

                }
    }
 

    function quitar_tildes($cadena) {
$no_permitidas= array ("á","é","í","ó","ú","Á","É","Í","Ó","Ú","ñ","À","Ã","Ì","Ò","Ù","Ã™","Ã ","Ã¨","Ã¬","Ã²","Ã¹","ç","Ç","Ã¢","ê","Ã®","Ã´","Ã»","Ã‚","ÃŠ","ÃŽ","Ã”","Ã›","ü","Ã¶","Ã–","Ã¯","Ã¤","«","Ò","Ã","Ã„","Ã‹");
$permitidas= array ("a","e","i","o","u","A","E","I","O","U","n","N","A","E","I","O","U","a","e","i","o","u","c","C","a","e","i","o","u","A","E","I","O","U","u","o","O","i","a","e","U","I","A","E");
$texto = str_replace($no_permitidas, $permitidas ,$cadena);
return $texto;
}
    function limpia_espacios($cadena){
    $cadena = str_replace(' ', '_', $cadena);
    return $cadena;
}
function limpiarCadenas($cadena) {
	$cadena = trim($cadena);
	$cadena = strtr($cadena,
"ÀÁÂÃÄÅàáâãäåÒÓÔÕÖØòóôõöøÈÉÊËèéêëÇçÌÍÎÏìíîïÙÚÛÜùúûüÿÑñ",
"aaaaaaaaaaaaooooooooooooeeeeeeeecciiiiiiiiuuuuuuuuynn");
	$cadena = strtr($cadena,"ABCDEFGHIJKLMNOPQRSTUVWXYZ","abcdefghijklmnopqrstuvwxyz");
        $cadena = preg_replace('#-{2,}#','-',$cadena);
        $cadena = preg_replace('#-$#','',$cadena);
        $cadena = preg_replace('#^-#','',$cadena);
	return $cadena;
}
function  codificarString($dato)
{
    return utf8_decode($dato);
}
             

    
    function depurarInputBlancos($parametros)
    {
        $data= array();
$data=$parametros;
$c=0;
//primerar validacion
for($i=0;$i<sizeof($data);$i++)
{
    if($data[$i]=="")
    {}else{
         //echo '</br>,la informaciòn es adecuada, espere un momneto mientras se realiza su pedido.. <br>';
         $c++;
    }
}

     if($c==sizeof($data))
     {
         
       
         return true;
     }else {
            echo '<div class="alert alert-warning" align="center">Recuerde que todos los campos deben ser llenados.</div>';
                //echo '</br>Recuerde que todos los campos deben estar llenos y no vacios, revise los siguientes campos por favor. <br>';
                
                for($i=0;$i<sizeof($data);$i++)
                            {
                                if($data[$i]=="")
                                {
                                    //echo "Casillero: (".($i+1).")<br>";
                                    echo '<div class="alert alert-info" align="center"><span>Casillero'.(' '.($i+1).'').'</span></div>';
            
                                }else{
                                     //echo '</br>,la informaciòn es adecuada, espere un momneto mientras se realiza su pedido.. <br>';
                                     $c++;
                                }
                            }
                            return false;
                          
           }





    }
    
    
        }
