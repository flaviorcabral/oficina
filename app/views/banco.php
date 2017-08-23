<?php

function ExcluirDados($tabela, $campo, $chave, $sql="") {
    include "conexao.php";

    if (empty($sql)) {
       $sql = "delete from "."{$tabela}"." where "."{$campo}"." = "."'{$chave}'";
    }

    mysqli_query($conexao, $sql);
    mysqli_close($conexao);

    $cdusua="99999999999";
    $delog = "Exclusão dos dados da tabela ["."{$tabela}"."] para a chave ["."{$chave}"."]";
    if (isset($_COOKIE['cdusua'])) {
        $cdusua = $_COOKIE['cdusua'];
    }

    if ($tabela !== "log") {
        GravarLog($cdusua, $delog);       
    }

    return;
}

function ConsultarDados($tabela, $campo, $chave, $sql="") {
    include "conexao.php";

    if (empty($sql)) {
        $sql = "select * from "."{$tabela}"." where "."{$campo}"." = "."'{$chave}'";
    }

    $aDados=array();

    $resultado=mysqli_query($conexao, $sql);

    if ($resultado) {
        while ($linha = mysqli_fetch_assoc($resultado)) {
            $aDados[]=$linha;
        }
    }

    //mysqli_query($conexao, $sql);
    mysqli_close($conexao);
    return ($aDados);
}

function GravarDados($tabela, $dados, $nomes=null, $tipo="G",$campo=null,$chave=null, $cdclie="0") {
    include "conexao.php";
 
    $sql="insert into "."{$tabela}"." values (";
    $campos="";
    $total=count($dados)-1;

    if ($tipo == "A") {       
        $sql="update "."{$tabela}"." set ";
    }

    for ($i =0 ; $i < count($dados) ; $i++ ) {

        if ($tipo == "A") {
            $campos=$campos.$nomes[$i]." = '".$dados[$i]."'";
        } Else {
            $campos=$campos."'".$dados[$i]."'";
        }
    
        if ($i < $total) {
            $campos=$campos.", ";
        }

    }
    
    if ($tipo == "A") {
        //$campos=$campos;
        if ($cdclie !== "0") {
            $sql=$sql.$campos." where  ".$campo." = "."'{$chave}'"." and cdclie = "."'{$cdclie}'";
        } Else {
            $sql=$sql.$campos." where  ".$campo." = "."'{$chave}'";
        }
    } Else {
        $campos=$campos." )";
        $sql=$sql.$campos;
    }

    mysqli_query($conexao, $sql);
    mysqli_close($conexao);
    return;
}

function AlterarDados($tabela, $dados, $nomes=null, $campo=null, $chave=null, $sql="") {
    include "conexao.php";

    if (empty($sql) == true) {

        $campos="";
        $total=count($dados)-1;

        $sql="update "."{$tabela}"." set ";
 
        for ($i =0 ; $i < count($dados) ; $i++ ) {

            $campos=$campos.$nomes[$i]." = '".$dados[$i]."'";
        
            if ($i < $total) {
                $campos=$campos.", ";
            }

        }
        if ($tabela !== "parametros"){
            $sql=$sql.$campos." where  ".$campo." = "."'{$chave}'";
        } Else {
            $sql=$sql.$campos;
        }
    }

    mysqli_query($conexao, $sql);
    mysqli_close($conexao);

    $cdusua="99999999999";
    $delog = "Alteração dos dados da tabela ["."{$tabela}"."] para a chave ["."{$chave}"."]";
    if (isset($_COOKIE['cdusua'])) {
        $cdusua = $_COOKIE['cdusua'];
    }

    if ($tabela !== "log") {
        GravarLog($cdusua, $delog);       
    }


    return;
}


