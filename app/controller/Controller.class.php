<?php

    session_start();

class Controller
{
    public $ordem = null;
    public $pedido = null;
    public $itens = null;
    public $peca = null;
    public $servico = null;
    public $cliente = null;
    public $conta = null;
    public $clientes = null;
    public $fornecedor = null;
    public $fornecedores = null;
    public $usuario = null;
    public $pecas = null;
    public $servicos = null;
    public $estados = null;

    private $util;

    function __construct()
    {
        $getUtil = new Util();
        $this->util = $getUtil->getUtil();
    }

    //Valida acesso ao sistema
    function login()
    {
        $delogin = preg_replace('/[^[:alnum:]_]/', '', $_POST["delogin"]);
        $desenh = md5(preg_replace('/[^[:alnum:]_]/', '', $_POST["desenh"]));

        $usuario = new Usuario();

        $result = $usuario->validaAcesso($delogin);

        if ($result) {

            $senha = $result['desenh'];

            if ($senha == $desenh) {
                // dados ok
                $cdusua = $result["cdusua"];
                $deusua = $result["deusua"];
                $cdtipo = substr($result["cdtipo"], 0, 1);
                $defoto = $result["defoto"];
                $demail = $result["demail"];

                $_SESSION['login'] = $deusua;

                date_default_timezone_set("Brazil/East");
                $tempoLimite = 1800; //30 minutos de inatividade

                $_SESSION['logado'] = time();
                $_SESSION['tempo_permitido'] = $tempoLimite;

                setcookie("cdusua", $cdusua);
                setcookie("cdtipo", $cdtipo);
                setcookie("defoto", $defoto);
                setcookie("demail", $demail);

                $delog = "Acesso ao Sistema";

                $this->util->geraLogSistema($cdusua, $delog);

                header('Location: app/views/home.php');

            } else {
                // senha NÃO confere
                $demens = "A senha não confere. Tente novamente!";
                $detitu = "Template oficina | Acesso";
                header('Location: app/views/mensagem.php?demens=' . $demens . '&detitu=' . $detitu);
            }

        } else {
            // Usuario NÃO encontrado
            $demens = "Usuário não cadastrado ou inativo!";
            $detitu = "Template oficina | Acesso";
            header('Location: app/views/mensagem.php?demens=' . $demens . '&detitu=' . $detitu);
        }
    }

    //Efetua logoff do sistema
    function logoff()
    {

        if (isset($_SESSION['login'])) {
            unset($_COOKIE);
            unset($_SESSION['login']);
            session_destroy();
            header('Location: index.php');
            exit;
        }
    }

    //Verifica sessão ativa do usuário
    function verificaSessao()
    {
        if (array_key_exists('login', $_SESSION)) {
           return true;
        }

        return false;
    }

    //Verifca inatividade da sessao
    function verificaInatividade()
    {
        $logado = $_SESSION['logado'];
        $limite = $_SESSION['tempo_permitido'];

        if($logado){
            $segundos = time() - $logado;
        }

        if($segundos > $limite){
            session_destroy();
            header('Location: Location: ../../index.php');
            exit;
        }else{
            $_SESSION['logado'] = time();
        }
    }

    //Salvar novo usuario
    function salvarUsuario($nomes, $dados)
    {

        $sql = "insert into " . "usuarios" . " (";
        $campos = "";
        $total = count($nomes) - 1;

        for ($i = 0; $i < count($nomes); $i++) {

            $campos = $campos . $nomes[$i];

            if ($i < $total) {
                $campos = $campos . ", ";
            }

        }

        $sql = $sql . $campos . ") values (";

        $campos = "";

        for ($x = 0; $x < count($dados); $x++) {

            $campo = "'" . $dados[$x] . "'";

            if ($x < $total) {
                $campos = $campos . $campo . ", ";
            } Else {
                $campos = $campos . $campo . ")";
            }
        }

        $sql = $sql . $campos;

        $user = new Usuario();

        if ($user->insertUsuario($sql)) {

             $delog = "Inclusão de usuario de acesso ao sistema na tabela [usuarios]";

            if (isset($_COOKIE['cdusua'])) {
                 $cdusua = $_COOKIE['cdusua'];
             }

            $this->util->geraLogSistema($cdusua, $delog);


            return true;
        }

        return false;
    }

    //Busca funcionario por matricula
    function buscarUsuario($mat)
    {
        $user = new Usuario();
        $result = $user->buscaUsuario($mat);
        return $result;
    }

    //Lista todos os usuarios cadastrados no sistema
    function listarUsuarios()
    {
        $user = new Usuario();
        $result = $user->listaUsuarios();
        return $result;
    }

    //Atualiza dados do usuario pelo admin
    function atualizaDadosUsuario($nomes, $dados, $codigo)
    {

        $campos = "";
        $total = count($dados) - 1;

        $sql = "update " . "usuarios" . " set ";

        for ($i = 0; $i < count($dados); $i++) {

            $campos = $campos . $nomes[$i] . " = '" . $dados[$i] . "'";

            if ($i < $total) {
                $campos = $campos . ", ";
            }

        }

        $sql = $sql . $campos . " where cdusua = " . "'{$codigo}'";

        $user = new Usuario();

        if ($user->updateDados($sql)) {

            $delog = "Alteração de dados na tabela [usuarios] codigo ". $codigo;

            if (isset($_COOKIE['cdusua'])) {
                $cdusua = $_COOKIE['cdusua'];
            }

            $this->util->geraLogSistema($cdusua, $delog);

            return true;
        }

        return false;
    }

    //Excluir usuario
    function excluirUsuario($cod)
    {
        $user = new Usuario();
        $result = $user->deleteUsuario($cod);

        if($result) {
            $delog = "Exclusão de usuario na tabela [usuarios] codigo " . $cod;

            if (isset($_COOKIE['cdusua'])) {
                $cdusua = $_COOKIE['cdusua'];
            }

            $this->util->geraLogSistema($cdusua, $delog);
            return $result;
        }

        return false;
    }

    //Atualiza dados pelo o usuario
    function atualizaMeusDados()
    {
        $user = new Usuario();

        $cdusua = $_POST["cdusua"];
        $demail = $_POST["demail"];
        $deusua = $_POST["deusua"];
        $defoto = $_POST["defoto"];
        $tel = $_POST["nrtele"];

        // tratando o upload da foto
        $uploaddir = '../../templates/img/' . $cdusua;
        $uploadfile = $uploaddir . basename($_FILES['defoto']['name']);

        // upload do arquivo da foto
        move_uploaded_file($_FILES['defoto']['tmp_name'], $uploadfile);

        $defoto1 = basename($_FILES['defoto']['name']);

        if (!empty($defoto1) == true) {
            $defoto = $uploadfile;
        }

        if ($user->updateMeusDados($cdusua, $deusua, $demail, $tel, $defoto))
        {
            setcookie("deusua", $deusua);
            setcookie("defoto", $defoto);
            setcookie("demail", $demail);

            $delog = "Atualização dados usuario na tabela [usuarios] codigo " . $cdusua;

            if (isset($_COOKIE['cdusua'])) {
                $cdusua = $_COOKIE['cdusua'];
            }

            $this->util->geraLogSistema($cdusua, $delog);

            return true;
        }

        return false;
    }

    //Atualiza senha do usuario
    function updateSenhaUsuario()
    {
        // receber as variaveis usuario (e-mail) e senha
        $data = date('Y-m-d H:i:s');
        $cdusua = $_POST["cdusua"];
        $desenh = md5($_POST["desenh"]);
        $desenh1 = md5($_POST["desenh1"]);

        if (empty($desenh) == true)
        {
            $demens = "É obrigatório informar a nova senha!";
            $detitu = "Template Oficina | Alterar Senha";
            $devolt = "minhasenha.php";
            header('Location: mensagem.php?demens=' . $demens . '&detitu=' . $detitu . '&devolt=' . $devolt);
        } Else {

            if ($desenh !== $desenh1) {
                $demens = "As senhas informadas estão diferentes! Favor corrigir.";
                $detitu = "Template Oficina | Alterar Senha";
                $devolt = "minhasenha.php";
                header('Location: mensagem.php?demens=' . $demens . '&detitu=' . $detitu . '&devolt=' . $devolt);
            } Else {

                $user = new Usuario();

                if ($user->updateSenha($cdusua, $desenh)) {

                    $delog = "Atualização senha usuario na tabela [usuarios] codigo " . $cdusua;

                    if (isset($_COOKIE['cdusua'])) {
                        $cdusua = $_COOKIE['cdusua'];
                    }

                    $this->util->geraLogSistema($cdusua, $delog);

                    return true;
                }

            }
        }

        return false;
    }

    //Traz informações da empresa
    function infoEmpresa()
    {
        $param = new Parametros();
        $result = $param->informaçõesEmp();
        return $result;
    }

    //Atualizar informações empresa
    function atualizaInfoEmp($dados, $nomes, $codigo)
    {
        $campos="";
        $total=count($dados)-1;

        $sql="update "."parametros"." set ";

        for ($i =0 ; $i < count($dados) ; $i++ ) {

            $campos=$campos.$nomes[$i]." = '".$dados[$i]."'";

            if ($i < $total) {
                $campos=$campos.", ";
            }

        }

        $sql=$sql.$campos." where cdprop = "."'{$codigo}'";

        $param = new Parametros();

        if($param->updateInformacoes($sql))
        {

            $delog = "Alteração de dados na tabela parametros na chave " . $codigo;

            if (isset($_COOKIE['cdusua'])) {
                $cdusua = $_COOKIE['cdusua'];
            }

            $this->util->geraLogSistema($cdusua, $delog);

            return true;
        }

        return false;
    }

    //Salvar ordem de serviço
    function salvarOrdemDeServico($dados, $nomes, $proc, $cod)
    {
        $ordem = new OrdemServico();

        $sql = "insert into " . "ordem" . " (";
        $campos = "";
        $total = count($nomes) - 1;

        for ($i = 0; $i < count($nomes); $i++) {

            $campos = $campos . $nomes[$i];

            if ($i < $total) {
                $campos = $campos . ", ";
            }

        }

        $sql = $sql . $campos . ") values (";

        $campos = "";

        for ($x = 0; $x < count($dados); $x++) {

            $campo = "'" . $dados[$x] . "'";

            if ($x < $total) {
                $campos = $campos . $campo . ", ";
            } Else {
                $campos = $campos . $campo . ")";
            }
        }

        $sql = $sql . $campos;
        $ordem->insertOrdemServico($sql);

        $delog = $proc." de dados na tabela [ordem] codigo ".$cod;

        if (isset($_COOKIE['cdusua'])) {
            $cdusua = $_COOKIE['cdusua'];
        }

        $this->util->geraLogSistema($cdusua, $delog);

        return;
    }

    //Salvar itens ordem de serviço
    function salvarItensOrdem($dados, $nomes)
    {
        $ordem = new OrdemServico();

        $sql = "insert into " . "ordemi" . " (";
        $campos = "";
        $total = count($nomes) - 1;

        for ($i = 0; $i < count($nomes); $i++) {

            $campos = $campos . $nomes[$i];

            if ($i < $total) {
                $campos = $campos . ", ";
            }

        }

        $sql = $sql . $campos . ") values (";

        $campos = "";

        for ($x = 0; $x < count($dados); $x++) {

            $campo = "'" . $dados[$x] . "'";

            if ($x < $total) {
                $campos = $campos . $campo . ", ";
            } Else {
                $campos = $campos . $campo . ")";
            }
        }

        $sql = $sql . $campos;
        if ($ordem->insertItensOrdem($sql)) {

            //implementar geração de log
            /*$cdusua="99999999999";
            $chave=$dados[0];
            $delog = "Inclusão dos dados da tabela ["."{$tabela}"."] para a chave ["."{$chave}"."]";
            if (isset($_COOKIE['cdusua'])) {
                $cdusua = $_COOKIE['cdusua'];
            }

            if ($tabela !== "log") {
                GravarLog($cdusua, $delog);
            }*/

            return true;
        }

        return false;
    }

    //Lista todas as ordens de serviços
    function listarOrdensServico()
    {
        $ordem = new OrdemServico();
        $result = $ordem->listaOrdens();
        return $result;
    }

    //Busca ordem de servido pelo codigo na tbl ordem retorno sem indice
    function buscarOrdem($cod)
    {
        $ordem = new OrdemServico();
        $result = $ordem->buscaOrdem($cod);
        return $result;
    }

    //Busca ordem de servido pelo codigo na tbl ordem retorno com indice
    function buscarOrdemCindice($cod)
    {
        $ordem = new OrdemServico();
        $result = $ordem->buscaOrdemIndices($cod);
        return $result;
    }

