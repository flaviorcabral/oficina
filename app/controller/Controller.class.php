<?php

class Controller
{
    public $ordem = null;
    public $itens = null;
    public $cliente = null;
    public $clientes = null;
    public $fornecedor = null;
    public $pecas = null;
    public $servicos = null;
    public $estados = null;

    //Valida acesso ao sistema
    function login()
    {

        if(isset($_REQUEST['login'])){

            $cdusua = preg_replace('/[^[:alnum:]_]/', '', $_POST["cdusua"]);
            $desenh = md5(preg_replace('/[^[:alnum:]_]/', '', $_POST["desenh"]));

            $usuario = new Usuario();

            $result = $usuario->validaAcesso($cdusua);

            if ($result) {

                $senha = $result['desenh'];

                if ($senha == $desenh) {
                    // dados ok
                    $cdusua=$result["cdusua"];
                    $deusua=$result["deusua"];
                    $cdtipo=substr($result["cdtipo"],0,1);
                    $defoto=$result["defoto"];
                    $demail=$result["demail"];

                    setcookie("cdusua",$cdusua);
                    setcookie("deusua",$deusua);
                    setcookie("cdtipo",$cdtipo);
                    setcookie("defoto",$defoto);
                    setcookie("demail",$demail);

                    //$delog = "Acesso ao Sistema"; //Implementar geração de logs
                    //GravarLog($cdusua, $delog);

                    header('Location: app/views/home.php');

                } else {
                    // senha NÃO confere
                    $demens = "A senha não confere. Tente novamente!";
                    $detitu = "Template oficina | Acesso";
                    header('Location: app/views/mensagem.php?demens='.$demens.'&detitu='.$detitu);
                }

            } else {
                // Usuario NÃO encontrado
                $demens = "Usuário não cadastrado ou inativo!";
                $detitu = "Template oficina | Acesso";
                header('Location: app/views/mensagem.php?demens='.$demens.'&detitu='.$detitu);
            }

        }
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

    //Atualiza dados dos usuarios
    function updateDadosUsuario()
    {
        $user = new Usuario();

        $cdusua = $_POST["cdusua"];
        $demail = $_POST["demail"];
        $deusua = $_POST["deusua"];
        $defoto = $_POST["defoto"];
        $tel    = $_POST["nrtele"];

        // tratando o upload da foto
        $uploaddir = '../../templates/img/'.$cdusua;
        $uploadfile = $uploaddir . basename($_FILES['defoto']['name']);

        // upload do arquivo da foto
        move_uploaded_file($_FILES['defoto']['tmp_name'], $uploadfile);

        $defoto1=basename($_FILES['defoto']['name']);

        if (!empty($defoto1) == true) {
            $defoto= $uploadfile;
        }

        if($user->updateUsuario($cdusua,$deusua,$demail,$tel,$defoto))
        {
            setcookie("deusua",$deusua);
            setcookie("defoto",$defoto);
            setcookie("demail",$demail);

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

        if (empty($desenh) == true) {
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

                if($user->updateSenha($cdusua, $desenh))
                {
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

    //Inserir dados tbl ordem
    function insertOrdem($dados, $nomes)
    {
            $ordem = new OrdemServico();

            $sql="insert into "."ordem"." (";
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
        $ordem->insertOrdemServico($sql);

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

        return;
    }

    //Inserir dados tbl ordem intermediaria
    function insertOrdemi($dados, $nomes)
    {
            $ordem = new OrdemServico();

            $sql="insert into "."ordemi"." (";
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
        if($ordem->insertOrdemiServico($sql)) {

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

    //Busca ordem de servido pelo codigo na tbl intemediaria ordemi
    function buscarOrdemTbli($cod)
    {
        $ordem = new OrdemServico();
        $result = $ordem->buscaOrdemi($cod);
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
        $result = $ordem->excluirOrdem($cod);
        return $result;
    }

    //Exluir ordem de serviço tbl intermediaria
    function excluirOrdemiDeServico($cod)
    {
        $ordem = new OrdemServico();
        $result = $ordem->excluirOrdemi($cod);
        return $result;
    }

    //Salvar novo cliente
    function salvarCliente($dados, $nomes)
    {

        $sql="insert into "."clientes"." (";
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

        $cliente = new Cliente();

        $result = $cliente->insertCliente($sql);

        /*$cdusua="99999999999";
        $chave=$dados[0];
        $delog = "Inclusão dos dados da tabela ["."{$tabela}"."] para a chave ["."{$chave}"."]";
        if (isset($_COOKIE['cdusua'])) {
            $cdusua = $_COOKIE['cdusua'];
        }

        if ($tabela !== "log") {
            GravarLog($cdusua, $delog);
        }*/

        return $result;
    }

    //Excluir cliente
    function excluirCliente($cod)
    {
        $cliente = new Cliente();
        $result = $cliente->deleteCliente($cod);
        return $result;
    }
    //BUscar cliente por codigo
    function buscarCliente($codigo)
    {
        $cliente = new Cliente();
        $result = $cliente->buscarCliente($codigo);
        return $result;
    }

    //Atualizar info cliente
    function updateCliente($nomes, $dados, $codigo)
    {
        $campos="";
        $total=count($dados)-1;

        $sql="update "."clientes"." set ";

        for ($i =0 ; $i < count($dados) ; $i++ ) {

            $campos=$campos.$nomes[$i]." = '".$dados[$i]."'";

            if ($i < $total) {
                $campos=$campos.", ";
            }
        }

        $sql=$sql.$campos." where cdclie = "."'{$codigo}'";

        $cliente = new Cliente();

        if($cliente->updateCliente($sql)) {

            /*$cdusua = "99999999999";
            $delog = "Alteração dos dados da tabela clientes  para a chave [" . "{$codigo}" . "]";
            if (isset($_COOKIE['cdusua'])) {
                $cdusua = $_COOKIE['cdusua'];
            }

            if ($tabela !== "log") {
                GravarLog($cdusua, $delog);
            }*/

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

    //Listar todos os serviços
    function listarServicos()
    {
        $serv = new Servico();
        $result = $serv->listarServicos();
        return $result;
    }

    //Salvar novo fornecedor
    function salvarFornecedor($nomes, $dados)
    {


            $sql="insert into "."fornecedores"." (";
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

        $forn = new Fornecedor();

        if($forn->insertFornecedor($sql))
        {

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

    //Listar todos os fornecedores
    function listaFornecedores()
    {
        $forn = new Fornecedor();
        $result = $forn->listarFornecedores();
        return $result;
    }

    //Atualiza infos fornecedor
    function updateFornecedor($nomes, $dados, $codigo)
    {

        $campos="";
        $total=count($dados)-1;

        $sql="update "."fornecedores"." set ";

        for ($i =0 ; $i < count($dados) ; $i++ ) {

            $campos=$campos.$nomes[$i]." = '".$dados[$i]."'";

            if ($i < $total) {
                $campos=$campos.", ";
            }

        }

        $sql=$sql.$campos." where cdforn = "."'{$codigo}'";

        $forn = new Fornecedor();

        if($forn->updateFornecedor($sql))
        {
            /*$cdusua="99999999999";
            $delog = "Alteração dos dados da tabela ["."{$tabela}"."] para a chave ["."{$chave}"."]";
            if (isset($_COOKIE['cdusua'])) {
                $cdusua = $_COOKIE['cdusua'];
            }

            if ($tabela !== "log") {
                GravarLog($cdusua, $delog);
            }*/

            return true;
        }
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
        return $result;
    }

    //Listar todas as peças
    function listarPecas()
    {
        $pecas = new Peca();
        $result = $pecas->listarPecas();
        return $result;
    }

    //Lista estados brasileiros
    function listarEstadosBra()
    {
        $est = new Estados();
        $result = $est->listarEstados();
        return $result;
    }

    //Inserir conta
    function insertConta($nomes, $dados)
    {
        $conta = new Conta();

        $sql="insert into contas"." (";
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

        if($conta->insertConta($sql))
        {
            //Implementar geração de log
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

    //Excluir conta
    function excluirConta($cod)
    {
        $conta = new Conta();
        $result = $conta->excluirConta($cod);
        return $result;
    }

    function traduz_data_para_banco($data)
    {
        if ($data == "") {
            return "";
        }

        $dados = explode("-", $data);

        $data_mysql = "{$dados[2]}-{$dados[1]}-{$dados[0]}";

        return $data_mysql;
    }

    function traduz_data_para_exibir($data)
    {
        if ($data == "" OR $data == "00-00-0000") {
            return "";
        }

        $dados = explode("-", $data);

        $data_exibir = "{$dados[2]}/{$dados[1]}/{$dados[0]}";

        return $data_exibir;
    }

    function preparar_corpo_email_novasenha()
    {
        ob_start();
        include "template_email_novasenha.php";

        $corpo = ob_get_contents();

        ob_end_clean();

        return $corpo;
    }

    function preparar_corpo_email_c()
    {
        ob_start();
        include "template_email_c.php";

        $corpo = ob_get_contents();

        ob_end_clean();

        return $corpo;
    }

    function montar_email() {

        $corpo = "
        <html>
            <head>
                <meta charset=\"utf-8\" />
                <title>Gerenciador de Tarefas</title>
                <link rel=\"stylesheet\" href=\"tarefas.css\" type=\"text/css\" />
            </head>
            <body>
                <h1>Tarefa: {$tarefa['nome']}</h1>

                <p><strong>Concluída:</strong> " . traduz_concluida($tarefa['concluida']) . "</p>
                <p><strong>Descrição:</strong> " . nl2br($tarefa['descricao']) . "</p>
                <p><strong>Prazo:</strong> " . traduz_data_para_exibir($tarefa['prazo']) . "</p>
                <p><strong>Prioridade:</strong> " . traduz_prioridade($tarefa['prioridade']) . "</p>

                {$tem_anexos}

            </body>
        </html>
    ";
    }

    function formatar ($string, $tipo = "")
    {

        //$string = ereg_replace("[^0-9]", "", $string);
        $string = preg_replace("/[^0-9]/", "", $string);

        if (!$tipo)
        {
            switch (strlen($string))
            {
                case 10:    $tipo = 'fone';     break;
                case 8:     $tipo = 'cep';      break;
                case 11:    $tipo = 'cpf';      break;
                case 14:    $tipo = 'cnpj';     break;
            }
        }
        switch ($tipo)
        {
            case 'fone':
                $string = '(' . substr($string, 0, 2) . ') ' . substr($string, 2, 4) .
                    '-' . substr($string, 6);
                break;
            case 'cep':
                $string = substr($string, 0, 5) . '-' . substr($string, 5, 3);
                break;
            case 'cpf':
                //$string = substr($string, 0, 3) . '.' . substr($string, 3, 3) .
                //    '.' . substr($string, 6, 3) . '-' . substr($string, 9, 2);
                break;
            case 'cnpj':
                //$string = substr($string, 0, 2) . '.' . substr($string, 2, 3) .
                //    '.' . substr($string, 5, 3) . '/' .
                //    substr($string, 8, 4) . '-' . substr($string, 12, 2);
                break;
            case 'rg':
                $string = substr($string, 0, 2) . '.' . substr($string, 2, 3) .
                    '.' . substr($string, 5, 3);
                break;
        }
        return $string;
    }

    function formata ($string, $tipo = "")
    {

        //$string = ereg_replace("[^0-9]", "", $string);
        $string = preg_replace("/[^0-9]/", "", $string);

        if (!$tipo)
        {
            switch (strlen($string))
            {
                case 10:    $tipo = 'fone';     break;
                case 8:     $tipo = 'cep';      break;
                case 11:    $tipo = 'cpf';      break;
                case 14:    $tipo = 'cnpj';     break;
            }
        }
        switch ($tipo)
        {
            case 'fone':
                $string = '(' . substr($string, 0, 2) . ') ' . substr($string, 2, 4) .
                    '-' . substr($string, 6);
                break;
            case 'cep':
                $string = substr($string, 0, 5) . '-' . substr($string, 5, 3);
                break;
            case 'cpf':
                $string = substr($string, 0, 3) . '.' . substr($string, 3, 3) .
                    '.' . substr($string, 6, 3) . '-' . substr($string, 9, 2);
                break;
            case 'cnpj':
                $string = substr($string, 0, 2) . '.' . substr($string, 2, 3) .
                    '.' . substr($string, 5, 3) . '/' .
                    substr($string, 8, 4) . '-' . substr($string, 12, 2);
                break;
            case 'rg':
                $string = substr($string, 0, 2) . '.' . substr($string, 2, 3) .
                    '.' . substr($string, 5, 3);
                break;
        }
        return $string;
    }

    function checauf($uf){
        if (!empty($uf)){
            $uf = strtoupper($uf);
            $flag=false;
            $aUF=array("AC", "AL", "AM", "AP", "BA", "CE", "DF", "ES", "GO", "MA", "MG", "MS", "MT", "PA", "PB", "PE", "PI", "PR", "RJ", "RN", "RO", "RR", "RS", "SC", "SE", "SP", "TO");
            if (in_array($uf, $aUF)) {
                $flag=true;
            }
        }
        else {
            $flag=true;
        }
        return ($flag);
    }

    function getIp()
    {

        if (!empty($_SERVER['HTTP_CLIENT_IP']))
        {

            $ip = $_SERVER['HTTP_CLIENT_IP'];

        }
        elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
        {

            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];

        }
        else{

            $ip = $_SERVER['REMOTE_ADDR'];

        }

        return $ip;

    }

    Function Busca_ultimo_dia_mes($mes,$ano) {

        $mes++;
        If ($mes < 10) {
            $mes = "0".$mes;
        }

        $data1 = $ano."-".$mes."-01";
        $data2 = date('Y-m-d', strtotime("-1 days",strtotime($data1)));
        $aData = explode("-", $data2);
        $dia =$aData[2];
        return ($dia);
    }

    Function BuscaNumeroMes($mes) {
        $numero=0;
        $mes=substr($mes, 0,3);

        switch ($mes) {
            case 'Jan':
                $numero="01";
                break;
            case 'Fev':
                $numero="02";
                break;
            case 'Mar':
                $numero="03";
                break;
            case 'Abr':
                $numero="04";
                break;
            case 'Mai':
                $numero="05";
                break;
            case 'Jun':
                $numero="06";
                break;
            case 'Jul':
                $numero="07";
                break;
            case 'Ago':
                $numero="08";
                break;
            case 'Set':
                $numero="09";
                break;
            case 'Out':
                $numero="10";
                break;
            case 'Nov':
                $numero="11";
                break;
            case 'Dez':
                $numero="12";
                break;
            default:
                break;
        };

        return ($numero);
    }

    function mask($val, $mask)
    {
        $maskared = '';
        $k = 0;
        for($i = 0; $i<=strlen($mask)-1; $i++)
        {
            if($mask[$i] == '#')
            {
                if(isset($val[$k]))
                    $maskared .= $val[$k++];
            }
            else
            {
                if(isset($mask[$i]))
                    $maskared .= $mask[$i];
            }
        }
        return $maskared;
    }

    function enviar_email($paraquem, $dequem, $assunto, $corpo) {

        //include "lib/PHPMailer/PHPMailerAutoload.php";

        //require 'lib/PHPMailer/PHPMailerAutoload.php';

        include("../../lib/PHPMailer/class.phpmailer.php");
        include("../../lib/PHPMailer/class.smtp.php");

        $email = new PHPMailer(); // Esta é a criação do objeto
        $email->CharSet = 'UTF-8';
        $email->isSMTP();
        $email->Host = "mail.everdeeninformatica.com.br";
        $email->Port = 587;
        $email->SMTPSecure = 'TSL';
        $email->SMTPAuth = true;
        $email->Username = "suporte@everdeeninformatica.com.br";
        $email->Password = "palio2001";
        $email->setFrom($dequem,"Everdeen Informática");

        // Digitar o e-mail do destinatário;
        $email->addAddress($paraquem);

        // Digitar o assunto do e-mail;
        $email->Subject = $assunto;

        //Escrever o corpo do e-mail;
        //$corpo = preparar_corpo_email($tarefa, $anexos);
        $email->msgHTML($corpo);

        // Usar a opção de enviar o e-mail.
        $email->send();
        //if ($email->send()){
        //echo "enviado";
        //}
        //else {
        //echo "Mensagem de erro: " . $email->ErrorInfo;
        //}

        return;
    }

    function get_post_action($name)
    {
        $aDados=array();
        $params = func_get_args();

        //print_r($params);

        foreach ($params as $name) {
            if (isset($_POST[$name])) {
                return $name;
            }
        }
    }

    function e_numero($val) {
        $flag=false;
        if (is_numeric($val)) {
            $flag=true;
        }
        return $flag;
    }

    function Traz_Data_Por_Extenso($hoje=null) {

        if (empty($hoje)) {
            $hoje = getdate();
        }

        $meses = array (1 => "Janeiro", 2 => "Fevereiro", 3 => "Março", 4 => "Abril", 5 => "Maio", 6 => "Junho", 7 => "Julho", 8 => "Agosto", 9 => "Setembro", 10 => "Outubro", 11 => "Novembro", 12 => "Dezembro");

        $diasdasemana = array (1 => "Segunda-Feira",2 => "Terça-Feira",3 => "Quarta-Feira",4 => "Quinta-Feira",5 => "Sexta-Feira",6 => "Sábado",0 => "Domingo");

        //$hoje = getdate();

        $dia = $hoje["mday"];

        $mes = $hoje["mon"];

        $nomemes = $meses[$mes];

        $ano = $hoje["year"];

        $diadasemana = $hoje["wday"];

        $nomediadasemana = $diasdasemana[$diadasemana];

        $data= "$nomediadasemana, $dia de $nomemes de $ano";

        return ($data);
    }

    function Traz_Mes_Data($hoje=null) {

        $meses = array (1 => "Janeiro", 2 => "Fevereiro", 3 => "Março", 4 => "Abril", 5 => "Maio", 6 => "Junho", 7 => "Julho", 8 => "Agosto", 9 => "Setembro", 10 => "Outubro", 11 => "Novembro", 12 => "Dezembro");

        if (empty($hoje)) {
            $hoje = getdate();
        }

        $dia = $hoje["mday"];

        $mes = $hoje["mon"];

        $nomemes = $meses[$mes];

        return($nomemes);
    }

    function validaCPF($cpf)
    {
        return true;
        // Verifiva se o número digitado contém todos os digitos
        //$cpf = str_pad(ereg_replace('[^0-9]', '', $cpf), 11, '0', STR_PAD_LEFT);
        $cpf = str_pad(preg_replace('/[^0-9]/', '', $cpf), 11, '0', STR_PAD_LEFT);

        // Verifica se nenhuma das sequências abaixo foi digitada, caso seja, retorna falso
        if (strlen($cpf) != 11 || $cpf == '00000000000' || $cpf == '11111111111' || $cpf == '22222222222' || $cpf == '33333333333' || $cpf == '44444444444' || $cpf == '55555555555' || $cpf == '66666666666' || $cpf == '77777777777' || $cpf == '88888888888' || $cpf == '99999999999')
        {
            //return false;
            return true;
        }
        else
        {   // Calcula os números para verificar se o CPF é verdadeiro
            for ($t = 9; $t < 11; $t++) {
                for ($d = 0, $c = 0; $c < $t; $c++) {
                    $d += $cpf{$c} * (($t + 1) - $c);
                }

                $d = ((10 * $d) % 11) % 10;

                if ($cpf{$c} != $d) {
                    //return false;
                    return true;
                }
            }

            return true;
        }
    }

    function validaCNPJ ( $cnpj ) {
        return true;
        // Deixa o CNPJ com apenas números
        //$cnpj = preg_replace( '/[^0-9]/', '', $cnpj );
        $cnpj = preg_replace( '/[^0-9]/', '', $cnpj );

        // Garante que o CNPJ é uma string
        $cnpj = (string)$cnpj;

        // O valor original
        $cnpj_original = $cnpj;

        // Captura os primeiros 12 números do CNPJ
        $primeiros_numeros_cnpj = substr( $cnpj, 0, 12 );

        /**
         * Multiplicação do CNPJ
         *
         * @param string $cnpj Os digitos do CNPJ
         * @param int $posicoes A posição que vai iniciar a regressão
         * @return int O
         *
         */
        if ( ! function_exists('multiplica_cnpj') ) {
            function multiplica_cnpj( $cnpj, $posicao = 5 ) {
                // Variável para o cálculo
                $calculo = 0;

                // Laço para percorrer os item do cnpj
                for ( $i = 0; $i < strlen( $cnpj ); $i++ ) {
                    // Cálculo mais posição do CNPJ * a posição
                    $calculo = $calculo + ( $cnpj[$i] * $posicao );

                    // Decrementa a posição a cada volta do laço
                    $posicao--;

                    // Se a posição for menor que 2, ela se torna 9
                    if ( $posicao < 2 ) {
                        $posicao = 9;
                    }
                }
                // Retorna o cálculo
                return $calculo;
            }
        }

        // Faz o primeiro cálculo
        $primeiro_calculo = multiplica_cnpj( $primeiros_numeros_cnpj );

        // Se o resto da divisão entre o primeiro cálculo e 11 for menor que 2, o primeiro
        // Dígito é zero (0), caso contrário é 11 - o resto da divisão entre o cálculo e 11
        $primeiro_digito = ( $primeiro_calculo % 11 ) < 2 ? 0 :  11 - ( $primeiro_calculo % 11 );

        // Concatena o primeiro dígito nos 12 primeiros números do CNPJ
        // Agora temos 13 números aqui
        $primeiros_numeros_cnpj .= $primeiro_digito;

        // O segundo cálculo é a mesma coisa do primeiro, porém, começa na posição 6
        $segundo_calculo = multiplica_cnpj( $primeiros_numeros_cnpj, 6 );
        $segundo_digito = ( $segundo_calculo % 11 ) < 2 ? 0 :  11 - ( $segundo_calculo % 11 );

        // Concatena o segundo dígito ao CNPJ
        $cnpj = $primeiros_numeros_cnpj . $segundo_digito;

        // Verifica se o CNPJ gerado é idêntico ao enviado
        if ( $cnpj === $cnpj_original ) {
            return true;
        }
    }

    function GerarSenha($tamanho = 8, $maiusculas = true, $numeros = true, $simbolos = false) {
        $lmin = 'abcdefghijklmnopqrstuvwxyz';
        $lmai = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $num = '1234567890';
        $simb = '!@#$%*-';
        $retorno = '';
        $caracteres = '';
        $caracteres .= $lmin;
        if ($maiusculas) $caracteres .= $lmai;
        if ($numeros) $caracteres .= $num;
        if ($simbolos) $caracteres .= $simb;
        $len = strlen($caracteres);
        for ($n = 1; $n <= $tamanho; $n++) {
            $rand = mt_rand(1, $len);
            $retorno .= $caracteres[$rand-1];
        }
        return $retorno;
    }

    function EnviarEmail($paraquem, $dequem, $assunto, $corpo) {

        //include "lib/PHPMailer/PHPMailerAutoload.php";

        //require 'lib/PHPMailer/PHPMailerAutoload.php';

        include("../../lib/PHPMailer/class.phpmailer.php");
        include("../../lib/PHPMailer/class.smtp.php");

        //$dequem="dataagro@dataagro.com.br";

        $aPara = ConsultarDados("parametros", "", "","select * from parametros");
        $demaile=$aPara[0]["demaile"];
        $desenhe=$aPara[0]["desenhe"];

        $email = new PHPMailer(); // Esta é a criação do objeto
        $email->CharSet = 'UTF-8';
        $email->isSMTP();
        $email->Host = "mail.rcx5plasticos.com.br";
        $email->Port = 587;
        $email->SMTPSecure = 'TSL';
        $email->SMTPAuth = true;
        //$email->Username = "dataagro@dataagro.com.br";
        $email->Username = $demaile;
        $email->Password = $desenhe;
        $email->setFrom($dequem,"H2O Hybrid");

        // Digitar o e-mail do destinatário;
        $email->addAddress($paraquem);

        // Digitar o assunto do e-mail;
        $email->Subject = $assunto;

        //Escrever o corpo do e-mail;
        //$corpo = preparar_corpo_email($tarefa, $anexos);
        $email->msgHTML($corpo);

        // Usar a opção de enviar o e-mail.
        $email->send();
        //if ($email->send()){
        //    echo "enviado";
        //}
        //else {
        //    echo "Mensagem de erro: " . $email->ErrorInfo;
        //}

        return;
    }

    function RetirarMascara($key,$tipo) {
        if (empty($key) == true) {
            //$key=str_replace(".","",$key);
            //$key=str_replace("/","",$key);
            //$key=str_replace("-","",$key);
            if ($tipo == "cpf") {
                $key = str_pad(preg_replace('/[^0-9]/', '', $key), 11, '0', STR_PAD_LEFT);
                //$key=str_pad($key, 11, "0", STR_PAD_LEFT);
            } Else {
                $key = str_pad(preg_replace('/[^0-9]/', '', $key), 14, '0', STR_PAD_LEFT);
            }
        }
        return ($key);
    }

    function GravarIPLog($cdusua, $delog) {
        include "conexao.php";

        $data=date('Y-m-d H:i:s');
        $ip=getIp();

        $sql="insert iplog (dtlog, delog, ip, cdusua) values ("."'{$data}'".","."'{$delog}'".","."'{$ip}'".","."'{$cdusua}'".")";

        mysqli_query($conexao, $sql);
        mysqli_close($conexao);

        return;
    }

    function GravarLog($cdusua, $delog) {

        $dtlog=date('Y-m-d H:i:s');
        $iplog=getIp();

        $aNomes=array();
        $aNomes[]="cdusua";
        $aNomes[]="dtlog";
        $aNomes[]="delog";
        $aNomes[]="iplog";
        $aNomes[]="flativ";

        $aDados=array();
        $aDados[]= $cdusua;
        $aDados[]= $dtlog;
        $aDados[]= $delog;
        $aDados[]= $iplog;
        $aDados[]= "S";

        IncluirDados("log", $aDados, $aNomes);

        return;
    }

    function BuscaChaveArray($aDados, $chave) {
        $aMatriz=array();
        foreach ($aDados as $surname => $names) {
            if (in_array($chave, $names)) {
                $aMatriz = $names;
                return $aMatriz;
            }
        }
        return $aMatriz;
    }

    function data_info(){
        $dia = date("j")-1;
        $hora = date("H")-3;
        $minuto = date("i");
        $segundo = date("s");

        $semana = array(0 => "Domingo",1 => "Segunda", 2 => "Terça", 3 => "Quarta",  4 => "Quinta", 5 => "Sexta",  6 => "Sábado");
        $mes = array(1 => "Janeiro",  2 => "Fevereiro",  3 => "Março", 4 => "Abril", 5 => "Maio", 6 => "Junho", 7 => "Julho", 8 => "Agosto", 9 => "Setembro", 10 => "Outubro",  11 => "Novembro", 12 => "Dezembro");

        $ano = date("Y");
        $data_completa = date("d/m/y");
        $hora_completa = $hora.":".$minuto.":".$segundo;
        $misc = $semana[date("w")].", ".date("j")." de ".$mes[date("n")]." de ".date("Y");
        return;
    }

    function data($data,$formato=12){
        $hora = $formato == 12 ? "h" : "H";
        $am_pm = (date("H",strtotime($data)) < 12) ? " AM" : " PM";
        $am_pm = $formato == 24 ? "" : $am_pm;
        if(date('d/m/Y', strtotime($data)) == date('d/m/Y')){
            return date("$hora:i",strtotime($data)).$am_pm;
        }
        else if(date('m/Y', strtotime($data)) == date('m/Y') && date("d", strtotime($data)) == date("d")-1){
            return "Ontem às ".date("$hora:i",strtotime($data)).$am_pm;
        }
        else if(date('m/Y', strtotime($data)) == date('m/Y') && date("d", strtotime($data)) == date("d")+1){
            return "Amanha às ".date("$hora:i",strtotime($data)).$am_pm;
        }
        else{
            return date("d/m/Y",strtotime($data));
        }
    }

    //Funçoes pagina login
    function pagLogin()
    {

        $this->login();

    }

    //Funcoes pagina meus dados e senha
    function pagsMeusDados()
    {
        if(isset($_REQUEST['atualiza']))
        {
            if($this->updateDadosUsuario()){

                //$delog = "Alteração de Próprios Dados (Nome/Foto/E-Mail)";
                //GravarLog($cdusua, $delog);

                //gravar log
                //GravarIPLog($cdusua, "Alterar Meus Dados:");

                $demens = "Cadastro atualizado com sucesso!";

            }else{
                $demens = "Ocorreu um problema durante atualização de dados. Se persistir contate o Suporte!";
            }

            $detitu = "Template Oficina | Meus Dados";
            $devolt = "home.php";
            header('Location: mensagem.php?demens='.$demens.'&detitu='.$detitu.'&devolt='.$devolt);
        }

        if(isset($_REQUEST['atualizaSenha']))
        {

            if ($this->updateSenhaUsuario()) {

                //GravarIPLog($cdusua, "Alterar Senha");
                //$delog = "Alteração da Própria Senha";
                //GravarLog($cdusua, $delog);

                $demens = "Senha atualizada com sucesso!";

            }else{
                $demens = "Ocorreu um problema durante atualização de senha. Se persistir contate o Suporte!";
            }

            $detitu = "Template Oficina | Alterar Senha";
            $devolt = "home.php";
            header('Location: mensagem.php?demens=' . $demens . '&detitu=' . $detitu . '&devolt=' . $devolt);
        }
    }

    //Funcoes pagina ordem de serviço
    public function pagOrdemServico()
    {
        $acao = $_REQUEST['acao'];

        if($acao == 'nova')
        {
            $this->clientes = $this->listarClientes();
            $this->pecas= $this->listarPecas();
            $this->servicos= $this->listarServicos();
        }

        if($acao == 'ver' or $acao == 'edita' or $acao == 'apaga')
        {
            $chave = $_REQUEST['chave'];
            $this->ordem = $this->buscarOrdem($chave);
            $this->itens = $this->buscarOrdemTbli($chave);
            $this->clientes = $this->listarClientes();
            $this->pecas= $this->listarPecas();
            $this->servicos= $this->listarServicos();
        }

        if(isset($_REQUEST['editar']))
        {
            $cdorde = $_REQUEST["cdorde"];

            $this->excluirOrdemDeServico($cdorde);
            //ExcluirDados("ordem", "cdorde", $cdorde);

            $this->excluirOrdemiDeServico($cdorde);
            //ExcluirDados("ordemi", "cdorde", $cdorde);

            $this->excluirConta($cdorde);
            //ExcluirDados("", "", "","delete from contas where cdtipo ='Pagar' and cdorig = '{$cdorde}'");

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

                $primeiro = $codItem[$f];
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

            if ($Flag == true) {

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
                $aDados[] = $_POST["qtform"];
                $aDados[] = $vlpago;
                $aDados[] = $_POST["dtpago"];
                $aDados[] = $_POST["deobse"];
                $aDados[] = 'Sim';
                $aDados[] = $dtcada;

                $this->insertOrdem($aDados, $aNomes);
                //IncluirDados("ordem", $aDados, $aNomes);

                $nritem = 1;
                for ($f = 1; $f <= 20; $f++) {

                    $primeiro = $codItem[$f];
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

                        $this->insertOrdemi($aDados, $aNomes);
                        //IncluirDados("ordemi", $aDados, $aNomes);
                    }
                }

                $result = $this->buscarOrdemCindice($cdorde);
                // ConsultarDados("", "", "","select * from ordem where cdorde = '{$cdorde}'");

                $dtorde = $result[0]["dtorde"];
                $qtform = $result[0]["qtform"];

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

                    $this->insertConta($aNomes, $aDados);
                    //IncluirDados("contas", $aDados, $aNomes);
                }

                $demens = "Alteração efetuada com sucesso!";
                $detitu = "Template Oficinas | Cadastro de OS";
                $devolt = "ordem.php";
                header('Location: mensagem.php?demens=' . $demens . '&detitu=' . $detitu . '&devolt=' . $devolt);
            }

        }

        if(isset($_REQUEST['apagar']))
        {
            $cdorde = $_REQUEST["cdorde"];

            if ($this->excluirOrdemDeServico($cdorde) and $this->excluirOrdemiDeServico($cdorde) and  $this->excluirConta($cdorde)){
                $demens = "Exclusão efetuada com sucesso!";

            }else{
                $demens = "Ocorreu um problema durante exclusão da O.S. Se persistir contate o Suporte!";
            }

            $detitu = "Template Oficinas | Cadastro de OS";
            $devolt = "ordem.php";
            header('Location: mensagem.php?demens=' . $demens . '&detitu=' . $detitu . '&devolt=' . $devolt);
        }

        if(isset($_REQUEST['salvar']))
        {
            $dtcada = date('Y-m-d');
            $Flag = true;

            $aCditem=$_POST["cditem"];
            $aQtitem=$_POST["qtitem"];
            $aVlitem=$_POST["vlitem"];
            $cdclie = $_POST["cdclie"];
            $dtorde = $_POST["dtorde"];
            $vlorde = $_POST["vlorde"];
            $vlpago = $_POST["vlpago"];
            $vlorde = str_replace(".","",$vlorde);
            $vlorde = str_replace(",",".",$vlorde);
            $vlpago = str_replace(".","",$vlpago);
            $vlpago = str_replace(",",".",$vlpago);
            $qtitem = 0;

            for ($f =1; $f <= 20; $f++) {

                $primeiro = $aCditem[$f];
                $aPrimeiro = explode("|", $aCditem[$f]);
                if ($aPrimeiro[0] !== 'X'){
                    $qtitem++;
                }
            }

            if ( $qtitem <= 0) {

                $demens = "É preciso informar os itens da O.S.!";
                $detitu = "Template Oficina | Lançamendo de Ordem de serviço";
                header('Location: mensagem.php?demens='.$demens.'&detitu='.$detitu);
                $Flag=false;
            }

            if ( empty($cdclie) == true) {

                $demens = "É preciso informar o cliente!";
                $detitu = "Template Oficina | Lançamendo de Ordem de serviço";
                header('Location: mensagem.php?demens='.$demens.'&detitu='.$detitu);
                $Flag=false;
            }

            if ( empty(strtotime($dtorde)) == true) {

                $demens = "É preciso informar a data de abertura O.S.!";
                $detitu = "Template Oficina | Lançamendo de Ordem de serviço";
                header('Location: mensagem.php?demens='.$demens.'&detitu='.$detitu);
                $Flag=false;
            }

            if ($Flag == true) {

                //campos da tabela
                $aNomes=array();
                $aNomes[]= "cdclie";
                $aNomes[]= "veplac";
                $aNomes[]= "vemarc";
                $aNomes[]= "vemode";
                $aNomes[]= "veanom";
                $aNomes[]= "veanof";
                $aNomes[]= "vecorv";
                $aNomes[]= "cdsitu";
                $aNomes[]= "dtorde";
                $aNomes[]= "vlorde";
                $aNomes[]= "cdform";
                $aNomes[]= "qtform";
                $aNomes[]= "vlpago";
                $aNomes[]= "dtpago";
                $aNomes[]= "deobse";
                $aNomes[]= "flativ";
                $aNomes[]= "dtcada";

                //dados da tabela
                $aDados=array();
                $aDados[]= $_POST["cdclie"];
                $aDados[]= $_POST["veplac"];
                $aDados[]= $_POST["vemarc"];
                $aDados[]= $_POST["vemode"];
                $aDados[]= $_POST["veanom"];
                $aDados[]= $_POST["veanof"];
                $aDados[]= $_POST["vecorv"];
                $aDados[]= $_POST["cdsitu"];
                $aDados[]= $_POST["dtorde"];
                $aDados[]= $vlorde;
                $aDados[]= $_POST["cdform"];
                $aDados[]= $_POST["qtform"];
                $aDados[]= $vlpago;
                $aDados[]= $_POST["dtpago"];
                $aDados[]= $_POST["deobse"];
                $aDados[]= 'Sim';
                $aDados[]= $dtcada;

                $this->insertOrdem($aDados, $aNomes);
                //IncluirDados("ordem", $aDados, $aNomes);

                $result = $this->buscarMaiorOrdemPorCliente($cdclie, $dtorde);
                //$cliente= ConsultarDados("", "", "","select max(cdorde) cdorde from ordem where cdclie = '{$cdclie}' and dtorde = '{$dtorde}'");

                $cdorde = $result[0]["cdorde"];

                $nritem=1;
                for ($f =1; $f <= 20; $f++) {

                    $primeiro = $aCditem[$f];
                    $aPrimeiro = explode("|", $aCditem[$f]);

                    if ($aPrimeiro[0] !== 'X'){
                        $cdpeca = $aPrimeiro[2];
                        $qtpeca = $aQtitem[$f];
                        $vlpeca = $aVlitem[$f];
                        $vltota = $qtpeca*$vlpeca;

                        $aNomes=array();
                        $aNomes[]= "cdorde";
                        $aNomes[]= "nritem";
                        $aNomes[]= "cdpeca";
                        $aNomes[]= "qtpeca";
                        $aNomes[]= "vlpeca";
                        $aNomes[]= "vltota";

                        $aDados=array();
                        $aDados[]= $cdorde;
                        $aDados[]= $nritem++;
                        $aDados[]= $cdpeca;
                        $aDados[]= $qtpeca;
                        $aDados[]= $vlpeca;
                        $aDados[]= $vltota;

                        $this->insertOrdemi($aDados, $aNomes);
                        //IncluirDados("ordemi", $aDados, $aNomes);
                    }
                }
                //$aTrab= ConsultarDados("", "", "","select * from ordem where cdorde = '{$cdorde}'");
                $result = $this->buscarOrdem($cdorde);

                $dtorde = $result[0]["dtorde"];
                $qtform = $result[0]["qtform"];

                for ($f =1; $f <= $qtform; $f++) {

                    $vlcont = $result[0]["vlorde"]/$qtform;
                    $dtcont=strtotime($dtorde . "+ {$f} months");
                    $dtcont=date("Y-m-d", $dtcont);

                    $aNomes=array();
                    $aNomes[]= "decont";
                    $aNomes[]= "dtcont";
                    $aNomes[]= "vlcont";
                    $aNomes[]= "cdtipo";
                    $aNomes[]= "cdquem";
                    $aNomes[]= "cdorig";
                    $aNomes[]= "flativ";
                    $aNomes[]= "dtcada";

                    $aDados=array();
                    $aDados[]= 'Cliente a Receber';
                    $aDados[]= $dtcont;
                    $aDados[]= $vlcont;
                    $aDados[]= 'Receber';
                    $aDados[]= $result[0]["cdclie"];
                    $aDados[]= $result[0]["cdorde"];
                    $aDados[]= 'Sim';
                    $aDados[]= $dtcada;

                    $this->insertConta($aNomes,$aDados);
                    //IncluirDados("contas", $aDados, $aNomes);
                }

                $demens = "Cadastro efetuado com sucesso!";
                $detitu = "Template Oficina | Cadastro de OS";
                $devolt = "ordem.php";
                header('Location: mensagem.php?demens='.$demens.'&detitu='.$detitu.'&devolt='.$devolt);
            }
        }
    }

    //Funcoes pagina cliente
    function pagCliente()
    {
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

            if (isset($_REQUEST['editar']))
            {
                $cdclie = $_POST["cdclie"];

                if (strlen($cdclie) < 12) {
                    $cdclie = $this->RetirarMascara($cdclie, "cpf");
                    if ($this->validaCPF($cdclie) == false) {
                        $demens = "Cpf inválido!";
                        $detitu = "Template Oficina | Cadastro de Clientes";
                        header('Location: mensagem.php?demens=' . $demens . '&detitu=' . $detitu);
                        $flag = false;
                    }
                } Else {
                    $cdclie = $this->RetirarMascara($cdclie, "cnpj");
                    if ($this->validaCNPJ($cdclie) == false) {
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

                    $aNomes[]= "cdclie";
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
                    $aDados[]= $_POST["cdclie"];
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

                    //AlterarDados("clientes", $aDados, $aNomes, "cdclie", $cdclie);
                    if($this->updateCliente($aNomes, $aDados, $chave)){
                        //gravar log
                        //GravarIPLog($cdusua, "Alterar Meus Dados:");

                        if ($flag2 == false) {
                            $demens = "Atualização efetuada com sucesso!";
                        }
                    }else{
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
                //ExcluirDados("clientes", "cdclie", $cdclie);

                if ($flag2 == false and $result == true) {

                    //gravar log
                    //GravarIPLog($cdusua, "Alterar Meus Dados:");

                    $demens = "Exclusão efetuada com sucesso!";

                }else{
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
                    $cdclie = $this->RetirarMascara($cdclie, "cpf");
                    if ($this->validaCPF($cdclie) == false) {
                        $demens = "Cpf inválido!";
                        $detitu = "Template Oficina | Cadastro de Clientes";
                        header('Location: mensagem.php?demens=' . $demens . '&detitu=' . $detitu);
                        $Flag = false;
                    }
                } Else {
                    $cdclie = $this->RetirarMascara($cdclie, "cnpj");
                    if ($this->validaCNPJ($cdclie) == false) {
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


                    if($this->salvarCliente($aDados, $aNomes))
                    {
                        //gravar log
                        //GravarIPLog($cdusua, "Alterar Meus Dados:");

                        $demens = "Cadastro efetuado com sucesso!";

                    }else{
                        $demens = "Ocorreu um problema durante tentativa de Salvar. Se persistir contate o Suporte!";
                    }
                }

                $detitu = "Template Oficina | Cadastro de Clientes";
                $devolt = "cliente.php";
                header('Location: mensagem.php?demens=' . $demens . '&detitu=' . $detitu . '&devolt=' . $devolt);

            }

        }
    }

    //Funcoes pagina fornecedores
    function pagFornecedor()
    {
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
                    $cdforn = $this->RetirarMascara($cdforn, "cpf");
                    if ($this->validaCPF($cdforn) == false) {
                        $demens = "Cpf inválido!";
                        $detitu = "Template Oficina | Cadastro de Clientes";
                        header('Location: mensagem.php?demens=' . $demens . '&detitu=' . $detitu);
                        $flag = false;
                    }
                } Else {
                    $cdforn = $this->RetirarMascara($cdforn, "cnpj");
                    if ($this->validaCNPJ($cdforn) == false) {
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

                    if ($this->updateFornecedor($aNomes, $aDados, $chave)) {
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

                    //gravar log
                    //GravarIPLog($cdusua, "Alterar Meus Dados:");
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

            if (isset($_REQUEST['salvar']))
            {

                $data = date('Y-m-d');
                $cdforn = $_POST["cdforn"];
                $demail = $_POST["demail"];
                $Flag = true;

                if (strlen($cdforn) < 12) {

                    $cdforn = $this->RetirarMascara($cdforn, "cpf");

                    if ($this->validaCPF($cdforn) == false) {
                        $demens = "Cpf inválido!";
                        $detitu = "Template Oficina | Cadastro de fornecedores";
                        header('Location: mensagem.php?demens=' . $demens . '&detitu=' . $detitu);
                        $Flag = false;
                    }
                } Else {

                    $cdforn = $this->RetirarMascara($cdforn, "cnpj");

                    if ($this->validaCNPJ($cdforn) == false) {
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

                    //IncluirDados("fornecedores", $aDados, $aNomes);

                    if($this->salvarFornecedor($aNomes, $aDados))
                    {
                        //gravar log
                        //GravarIPLog($cdusua, "Alterar Meus Dados:");

                        $demens = "Cadastro efetuado com sucesso!";

                    }else{
                        $demens = "Ocorreu um problema na tentativa de Salvar. Se persistir contate o Suporte!";
                    }
                }

                $detitu = "Template Oficina | Cadastro de fornecedores";
                $devolt = "fornecedores.php";
                header('Location: mensagem.php?demens=' . $demens . '&detitu=' . $detitu . '&devolt=' . $devolt);

            }
        }
    }
}