function IncluirDados($tabela, $dados=null, $nomes=null, $sql="") {
    include "conexao.php";

    if (empty($sql) == true) {

        $sql="insert into "."{$tabela}"." (";
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
    }

    $sql=$sql.$campos;

    mysqli_query($conexao, $sql);
    mysqli_close($conexao);

    $cdusua="99999999999";
    $chave=$dados[0];
    $delog = "Inclusão dos dados da tabela ["."{$tabela}"."] para a chave ["."{$chave}"."]";
    if (isset($_COOKIE['cdusua'])) {
        $cdusua = $_COOKIE['cdusua'];
    }

    if ($tabela !== "log") {
        GravarLog($cdusua, $delog);       
    }

    return;
}



function GravarNovaSenha($demail,$desenh) {
    include "conexao.php";
 
    $sql="update usuarios set desenh = "."'{$desenh}'"." where demail = "."'{$demail}'";

    mysqli_query($conexao, $sql);
    mysqli_close($conexao);
    return;
}

function GravarFerramenta($cdofic, $nrorde, $deposs) {
    include "conexao.php";
 
    $sql = "Update m_ferramentas set deposs = "."'{$deposs}'"." Where cdferr = "."'{$cdofic}'"." and nrorde = "."'{$nrorde}'";
    if ($nrorde == 9999){
        $sql = "Update m_ferramentas set deposs = '' Where cdferr = "."'{$cdofic}'";
    } 

    mysqli_query($conexao, $sql);
    mysqli_close($conexao);

    $cdusua="99999999999";
    $delog = "Atualização dos dados da Lista de Ferramentas para Oficina "."{$cdofic}"." e Item "."{$nrorde}";
    if (isset($_COOKIE['cdusua'])) {
        $cdusua = $_COOKIE['cdusua'];
    }

    GravarLog($cdusua, $delog);

    return;
}

function GravarChecklist($cdchec, $nrchec, $flsim="", $flnao="", $nrsoma=0) {
    include "conexao.php";
 
    $sql = "Update m_checklist set flsim = "."'{$flsim}'".", flnao = "."'{$flnao}'".", nrsoma = "."{$nrsoma}"." Where cdchec = "."'{$cdchec}'"." and nrchec = "."'{$nrchec}'";
    if ($nrchec == 9999){
        $sql = "Update m_checklist set flsim = '', flnao = 'X' Where cdchec = "."'{$cdchec}'";
    } 

    mysqli_query($conexao, $sql);
    mysqli_close($conexao);

    $cdusua="99999999999";
    $delog = "Atualização dos dados de Checklist para Oficina "."{$cdchec}"." e Item "."{$nrchec}";
    if (isset($_COOKIE['cdusua'])) {
        $cdusua = $_COOKIE['cdusua'];
    }

    GravarLog($cdusua, $delog);

    return;
}

Function ConsultarTodos(){
    include "conexao.php";

    $sql = "select cdofic 'cdcodi', deofic 'decodi', demail, deende, nrende, decomp, debair, decida, cdesta, nrcepi, flhomo, flativ, flpend, dtcada, 'Oficina' detipo from m_oficinas";
 
    $aDados=array();

    $resultado1=mysqli_query($conexao, $sql);

    if ($resultado1) {
        while ($linha = mysqli_fetch_assoc($resultado1)) {
            $aDados[]=$linha;
        }
    }

    $sql = "select cdclie 'cdcodi', declie 'decodi', demail, deende, nrende, decomp, debair, decida, cdesta, nrcepi, flhomo, flativ, flpend, dtcada, 'Cliente' detipo from clientes";
    $resultado2=mysqli_query($conexao, $sql);

    if ($resultado2) {
        while ($linha = mysqli_fetch_assoc($resultado2)) {
            $aDados[]=$linha;
        }
    }

    $sql = "select cdmeca 'cdcodi', demeca 'decodi', demail, deende, nrende, decomp, debair, decida, cdesta, nrcepi, flhomo, flativ, flpend, dtcada, 'Mecânico' detipo from m_mecanicos";
    $resultado3=mysqli_query($conexao, $sql);

    if ($resultado3) {
        while ($linha = mysqli_fetch_assoc($resultado3)) {
            $aDados[]=$linha;
        }
    }

    mysqli_close($conexao);
    return ($aDados);
}