    //Buscar itens da ordem de servido
    function buscarItensOrdem($cod)
    {
        $ordem = new OrdemServico();
        $result = $ordem->buscaItensOrdem($cod);
        return $result;
    }

    //Buscar maior ordem por cliente
    function buscarMaiorOrdemPorCliente($codCliente, $dtOrdem)
    {
        $ordem = new OrdemServico();
        $result = $ordem->buscaMaiorOrdemPorCliente($codCliente, $dtOrdem);
        return $result;
    }

    //Excluir ordem de serviço
    function excluirOrdemDeServico($cod)
    {
        $ordem = new OrdemServico();
        $result = $ordem->deleteOrdem($cod);

        if($result)
        {
            $delog = "Exclusão ordem de serviço na tabela [ordem] codigo ".$cod;

            if (isset($_COOKIE['cdusua'])) {
                $cdusua = $_COOKIE['cdusua'];
            }

            $this->util->geraLogSistema($cdusua, $delog);

            return $result;
        }

        return false;
    }

    //Busca ordem por situação diferente de orçamento e Entregue
    function buscaOrdemSituacao()
    {
        $ordem = new OrdemServico();
        $result = $ordem->buscarOrdemSituacao();
        return $result;
    }

    //Exluir itens ordem de serviço
    function excluirItensOrdemDeServico($cod)
    {
        $ordem = new OrdemServico();
        $result = $ordem->deleteItensOrdem($cod);
        return $result;
    }

    //Salvar novo cliente
    function salvarCliente($dados, $nomes)
    {

        $sql = "insert into " . "clientes" . " (";
        $campos = "";
        $total = count($nomes) - 1;

        for ($i = 0; $i < count($nomes); $i++) {

            $campos = $campos . $nomes[$i];

            if ($i < $total) {
                $campos = $campos . ", ";
            }

        }

        $sql = $sql . $campos . ") values (";

        $campos = "";

        for ($x = 0; $x < count($dados); $x++) {

            $campo = "'" . $dados[$x] . "'";

            if ($x < $total) {
                $campos = $campos . $campo . ", ";
            } Else {
                $campos = $campos . $campo . ")";
            }
        }

        $sql = $sql . $campos;

        $cliente = new Cliente();

        $result = $cliente->insertCliente($sql);

        if($result)
        {
            $delog = "Inclusão de clientes na tabela [clientes]";

            if (isset($_COOKIE['cdusua'])) {
                $cdusua = $_COOKIE['cdusua'];
            }

            $this->util->geraLogSistema($cdusua, $delog);

            return $result;
        }

        return false;
    }

    //Excluir cliente
    function excluirCliente($cod)
    {
        $cliente = new Cliente();
        $result = $cliente->deleteCliente($cod);

        if($result)
        {
            $delog = "Exclusão de cliente na tabela [clientes] Cpf/Cnpj " . $cod;

            if (isset($_COOKIE['cdusua'])) {
                $cdusua = $_COOKIE['cdusua'];
            }

            $this->util->geraLogSistema($cdusua,$delog);

            return $result;
        }

        return false;
    }

    //BUscar cliente por codigo
    function buscarCliente($codigo)
    {
        $cliente = new Cliente();
        $result = $cliente->buscarCliente($codigo);
        return $result;
    }

    //Atualizar info cliente
    function atualizarCliente($nomes, $dados, $codigo)
    {
        $campos = "";
        $total = count($dados) - 1;

        $sql = "update " . "clientes" . " set ";

        for ($i = 0; $i < count($dados); $i++) {

            $campos = $campos . $nomes[$i] . " = '" . $dados[$i] . "'";

            if ($i < $total) {
                $campos = $campos . ", ";
            }
        }

        $sql = $sql . $campos . " where cdclie = " . "'{$codigo}'";

        $cliente = new Cliente();

        if ($cliente->updateCliente($sql)) {

            $delog = "Alteração de dados na tabela [clientes] Cpf/Cnpj " . $codigo;

            if (isset($_COOKIE['cdusua'])) {
                $cdusua = $_COOKIE['cdusua'];
            }

            $this->util->geraLogSistema($cdusua,$delog);

            return true;
        }
    }

    //Lista todos os clientes cadastrados no sistema
    function listarClientes()
    {
        $cliente = new Cliente();
        $result = $cliente->listarClientes();
        return $result;
    }

    //Salvar novo serviço
    function salvarServico($nomes, $dados)
    {
        $sql="insert into "."servicos"." (";
        $campos="";
        $total=count($nomes)-1;

        for ($i=0 ; $i < count($nomes) ; $i++ ) {

            $campos=$campos.$nomes[$i];

            if ($i < $total) {
                $campos=$campos.", ";
            }

        }

        $sql=$sql.$campos.") values (";

        $campos="";

        for ($x =0 ; $x < count($dados) ; $x++ ) {

            $campo="'".$dados[$x]."'";

            if ($x < $total) {
                $campos=$campos.$campo.", ";
            } Else {
                $campos=$campos.$campo.")";
            }
        }

        $sql=$sql.$campos;

        $serv = new Servico();

        if($serv->insertServico($sql))
        {

            $delog = "Inclusão de dados na tabela [servicos]";

            if (isset($_COOKIE['cdusua'])) {
                $cdusua = $_COOKIE['cdusua'];
            }

            $this->util->geraLogSistema($cdusua, $delog);

            return true;
        }

        return false;
    }

    //Listar todos os serviços
    function listarServicos()
    {
        $serv = new Servico();
        $result = $serv->listarServicos();
        return $result;
    }

    //Atualizar info serviço
    function atualizaServiço($nomes, $dados, $codigo)
    {
        $campos="";
        $total=count($dados)-1;

        $sql="update "."servicos"." set ";

        for ($i =0 ; $i < count($dados) ; $i++ ) {

            $campos=$campos.$nomes[$i]." = '".$dados[$i]."'";

            if ($i < $total) {
                $campos=$campos.", ";
            }

        }

        $sql=$sql.$campos." where cdserv = "."'{$codigo}'";

        $serv = new Servico();

        if($serv->updateServico($sql))
        {
            $delog = "Alteração de dados na tabela [servicos] chave ".$codigo;

            if (isset($_COOKIE['cdusua'])) {
                $cdusua = $_COOKIE['cdusua'];
            }

            $this->util->geraLogSistema($cdusua, $delog);

            return true;
        }

        return false;
    }

    //Excluir serviço
    function excluirServico($cod)
    {
        $serv = new Servico();
        $result = $serv->deleteServico($cod);

        if($result)
        {
            $delog = "Exclusão de servico na tabela [servicos] codigo " . $cod;

            if (isset($_COOKIE['cdusua'])) {
                $cdusua = $_COOKIE['cdusua'];
            }

            $this->util->geraLogSistema($cdusua,$delog);

            return $result;
        }

        return false;
    }

    //Buscar serviço por codigo
    function buscaServico($cod)
    {
        $serv = new Servico();
        $result = $serv->buscaServico($cod);
        return $result;
    }

    //Salvar novo fornecedor
    function salvarFornecedor($nomes, $dados)
    {
        $sql = "insert into " . "fornecedores" . " (";
        $campos = "";
        $total = count($nomes) - 1;

        for ($i = 0; $i < count($nomes); $i++) {

            $campos = $campos . $nomes[$i];

            if ($i < $total) {
                $campos = $campos . ", ";
            }

        }

        $sql = $sql . $campos . ") values (";

        $campos = "";

        for ($x = 0; $x < count($dados); $x++) {

            $campo = "'" . $dados[$x] . "'";

            if ($x < $total) {
                $campos = $campos . $campo . ", ";
            } Else {
                $campos = $campos . $campo . ")";
            }
        }

        $sql = $sql . $campos;

        $forn = new Fornecedor();

        if ($forn->insertFornecedor($sql)) {

            $delog = "Inclusão de dados na tabela [fornecedores]";

            if (isset($_COOKIE['cdusua'])) {
                $cdusua = $_COOKIE['cdusua'];
            }

            $this->util->geraLogSistema($cdusua, $delog);

            return true;
        }

        return false;
    }

    //Listar todos os fornecedores
    function listaFornecedores()
    {
        $forn = new Fornecedor();
        $result = $forn->listarFornecedores();
        return $result;
    }

    //Atualiza infos fornecedor
    function atualizarFornecedor($nomes, $dados, $codigo)
    {
        $campos = "";
        $total = count($dados) - 1;

        $sql = "update " . "fornecedores" . " set ";

        for ($i = 0; $i < count($dados); $i++) {

            $campos = $campos . $nomes[$i] . " = '" . $dados[$i] . "'";

            if ($i < $total) {
                $campos = $campos . ", ";
            }

        }

        $sql = $sql . $campos . " where cdforn = " . "'{$codigo}'";

        $forn = new Fornecedor();

        if ($forn->updateFornecedor($sql)) {

            $delog = "Alteração de dados na tabela [fornecedores] Cpf/Cnpj ".$codigo;

            if (isset($_COOKIE['cdusua'])) {
                $cdusua = $_COOKIE['cdusua'];
            }

            $this->util->geraLogSistema($cdusua, $delog);

            return true;
        }

        return false;
    }

    //Buscar fornecedor pelo codigo
    function buscaFornecedor($cod)
    {
        $forn = new Fornecedor();
        $result = $forn->buscaFornecedor($cod);
        return $result;
    }

    //Delete fornecedor
    function excluirFornecedor($cod)
    {
        $forn = new Fornecedor();
        $result = $forn->deleteFornecedor($cod);

        if($result)
        {
            $delog = "Exclusão de dados na tabela [fornecedores] Cpf/Cnpj ".$cod;

            if (isset($_COOKIE['cdusua'])) {
                $cdusua = $_COOKIE['cdusua'];
            }

            $this->util->geraLogSistema($cdusua, $delog);

            return true;
        }

        return false;
    }

    //Salvar pedido
    function salvarPedido($nomes, $dados, $proc, $cod)
    {

        $sql="insert into "."pedidos"." (";
        $campos="";
        $total=count($nomes)-1;

        for ($i=0 ; $i < count($nomes) ; $i++ ) {

            $campos=$campos.$nomes[$i];

            if ($i < $total) {
                $campos=$campos.", ";
            }

        }

        $sql=$sql.$campos.") values (";

        $campos="";

        for ($x =0 ; $x < count($dados) ; $x++ ) {

            $campo="'".$dados[$x]."'";

            if ($x < $total) {
                $campos=$campos.$campo.", ";
            } Else {
                $campos=$campos.$campo.")";
            }
        }

        $sql=$sql.$campos;
        $ped = new Pedido();

        if($ped->insertPedido($sql)){

            $delog = $proc . " de dados na tabela [pedidos] codigo ".$cod;

            if (isset($_COOKIE['cdusua'])) {
                $cdusua = $_COOKIE['cdusua'];
            }

            $this->util->geraLogSistema($cdusua, $delog);

            return true;

        }

        return false;
    }

    //Salvar itens pedido
    function salvarItensPedido($nomes, $dados)
    {

        $sql="insert into "."pedidosi"." (";
        $campos="";
        $total=count($nomes)-1;

        for ($i=0 ; $i < count($nomes) ; $i++ ) {

            $campos=$campos.$nomes[$i];

            if ($i < $total) {
                $campos=$campos.", ";
            }

        }

        $sql=$sql.$campos.") values (";

        $campos="";

        for ($x =0 ; $x < count($dados) ; $x++ ) {

            $campo="'".$dados[$x]."'";

            if ($x < $total) {
                $campos=$campos.$campo.", ";
            } Else {
                $campos=$campos.$campo.")";
            }
        }

        $sql=$sql.$campos;
        $ped = new Pedido();

        if($ped->insertPedido($sql)){

            /*$cdusua="99999999999";
            $chave=$dados[0];
            $delog = "Inclusão dos dados da tabela ["."{$tabela}"."] para a chave ["."{$chave}"."]";

            if (isset($_COOKIE['cdusua'])) {
                $cdusua = $_COOKIE['cdusua'];
            }

            if ($tabela !== "log") {
                GravarLog($cdusua, $delog);
            }*/

            return true;

        }

        return false;
    }

    //Listar todos os pedidos
    function listaPedidos()
    {
        $ped = new Pedido();
        $result = $ped->listaPedidos();
        return $result;
    }

    //Buscar pedido por codigo
    function buscarPedido($codigo)
    {
        $ped = new Pedido();
        $result = $ped->buscaPedido($codigo);
        return $result;
    }

    //Buscar intes do pedido
    function buscaItensPedido($codigo)
    {
        $ped = new Pedido();
        $result = $ped->buscaItensPedido($codigo);
        return $result;
    }

