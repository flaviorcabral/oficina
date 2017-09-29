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

    //Insert nova peça
    function insertPeca($sql)
    {
        if ($this->con->exec($sql)){
            return true;
        }

        return false;
    }

    //Listas todas as peças
    function listarPecas()
    {
        $lista = $this->con->query("SELECT * FROM pecas ORDER BY depeca");

        if (count($lista) > 0) {

            return $lista->fetchALL(PDO::FETCH_ASSOC);
        }

        return FALSE;
    }

    //Buscar peça por codigo
    function buscaPeca($cod)
    {
        $busca = $this->con->query("SELECT * FROM pecas WHERE cdpeca = '{$cod}'");

        if (count($busca) > 0) {

            return $busca->fetch(PDO::FETCH_ASSOC);
        }

        return false;
    }

    //Update info peça
    function updatePeca($sql)
    {
        if ($this->con->exec($sql)){
            return true;
        }

        return false;
    }

    //Delete usuario
    function deletePeca($codigo)
    {
        if ($this->con->exec("DELETE FROM pecas WHERE cdpeca = '{$codigo}'")) {

            return TRUE;
        }

        return FALSE;
    }

    //Busca total peça estoque
    function estoquePeca($codigo)
    {
        $busca = $this->con->query("SELECT qtpeca FROM pecas WHERE cdpeca = '{$codigo}'");

        if (count($busca) > 0) {

            return $busca->fetch(PDO::FETCH_COLUMN);
        }

        return false;
    }

    //Incrementa peça estoque
    function atualizaEstoque($codigo, $qtd)
    {
        if ($this->con->exec("UPDATE pecas SET qtpeca = '{$qtd}' WHERE cdpeca = '{$codigo}'")) {

            return TRUE;
        }

        return FALSE;
    }

}