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

    //Insert novo serviço
    function insertServico($sql)
    {
        if ($this->con->exec($sql)){
            return true;
        }

        return false;
    }

    //Listar todos os serviços
    function listarServicos()
    {
        $lista = $this->con->query("SELECT * FROM servicos ORDER BY deserv");

        if (count($lista) > 0) {

            return $lista->fetchALL(PDO::FETCH_ASSOC);
        }

        return FALSE;
    }

    //Buscar serviço
    function buscaServico($codigo)
    {
        $busca = $this->con->query("SELECT * FROM servicos WHERE cdserv = '{$codigo}'");

        if (count($busca) > 0) {

            return $busca->fetch(PDO::FETCH_ASSOC);
        }

        return false;
    }

    //Update infor serviço
    function updateServico($sql)
    {
        if ($this->con->exec($sql)){
            return true;
        }

        return false;
    }

    //Delete serviço
    function deleteServico($codigo)
    {
        if ($this->con->exec("DELETE FROM servicos WHERE cdserv = '{$codigo}'")) {

            return TRUE;
        }

        return FALSE;
    }
}