    //Busca maior numero pedido por fornecedor
    function buscarMaiorPedidoFornecedor($codForne, $dataPed)
    {
        $ped = new Pedido();
        $result = $ped->buscaMaxPedidoPorFornecedor($codForne, $dataPed);
        return $result;
    }

    //Excluir pedido
    function excluirPedido($codigo)
    {
        $ped = new Pedido();
        $result = $ped->deletePedido($codigo);

        if($result)
        {
            $delog = "Exclusão de dados na tabela [pedidos] codigo ".$codigo;

            if (isset($_COOKIE['cdusua'])) {
                $cdusua = $_COOKIE['cdusua'];
            }

            $this->util->geraLogSistema($cdusua, $delog);

            return true;
        }

        return false;
    }

    //Excluir itens do pedido
    function excluirItensPedido($codigo)
    {
        $ped = new Pedido();
        $result = $ped->deleteItensPedido($codigo);
        return $result;
    }

    //Salvar nova peça
    function salvarPeca($nomes, $dados)
    {
        $sql="insert into "."pecas"." (";
        $campos="";
        $total=count($nomes)-1;

        for ($i=0 ; $i < count($nomes) ; $i++ ) {

            $campos=$campos.$nomes[$i];

            if ($i < $total) {
                $campos=$campos.", ";
            }

        }

        $sql=$sql.$campos.") values (";

        $campos="";

        for ($x =0 ; $x < count($dados) ; $x++ ) {

            $campo="'".$dados[$x]."'";

            if ($x < $total) {
                $campos=$campos.$campo.", ";
            } Else {
                $campos=$campos.$campo.")";
            }
        }

        $sql=$sql.$campos;

        $pecas = new Peca();

        if($pecas->insertPeca($sql))
        {
            $delog = "Inclusão de dados na tabela [pecas]";

            if (isset($_COOKIE['cdusua'])) {
                $cdusua = $_COOKIE['cdusua'];
            }

            $this->util->geraLogSistema($cdusua, $delog);

            return true;
        }

        return false;
    }

    //Listar todas as peças
    function listarPecas()
    {
        $pecas = new Peca();
        $result = $pecas->listarPecas();
        return $result;
    }

    //Buscar peça
    function buscaPeca($codigo)
    {
        $peca = new Peca();
        $result = $peca->buscaPeca($codigo);
        return $result;
    }

    //Atualizar info peças
    function atualizaPeca($nomes, $dados, $cod)
    {
        $campos="";
        $total=count($dados)-1;

        $sql="update "."pecas"." set ";

        for ($i =0 ; $i < count($dados) ; $i++ ) {

            $campos=$campos.$nomes[$i]." = '".$dados[$i]."'";

            if ($i < $total) {
                $campos=$campos.", ";
            }

        }

        $sql=$sql.$campos." where cdpeca = "."'{$cod}'";

        $peca = new Peca();

        if($peca->updatePeca($sql))
        {
            $delog = "Alteração de dados na tabela [pecas] codigo ".$cod;

            if (isset($_COOKIE['cdusua'])) {
                $cdusua = $_COOKIE['cdusua'];
            }

            $this->util->geraLogSistema($cdusua, $delog);

            return true;

        }

        return false;
    }

    //Excluir peça
    function excluirPeca($codigo)
    {
        $peca = new Peca();
        $result = $peca->deletePeca($codigo);

        if($result)
        {
            $delog = "Exclusão de dados na tabela [pecas] codigo ".$codigo;

            if (isset($_COOKIE['cdusua'])) {
                $cdusua = $_COOKIE['cdusua'];
            }

            $this->util->geraLogSistema($cdusua, $delog);

            return $result;

        }

        return false;
    }

    //Atualiza quantidade de peça em estoque
    function atualizarEstoque($codigo, $qtd)
    {
        $peca = new Peca();
        $result = $peca->atualizaEstoque($codigo, $qtd);

        if($result)
        {
            $delog = "Atualização de dados na tabela [pecas] codigo ".$codigo;

            if (isset($_COOKIE['cdusua'])) {
                $cdusua = $_COOKIE['cdusua'];
            }

            $this->util->geraLogSistema($cdusua, $delog);

            return $result;

        }

        return false;
    }

    //Buscar quantidade de peça no estoque
    function buscaQtdPecaEstoque($codigo)
    {
        $peca = new Peca();
        $result = $peca->estoquePeca($codigo);
        return $result;
    }

    //Lista estados brasileiros
    function listarEstadosBra()
    {
        $est = new Estados();
        $result = $est->listarEstados();
        return $result;
    }

    //Salvar conta
    function salvarConta($nomes, $dados)
    {
        $sql="insert into "."contas"." (";
        $campos = "";
        $total = count($nomes) - 1;

        for ($i = 0; $i < count($nomes); $i++) {

            $campos = $campos . $nomes[$i];

            if ($i < $total) {
                $campos = $campos . ", ";
            }

        }

        $sql = $sql . $campos . ") values (";

        $campos = "";

        for ($x = 0; $x < count($dados); $x++) {

            $campo = "'" . $dados[$x] . "'";

            if ($x < $total) {
                $campos = $campos . $campo . ", ";
            } Else {
                $campos = $campos . $campo . ")";
            }
        }

        $sql = $sql . $campos;

        $conta = new Conta();

        if ($conta->insertConta($sql)) {

            $delog = "Inclusão de dados na tabela [contas]";

            if (isset($_COOKIE['cdusua'])) {
                $cdusua = $_COOKIE['cdusua'];
            }

            $this->util->geraLogSistema($cdusua, $delog);

            return true;
        }

        return false;
    }

    //Atualizar conta
    function atualizaConta($nomes, $dados, $cod)
    {
        $campos="";
        $total=count($dados)-1;

        $sql="update "."contas"." set ";

        for ($i =0 ; $i < count($dados) ; $i++ ) {

            $campos=$campos.$nomes[$i]." = '".$dados[$i]."'";

            if ($i < $total) {
                $campos=$campos.", ";
            }

        }

        $sql=$sql.$campos." where cdcont = "."'{$cod}'";

        $conta = new Conta();

        if($conta->updateConta($sql)) {


            $delog = "Alteração de dados na tabela [contas] chave " . $cod;

            if (isset($_COOKIE['cdusua'])) {
                $cdusua = $_COOKIE['cdusua'];
            }

            $this->util->geraLogSistema($cdusua, $delog);

            return true;
        }

        return false;
    }

    //Buscar conta
    function buscaConta($cod)
    {
        $conta = new Conta();
        $result = $conta->buscarConta($cod);
        return $result;
    }

    //Excluir conta referente Ordem de serviço
    function excluirContaOrdem($cod)
    {
        $conta = new Conta();
        $result = $conta->deleteContaOrdem($cod);
        return $result;
    }

    //Excluir conta referente Pedido
    function excluirContaPedido($cod)
    {
        $conta = new Conta();
        $result = $conta->deleteContaPedido($cod);
        return $result;
    }

    //Excluir qualquer tipo de conta
    function excluirConta($cod)
    {
        $conta = new Conta();
        $result = $conta->deleteConta($cod);

        if($result)
        {
            $delog = "Exclusão de dados na tabela [contas] chave " . $cod;

            if (isset($_COOKIE['cdusua'])) {
                $cdusua = $_COOKIE['cdusua'];
            }

            $this->util->geraLogSistema($cdusua, $delog);

            return $result;
        }

        return false;
    }

    //Listar contas
    function listaContas()
    {
        $conta = new Conta();
        $result = $conta->listarContas();
        return $result;
    }

    //Buscar total de contas por situação
    function totalContasSituacao($qual)
    {
        $qtde=0;

        $ordem = new OrdemServico();

        $resultado= $ordem->totalContasSituacao($qual);

        if ($resultado) {
            foreach($resultado as $conta){
                $qtde=$conta["qtde"];
            }

            return $qtde;
        }

        return false;
    }

    //Somar contas
    function somarTotalValorContas($mes,$tipo)
    {
        $ordem = new OrdemServico();
        $result =  $ordem->somaContas($mes, $tipo);
        return $result;
    }

    //Buscar conta por forma de pagamento
    function buscaContasPorFormaPag()
    {
        $conta = new Conta();
        $result = $conta->buscarContasFormPag();
        return $result;
    }

    //Listar historico de logs
    function listaHistorico()
    {
        $log = new logsistema();
        $result = $log->listaHistorico();
        return $result;
    }

    //Pagina index.php
    function pagLogin()
    {
        if(isset($_REQUEST['login']))
        {
            $this->login();
        }

        if(isset($_REQUEST['logoff']))
        {
            $this->logoff();
        }
    }

    //Pagina home.php
    function pagHome()
    {
        if (!$this->verificaSessao()) {
            header('Location: ../../index.php');
            exit;
        }

        $this->verificaInatividade();

    }

    //Pagina meus dados e senha
    function pagsMeusDados()
    {
        if (!$this->verificaSessao()) {
            header('Location: ../../index.php');
            exit;
        }

        $this->verificaInatividade();

        if (isset($_REQUEST['atualiza']))
        {
            if ($this->atualizaMeusDados()) {

                $demens = "Cadastro atualizado com sucesso!";

            } else {
                $demens = "Ocorreu um problema durante atualização de dados. Se persistir contate o Suporte!";
            }

            $detitu = "Template Oficina | Meus Dados";
            $devolt = "home.php";
            header('Location: mensagem.php?demens=' . $demens . '&detitu=' . $detitu . '&devolt=' . $devolt);
        }

        if (isset($_REQUEST['atualizaSenha']))
        {

            if ($this->updateSenhaUsuario()) {

                $demens = "Senha atualizada com sucesso!";

            } else {
                $demens = "Ocorreu um problema durante atualização de senha. Se persistir contate o Suporte!";
            }

            $detitu = "Template Oficina | Alterar Senha";
            $devolt = "home.php";
            header('Location: mensagem.php?demens=' . $demens . '&detitu=' . $detitu . '&devolt=' . $devolt);
        }
    }

