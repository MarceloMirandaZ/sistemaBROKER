<?php
require_once './core/archivos.php';
$archivos = new archivos();
//leer archivos json
$data = $archivos->leerJson('parametros/rutas.json');
require_once './core/enrutamiento.php';
$nave = new enrutamiento();
$nave->redireccionar($data['vista']);
?>