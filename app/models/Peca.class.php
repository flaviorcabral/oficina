<?php

    require_once 'Conexao.class.php';
class Peca
{
    private $con;

    function __construct()
    {
        $conexao = new Conexao();
        $this->con = $conexao->getConexao();
    }

    function listarPecas()
    {
        $lista = $this->con->query("SELECT * FROM pecas ORDER BY depeca");

        if (count($lista) > 0) {

            return $lista->fetchALL(PDO::FETCH_ASSOC);
        }

        return FALSE;
    }
}