    //Pagina clienteacoes.php
    function pagClientes()
    {
        if (!$this->verificaSessao()) {
            header('Location: ../../index.php');
            exit;
        }

        $this->verificaInatividade();

        $data = date('Y-m-d');
        $acao = $_REQUEST['acao'];

        $flag = true;
        $flag2 = false;
        $this->estados = $this->listarEstadosBra();

        if ($flag == true) {

            if ($acao == 'ver' or $acao == 'edita' or $acao == 'apaga') {
                $chave = $_REQUEST['chave'];
                $this->cliente = $this->buscarCliente($chave);
            }

            if (isset($_REQUEST['editar'])) {
                $cdclie = $_POST["cdclie"];

                if (strlen($cdclie) < 12) {
                    $cdclie = $this->util->RetirarMascara($cdclie, "cpf");
                    if ($this->util->validaCPF($cdclie) == false) {
                        $demens = "Cpf inválido!";
                        $detitu = "Template Oficina | Cadastro de Clientes";
                        header('Location: mensagem.php?demens=' . $demens . '&detitu=' . $detitu);
                        $flag = false;
                    }
                } Else {
                    $cdclie = $this->util->utilRetirarMascara($cdclie, "cnpj");
                    if ($this->util->validaCNPJ($cdclie) == false) {
                        $demens = "Cnpj inválido!";
                        $detitu = "Template Oficina | Cadastro de Clientes";
                        header('Location: mensagem.php?demens=' . $demens . '&detitu=' . $detitu);
                        $flag = false;
                    }
                }

                if ($flag2 == true) {
                } Else {

                    //campos da tabela
                    $aNomes = array();

                    $aNomes[] = "cdclie";
                    $aNomes[] = "declie";
                    $aNomes[] = "cdtipo";
                    $aNomes[] = "nrinsc";
                    $aNomes[] = "nrccm";
                    $aNomes[] = "nrrg";
                    $aNomes[] = "deende";
                    $aNomes[] = "nrende";
                    $aNomes[] = "decomp";
                    $aNomes[] = "debair";
                    $aNomes[] = "decida";
                    $aNomes[] = "cdesta";
                    $aNomes[] = "nrcepi";
                    $aNomes[] = "nrtele";
                    $aNomes[] = "nrcelu";
                    $aNomes[] = "demail";
                    $aNomes[] = "deobse";
                    $aNomes[] = "flativ";
                    $aNomes[] = "dtcada";

                    //dados da tabela
                    $aDados = array();
                    $aDados[] = $_POST["cdclie"];
                    $aDados[] = $_POST["declie"];
                    $aDados[] = $_POST["cdtipo"];
                    $aDados[] = $_POST["nrinsc"];
                    $aDados[] = $_POST["nrccm"];
                    $aDados[] = $_POST["nrrg"];
                    $aDados[] = $_POST["deende"];
                    $aDados[] = $_POST["nrende"];
                    $aDados[] = $_POST["decomp"];
                    $aDados[] = $_POST["debair"];
                    $aDados[] = $_POST["decida"];
                    $aDados[] = $_POST["cdesta"];
                    $aDados[] = $_POST["nrcepi"];
                    $aDados[] = $_POST["nrtele"];
                    $aDados[] = $_POST["nrcelu"];
                    $aDados[] = $_POST["demail"];
                    $aDados[] = $_POST["deobse"];
                    $aDados[] = "S";
                    $aDados[] = $data;

                    if ($this->atualizarCliente($aNomes, $aDados, $chave)) {

                        if ($flag2 == false) {
                            $demens = "Atualização efetuada com sucesso!";
                        }
                    } else {
                        $demens = "Ocorreu um problema na atualização/exclusão. Se persistir contate o Suporte!";
                    }
                }

                $detitu = "Template Oficina | Cadastro de Clientes";
                $devolt = "cliente.php";
                header('Location: mensagem.php?demens=' . $demens . '&detitu=' . $detitu . '&devolt=' . $devolt);
            }

            if (isset($_REQUEST['apagar'])) {

                $cdclie = $_POST["cdclie"];

                $result = $this->excluirCliente($cdclie);

                if ($flag2 == false and $result == true) {

                    $demens = "Exclusão efetuada com sucesso!";

                } else {
                    $demens = "Ocorreu um problema na atualização/exclusão. Se persistir contate o Suporte!";
                }

                $detitu = "Template Oficina | Cadastro de Clientes";
                $devolt = "cliente.php";
                header('Location: mensagem.php?demens=' . $demens . '&detitu=' . $detitu . '&devolt=' . $devolt);
            }

            if (isset($_REQUEST['salvar'])) {

                $cdclie = $_POST["cdclie"];

                $Flag = true;

                if (strlen($cdclie) < 12) {
                    $cdclie = $this->util->RetirarMascara($cdclie, "cpf");
                    if ($this->util->validaCPF($cdclie) == false) {
                        $demens = "Cpf inválido!";
                        $detitu = "Template Oficina | Cadastro de Clientes";
                        header('Location: mensagem.php?demens=' . $demens . '&detitu=' . $detitu);
                        $Flag = false;
                    }
                } Else {
                    $cdclie = $this->util->RetirarMascara($cdclie, "cnpj");
                    if ($this->util->validaCNPJ($cdclie) == false) {
                        $demens = "Cnpj inválido!";
                        $detitu = "Template Oficina | Cadastro de Clientes";
                        header('Location: mensagem.php?demens=' . $demens . '&detitu=' . $detitu);
                        $Flag = false;
                    }
                }

                $result = $this->buscarCliente($cdclie);

                if ($result) {
                    $demens = "Cpf/Cnpj já cadastrado!";
                    $detitu = "Template Oficina | Cadastro de Clientes";
                    header('Location: mensagem.php?demens=' . $demens . '&detitu=' . $detitu);
                    $Flag = false;
                }

                if ($Flag == true) {

                    //campos da tabela
                    $aNomes = array();
                    $aNomes[] = "cdclie";
                    $aNomes[] = "declie";
                    $aNomes[] = "cdtipo";
                    $aNomes[] = "nrinsc";
                    $aNomes[] = "nrccm";
                    $aNomes[] = "nrrg";
                    $aNomes[] = "deende";
                    $aNomes[] = "nrende";
                    $aNomes[] = "decomp";
                    $aNomes[] = "debair";
                    $aNomes[] = "decida";
                    $aNomes[] = "cdesta";
                    $aNomes[] = "nrcepi";
                    $aNomes[] = "nrtele";
                    $aNomes[] = "nrcelu";
                    $aNomes[] = "demail";
                    $aNomes[] = "deobse";
                    $aNomes[] = "flativ";
                    $aNomes[] = "dtcada";

                    //dados da tabela
                    $aDados = array();
                    $aDados[] = $_POST["cdclie"];
                    $aDados[] = $_POST["declie"];
                    $aDados[] = $_POST["cdtipo"];
                    $aDados[] = $_POST["nrinsc"];
                    $aDados[] = $_POST["nrccm"];
                    $aDados[] = $_POST["nrrg"];
                    $aDados[] = $_POST["deende"];
                    $aDados[] = $_POST["nrende"];
                    $aDados[] = $_POST["decomp"];
                    $aDados[] = $_POST["debair"];
                    $aDados[] = $_POST["decida"];
                    $aDados[] = $_POST["cdesta"];
                    $aDados[] = $_POST["nrcepi"];
                    $aDados[] = $_POST["nrtele"];
                    $aDados[] = $_POST["nrcelu"];
                    $aDados[] = $_POST["demail"];
                    $aDados[] = $_POST["deobse"];
                    $aDados[] = "S";
                    $aDados[] = $data;

                    if ($this->salvarCliente($aDados, $aNomes)) {

                        $demens = "Cadastro efetuado com sucesso!";

                    } else {
                        $demens = "Ocorreu um problema durante o cadastro. Se persistir contate o suporte!";
                    }
                }

                $detitu = "Template Oficina | Cadastro de Clientes";
                $devolt = "cliente.php";
                header('Location: mensagem.php?demens=' . $demens . '&detitu=' . $detitu . '&devolt=' . $devolt);

            }

        }
    }

