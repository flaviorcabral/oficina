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

$result = $con->buscarMaiorOrdemPorCliente("26812855000100 - AILTON F SILVA", "2017-09-08");

//$result = $usu->listaUsuarios();
echo "<pre>";
var_dump($result);
echo "<pre/>";

