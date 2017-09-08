<?php

require_once 'Conexao.class.php';

class OrdemServico
{
    private $con;

    function __construct()
    {
        $conexao = new Conexao();
        $this->con = $conexao->getConexao();
    }

    //Listar todas as ordens de serviços
    function listaOrdens()
    {
        $lista = $this->con->query("SELECT * FROM ordem ORDER BY cdorde");

        if (count($lista) > 0) {

            return $lista->fetchALL(PDO::FETCH_ASSOC);
        }

        return FALSE;
    }

    //Busca maior codigo ordem de determinado cliente
    function buscaMaiorOrdemPorCliente($codCliente, $dtOrdem)
    {
        $lista = $this->con->query("SELECT MAX(cdorde) cdorde FROM ordem WHERE cdclie = '{$codCliente}' and dtorde = '{$dtOrdem}'");

        if (count($lista) > 0) {

            return $lista->fetchALL(PDO::FETCH_ASSOC);
        }

        return FALSE;
    }

    //Busca ordem de serviço tbl ordem sem indice
    function buscaOrdem($cod)
    {
        $busca = $this->con->query("SELECT * FROM ordem WHERE cdorde = '{$cod}'");

        if (count($busca) > 0) {

            return $busca->fetchAll(PDO::FETCH_ASSOC);
        }

        return false;
    }

    //Busca ordem de serviço tbl ordem com indice
    function buscaOrdemIndices($cod)
    {
        $busca = $this->con->query("SELECT * FROM ordem WHERE cdorde = '{$cod}'");

        if (count($busca) > 0) {

            return $busca->fetchAll(PDO::FETCH_ASSOC);
        }

        return false;
    }

    //Busca itens da ordem de serviço
    function buscaItensOrdem($cod)
    {
        $busca = $this->con->query("SELECT * FROM ordemi WHERE cdorde = '{$cod}'");

        if (count($busca) > 0) {

            return $busca->fetchAll(PDO::FETCH_ASSOC);
        }

        return false;
    }

    //Salvar ordem de serviço
    function insertOrdemServico($sql)
    {
        if ($this->con->exec($sql)){
            return true;
        }

        return false;
    }

    //Salva itens ordem de serviço
    function insertItensOrdem($sql)
    {
        if ($this->con->exec($sql)){
            return true;
        }

        return false;
    }

    //Exluir ordem de serviço
    function deleteOrdem($cod)
    {
        if ($this->con->exec("DELETE FROM ordem WHERE cdorde = '{$cod}'")) {

            return TRUE;
        }

        return FALSE;
    }

    //Exluir itens ordem de serviço
    function deleteItensOrdem($cod)
    {
        if ($this->con->exec("DELETE FROM ordemi WHERE cdorde = '{$cod}'")) {

            return TRUE;
        }

        return FALSE;
    }
}