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

    function validaAcesso($mat){

        $result = $this->con->query("SELECT * FROM usuarios WHERE cdusua = '{$mat}'");

        if (count($result) > 0) {

            return $result->fetch(PDO::FETCH_ASSOC);
        }

        return FALSE;

    }

    function listaUsuarios()
    {
        $lista = $this->con->query("SELECT * FROM usuarios");

        if (count($lista) > 0) {

            return $lista->fetchALL(PDO::FETCH_ASSOC);
        }

        return FALSE;
    }

    function buscaUsuario($mat)
    {
        $busca = $this->con->query("SELECT * FROM usuarios WHERE cdusua = '{$mat}'");

        if (count($busca) > 0) {

            return $busca->fetch(PDO::FETCH_ASSOC);
        }

        return false;

    }

    function updateUsuario($mat, $nome, $email, $telefone, $camfoto)
    {

        if ($this->con->exec("UPDATE usuarios SET deusua = '{$nome}' , demail = '{$email}', nrtele = '{$telefone}', defoto = '{$camfoto}' WHERE cdusua = '{$mat}'")) {

            return TRUE;
        }

        return FALSE;
    }

    function updateSenha($mat, $nvsenha)
    {
        if ($this->con->exec("UPDATE usuarios SET desenh = '{$nvsenha}' WHERE cdusua = '{$mat}'")) {

            return TRUE;
        }

        return FALSE;
    }
}