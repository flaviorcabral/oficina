<?php
/**
 * Created by PhpStorm.
 * User: flavio.pereira
 * Date: 25/08/2017
 * Time: 11:07
 */

include 'config.php';


$con = new Controller();
$usu = new Usuario();
$result = $con->buscarOrdemCindice('7');

//$result = $usu->listaUsuarios();
echo "<pre>";
print_r($result);
echo "<pre/>";

echo $result[0];