Function ConsultarAprovarFotos(){
    include "conexao.php";

    $aDados=array();

    $sql = "select cdclie 'cdcodi', declie 'decodi', demail, dtcada, fluploa, 'Cliente' detipo from clientes";
    $resultado2=mysqli_query($conexao, $sql);

    if ($resultado2) {
        while ($linha = mysqli_fetch_assoc($resultado2)) {
            $aDados[]=$linha;
        }
    }

    $sql = "select cdmeca 'cdcodi', demeca 'decodi', demail, dtcada, fluploa, 'Mecânico' detipo from m_mecanicos";
    $resultado3=mysqli_query($conexao, $sql);

    if ($resultado3) {
        while ($linha = mysqli_fetch_assoc($resultado3)) {
            $aDados[]=$linha;
        }
    }

    mysqli_close($conexao);
    return ($aDados);
}

Function ValidarUpload($tipo) {
    include "conexao.php";

    switch ($tipo) {
    case 'bmp':
        $tipo = "bmp";
        break;
    case 'gif':
        $tipo = "gif";
        break;
    case 'jpeg':
        $tipo = "jpg";
        break;
    case 'png':
        $tipo = "png";
        break;
    case 'plain':
        $tipo = "txt";
        break;
    case 'vnd.openxmlformats-officedocument.wordprocessingml.document':
        $tipo = "doc";
        break;
    case 'msword':
        $tipo = "doc";
        break;
    case 'pdf':
        $tipo = "pdf";
        break;
    case 'vnd.openxmlformats-officedocument.spreadsheetml.sheet':
        $tipo = "xls";
        break;
    case 'vnd.openxmlformats-officedocument.presentationml.presentation':
        $tipo = "ppt";
        break;            
    case 'vnd.ms-excel':
        $tipo = "xls";
        break;
    default:
        break;
    }

    $aPara = ConsultarDados("", "", "", "select * from h_parametros");
    $cTipos = $aPara[0]["tparqui"];

    $aTipos = explode(";", $cTipos);

    $fltipo = false;
    for ($f =0; $f <= (count($aTipos)-1); $f++) {
        $xTipo=$aTipos[$f];
        if ($tipo == $xTipo) {
           $fltipo=true;
        }
    }
    if (empty($tipo) == true){
        $fltipo = true;
    }
    return $fltipo;
}

Function ContaOS($qual){
    include "conexao.php";

    $qtde=0;
    $sql = "select count(cdorde) qtde from ordem where left(cdsitu,1) = '{$qual}'";

    $resultado=mysqli_query($conexao, $sql);

    if ($resultado) {
        while ($linha = mysqli_fetch_assoc($resultado)) {
            $qtde=$linha["qtde"];
        }
    }

    mysqli_close($conexao);
    return ($qtde);
}

Function SomaContas($mes,$tipo){
    include "conexao.php";

    $valor=0;
    if ($tipo == 'P') {
        $sql = "SELECT sum(vlcont) valor FROM `contas` where cdtipo = 'Pagar' and month(dtcont)= {$mes} and year(dtcont) = year(CURRENT_DATE) and (vlpago is null or vlpago <= 0)";
    } Else {
        $sql = "SELECT sum(vlcont) valor FROM `contas` where cdtipo = 'Receber' and month(dtcont)= {$mes} and year(dtcont) = year(CURRENT_DATE) and (vlpago is null or vlpago <= 0)";
    }

    $resultado=mysqli_query($conexao, $sql);

    if ($resultado) {
        while ($linha = mysqli_fetch_assoc($resultado)) {
            $valor=$linha["valor"];
        }
    }

    mysqli_close($conexao);
    return ($valor);
}


?>