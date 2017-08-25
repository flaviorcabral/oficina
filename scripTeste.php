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

$senha = md5(preg_replace('/[^[:alpha:]_]/', '', '123'));
var_dump($senha);
$result = $usu->validaAcesso('364', $senha);
//$result = $usu->listaUsuarios();
var_dump($result);