    //Pagina ordem de serviçoacoes.php
    function pagOrdemServicos()
    {
        if (!$this->verificaSessao()) {
            header('Location: ../../index.php');
            exit;
        }

        $this->verificaInatividade();

        $acao = $_REQUEST['acao'];

        if ($acao == 'nova') {
            $this->clientes = $this->listarClientes();
            $this->pecas = $this->listarPecas();
            $this->servicos = $this->listarServicos();
        }

        if ($acao == 'ver' or $acao == 'edita' or $acao == 'apaga') {

            $chave = $_REQUEST['chave'];
            $this->ordem = $this->buscarOrdem($chave);
            $this->itens = $this->buscarItensOrdem($chave);
            $this->clientes = $this->listarClientes();
            $this->pecas = $this->listarPecas();
            $this->servicos = $this->listarServicos();
        }

        if (isset($_REQUEST['editar'])) {

            $cdorde = $_REQUEST["cdorde"];

            $itensOrdem = $this->buscarItensOrdem($cdorde);

            foreach($itensOrdem as $item)
            {
                $cod = intval($item['cdpeca']);
                $qtdItem = intval($item['qtpeca']);

                $qtdPecaEst = intval($this->buscaQtdPecaEstoque($cod));

                $total = $qtdPecaEst + $qtdItem;

                $this->atualizarEstoque($cod, $total);

            }

            $this->excluirOrdemDeServico($cdorde);
            $this->excluirItensOrdemDeServico($cdorde);
            $this->excluirContaOrdem($cdorde);

            $dtcada = date('Y-m-d');
            $Flag = true;

            $codItem = $_POST["cditem"];
            $qtdItem = $_POST["qtitem"];
            $vlrItem = $_POST["vlitem"];
            $cdclie = $_POST["cdclie"];
            $dtorde = $_POST["dtorde"];
            $vlorde = $_POST["vlorde"];
            $vlpago = $_POST["vlpago"];

            $vlorde = str_replace(".", "", $vlorde);
            $vlorde = str_replace(",", ".", $vlorde);
            $vlpago = str_replace(".", "", $vlpago);
            $vlpago = str_replace(",", ".", $vlpago);

            $qtitem = 0;

            for ($f = 1; $f <= 20; $f++) {

                $aPrimeiro = explode("|", $codItem[$f]);

                if ($aPrimeiro[0] !== 'X') {
                    $qtitem++;
                }
            }

            if ($qtitem <= 0) {

                $demens = "É preciso informar os itens da OS!";
                $detitu = "Template Oficina | Cadastro de OS";
                header('Location: mensagem.php?demens=' . $demens . '&detitu=' . $detitu);
                $Flag = false;
            }

            if (empty($cdclie) == true) {

                $demens = "É preciso informar o Cliente!";
                $detitu = "Template Oficina | Cadastro de OS";
                header('Location: mensagem.php?demens=' . $demens . '&detitu=' . $detitu);
                $Flag = false;
            }

            if (empty(strtotime($dtorde)) == true) {

                $demens = "É preciso informar a data da OS!";
                $detitu = "Template Oficina | Cadastro de OS";
                header('Location: mensagem.php?demens=' . $demens . '&detitu=' . $detitu);
                $Flag = false;
            }

            //Implementando controle de estoque
            for ($f = 1; $f <= 20; $f++) {

                $aPrimeiro = explode("|", $codItem[$f]);

                if ($aPrimeiro[0] !== 'X') {
                    if ($aPrimeiro[0] == 'P') {

                        $cdpeca = $aPrimeiro[2];
                        $qtpeca = intval($qtdItem[$f]);

                        $qtdPecaEst = intval($this->buscaQtdPecaEstoque($cdpeca));

                        if ($qtdPecaEst >= $qtpeca) {
                            $qtdPecaEst -= $qtpeca;
                            $qtd = $qtdPecaEst;

                            $this->atualizarEstoque($cdpeca, $qtd);

                        } else {

                            $demens = "O.S. possui peça a menor/zerado no estoque!";
                            $detitu = "Template Oficina | Alteração de Ordem de serviço";
                            header('Location: mensagem.php?demens=' . $demens . '&detitu=' . $detitu);
                            $Flag = false;

                        }

                    }
                }
            }

            if ($Flag == true) {

                if($_POST["qtform"] == 0){
                    $parcPague = 1;
                }else{
                    $parcPague = $_POST["qtform"];
                }

                //campos da tabela
                $aNomes = array();
                $aNomes[] = "cdorde";
                $aNomes[] = "cdclie";
                $aNomes[] = "veplac";
                $aNomes[] = "vemarc";
                $aNomes[] = "vemode";
                $aNomes[] = "veanom";
                $aNomes[] = "veanof";
                $aNomes[] = "vecorv";
                $aNomes[] = "cdsitu";
                $aNomes[] = "dtorde";
                $aNomes[] = "vlorde";
                $aNomes[] = "cdform";
                $aNomes[] = "qtform";
                $aNomes[] = "vlpago";
                $aNomes[] = "dtpago";
                $aNomes[] = "deobse";
                $aNomes[] = "flativ";
                $aNomes[] = "dtcada";

                //dados da tabela
                $aDados = array();
                $aDados[] = $_POST["cdorde"];
                $aDados[] = $_POST["cdclie"];
                $aDados[] = $_POST["veplac"];
                $aDados[] = $_POST["vemarc"];
                $aDados[] = $_POST["vemode"];
                $aDados[] = $_POST["veanom"];
                $aDados[] = $_POST["veanof"];
                $aDados[] = $_POST["vecorv"];
                $aDados[] = $_POST["cdsitu"];
                $aDados[] = $_POST["dtorde"];
                $aDados[] = $vlorde;
                $aDados[] = $_POST["cdform"];
                $aDados[] = $parcPague;
                $aDados[] = $vlpago;
                $aDados[] = $_POST["dtpago"];
                $aDados[] = $_POST["deobse"];
                $aDados[] = 'Sim';
                $aDados[] = $dtcada;

                $proc = "Alteração";
                $chave = $_POST["cdorde"];

                $this->salvarOrdemDeServico($aDados, $aNomes, $proc, $chave);

                $nritem = 1;
                for ($f = 1; $f <= 20; $f++) {

                    $aPrimeiro = explode("|", $codItem[$f]);

                    if ($aPrimeiro[0] !== 'X') {
                        $cdpeca = $aPrimeiro[2];
                        $qtpeca = $qtdItem[$f];
                        $vlpeca = $vlrItem[$f];
                        $vltota = $qtpeca * $vlpeca;

                        $aNomes = array();
                        $aNomes[] = "cdorde";
                        $aNomes[] = "nritem";
                        $aNomes[] = "cdpeca";
                        $aNomes[] = "qtpeca";
                        $aNomes[] = "vlpeca";
                        $aNomes[] = "vltota";

                        $aDados = array();
                        $aDados[] = $cdorde;
                        $aDados[] = $nritem++;
                        $aDados[] = $cdpeca;
                        $aDados[] = $qtpeca;
                        $aDados[] = $vlpeca;
                        $aDados[] = $vltota;

                        $this->salvarItensOrdem($aDados, $aNomes);

                    }
                }

                $result = $this->buscarOrdemCindice($cdorde);

                $dtorde = $result[0]["dtorde"];
                $qtform = $result[0]["qtform"];

                if($qtform === "0"){

                    $qtform = 1;

                }

                for ($f = 1; $f <= $qtform; $f++) {

                    $vlcont = $result[0]["vlorde"] / $qtform;
                    $dtcont = strtotime($dtorde . "+ {$f} months");
                    $dtcont = date("Y-m-d", $dtcont);

                    $aNomes = array();
                    $aNomes[] = "decont";
                    $aNomes[] = "dtcont";
                    $aNomes[] = "vlcont";
                    $aNomes[] = "cdtipo";
                    $aNomes[] = "cdquem";
                    $aNomes[] = "cdorig";
                    $aNomes[] = "flativ";
                    $aNomes[] = "dtcada";

                    $aDados = array();
                    $aDados[] = 'Cliente a Receber';
                    $aDados[] = $dtcont;
                    $aDados[] = $vlcont;
                    $aDados[] = 'Receber';
                    $aDados[] = $result[0]["cdclie"];
                    $aDados[] = $result[0]["cdorde"];
                    $aDados[] = 'Sim';
                    $aDados[] = $dtcada;

                    $this->salvarConta($aNomes, $aDados);

                }

                $demens = "Alteração efetuada com sucesso!";
                $detitu = "Template Oficinas | Cadastro de OS";
                $devolt = "ordem.php";
                header('Location: mensagem.php?demens=' . $demens . '&detitu=' . $detitu . '&devolt=' . $devolt);
            }

        }

        if (isset($_REQUEST['apagar']))
        {

            $cdorde = $_REQUEST["cdorde"];

            if ($this->excluirOrdemDeServico($cdorde) and $this->excluirItensOrdemDeServico($cdorde) and $this->excluirContaOrdem($cdorde)) {
                $demens = "Exclusão efetuada com sucesso!";

            } else {
                $demens = "Ocorreu um problema durante exclusão da O.S. Se persistir contate o Suporte!";
            }

            $detitu = "Template Oficinas | Cadastro de OS";
            $devolt = "ordem.php";
            header('Location: mensagem.php?demens=' . $demens . '&detitu=' . $detitu . '&devolt=' . $devolt);
        }

        if (isset($_REQUEST['salvar']))
        {
            $dtcada = date('Y-m-d');
            $Flag = true;

            $aCditem = $_POST["cditem"];
            $aQtitem = $_POST["qtitem"];
            $aVlitem = $_POST["vlitem"];
            $cdclie = $_POST["cdclie"];
            $dtorde = $_POST["dtorde"];
            $vlorde = $_POST["vlorde"];
            $vlpago = $_POST["vlpago"];
            $vlorde = str_replace(".", "", $vlorde);
            $vlorde = str_replace(",", ".", $vlorde);
            $vlpago = str_replace(".", "", $vlpago);
            $vlpago = str_replace(",", ".", $vlpago);
            $qtitem = 0;

            for ($f = 1; $f <= 20; $f++) {

                $aPrimeiro = explode("|", $aCditem[$f]);
                if ($aPrimeiro[0] !== 'X') {
                    $qtitem++;
                }
            }

            if ($qtitem <= 0) {

                $demens = "É preciso informar os itens da O.S.!";
                $detitu = "Template Oficina | Lançamendo de Ordem de serviço";
                header('Location: mensagem.php?demens=' . $demens . '&detitu=' . $detitu);
                $Flag = false;
            }

            if (empty($cdclie) == true) {

                $demens = "É preciso informar o cliente!";
                $detitu = "Template Oficina | Lançamendo de Ordem de serviço";
                header('Location: mensagem.php?demens=' . $demens . '&detitu=' . $detitu);
                $Flag = false;
            }

            if (empty(strtotime($dtorde)) == true) {

                $demens = "É preciso informar a data de abertura O.S.!";
                $detitu = "Template Oficina | Lançamendo de Ordem de serviço";
                header('Location: mensagem.php?demens=' . $demens . '&detitu=' . $detitu);
                $Flag = false;
            }

            //Implementando controle de estoque
            for ($f = 1; $f <= 20; $f++) {

                $aPrimeiro = explode("|", $aCditem[$f]);

                if ($aPrimeiro[0] !== 'X') {
                    if ($aPrimeiro[0] == 'P') {

                        $cdpeca = $aPrimeiro[2];
                        $qtpeca = intval($aQtitem[$f]);

                        $qtdPecaEst = intval($this->buscaQtdPecaEstoque($cdpeca));

                        if ($qtdPecaEst >= $qtpeca) {
                            $qtdPecaEst -= $qtpeca;
                            $qtd = $qtdPecaEst;

                            $this->atualizarEstoque($cdpeca, $qtd);

                        } else {

                            $demens = "O.S. possui peça a menor/zerado no estoque!";
                            $detitu = "Template Oficina | Lançamendo de Ordem de serviço";
                            header('Location: mensagem.php?demens=' . $demens . '&detitu=' . $detitu);
                            $Flag = false;

                        }

                    }
                }
            }

            if ($Flag == true) {

                if($_POST["qtform"] == 0){
                    $parcPague = 1;
                }else{
                    $parcPague = $_POST["qtform"];
                }

                //campos da tabela
                $aNomes = array();
                $aNomes[] = "cdclie";
                $aNomes[] = "veplac";
                $aNomes[] = "vemarc";
                $aNomes[] = "vemode";
                $aNomes[] = "veanom";
                $aNomes[] = "veanof";
                $aNomes[] = "vecorv";
                $aNomes[] = "cdsitu";
                $aNomes[] = "dtorde";
                $aNomes[] = "vlorde";
                $aNomes[] = "cdform";
                $aNomes[] = "qtform";
                $aNomes[] = "vlpago";
                $aNomes[] = "dtpago";
                $aNomes[] = "deobse";
                $aNomes[] = "flativ";
                $aNomes[] = "dtcada";

                //dados da tabela
                $aDados = array();
                $aDados[] = $_POST["cdclie"];
                $aDados[] = $_POST["veplac"];
                $aDados[] = $_POST["vemarc"];
                $aDados[] = $_POST["vemode"];
                $aDados[] = $_POST["veanom"];
                $aDados[] = $_POST["veanof"];
                $aDados[] = $_POST["vecorv"];
                $aDados[] = $_POST["cdsitu"];
                $aDados[] = $_POST["dtorde"];
                $aDados[] = $vlorde;
                $aDados[] = $_POST["cdform"];
                $aDados[] = $parcPague;
                $aDados[] = $vlpago;
                $aDados[] = $_POST["dtpago"];
                $aDados[] = $_POST["deobse"];
                $aDados[] = 'Sim';
                $aDados[] = $dtcada;

                $proc = "Inclusão";
                $chave = "";

                $this->salvarOrdemDeServico($aDados, $aNomes, $proc, $chave);

                $result = $this->buscarMaiorOrdemPorCliente($cdclie, $dtorde);

                $cdorde = $result[0]["cdorde"];

                $nritem = 1;
                for ($f = 1; $f <= 20; $f++) {

                    $aPrimeiro = explode("|", $aCditem[$f]);

                    if ($aPrimeiro[0] !== 'X') {

                        $cdpeca = $aPrimeiro[2];
                        $qtpeca = $aQtitem[$f];
                        $vlpeca = $aVlitem[$f];
                        $vltota = $qtpeca * $vlpeca;

                        $aNomes = array();
                        $aNomes[] = "cdorde";
                        $aNomes[] = "nritem";
                        $aNomes[] = "cdpeca";
                        $aNomes[] = "qtpeca";
                        $aNomes[] = "vlpeca";
                        $aNomes[] = "vltota";

                        $aDados = array();
                        $aDados[] = $cdorde;
                        $aDados[] = $nritem++;
                        $aDados[] = $cdpeca;
                        $aDados[] = $qtpeca;
                        $aDados[] = $vlpeca;
                        $aDados[] = $vltota;

                        $this->salvarItensOrdem($aDados, $aNomes);
                    }

                }

                $result = $this->buscarOrdem($cdorde);

                $dtorde = $result[0]["dtorde"];
                $qtform = $result[0]["qtform"];

                if($qtform === "0"){

                    $qtform = 1;

                }

                for ($f = 1; $f <= $qtform; $f++) {

                    $vlcont = $result[0]["vlorde"] / $qtform;
                    $dtcont = strtotime($dtorde . "+ {$f} months");
                    $dtcont = date("Y-m-d", $dtcont);

                    $aNomes = array();
                    $aNomes[] = "decont";
                    $aNomes[] = "dtcont";
                    $aNomes[] = "vlcont";
                    $aNomes[] = "cdtipo";
                    $aNomes[] = "cdquem";
                    $aNomes[] = "cdorig";
                    $aNomes[] = "flativ";
                    $aNomes[] = "dtcada";

                    $aDados = array();
                    $aDados[] = 'Cliente a Receber';
                    $aDados[] = $dtcont;
                    $aDados[] = $vlcont;
                    $aDados[] = 'Receber';
                    $aDados[] = $result[0]["cdclie"];
                    $aDados[] = $result[0]["cdorde"];
                    $aDados[] = 'Sim';
                    $aDados[] = $dtcada;

                    $this->salvarConta($aNomes, $aDados);
                }

                $demens = "Cadastro efetuado com sucesso!";
                $detitu = "Template Oficina | Cadastro de OS";
                $devolt = "ordem.php";
                header('Location: mensagem.php?demens=' . $demens . '&detitu=' . $detitu . '&devolt=' . $devolt);
            }
        }
    }

