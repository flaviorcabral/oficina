<?php

    require_once 'Conexao.class.php';

class logsistema
{
    private $con;

    function __construct()
    {
        $conexao = new Conexao();
        $this->con = $conexao->getConexao();
    }

    //Salvar log de operações no sistema
    function salvarLog($sql)
    {
        if($this->con->exec($sql)){

            return true;

        }

        return false;
    }

    function listaHistorico()
    {
        $sql = "select l.cdusua, l.dtlog, l.delog, l.iplog, u.deusua from logs l, usuarios u where l.cdusua = u.cdusua and left(l.flativ,1) = 'S' order by l.cdusua, l.dtlog";

        if($this->con->exec($sql)){

            return true;

        }

        return false;
    }

}