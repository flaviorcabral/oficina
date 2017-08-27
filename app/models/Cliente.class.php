<?php

    require_once 'Conexao.class.php';

class Cliente
{
    private $con;

    function __construct()
    {
        $conexao = new Conexao();
        $this->con = $conexao->getConexao();
    }

    function listarClientes()
    {
        $lista = $this->con->query("SELECT * FROM clientes ORDER BY declie");

        if (count($lista) > 0) {

            return $lista->fetchALL(PDO::FETCH_ASSOC);
        }

        return FALSE;
    }

}