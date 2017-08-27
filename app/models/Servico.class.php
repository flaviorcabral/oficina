<?php

require_once 'Conexao.class.php';

class Servico
{
    private $con;

    function __construct()
    {
        $conexao = new Conexao();
        $this->con = $conexao->getConexao();
    }

    function listarServicos()
    {
        $lista = $this->con->query("SELECT * FROM servicos ORDER BY deserv");

        if (count($lista) > 0) {

            return $lista->fetchALL(PDO::FETCH_ASSOC);
        }

        return FALSE;
    }
}