    //Pagina de pedidosacoes.php
    function pagPedidos()
    {
        if (!$this->verificaSessao()) {
            header('Location: ../../index.php');
            exit;
        }

        $this->verificaInatividade();

        $acao = $_REQUEST['acao'];

        if ($acao == 'novo') {
            $this->fornecedores = $this->listaFornecedores();
            $this->pecas = $this->listarPecas();
            $this->servicos = $this->listarServicos();
        }

        if ($acao == 'ver' or $acao == 'edita' or $acao == 'apaga') {
            $chave = $_REQUEST['chave'];
            $this->pedido = $this->buscarPedido($chave);
            $this->itens = $this->buscaItensPedido($chave);
            $this->fornecedores = $this->listaFornecedores();
            $this->pecas = $this->listarPecas();
            $this->servicos = $this->listarServicos();

        }

        if (isset($_REQUEST['editar']))
        {
            $cdpedi = $_POST["cdpedi"];

            $this->excluirPedido($cdpedi);
            $this->excluirItensPedido($cdpedi);
            $this->excluirContaPedido($cdpedi);

            $dtcada = date('Y-m-d');
            $Flag = true;

            $aCditem = $_POST["cditem"];
            $aQtitem = $_POST["qtitem"];
            $aVlitem = $_POST["vlitem"];
            $cdforn = $_POST["cdforn"];
            $dtpedi = $_POST["dtpedi"];
            $vlpedi = $_POST["vlpedi"];

            $vlpedi = str_replace(".", "", $vlpedi);
            $vlpedi = str_replace(",", ".", $vlpedi);

            $qtitem = 0;
            for ($f = 1; $f <= 10; $f++) {
                $primeiro = $aCditem[$f];
                $aPrimeiro = explode("|", $aCditem[$f]);
                if ($aPrimeiro[0] !== 'X') {
                    $qtitem++;
                }
            }

            if ($qtitem <= 0) {
                $demens = "É preciso informar os itens do pedido!";
                $detitu = "Template Oficina | Cadastro de Pedidos";
                header('Location: mensagem.php?demens=' . $demens . '&detitu=' . $detitu);
                $Flag = false;
            }

            if (empty($cdforn) == true) {
                $demens = "É preciso informar o fornecedor!";
                $detitu = "Template Oficina | Cadastro de Pedidos";
                header('Location: mensagem.php?demens=' . $demens . '&detitu=' . $detitu);
                $Flag = false;
            }

            if (empty(strtotime($dtpedi)) == true) {
                $demens = "É preciso informar a data do pedido!";
                $detitu = "Template Oficina | Cadastro de Pedidos";
                header('Location: mensagem.php?demens=' . $demens . '&detitu=' . $detitu);
                $Flag = false;
            }


            if ($Flag == true) {

                //campos da tabela
                $aNomes = array();
                $aNomes[] = "cdpedi";
                $aNomes[] = "cdforn";
                $aNomes[] = "dtpedi";
                $aNomes[] = "vlpedi";
                $aNomes[] = "decont";
                $aNomes[] = "dtentr";
                $aNomes[] = "status";
                $aNomes[] = "deobse";
                $aNomes[] = "flativ";
                $aNomes[] = "dtcada";
                $aNomes[] = "cdform";
                $aNomes[] = "qtform";


                //dados da tabela
                $aDados = array();
                $aDados[] = $_POST["cdpedi"];
                $aDados[] = $_POST["cdforn"];
                $aDados[] = $_POST["dtpedi"];
                $aDados[] = $vlpedi;
                $aDados[] = $_POST["decont"];
                $aDados[] = $_POST["dtentr"];
                $aDados[] = $_POST["status"];
                $aDados[] = $_POST["deobse"];
                $aDados[] = 'Sim';
                $aDados[] = $dtcada;
                $aDados[] = $_POST["cdform"];
                $aDados[] = $_POST["qtform"];

                $proc = "Alteração";
                $chave = $_POST["cdpedi"];

                $this->salvarPedido($aNomes, $aDados, $proc, $chave);

                $nritem = 1;
                for ($f = 1; $f <= 10; $f++) {
                    $primeiro = $aCditem[$f];
                    $aPrimeiro = explode("|", $aCditem[$f]);
                    if ($aPrimeiro[0] !== 'X') {
                        $cdpeca = $aPrimeiro[2];
                        $qtpeca = $aQtitem[$f];
                        $vlpeca = $aVlitem[$f];

                        $vltota = $qtpeca * $vlpeca;

                        $aNomes = array();
                        $aNomes[] = "cdpedi";
                        $aNomes[] = "nritem";
                        $aNomes[] = "cdpeca";
                        $aNomes[] = "qtpeca";
                        $aNomes[] = "vlpeca";
                        $aNomes[] = "vltota";

                        $aDados = array();
                        $aDados[] = $cdpedi;
                        $aDados[] = $nritem++;
                        $aDados[] = $cdpeca;
                        $aDados[] = $qtpeca;
                        $aDados[] = $vlpeca;
                        $aDados[] = $vltota;

                        $this->salvarItensPedido($aNomes, $aDados);

                    }
                }

                $pedidos = $this->buscarPedido($cdpedi);
                $dtpedi = $pedidos[0]["dtpedi"];
                $qtform = $pedidos[0]["qtform"];

                if($qtform === "0"){

                    $qtform = 1;

                }

                for ($f = 1; $f <= $qtform; $f++) {
                    $vlcont = $pedidos[0]["vlpedi"] / $qtform;

                    $dtcont = strtotime($dtpedi . "+ {$f} months");
                    $dtcont = date("Y-m-d", $dtcont);

                    $aNomes = array();
                    $aNomes[] = "decont";
                    $aNomes[] = "dtcont";
                    $aNomes[] = "vlcont";
                    $aNomes[] = "cdtipo";
                    $aNomes[] = "cdquem";
                    $aNomes[] = "cdorig";
                    $aNomes[] = "flativ";
                    $aNomes[] = "dtcada";

                    $aDados = array();
                    $aDados[] = 'Pedido a Pagar';
                    $aDados[] = $dtcont;
                    $aDados[] = $vlcont;
                    $aDados[] = 'Pagar';
                    $aDados[] = $pedidos[0]["cdforn"];
                    $aDados[] = $pedidos[0]["cdpedi"];
                    $aDados[] = 'Sim';
                    $aDados[] = $dtcada;

                    $this->salvarConta($aNomes, $aDados);

                }

                $demens = "Alteração efetuada com sucesso!";
                $detitu = "Template Oficina | Cadastro de Pedidos";
                $devolt = "pedidos.php";
                header('Location: mensagem.php?demens=' . $demens . '&detitu=' . $detitu . '&devolt=' . $devolt);
            }

        }

        if (isset($_REQUEST['apagar'])) {
            $cdpedi = $_POST["cdpedi"];

            if ($this->excluirPedido($cdpedi) and $this->excluirItensPedido($cdpedi) and $this->excluirContaPedido($cdpedi)) {
                $demens = "Exclusão efetuada com sucesso!";

            } else {

                $demens = "Ocorreu um problema durante exclusão do pedido. Se persistir contate o Suporte!";
            }

            $detitu = "Template Oficinas | Cadastro de Pedidos";
            $devolt = "pedidos.php";
            header('Location: mensagem.php?demens=' . $demens . '&detitu=' . $detitu . '&devolt=' . $devolt);

        }

        if (isset($_REQUEST['salvar'])) {

            $dtcada = date('Y-m-d');
            $Flag = true;

            $aCditem = $_POST["cditem"];
            $aQtitem = $_POST["qtitem"];
            $aVlitem = $_POST["vlitem"];
            $cdforn = $_POST["cdforn"];
            $dtpedi = $_POST["dtpedi"];
            $vlpedi = $_POST["vlpedi"];

            $vlpedi = str_replace(".", "", $vlpedi);
            $vlpedi = str_replace(",", ".", $vlpedi);

            $qtitem = 0;
            for ($f = 1; $f <= 10; $f++) {
                $primeiro = $aCditem[$f];
                $aPrimeiro = explode("|", $aCditem[$f]);
                if ($aPrimeiro[0] !== 'X') {
                    $qtitem++;
                }
            }

            if ($qtitem <= 0) {
                $demens = "É preciso informar os itens do pedido!";
                $detitu = "Template Oficina | Cadastro de Pedidos";
                header('Location: mensagem.php?demens=' . $demens . '&detitu=' . $detitu);
                $Flag = false;
            }

            if (empty($cdforn) == true) {
                $demens = "É preciso informar o fornecedor!";
                $detitu = "Template Oficina | Cadastro de Pedidos";
                header('Location: mensagem.php?demens=' . $demens . '&detitu=' . $detitu);
                $Flag = false;
            }

            if (empty(strtotime($dtpedi)) == true) {
                $demens = "É preciso informar a data do pedido!";
                $detitu = "Template Oficina | Cadastro de Pedidos";
                header('Location: mensagem.php?demens=' . $demens . '&detitu=' . $detitu);
                $Flag = false;
            }


            if ($Flag == true) {

                //campos da tabela
                $aNomes = array();
                $aNomes[] = "cdforn";
                $aNomes[] = "dtpedi";
                $aNomes[] = "vlpedi";
                $aNomes[] = "decont";
                $aNomes[] = "dtentr";
                $aNomes[] = "deobse";
                $aNomes[] = "status";
                $aNomes[] = "flativ";
                $aNomes[] = "dtcada";
                $aNomes[] = "cdform";
                $aNomes[] = "qtform";


                //dados da tabela
                $aDados = array();
                $aDados[] = $_POST["cdforn"];
                $aDados[] = $_POST["dtpedi"];
                $aDados[] = $vlpedi;
                $aDados[] = $_POST["decont"];
                $aDados[] = $_POST["dtentr"];
                $aDados[] = $_POST["deobse"];
                $aDados[] = $_POST["status"];
                $aDados[] = 'Sim';
                $aDados[] = $dtcada;
                $aDados[] = $_POST["cdform"];
                $aDados[] = $_POST["qtform"];

                $proc = "Inclusão";
                $chave = "";

                $this->salvarPedido($aNomes, $aDados, $proc, $chave);

                $pedido = $this->buscarMaiorPedidoFornecedor($cdforn,$dtpedi);
                $cdpedi = $pedido[0]["cdpedi"];

                $nritem = 1;
                for ($f = 1; $f <= 10; $f++) {

                    $primeiro = $aCditem[$f];
                    $aPrimeiro = explode("|", $aCditem[$f]);

                    if ($aPrimeiro[0] !== 'X') {
                        $cdpeca = $aPrimeiro[2];
                        $qtpeca = $aQtitem[$f];
                        $vlpeca = $aVlitem[$f];

                        $vltota = $qtpeca * $vlpeca;

                        $aNomes = array();
                        $aNomes[] = "cdpedi";
                        $aNomes[] = "nritem";
                        $aNomes[] = "cdpeca";
                        $aNomes[] = "qtpeca";
                        $aNomes[] = "vlpeca";
                        $aNomes[] = "vltota";

                        $aDados = array();
                        $aDados[] = $cdpedi;
                        $aDados[] = $nritem++;
                        $aDados[] = $cdpeca;
                        $aDados[] = $qtpeca;
                        $aDados[] = $vlpeca;
                        $aDados[] = $vltota;

                        $this->salvarItensPedido($aNomes, $aDados);

                    }
                }

                $result = $this->buscarPedido($cdpedi);

                $dtpedi = $result[0]["dtpedi"];
                $qtform = $result[0]["qtform"];

                if($qtform === "0"){

                    $qtform = 1;

                }

                for ($f = 1; $f <= $qtform; $f++) {

                    $vlcont = $result[0]["vlpedi"] / $qtform;

                    $dtcont = strtotime($dtpedi . "+ {$f} months");
                    $dtcont = date("Y-m-d", $dtcont);

                    $aNomes = array();
                    $aNomes[] = "decont";
                    $aNomes[] = "dtcont";
                    $aNomes[] = "vlcont";
                    $aNomes[] = "cdtipo";
                    $aNomes[] = "cdquem";
                    $aNomes[] = "cdorig";
                    $aNomes[] = "flativ";
                    $aNomes[] = "dtcada";

                    $aDados = array();
                    $aDados[] = 'Pedido a Pagar';
                    $aDados[] = $dtcont;
                    $aDados[] = $vlcont;
                    $aDados[] = 'Pagar';
                    $aDados[] = $result[0]["cdforn"];
                    $aDados[] = $result[0]["cdpedi"];
                    $aDados[] = 'Sim';
                    $aDados[] = $dtcada;

                    $this->salvarConta($aNomes, $aDados);

                }

                $demens = "Cadastro efetuado com sucesso!";
                $detitu = "Template Oficina | Cadastro de Pedidos";
                $devolt = "pedidos.php";
                header('Location: mensagem.php?demens=' . $demens . '&detitu=' . $detitu . '&devolt=' . $devolt);
        }

        }
    }

