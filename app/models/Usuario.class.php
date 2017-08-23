<?php

require_once 'Conexao.class.php';

class Usuario
{
    private $con;

    function __construct()
    {
        $conexao = new Conexao();
        $this->con = $conexao->getConexao();
    }



}