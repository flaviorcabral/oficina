<?php
/**
 * Created by PhpStorm.
 * User: flavio.pereira
 * Date: 25/08/2017
 * Time: 11:07
 */

include 'config.php';

//session_start();

$con = new Controller();
$usu = new Conta();

$result = $con->buscarItensOrdem(4);
$result1 = $con->buscaQtdPecaEstoque(1);

foreach ($result as $item){
    $qtd = $item['qtpeca'];
}

echo $qtd;
$result1 += $qtd;
//$result = $usu->listaUsuarios();
echo "<pre>";
var_dump($result);
var_dump($result1);
echo "<pre/>";