    //Pagina fornecedoresacoes.php
    function pagFornecedores()
    {
        if (!$this->verificaSessao()) {
            header('Location: ../../index.php');
            exit;
        }

        $this->verificaInatividade();

        $data = date('Y-m-d');
        $acao = $_REQUEST['acao'];

        $flag = true;
        $flag2 = false;
        $this->estados = $this->listarEstadosBra();

        if ($flag == true) {

            if ($acao == 'ver' or $acao == 'edita' or $acao == 'apaga') {
                $chave = $_REQUEST['chave'];
                $this->fornecedor = $this->buscaFornecedor($chave);
            }

            if (isset($_REQUEST['editar'])) {

                $cdforn = $_POST["cdforn"];

                if (strlen($cdforn) < 12) {
                    $cdforn = $this->util->RetirarMascara($cdforn, "cpf");
                    if ($this->util->validaCPF($cdforn) == false) {
                        $demens = "Cpf inválido!";
                        $detitu = "Template Oficina | Cadastro de Fornecedores";
                        header('Location: mensagem.php?demens=' . $demens . '&detitu=' . $detitu);
                        $flag = false;
                    }
                } Else {
                    $cdforn = $this->util->RetirarMascara($cdforn, "cnpj");
                    if ($this->util->validaCNPJ($cdforn) == false) {
                        $demens = "Cnpj inválido!";
                        $detitu = "Template Oficina | Cadastro de Clientes";
                        header('Location: mensagem.php?demens=' . $demens . '&detitu=' . $detitu);
                        $flag = false;
                    }
                }

                if ($flag2 == true) {
                } Else {

                    //campos da tabela
                    $aNomes = array();
                    $aNomes[] = "cdforn";
                    $aNomes[] = "deforn";
                    $aNomes[] = "cdtipo";
                    $aNomes[] = "nrinsc";
                    $aNomes[] = "nrccm";
                    $aNomes[] = "nrrg";
                    $aNomes[] = "deende";
                    $aNomes[] = "nrende";
                    $aNomes[] = "decomp";
                    $aNomes[] = "debair";
                    $aNomes[] = "decida";
                    $aNomes[] = "cdesta";
                    $aNomes[] = "nrcepi";
                    $aNomes[] = "nrtele";
                    $aNomes[] = "nrcelu";
                    $aNomes[] = "demail";
                    $aNomes[] = "deobse";
                    $aNomes[] = "flativ";
                    $aNomes[] = "dtcada";

                    //dados da tabela
                    $aDados = array();
                    $aDados[] = $_POST["cdforn"];
                    $aDados[] = $_POST["deforn"];
                    $aDados[] = $_POST["cdtipo"];
                    $aDados[] = $_POST["nrinsc"];
                    $aDados[] = $_POST["nrccm"];
                    $aDados[] = $_POST["nrrg"];
                    $aDados[] = $_POST["deende"];
                    $aDados[] = $_POST["nrende"];
                    $aDados[] = $_POST["decomp"];
                    $aDados[] = $_POST["debair"];
                    $aDados[] = $_POST["decida"];
                    $aDados[] = $_POST["cdesta"];
                    $aDados[] = $_POST["nrcepi"];
                    $aDados[] = $_POST["nrtele"];
                    $aDados[] = $_POST["nrcelu"];
                    $aDados[] = $_POST["demail"];
                    $aDados[] = $_POST["deobse"];
                    $aDados[] = "S";
                    $aDados[] = $data;

                    if ($this->atualizarFornecedor($aNomes, $aDados, $chave)) {
                        if ($flag2 == false) {
                            $demens = "Atualização efetuada com sucesso!";
                        }
                    } else {
                        $demens = "Ocorreu um problema na atualização/exclusão. Se persistir contate o Suporte!";
                    }
                }
                $detitu = "Template Oficina | Cadastro de fornecedores";
                $devolt = "fornecedores.php";
                header('Location: mensagem.php?demens=' . $demens . '&detitu=' . $detitu . '&devolt=' . $devolt);
            }

            if (isset($_REQUEST['apagar'])) {
                $cdforn = $_POST["cdforn"];

                if ($this->excluirFornecedor($cdforn)) {

                    if ($flag2 == false) {
                        $demens = "Exclusão efetuada com sucesso!";

                    }
                } else {
                    $demens = "Ocorreu um problema na atualização/exclusão. Se persistir contate o Suporte!";
                }

                $detitu = "Template Oficina | Cadastro de fornecedores";
                $devolt = "fornecedores.php";
                header('Location: mensagem.php?demens=' . $demens . '&detitu=' . $detitu . '&devolt=' . $devolt);
            }

            if (isset($_REQUEST['salvar'])) {

                $data = date('Y-m-d');
                $cdforn = $_POST["cdforn"];
                $demail = $_POST["demail"];
                $Flag = true;

                if (strlen($cdforn) < 12) {

                    $cdforn = $this->util->RetirarMascara($cdforn, "cpf");

                    if ($this->util->validaCPF($cdforn) == false) {
                        $demens = "Cpf inválido!";
                        $detitu = "Template Oficina | Cadastro de fornecedores";
                        header('Location: mensagem.php?demens=' . $demens . '&detitu=' . $detitu);
                        $Flag = false;
                    }
                } Else {

                    $cdforn = $this->util->RetirarMascara($cdforn, "cnpj");

                    if ($this->util->validaCNPJ($cdforn) == false) {
                        $demens = "Cnpj inválido!";
                        $detitu = "Template Oficina | Cadastro de fornecedores";
                        header('Location: mensagem.php?demens=' . $demens . '&detitu=' . $detitu);
                        $Flag = false;
                    }
                }

                $forn = $this->buscaFornecedor($cdforn);

                if ($forn) {
                    $demens = "Cpf/Cnpj já cadastrado!";
                    $detitu = "Template Oficina | Cadastro de fornecedores";
                    header('Location: mensagem.php?demens=' . $demens . '&detitu=' . $detitu);
                    $Flag = false;
                }

                if ($Flag == true) {

                    //campos da tabela
                    $aNomes = array();
                    $aNomes[] = "cdforn";
                    $aNomes[] = "deforn";
                    $aNomes[] = "cdtipo";
                    $aNomes[] = "nrinsc";
                    $aNomes[] = "nrccm";
                    $aNomes[] = "nrrg";
                    $aNomes[] = "deende";
                    $aNomes[] = "nrende";
                    $aNomes[] = "decomp";
                    $aNomes[] = "debair";
                    $aNomes[] = "decida";
                    $aNomes[] = "cdesta";
                    $aNomes[] = "nrcepi";
                    $aNomes[] = "nrtele";
                    $aNomes[] = "nrcelu";
                    $aNomes[] = "demail";
                    $aNomes[] = "deobse";
                    $aNomes[] = "flativ";
                    $aNomes[] = "dtcada";

                    //dados da tabela
                    $aDados = array();
                    $aDados[] = $_POST["cdforn"];
                    $aDados[] = $_POST["deforn"];
                    $aDados[] = $_POST["cdtipo"];
                    $aDados[] = $_POST["nrinsc"];
                    $aDados[] = $_POST["nrccm"];
                    $aDados[] = $_POST["nrrg"];
                    $aDados[] = $_POST["deende"];
                    $aDados[] = $_POST["nrende"];
                    $aDados[] = $_POST["decomp"];
                    $aDados[] = $_POST["debair"];
                    $aDados[] = $_POST["decida"];
                    $aDados[] = $_POST["cdesta"];
                    $aDados[] = $_POST["nrcepi"];
                    $aDados[] = $_POST["nrtele"];
                    $aDados[] = $_POST["nrcelu"];
                    $aDados[] = $_POST["demail"];
                    $aDados[] = $_POST["deobse"];
                    $aDados[] = "S";
                    $aDados[] = $data;

                    if ($this->salvarFornecedor($aNomes, $aDados)) {

                        $demens = "Cadastro efetuado com sucesso!";

                    } else {
                        $demens = "Ocorreu um problema durante o cadastro. Se persistir contate o suporte!";
                    }
                }

                $detitu = "Template Oficina | Cadastro de fornecedores";
                $devolt = "fornecedores.php";
                header('Location: mensagem.php?demens=' . $demens . '&detitu=' . $detitu . '&devolt=' . $devolt);

            }
        }
    }

    //Pagina Usuarioscoes.php
    function pagUsuarios()
    {
        if (!$this->verificaSessao()) {
            header('Location: ../../index.php');
            exit;
        }

        $this->verificaInatividade();

        $acao = $_REQUEST['acao'];

        if ($acao == 'ver' or $acao == 'edita' or $acao == 'apaga') {

            $chave = $_REQUEST['chave'];
            $this->usuario = $this->buscarUsuario($chave);

        }

        if (isset($_REQUEST['editar'])) {

            $cdusua = $_POST["cdusua"];
            $defoto1 = $_POST["defoto1"];
            $desenha = $_POST['password'];

            //uploads
            $uploaddir = '../../templates/img/' . $cdusua . "_";
            $uploadfile1 = $uploaddir . basename($_FILES['defotom']['name']);

            #Move o arquivo para o diretório de destino
            move_uploaded_file($_FILES["defotom"]["tmp_name"], $uploadfile1);

            $defotom = basename($_FILES['defotom']['name']);

            if (empty($defotom) == true) {
                $defoto = $defoto1;
            } Else {
                $defoto = $uploadfile1;
            }

            //campos da tabela
            $aNomes = array();
            $aNomes[] = "deusua";
            $aNomes[] = "demail";
            $aNomes[] = "defoto";
            $aNomes[] = "cdtipo";
            $aNomes[] = "flativ";
            $aNomes[] = "nrtele";

            //dados da tabela
            $aDados = array();
            $aDados[] = $_POST["deusua"];
            $aDados[] = $_POST["demail"];
            $aDados[] = $defoto;
            $aDados[] = $_POST["cdtipo"];
            $aDados[] = $_POST["flativ"];
            $aDados[] = $_POST["nrtele"];

            if (!empty($desenha)) {
                $aNomes[] = "desenh";
                $aDados[] = md5($desenha);
            }

            if ($this->atualizaDadosUsuario($aNomes, $aDados, $cdusua)) {

                $demens = "Atualização efetuada com sucesso!";

            } else {

                $demens = "Ocorreu um problema na atualização/exclusão. Se persistir contate o Suporte!";
            }

            $detitu = "Template Oficina | Cadastro de Usuários";
            $devolt = "usuarios.php";
            header('Location: mensagem.php?demens=' . $demens . '&detitu=' . $detitu . '&devolt=' . $devolt);
        }

        if (isset($_REQUEST['apagar']))
        {
            $cdusua = $_POST["cdusua"];

            if ($this->excluirUsuario($cdusua)) {
                $demens = "Exclusão efetuada com sucesso!";

            } else {

                $demens = "Ocorreu um problema na atualização/exclusão. Se persistir contate o suporte!";
            }

            $detitu = "Template Oficina | Cadastro de Usuários";
            $devolt = "usuarios.php";
            header('Location: mensagem.php?demens=' . $demens . '&detitu=' . $detitu . '&devolt=' . $devolt);

        }

        if (isset($_REQUEST['salvar']))
        {
            $delogin = $_POST["login"];
            $demail = $_POST["demail"];
            $dtcada = date('Y-m-d');
            $flativ = "S";
            $Flag = true;

            if ($Flag == true) {

                //uploads
                $uploaddir = '../../templates/img/' . $delogin . "_";
                $uploadfile1 = $uploaddir . basename($_FILES['defotom']['name']);

                #Move o arquivo para o diretório de destino
                move_uploaded_file($_FILES["defotom"]["tmp_name"], $uploadfile1);

                $defoto1 = basename($_FILES['defotom']['name']);

                $desenh = md5($_POST["password"]);

                if (empty($defoto1) == true) {
                    $defoto = "img/semfoto.jpg";
                } Else {
                    $defoto = $uploadfile1;
                }

                //campos da tabela
                $aNomes = array();
                $aNomes[] = "deusua";
                $aNomes[] = "delogin";
                $aNomes[] = "desenh";
                $aNomes[] = "demail";
                $aNomes[] = "defoto";
                $aNomes[] = "cdtipo";
                $aNomes[] = "flativ";
                $aNomes[] = "dtcada";
                $aNomes[] = "nrtele";

                //dados da tabela
                $aDados = array();
                $aDados[] = $_POST["deusua"];
                $aDados[] = $delogin;
                $aDados[] = $desenh;
                $aDados[] = $demail;
                $aDados[] = $defoto;
                $aDados[] = $_POST["cdtipo"];
                $aDados[] = $flativ;
                $aDados[] = $dtcada;
                $aDados[] = $_POST["nrtele"];

                if ($this->salvarUsuario($aNomes, $aDados)) {

                    $demens = "Cadastro efetuado com sucesso!";

                } else {

                    $demens = "Ocorreu um problema durante o cadastro. Se persistir contate o suporte!";
                }

                $detitu = "Template Oficina | Cadastro de usuarios";
                $devolt = "usuarios.php";
                header('Location: mensagem.php?demens=' . $demens . '&detitu=' . $detitu . '&devolt=' . $devolt);
            }
        }
    }

    //Pagina pecasacoes.php
    function pagPecas()
    {
        if (!$this->verificaSessao()) {
            header('Location: ../../index.php');
            exit;
        }

        $this->verificaInatividade();

        $data = date('Y-m-d');
        $acao = $_REQUEST['acao'];

        $flag = true;
        $flag2 = false;

        if ($flag == true) {

            if ($acao == 'ver' or $acao == 'edita' or $acao == 'apaga') {

                $chave = $_REQUEST['chave'];
                $this->peca = $this->buscaPeca($chave);

            }

            if(isset($_REQUEST['editar']))
            {
                $data = date('Y-m-d');
                $cdpeca = $_POST["cdpeca"];
                $depeca = $_POST["depeca"];
                $qtpeca = $_POST["qtpeca"];
                $vlpeca = $_POST["vlpeca"];

                $vlpeca= str_replace(".","",$vlpeca);
                $vlpeca= str_replace(",",".",$vlpeca);

                //campos da tabela
                $aNomes=array();

                //$aNomes[]= "cdveic";
                $aNomes[]= "depeca";
                $aNomes[]= "qtpeca";
                $aNomes[]= "vlpeca";

                //dados da tabela
                $aDados=array();
                //$aDados[]= $_POST["cdveic"];
                $aDados[]= $depeca;
                $aDados[]= $qtpeca;
                $aDados[]= $vlpeca;

                if($this->atualizaPeca($aNomes, $aDados, $cdpeca)){

                    $demens = "Atualização efetuada com sucesso!";

                }else{

                    $demens = "Ocorreu um problema na atualização/exclusão. Se persistir contate o suporte!";

                }

                $detitu = "Template Oficina | Cadastro de Peças";
                $devolt = "pecas.php";
                header('Location: mensagem.php?demens='.$demens.'&detitu='.$detitu.'&devolt='.$devolt);
            }

            if(isset($_REQUEST['apagar']))
            {
                $chave = $_REQUEST['chave'];

                if($this->excluirPeca($chave)){

                    $demens = "Exclusão efetuada com sucesso!";

                }else{

                    $demens = "Ocorreu um problema na atualização/exclusão. Se persistir contate o suporte!";

                }

                $detitu = "Template Oficina | Cadastro de Peças";
                $devolt = "pecas.php";
                header('Location: mensagem.php?demens='.$demens.'&detitu='.$detitu.'&devolt='.$devolt);

            }

            if(isset($_REQUEST['salvar']))
            {
                $data = date('Y-m-d');
                $cdpeca = $_POST["cdpeca"];
                $depeca = $_POST["depeca"];
                $qtpeca = $_POST["qtpeca"];
                $vlpeca = $_POST["vlpeca"];

                $vlpeca= str_replace(".","",$vlpeca);
                $vlpeca= str_replace(",",".",$vlpeca);

                $Flag = true;

                $peca = $this->buscaPeca($cdpeca);

                if ($peca) {
                    $demens = "Código da peça já cadastrado!";
                    $detitu = "Template Oficina | Cadastro de Peças";
                    header('Location: mensagem.php?demens='.$demens.'&detitu='.$detitu);
                    $Flag=false;
                }

                if ($Flag == true) {

                    //campos da tabela
                    $aNomes=array();

                    $aNomes[]= "cdpeca";
                    $aNomes[]= "depeca";
                    $aNomes[]= "qtpeca";
                    $aNomes[]= "vlpeca";

                    //dados da tabela
                    $aDados=array();
                    $aDados[]= $cdpeca;
                    $aDados[]= $depeca;
                    $aDados[]= $qtpeca;
                    $aDados[]= $vlpeca;

                    if($this->salvarPeca($aNomes, $aDados))
                    {
                        $demens = "Cadastro efetuado com sucesso!";

                    }else{

                        $demens = "Ocorreu um problema durante o cadastro. Se persistir contate o suporte!";
                    }

                }

                $detitu = "Template Oficina | Cadastro de Peças";
                $devolt = "pecas.php";
                header('Location: mensagem.php?demens='.$demens.'&detitu='.$detitu.'&devolt='.$devolt);
            }
        }
    }

