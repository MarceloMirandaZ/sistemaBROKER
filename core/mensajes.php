<?php
/**
 * Description of mensajes
 *
 * @author Cristian
 */
class mensajes {
    //put your code here
    function librerias() 
    {
     
    }
    
    function mensajeBooleam($bandera,$true,$false) 
    {
        switch ($bandera) 
        {
            case 1:
                ?>
<script>
$("#cabecera_formulario").css('background','green');
</script>
<div class="alert alert-success"><?php echo ($true); ?></div>
                <?php
                break;
            case 0:
                ?>
<script>
$("#cabecera_formulario").css('background','red');
</script>
<div class="alert alert-warning"><?php echo ($false); ?></div>
                <?php
                break; 
            
    }
    }
    function mensajesProceso($tipo,$mensaje="")
    {
        switch ($tipo) 
        {
            case 'correcto':
                ?>
<div class="alert alert-success"><?php echo ($mensaje); ?></div>
                <?php
                break;
            case 'advertencia':
                ?>
<div class="alert alert-warning"><?php echo ($mensaje); ?></div>
                <?php
                break; 
               case 'peligro':
                ?>
<div class="alert alert-danger"><?php echo ($mensaje); ?></div>
                <?php
                break;
                           case 'trace':
                ?>
<div class="alert alert-info"><?php echo 'Proceso interno:'.($mensaje); ?></div>
                <?php
                break;
                                       case 'error':
                ?>
<div class="alert alert-info"><?php echo 'advertencia:'.($mensaje); ?></div>
                <?php
                break;

            default:
                break;
        }
    }
    function formularioMensaje($mensaje)
    {
        $this->librerias();
        ?>
          <
  
        <?php
        
    }
        function mensaje($mensaje)
    {
     
        ?>
            <div class="alert alert-danger" align="center"><?php echo $mensaje;?></div>
            

        <?php
        
    }
}
