<?php

    require_once 'Conexao.class.php';

class Conta
{
    private $con;

    function __construct()
    {
        $conexao = new Conexao();
        $this->con = $conexao->getConexao();
    }

    //Inserir conta
    function insertConta($sql)
    {
        if ($this->con->exec($sql)){
            return true;
        }
        return false;
    }

    //Update conta
    function updateConta($sql)
    {
        if ($this->con->exec($sql)){
            return true;
        }
        return false;
    }

    //Listar todas as contas
    function listarContas()
    {
        $lista = $this->con->query("SELECT * FROM contas ORDER BY cdcont");

        if (count($lista) > 0) {

            return $lista->fetchALL(PDO::FETCH_ASSOC);
        }

        return FALSE;
    }

    //Buscar conta
    function buscarConta($cod)
    {
        $busca = $this->con->query("SELECT * FROM contas WHERE cdcont = '{$cod}'");

        if (count($busca) > 0) {

            return $busca->fetchAll(PDO::FETCH_ASSOC);
        }

        return false;
    }

    //Deletar conta referente Ordem de serviço
    function deleteContaOrdem($cod)
    {
        if ($this->con->exec("DELETE FROM contas WHERE cdtipo = 'Receber' AND cdorig = '{$cod}'")) {

            return TRUE;
        }

        return FALSE;
    }

    //Deletar conta referente Pedido
    function deleteContaPedido($cod)
    {
        if ($this->con->exec("DELETE FROM contas WHERE cdtipo = 'Pagar' AND cdorig = '{$cod}'")) {

            return TRUE;
        }

        return FALSE;
    }

    //Deletar conta
    function deleteConta($cod)
    {
        if ($this->con->exec("DELETE FROM contas WHERE cdcont = '{$cod}'")) {

            return TRUE;
        }

        return FALSE;
    }
}