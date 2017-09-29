<?php
/**
 * Created by PhpStorm.
 * User: flavio.pereira
 * Date: 25/08/2017
 * Time: 11:07
 */

include 'config.php';

session_start();

$con = new Controller();
$usu = new Conta();

$result = $con->buscarItensOrdem(23);

//$result = $usu->listaUsuarios();
echo "<pre>";
var_dump($result);
echo "<pre/>";

