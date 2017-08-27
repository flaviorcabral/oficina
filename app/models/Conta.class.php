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

    //Listar todas as contas
    function listarContas()
    {
        $lista = $this->con->query("SELECT * FROM contas ORDER BY cdcont");

        if (count($lista) > 0) {

            return $lista->fetchALL(PDO::FETCH_ASSOC);
        }

        return FALSE;
    }

    //atualiza informações tbl contas
    function excluirConta($cod)
    {
        if ($this->con->exec("DELETE FROM contas WHERE cdtipo = 'Pagar' AND cdorig = '{$cod}'")) {

            return TRUE;
        }

        return FALSE;
    }
}