    //Pagina servicosacoes.php
    function pagServicos()
    {
        if (!$this->verificaSessao()) {
            header('Location: ../../index.php');
            exit;
        }

        $this->verificaInatividade();

        $data = date('Y-m-d');
        $acao = $_REQUEST['acao'];

        $flag = true;
        $flag2 = false;

        if ($flag == true) {

            if ($acao == 'ver' or $acao == 'edita' or $acao == 'apaga') {

                $chave = $_REQUEST['chave'];
                $this->servico = $this->buscaServico($chave);

            }
        }

        if(isset($_REQUEST['editar']))
        {
            $cdserv = $_POST["cdserv"];
            $deserv = $_POST["deserv"];
            $qtserv = $_POST["qtserv"];
            $vlserv = $_POST["vlserv"];

            $vlserv= str_replace(".","",$vlserv);
            $vlserv= str_replace(",",".",$vlserv);

			//campos da tabela
			$aNomes=array();

			//$aNomes[]= "cdveic";
			$aNomes[]= "deserv";
			$aNomes[]= "qtserv";
			$aNomes[]= "vlserv";

			//dados da tabela
			$aDados=array();
			//$aDados[]= $_POST["cdveic"];
			$aDados[]= $deserv;
			$aDados[]= $qtserv;
			$aDados[]= $vlserv;

            if($this->atualizaServiço($aNomes, $aDados, $cdserv))
            {
                $demens = "Atualização efetuada com sucesso!";

            }else{

                $demens = "Ocorreu um problema na atualização/exclusão. Se persistir contate o suporte!";

            }

                $detitu = "Template Oficina | Cadastro de Serviços";
                $devolt = "servicos.php";
                header('Location: mensagem.php?demens='.$demens.'&detitu='.$detitu.'&devolt='.$devolt);

        }

        if(isset($_REQUEST['apagar']))
        {
            $data = date('Y-m-d');
            $chave = $_POST["cdserv"];

            if($this->excluirServico($chave))
            {
                $demens = "Exclusão efetuada com sucesso!";

            }else{

                $demens = "Ocorreu um problema na atualização/exclusão. Se persistir contate o suporte!";
            }


            $detitu = "Template Oficina | Cadastro de Serviços";
            $devolt = "servicos.php";
            header('Location: mensagem.php?demens='.$demens.'&detitu='.$detitu.'&devolt='.$devolt);
        }

        if(isset($_REQUEST['salvar']))
        {
            $data = date('Y-m-d');
            $cdserv = $_POST["cdserv"];
            $deserv = $_POST["deserv"];
            $qtserv = $_POST["qtserv"];
            $vlserv = $_POST["vlserv"];

            $vlserv = str_replace(".", "", $vlserv);
            $vlserv = str_replace(",", ".", $vlserv);

            $Flag = true;

            $servico = $this->buscaServico($cdserv);

            if ($servico) {
                $demens = "Código do serviço já cadastrado!";
                $detitu = "Template Oficina | Cadastro de Serviços";
                header('Location: mensagem.php?demens=' . $demens . '&detitu=' . $detitu);
                $Flag = false;
            }

            if ($Flag == true) {

                //campos da tabela
                $aNomes = array();

                $aNomes[] = "cdserv";
                $aNomes[] = "deserv";
                $aNomes[] = "qtserv";
                $aNomes[] = "vlserv";

                //dados da tabela
                $aDados = array();
                $aDados[] = $cdserv;
                $aDados[] = $deserv;
                $aDados[] = $qtserv;
                $aDados[] = $vlserv;

                if($this->salvarServico($aNomes, $aDados))
                {
                    $demens = "Cadastro efetuado com sucesso!";

                }else{

                    $demens = "Ocorreu um problema durante o cadastro. Se persistir contate o suporte!";
                }

                $detitu = "Demonstração Auto Mecânica&copy; | Cadastro de Serviços";
                $devolt = "servicos.php";
                header('Location: mensagem.php?demens=' . $demens . '&detitu=' . $detitu . '&devolt=' . $devolt);
            }
        }
    }

    //Pagina contasacoes.php
    function pagContas()
    {
        if (!$this->verificaSessao()) {
            header('Location: ../../index.php');
            exit;
        }

        $this->verificaInatividade();

        $data = date('Y-m-d');
        $acao = $_REQUEST['acao'];

        $flag = true;
        $flag2 = false;

        if ($flag == true) {

            if ($acao == 'ver' or $acao == 'edita' or $acao == 'apaga') {

                $chave = $_REQUEST['chave'];
                $this->conta = $this->buscaConta($chave);

            }
        }

        if(isset($_REQUEST['editar']))
        {
            $data = date('Y-m-d');
            $cdcont = $_POST["cdcont"];
            $vlcont = $_POST["vlcont"];
            $vlpago = $_POST["vlpago"];

            $vlcont= str_replace(".","",$vlcont);
            $vlcont= str_replace(",",".",$vlcont);
            $vlpago= str_replace(".","",$vlpago);
            $vlpago= str_replace(",",".",$vlpago);

            //campos da tabela
            $aNomes=array();

            $aNomes[]= "decont";
            $aNomes[]= "dtcont";
            $aNomes[]= "vlcont";
            $aNomes[]= "cdtipo";
            $aNomes[]= "vlpago";
            $aNomes[]= "dtpago";
            $aNomes[]= "cdquem";
            $aNomes[]= "cdorig";
            $aNomes[]= "deobse";
            $aNomes[]= "flativ";
            $aNomes[]= "dtcada";

            //dados da tabela
            $aDados=array();
            $aDados[]= $_POST["decont"];
            $aDados[]= $_POST["dtcont"];
            $aDados[]= $vlcont;
            $aDados[]= $_POST["cdtipo"];
            $aDados[]= $vlpago;
            $aDados[]= $_POST["dtpago"];
            $aDados[]= $_POST["cdquem"];
            $aDados[]= $_POST["cdorig"];
            $aDados[]= $_POST["deobse"];
            $aDados[]= "S";
            $aDados[]= date("Y-m-d");

            if($this->atualizaConta($aNomes, $aDados, $cdcont ))
            {
                $demens = "Atualização efetuada com sucesso!";

            }else{

                $demens = "Ocorreu um problema na atualização/exclusão. Se persistir contate o suporte!";

            }

            $detitu = "Template Oficinas; | Cadastro de Contas a Pagar/Receber";
            $devolt = "contas.php";
            header('Location: mensagem.php?demens='.$demens.'&detitu='.$detitu.'&devolt='.$devolt);
        }

        if(isset($_REQUEST['apagar']))
        {
            $cdcont = $_POST["cdcont"];

            if($this->excluirConta($cdcont))
            {
                $demens = "Exclusão efetuada com sucesso!";

            }else{

                $demens = "1Ocorreu um problema na atualização/exclusão. Se persistir contate o suporte!";
            }

            $detitu = "Template Oficinas; | Cadastro de Contas a Pagar/Receber";
            $devolt = "contas.php";
            header('Location: mensagem.php?demens='.$demens.'&detitu='.$detitu.'&devolt='.$devolt);

        }

        if(isset($_REQUEST['salvar']))
        {
            $data = date('Y-m-d');
            $vlcont = $_POST["vlcont"];
            $vlpago = $_POST["vlpago"];

            $vlcont= str_replace(".","",$vlcont);
            $vlcont= str_replace(",",".",$vlcont);
            $vlpago= str_replace(".","",$vlpago);
            $vlpago= str_replace(",",".",$vlpago);

            //campos da tabela
            $aNomes=array();
            $aNomes[]= "decont";
            $aNomes[]= "dtcont";
            $aNomes[]= "vlcont";
            $aNomes[]= "cdtipo";
            $aNomes[]= "vlpago";
            $aNomes[]= "dtpago";
            $aNomes[]= "cdquem";
            $aNomes[]= "cdorig";
            $aNomes[]= "deobse";
            $aNomes[]= "flativ";
            $aNomes[]= "dtcada";

            //dados da tabela
            $aDados=array();
            $aDados[]= $_POST["decont"];
            $aDados[]= $_POST["dtcont"];
            $aDados[]= $vlcont;
            $aDados[]= $_POST["cdtipo"];
            $aDados[]= $vlpago;
            $aDados[]= $_POST["dtpago"];
            $aDados[]= $_POST["cdquem"];
            $aDados[]= $_POST["cdorig"];
            $aDados[]= $_POST["deobse"];
            $aDados[]= "S";
            $aDados[]= $data;

            if($this->salvarConta($aNomes, $aDados))
            {
                $demens = "Cadastro efetuado com sucesso!";

            }else{

                $demens = "Ocorreu um problema na atualização/exclusão. Se persistir contate o suporte!";
            }

            $detitu = "Template Oficina | Cadastro de Contas a Pagar/Receber";
            $devolt = "contas.php";
            header('Location: mensagem.php?demens='.$demens.'&detitu='.$detitu.'&devolt='.$devolt);

        }
    }

    //Pagina paramentro.php
    function pagParamentros()
    {
        if (!$this->verificaSessao()) {
            header('Location: ../../index.php');
            exit;
        }

        $this->verificaInatividade();

        if(isset($_REQUEST['editar']))
        {
            $cod = $_POST["cdprop"];

            //campos da tabela
            $aNomes=array();
            $aNomes[]= "cdprop";
            $aNomes[]= "deprop";
            $aNomes[]= "nrinsc";
            $aNomes[]= "nrccm";
            $aNomes[]= "deende";
            $aNomes[]= "nrende";
            $aNomes[]= "decomp";
            $aNomes[]= "debair";
            $aNomes[]= "decida";
            $aNomes[]= "nrcepi";
            $aNomes[]= "cdesta";
            $aNomes[]= "nrtele";
            $aNomes[]= "nrcelu";
            $aNomes[]= "demail";

            //dados da tabela
            $aDados=array();
            $aDados[]= $_POST["cdprop"];
            $aDados[]= $_POST["deprop"];
            $aDados[]= $_POST["nrinsc"];
            $aDados[]= $_POST["nrccm"];
            $aDados[]= $_POST["deende"];
            $aDados[]= $_POST["nrende"];
            $aDados[]= $_POST["decomp"];
            $aDados[]= $_POST["debair"];
            $aDados[]= $_POST["decida"];
            $aDados[]= $_POST["nrcepi"];
            $aDados[]= $_POST["cdesta"];
            $aDados[]= $_POST["nrtele"];
            $aDados[]= $_POST["nrcelu"];
            $aDados[]= $_POST["demail"];

            if($this->atualizaInfoEmp($aDados, $aNomes, $cod))
            {
                $demens = "Parâmetros atualizados com sucesso!";

            }else{

                $demens = "Ocorreu um problema na atualização. Se persistir contate o suporte!";
            }

            $detitu = "Template Oficina | Parâmetros do Sistema";
            $devolt = "home.php";
            header('Location: mensagem.php?demens='.$demens.'&detitu='.$detitu.'&devolt='.$devolt);
        }


    }

}