<?php

    // identificando dispositivo
    $iphone = strpos($_SERVER['HTTP_USER_AGENT'],"iPhone");
    $ipad = strpos($_SERVER['HTTP_USER_AGENT'],"iPad");
    $android = strpos($_SERVER['HTTP_USER_AGENT'],"Android");
    $palmpre = strpos($_SERVER['HTTP_USER_AGENT'],"webOS");
    $berry = strpos($_SERVER['HTTP_USER_AGENT'],"BlackBerry");
    $ipod = strpos($_SERVER['HTTP_USER_AGENT'],"iPod");
    $symbian =  strpos($_SERVER['HTTP_USER_AGENT'],"Symbian");

    $eMovel="N";
    if ($iphone || $ipad || $android || $palmpre || $ipod || $berry || $symbian == true) {
        $eMovel="S";
    }

    // incluindo bibliotecas de apoio
    include "banco.php";
    include "util.php";

    $acao = $_GET["acao"];
    $chave = trim($_GET["chave"]);

    switch ($acao) {
    case 'ver':
        $titulo = "Consulta";
        break;
    case 'edita':
        $titulo = "Alteração";
        break;
    case 'apaga':
        $titulo = "Exclusão";
        break;
    default:
        header('Location: ordem.php');
    }

    //codigo do usuario
    if (isset($_COOKIE['cdusua'])) {
        $cdusua = $_COOKIE['cdusua'];
    }

    // nome do usuario
    if (isset($_COOKIE['deusua'])) {
        $deusua = $_COOKIE['deusua'];
    }

    //localização da foto
    if (isset($_COOKIE['defoto'])) {
        $defoto = $_COOKIE['defoto'];
    }

    //tipo de usuario
    if (isset($_COOKIE['cdtipo'])) {
        $cdtipo = $_COOKIE['cdtipo'];
    }

    //email de usuario
    if (isset($_COOKIE['demail'])) {
        $demail = $_COOKIE['demail'];
    }

    $detipo="Tipo Não Identificado";
    if ($cdtipo == "A") {
        $detipo="Administrador";
    }
    if ($cdtipo == "R") {
        $detipo="Representante";
    }
    if ($cdtipo == "O") {
        $detipo="Oficina";
    }
    if ($cdtipo == "M") {
        $detipo="Mecânico";
    }
    if ($cdtipo == "C") {
        $detipo="Cliente";
    }

    // reduzir o tamanho do nome do usuario
    $deusua1=$deusua;
    $deusua = substr($deusua, 0,15);

    $aOrde = ConsultarDados("m_ordem", "cdorde", $chave);
    $cdclie = $aOrde[0]["cdclie"];

    $aClie = ConsultarDados("m_clientes", "cdclie", $cdclie);
    $declie = $aClie[0]["declie"];

    $dtemis = $aOrde[0]["dtemis"];
    $dtemis = strtotime($dtemis);
    $dtemis = date("d-m-Y", $dtemis);

    $cdorde = $aOrde[0]["cdorde"];
    $nrnota = $aOrde[0]["nrnota"];
    $vlserv = $aOrde[0]["vlserv"];
    $vlpeca = $aOrde[0]["vlpeca"];
    $vlimpo = $aOrde[0]["vlimpo"];
    $vltota = $aOrde[0]["vltota"];
    $vloutr = $aOrde[0]["vloutr"];
    $flcanc = $aOrde[0]["flcanc"];
    $flpago = $aOrde[0]["flpago"];
    $flstat = $aOrde[0]["flstat"]; 

    $vlserv= str_replace(".",",",$vlserv);
    $vlpeca= str_replace(".",",",$vlpeca);
    $vlimpo= str_replace(".",",",$vlimpo);
    $vloutr= str_replace(".",",",$vloutr);
    $vltota= str_replace(".",",",$vltota);

    $aPeca = ConsultarDados("", "", "", "select * from m_pecas");
    $aServ = ConsultarDados("", "", "", "select * from m_servicos");

    $aPara = ConsultarDados("", "", "", "select * from m_parametros");
    $iss=$aPara[0]["iss"]/100;
    $inss=$aPara[0]["inss"]/100;
    $irrf=$aPara[0]["irrf"]/100;
    $pis=$aPara[0]["pis"]/100;

?>
<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Nova Aliança Auto Mecânica&copy; | Principal </title>

    <link href="../../templates/css/bootstrap.min.css" rel="stylesheet">
    <link href="../../templates/font-awesome/css/font-awesome.css" rel="stylesheet">

    <link href="../../templates/css/animate.css" rel="stylesheet">
    <link href="../../templates/css/style.css" rel="stylesheet">

</head>

<body>
    <div id="wrapper">
        <nav class="navbar-default navbar-static-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav metismenu" id="side-menu">
                    <li class="nav-header">
                        <div class="dropdown profile-element"> <span>
                                <img alt="foto" width="80" height="80" class="img-circle" src="<?php echo $defoto; ?>" />
                                 </span>
                            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold"><?php echo $deusua; ?></strong>
                                 </span> <span class="text-muted text-xs block"><?php echo $detipo; ?><b class="caret"></b></span> </span> </a>
                            <ul class="dropdown-menu animated fadeInRight m-t-xs">
                                <li><a href="meusdados.php">Atualizar Meus Dados</a></li>
                                <li><a href="minhasenha.php">Alterar Minha Senha</a></li>
                                <li class="divider"></li>
                                <li><a href="../../index.php">Sair</a></li>
                            </ul>
                        </div>
                    </li>

                    <li>
                        <a href="home.php"><i class="fa fa-home"></i> <span class="nav-label">Menu Principal</span></a>
                    </li>                    

                </ul>
            </div>
        </nav>

        <div id="page-wrapper" class="gray-bg">
            <div class="row border-bottom">
                <nav class="navbar navbar-static-top white-bg" role="navigation" style="margin-bottom: 0">
                    <div class="navbar-header">
                        <a class="navbar-minimalize minimalize-styl-2 btn btn-warning " href="#"><i class="fa fa-bars"></i> </a>
                    </div>
                    <ul class="nav navbar-top-links navbar-left">
                        <br>
                        <li>
                            <?php if (strlen($cdusua) == 14 ) {;?>
                                <span><?php echo  formatar($cdusua,"cnpj")." - ";?></span>
                            <?php } Else {?>
                                <span><?php echo  formatar($cdusua,"cpf")." - ";?></span>
                            <?php }?>
                        </li>
                        <li>
                            <span><?php echo  $deusua1 ;?></span>
                        </li>
                    </ul>
                    <ul class="nav navbar-top-links navbar-right">
                        <li>
                            <span class="m-r-sm text-muted welcome-message">Benvindo a <strong>Nova Aliança Auto Mecânica&copy;</strong></span>
                        </li>
                        <li>
                            <a href="../../index.php">
                                <i class="fa fa-sign-out"></i> Sair
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
            <div class="wrapper wrapper-content animated fadeInRight ecommerce">
                    <div class="ibox-title">
                        <button type="button" class="btn btn-warning btn-lg btn-block"><i
                                                    class="fa fa-user"></i> Cadastro de Ordem de Serviços - <small><?php echo $titulo; ?></small>
                        </button>
                    </div>
                    <div class="ibox-content m-b-sm border-bottom">

                        <div class="ibox-content">
                            <form class="form-horizontal" method="POST" enctype="multipart/form-data" action="ordemaa.php">
                                <div>
                                    <center>
                                        <?php if($acao == "edita") {?>
                                            <button class="btn btn-sm btn-primary" name = "edita" type="submit"><strong>Alterar</strong></button>
                                        <?php }?>
                                        <?php if($acao == "apaga") {?>
                                            <button class="btn btn-sm btn-danger" name = "apaga" type="submit"><strong>Apagar</strong></button>
                                        <?php }?>
                                        <button class="btn btn-sm btn-warning " type="button" onClick="history.go(-1)"><strong>Retornar</strong></button>
                                    </center>
                                </div>
                                <?php if($acao == "edita") {?>
                                    <div class="row">
                                        <div class="col-sm-2">
                                            <div class="form-group">
                                                <?php if (strlen($cdclie) < 12) {?>
                                                    <?php $cdclie = formatar($cdclie, "cpf");?>
                                                <?php } Else {?>
                                                    <?php $cdclie = formatar($cdclie, "cnpj");?>
                                                <?php }?>
                                                <label class="control-label" for="cdclie">Cpf/Cnpj</label>
                                                <input id="cdclie" name="cdclie" type="text" value="<?php echo $cdclie; ?>" placeholder="" class="form-control" maxlength = "14" readonly="">
                                            </div>
                                        </div>
                                        <div class="col-sm-1"></div>
                                        <div class="col-sm-5">
                                            <div class="form-group">
                                                <label class="control-label" for="declie">Nome/Razão Social</label>
                                                <input id="declie" name="declie" value="<?php echo $declie; ?>" type="text" placeholder="" class="form-control" maxlength = "100" readonly = "" required="">
                                            </div>
                                        </div>
                                        <div class="col-sm-1"></div>
                                        <div class="col-sm-2">
                                            <div class="form-group">
                                                <label class="control-label" for="cdorde">Número de Controle</label>
                                                <input id="cdorde" name="cdorde" value="<?php echo $cdorde; ?>" type="text" placeholder="" class="form-control" maxlength = "10" readonly = "" >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-2">
                                            <div class="form-group">
                                                <label class="control-label" for="dtemis">Emissão</label>
                                                <input id="dtemis" name="dtemis" value="<?php echo $aOrde[0]["dtemis"]; ?>" type="date" placeholder="" class="form-control" maxlength = "10" autofocus>
                                            </div>
                                        </div>
                                        <div class="col-sm-1"></div>
                                        <div class="col-sm-2">
                                            <div class="form-group">
                                                <label class="control-label" for="nrnota">Número da Nota</label>
                                                <input id="nrnota" name="nrnota" value="<?php echo $nrnota; ?>" type="text" placeholder="" class="form-control" maxlength = "15">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-2">
                                            <div class="form-group">
                                                <label class="control-label" for="vlserv">Valor dos Serviços</label>
                                                <input id="vlserv" name="vlserv" value="<?php echo $vlserv; ?>" type="text" placeholder="" class="form-control" maxlength = "15">
                                            </div>
                                        </div>
                                        <div class="col-sm-1"></div>
                                        <div class="col-sm-2">
                                            <div class="form-group">
                                                <label class="control-label" for="vlpeca">Valor das Peças</label>
                                                <input id="vlpeca" name="vlpeca" value="<?php echo $vlpeca; ?>" type="text" placeholder="" class="form-control" maxlength = "15">
                                            </div>
                                        </div>
                                        <div class="col-sm-1"></div>
                                        <div class="col-sm-2">
                                            <div class="form-group">
                                                <label class="control-label" for="vlimpo">Valor dos Tributos</label>
                                                <input id="vlimpo" name="vlimpo" value="<?php echo $vlimpo; ?>" type="text" placeholder="" class="form-control" maxlength = "15">
                                            </div>
                                        </div> 
                                        <div class="col-sm-1"></div>
                                        <div class="col-sm-2">
                                            <div class="form-group">
                                                <label class="control-label" for="vloutr">Outros Valores</label>
                                                <input id="vloutr" name="vloutr" value="<?php echo $vloutr; ?>" type="text" placeholder="" class="form-control" maxlength = "15">
                                            </div>
                                        </div>
                                    </div>
                                    <div class = "row">
                                        <div class="col-sm-2">
                                            <div class="form-group">
                                                <label class="control-label" for="vltota">Valor Total</label>
                                                <input id="vltota" name="vltota" value="<?php echo $vltota; ?>" type="text" placeholder="" class="form-control" maxlength = "15">
                                            </div>
                                        </div>
                                        <div class="col-sm-1"></div>
                                        <div class="col-sm-2">
                                            <div class="form-group">
                                                <label class="control-label" for="flcanc" style="width: 100%">Cancelado</label>
                                                <select name="flcanc" id="flcanc" style="width: 100%">
                                                    <?php if ($flcanc == 'N') {?>
                                                        <option>Sim</option>
                                                        <option selected= "selected">Não</option>
                                                    <?php } Else {?>
                                                        <option selected= "selected">Sim</option>
                                                        <option>Não</option>
                                                    <?php }?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-1"></div>
                                        <div class="col-sm-2">
                                            <div class="form-group">
                                                <label class="control-label" for="flpago" style="width: 100%">Pago</label>
                                                <select name="flpago" id="flpago" style="width: 100%">
                                                    <?php if ($flpago == 'N') {?>
                                                        <option>Sim</option>
                                                        <option selected= "selected">Não</option>
                                                    <?php } Else {?>
                                                        <option selected= "selected">Sim</option>
                                                        <option>Não</option>
                                                    <?php }?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-1"></div>
                                        <div class="col-sm-2">
                                            <div class="form-group">
                                                <label class="control-label" for="flstat" style="width: 100%">Situação</label>
                                                <select name="flstat" id="flstat" style="width: 100%">
                                                    <?php if (empty($flstat) == true) {?>
                                                        <option selected= "selected">Pendente</option>
                                                        <option>Andamento</option>
                                                        <option>Concluído</option>
                                                        <option>Entregue</option>
                                                    <?php }?>

                                                    <?php if ($flstat == 'P') {?>
                                                        <option selected= "selected">Pendente</option>
                                                        <option>Andamento</option>
                                                        <option>Concluído</option>
                                                        <option>Entregue</option>
                                                    <?php }?>

                                                    <?php if ($flstat == 'A') {?>
                                                        <option>Pendente</option>
                                                        <option selected= "selected">Andamento</option>
                                                        <option>Concluído</option>
                                                        <option>Entregue</option>
                                                    <?php }?>

                                                    <?php if ($flstat == 'C') {?>
                                                        <option>Pendente</option>
                                                        <option>Andamento</option>
                                                        <option selected= "selected">Concluído</option>
                                                        <option>Entregue</option>
                                                    <?php }?>

                                                    <?php if ($flstat == 'E') {?>
                                                        <option>Pendente</option>
                                                        <option>Andamento</option>
                                                        <option>Concluído</option>
                                                        <option selected= "selected">Entregue</option>
                                                    <?php }?>

                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                       
                                <?php } Else {?>
                                    <div class="row">
                                        <div class="col-sm-2">
                                            <div class="form-group">
                                                <?php if (strlen($cdclie) < 12) {?>
                                                    <?php $cdclie = formatar($cdclie, "cpf");?>
                                                <?php } Else {?>
                                                    <?php $cdclie = formatar($cdclie, "cnpj");?>
                                                <?php }?>
                                                <label class="control-label" for="cdclie">Cpf/Cnpj</label>
                                                <input id="cdclie" name="cdclie" type="text" value="<?php echo $cdclie; ?>" placeholder="" class="form-control" maxlength = "14" readonly="">
                                            </div>
                                        </div>
                                        <div class="col-sm-1"></div>
                                        <div class="col-sm-5">
                                            <div class="form-group">
                                                <label class="control-label" for="declie">Nome/Razão Social</label>
                                                <input id="declie" name="declie" value="<?php echo $declie; ?>" type="text" placeholder="" class="form-control" maxlength = "100" readonly = "" required="">
                                            </div>
                                        </div>
                                        <div class="col-sm-1"></div>
                                        <div class="col-sm-2">
                                            <div class="form-group">
                                                <label class="control-label" for="cdorde">Número de Controle</label>
                                                <input id="cdorde" name="cdorde" value="<?php echo $cdorde; ?>" type="text" placeholder="" class="form-control" maxlength = "10" readonly = "" >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-2">
                                            <div class="form-group">
                                                <label class="control-label" for="dtemis">Emissão</label>
                                                <input id="dtemis" name="dtemis" value="<?php echo $aOrde[0]["dtemis"]; ?>" type="date" placeholder="" class="form-control" maxlength = "10"  readonly="">
                                            </div>
                                        </div>
                                        <div class="col-sm-1"></div>
                                        <div class="col-sm-2">
                                            <div class="form-group">
                                                <label class="control-label" for="nrnota">Número da Nota</label>
                                                <input id="nrnota" name="nrnota" value="<?php echo $nrnota; ?>" type="text" placeholder="" class="form-control" maxlength = "15" readonly="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-2">
                                            <div class="form-group">
                                                <label class="control-label" for="vlserv">Valor dos Serviços</label>
                                                <input id="vlserv" name="vlserv" value="<?php echo $vlserv; ?>" type="text" placeholder="" class="form-control" maxlength = "15" readonly="">
                                            </div>
                                        </div>
                                        <div class="col-sm-1"></div>
                                        <div class="col-sm-2">
                                            <div class="form-group">
                                                <label class="control-label" for="vlpeca">Valor das Peças</label>
                                                <input id="vlpeca" name="vlpeca" value="<?php echo $vlpeca; ?>" type="text" placeholder="" class="form-control" maxlength = "15" readonly="">
                                            </div>
                                        </div>
                                        <div class="col-sm-1"></div>
                                        <div class="col-sm-2">
                                            <div class="form-group">
                                                <label class="control-label" for="vlimpo">Valor dos Tributos</label>
                                                <input id="vlimpo" name="vlimpo" value="<?php echo $vlimpo; ?>" type="text" placeholder="" class="form-control" maxlength = "15" readonly="">
                                            </div>
                                        </div> 
                                        <div class="col-sm-1"></div>
                                        <div class="col-sm-2">
                                            <div class="form-group">
                                                <label class="control-label" for="vloutr">Outros Valores</label>
                                                <input id="vloutr" name="vloutr" value="<?php echo $vloutr; ?>" type="text" placeholder="" class="form-control" maxlength = "15" readonly="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class = "row">
                                        <div class="col-sm-2">
                                            <div class="form-group">
                                                <label class="control-label" for="vltota">Valor Total</label>
                                                <input id="vltota" name="vltota" value="<?php echo $vltota; ?>" type="text" placeholder="" class="form-control" maxlength = "15" readonly="">
                                            </div>
                                        </div>
                                        <div class="col-sm-1"></div>
                                        <div class="col-sm-2">
                                            <div class="form-group">
                                                <label class="control-label" for="flcanc" style="width: 100%">Cancelado</label>
                                                <select name="flcanc" id="flcanc" style="width: 100%">
                                                    <?php if ($flcanc == 'N') {?>
                                                        <option selected= "selected">Não</option>
                                                    <?php } Else {?>
                                                        <option selected= "selected">Sim</option>
                                                    <?php }?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-1"></div>
                                        <div class="col-sm-2">
                                            <div class="form-group">
                                                <label class="control-label" for="flpago" style="width: 100%">Pago</label>
                                                <select name="flpago" id="flpago" style="width: 100%">
                                                    <?php if ($flpago == 'N') {?>
                                                        <option selected= "selected">Não</option>
                                                    <?php } Else {?>
                                                        <option selected= "selected">Sim</option>
                                                    <?php }?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-1"></div>
                                        <div class="col-sm-2">
                                            <div class="form-group">
                                                <label class="control-label" for="flstat" style="width: 100%">Situação</label>
                                                <select name="flstat" id="flstat" style="width: 100%">
                                                    <?php if (empty($flstat) == true) {?>
                                                        <option selected= "selected">Pendente</option>
                                                    <?php }?>

                                                    <?php if ($flstat == 'P') {?>
                                                        <option selected= "selected">Pendente</option>
                                                    <?php }?>

                                                    <?php if ($flstat == 'A') {?>
                                                        <option selected= "selected">Andamento</option>
                                                    <?php }?>

                                                    <?php if ($flstat == 'C') {?>
                                                        <option selected= "selected">Concluído</option>
                                                    <?php }?>

                                                    <?php if ($flstat == 'E') {?>
                                                        <option selected= "selected">Entregue</option>
                                                    <?php }?>

                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                <?php }?>
                                <input type="hidden" id="iss" name="iss" value="<?php echo $iss; ?>">
                                <input type="hidden" id="inss" name="inss" value="<?php echo $inss; ?>">
                                <input type="hidden" id="irrf" name="irrf" value="<?php echo $irrf; ?>">
                                <input type="hidden" id="pis" name="pis" value="<?php echo $pis; ?>">

                                <input type="hidden" id="cditem1_" name="cditem1_" value="<?php echo $aOrde[0]["cditem1"];?>">
                                <input type="hidden" id="cditem2_" name="cditem2_" value="<?php echo $aOrde[0]["cditem2"];?>">
                                <input type="hidden" id="cditem3_" name="cditem3_" value="<?php echo $aOrde[0]["cditem3"];?>">
                                <input type="hidden" id="cditem4_" name="cditem4_" value="<?php echo $aOrde[0]["cditem4"];?>">
                                <input type="hidden" id="cditem5_" name="cditem5_" value="<?php echo $aOrde[0]["cditem5"];?>">
                                <input type="hidden" id="cditem6_" name="cditem6_" value="<?php echo $aOrde[0]["cditem6"];?>">
                                <input type="hidden" id="cditem7_" name="cditem7_" value="<?php echo $aOrde[0]["cditem7"];?>">
                                <input type="hidden" id="cditem8_" name="cditem8_" value="<?php echo $aOrde[0]["cditem8"];?>">
                                <input type="hidden" id="cditem9_" name="cditem9_" value="<?php echo $aOrde[0]["cditem9"];?>">
                                <input type="hidden" id="cditem10_" name="cditem10_" value="<?php echo $aOrde[0]["cditem10"];?>">

                                <div class="row">
                                    <div class="table-responsive">
                                        <table class="table table-stripped table-bordered">
                                            <thead>
                                                <th style="width: 10%"><center>Item</center></th>
                                                <th style="width: 45%"><center>Produto/Serviço</center></th>
                                                <th style="width: 05%"><center>Quantidade</center></th>
                                                <th style="width: 10%"><center>Valor Unitário</center></th>
                                                <th style="width: 15%"><center>Outros Valores</center></th>
                                                <th style="width: 20%"><center>Valor Total Item</center></th>
                                                <th style="width: 20%"><center>Cancelado</center></th>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td><center><input type="text" class="form-control" placeholder="1" maxlength = "15" readonly =""></center></td>
                                                    <td>
                                                        <center>
                                                            <select id="cditem1" name="cditem1" class="form-control" onclick="colocapreco();">
                                                                <option value=55 selected>SERVIÇOS</option>
                                                                <option value=45><?php echo $aOrde[0]["cditem1"];?></option>
                                                                <?php for($i=0;$i < count($aServ);$i++) { ?>
                                                                  <option value = "<?php echo $aServ[$i]["vlserv"];?>"><?php echo str_pad($aServ[$i]["cdserv"],1," ",STR_PAD_RIGHT)." - ".$aServ[$i]["deserv"];?></option>
                                                                <?php }?>
                                                                <option value=55 selected>PEÇAS</option>
                                                                <?php for($i=0;$i < count($aPeca);$i++) { ?>
                                                                  <option value = "<?php echo $aPeca[$i]["vlpeca"];?>"><?php echo str_pad($aPeca[$i]["cdpeca"],1," ",STR_PAD_RIGHT)." - ".$aPeca[$i]["depeca"];?></option>
                                                                <?php }?>
                                                            </select>
                                                        </center>
                                                    </td>
                                                    <td><center><input id="qtitem1" name="qtitem1" value = "0" onkeyup="calcula();" type="text" class="form-control" placeholder="13.45" maxlength = "15"></center></td>
                                                    <td><center><input id="vlitem1" name="vlitem1" value = "0.00" onkeyup="calcula();" type="text" class="form-control" placeholder="11.32" maxlength = "15"></center></td>
                                                    <td><center><input id="vloutr1" name="vloutr1" value = "0.00" onkeyup="calcula();" type="text" class="form-control" placeholder="43.23" maxlength = "15"></center></td>
                                                    <td><center><input id="vltota1" name="vltota1" value = "0.00" type="text" class="form-control" placeholder="6.45" maxlength = "15" readonly = ""></center></td>
                                                    <td>
                                                        <center>
                                                            <select id="flcanc1" name="flcanc1" class="form-control" style="width: 109%">
                                                                <option selected>Não</option>
                                                                <option>Sim</option>
                                                            </select>
                                                        </center>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><center><input type="text" class="form-control" placeholder="2" maxlength = "15" readonly =""></center></td>
                                                    <td>
                                                        <center>
                                                            <select id="cditem2" name="cditem2" class="form-control" onclick="colocapreco();">
                                                                <option value=55 selected>SERVIÇOS</option>
                                                                <option><?php echo $aOrde[0]["cditem2"];?></option>
                                                                <?php for($i=0;$i < count($aServ);$i++) { ?>
                                                                  <option value = "<?php echo $aServ[$i]["vlserv"];?>"><?php echo str_pad($aServ[$i]["cdserv"],1," ",STR_PAD_RIGHT)." - ".$aServ[$i]["deserv"];?></option>
                                                                <?php }?>
                                                                <option value=55 selected>PEÇAS</option>
                                                                <?php for($i=0;$i < count($aPeca);$i++) { ?>
                                                                  <option value = "<?php echo $aPeca[$i]["vlpeca"];?>"><?php echo str_pad($aPeca[$i]["cdpeca"],1," ",STR_PAD_RIGHT)." - ".$aPeca[$i]["depeca"];?></option>
                                                                <?php }?>
                                                            </select>
                                                        </center>
                                                    </td>
                                                    <td><center><input id="qtitem2" name="qtitem2" value = "0" onkeyup="calcula();" type="text" class="form-control" placeholder="0.00" maxlength = "15"></center></td>
                                                    <td><center><input id="vlitem2" name="vlitem2" value = "0.00" onkeyup="calcula();" type="text" class="form-control" placeholder="0.00" maxlength = "15"></center></td>
                                                    <td><center><input id="vloutr2" name="vloutr2" value = "0.00" onkeyup="calcula();" type="text" class="form-control" placeholder="0.00" maxlength = "15"></center></td>
                                                    <td><center><input id="vltota2" name="vltota2" value = "0.00" type="text" class="form-control" placeholder="0.00" maxlength = "15" readonly = ""></center></td>
                                                    <td>
                                                        <center>
                                                            <select id="flcanc2" name="flcanc2" class="form-control" style="width: 109%">
                                                                <option selected>Não</option>
                                                                <option>Sim</option>
                                                            </select>
                                                        </center>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><center><input type="text" class="form-control" placeholder="3" maxlength = "15" readonly =""></center></td>
                                                    <td>
                                                        <center>
                                                            <select id="cditem3" name="cditem3" class="form-control" onclick="colocapreco();">
                                                                <option value=55 selected>SERVIÇOS</option>
                                                                <option><?php echo $aOrde[0]["cditem3"];?></option>
                                                                <?php for($i=0;$i < count($aServ);$i++) { ?>
                                                                  <option value = "<?php echo $aServ[$i]["vlserv"];?>"><?php echo str_pad($aServ[$i]["cdserv"],1," ",STR_PAD_RIGHT)." - ".$aServ[$i]["deserv"];?></option>
                                                                <?php }?>
                                                                <option value=55 selected>PEÇAS</option>
                                                                <?php for($i=0;$i < count($aPeca);$i++) { ?>
                                                                  <option value = "<?php echo $aPeca[$i]["vlpeca"];?>"><?php echo str_pad($aPeca[$i]["cdpeca"],1," ",STR_PAD_RIGHT)." - ".$aPeca[$i]["depeca"];?></option>
                                                                <?php }?>
                                                            </select>
                                                        </center>
                                                    </td>
                                                    <td><center><input id="qtitem3" name="qtitem3" value = "0" onkeyup="calcula();" type="text" class="form-control" placeholder="13.45" maxlength = "15"></center></td>
                                                    <td><center><input id="vlitem3" name="vlitem3" value = "0.00" onkeyup="calcula();" type="text" class="form-control" placeholder="11.32" maxlength = "15"></center></td>
                                                    <td><center><input id="vloutr3" name="vloutr3" value = "0.00" onkeyup="calcula();" type="text" class="form-control" placeholder="43.23" maxlength = "15"></center></td>
                                                    <td><center><input id="vltota3" name="vltota3" value = "0.00" type="text" class="form-control" placeholder="6.45" maxlength = "15" readonly = ""></center></td>
                                                    <td>
                                                        <center>
                                                            <select id="flcanc3" name="flcanc3" class="form-control" style="width: 109%">
                                                                <option selected>Não</option>
                                                                <option>Sim</option>
                                                            </select>
                                                        </center>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><center><input type="text" class="form-control" placeholder="4" maxlength = "15" readonly =""></center></td>
                                                    <td>
                                                        <center>
                                                            <select id="cditem4" name="cditem4" class="form-control" onclick="colocapreco();">
                                                                <option value=55 selected>SERVIÇOS</option>
                                                                <option><?php echo $aOrde[0]["cditem4"];?></option>
                                                                <?php for($i=0;$i < count($aServ);$i++) { ?>
                                                                  <option value = "<?php echo $aServ[$i]["vlserv"];?>"><?php echo str_pad($aServ[$i]["cdserv"],1," ",STR_PAD_RIGHT)." - ".$aServ[$i]["deserv"];?></option>
                                                                <?php }?>
                                                                <option value=55 selected>PEÇAS</option>
                                                                <?php for($i=0;$i < count($aPeca);$i++) { ?>
                                                                  <option value = "<?php echo $aPeca[$i]["vlpeca"];?>"><?php echo str_pad($aPeca[$i]["cdpeca"],1," ",STR_PAD_RIGHT)." - ".$aPeca[$i]["depeca"];?></option>
                                                                <?php }?>
                                                            </select>
                                                        </center>
                                                    </td>
                                                    <td><center><input id="qtitem4" name="qtitem4" value = "0" onkeyup="calcula();" type="text" class="form-control" placeholder="13.45" maxlength = "15"></center></td>
                                                    <td><center><input id="vlitem4" name="vlitem4" value = "0.00" onkeyup="calcula();" type="text" class="form-control" placeholder="11.32" maxlength = "15"></center></td>
                                                    <td><center><input id="vloutr4" name="vloutr4" value = "0.00" onkeyup="calcula();" type="text" class="form-control" placeholder="43.23" maxlength = "15"></center></td>
                                                    <td><center><input id="vltota4" name="vltota4" value = "0.00" type="text" class="form-control" placeholder="6.45" maxlength = "15" readonly = ""></center></td>
                                                    <td>
                                                        <center>
                                                            <select id="flcanc4" name="flcanc4" class="form-control" style="width: 109%">
                                                                <option selected>Não</option>
                                                                <option>Sim</option>
                                                            </select>
                                                        </center>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><center><input type="text" class="form-control" placeholder="5" maxlength = "15" readonly =""></center></td>
                                                    <td>
                                                        <center>
                                                            <select id="cditem5" name="cditem5" class="form-control" onclick="colocapreco();">
                                                                <option value=55 selected>SERVIÇOS</option>
                                                                <option><?php echo $aOrde[0]["cditem5"];?></option>
                                                                <?php for($i=0;$i < count($aServ);$i++) { ?>
                                                                  <option value = "<?php echo $aServ[$i]["vlserv"];?>"><?php echo str_pad($aServ[$i]["cdserv"],1," ",STR_PAD_RIGHT)." - ".$aServ[$i]["deserv"];?></option>
                                                                <?php }?>
                                                                <option value=55 selected>PEÇAS</option>
                                                                <?php for($i=0;$i < count($aPeca);$i++) { ?>
                                                                  <option value = "<?php echo $aPeca[$i]["vlpeca"];?>"><?php echo str_pad($aPeca[$i]["cdpeca"],1," ",STR_PAD_RIGHT)." - ".$aPeca[$i]["depeca"];?></option>
                                                                <?php }?>
                                                            </select>
                                                        </center>
                                                    </td>
                                                    <td><center><input id="qtitem5" name="qtitem5" value = "0" onkeyup="calcula();" type="text" class="form-control" placeholder="13.45" maxlength = "15"></center></td>
                                                    <td><center><input id="vlitem5" name="vlitem5" value = "0.00" onkeyup="calcula();" type="text" class="form-control" placeholder="11.32" maxlength = "15"></center></td>
                                                    <td><center><input id="vloutr5" name="vloutr5" value = "0.00" onkeyup="calcula();" type="text" class="form-control" placeholder="43.23" maxlength = "15"></center></td>
                                                    <td><center><input id="vltota5" name="vltota5" value = "0.00" type="text" class="form-control" placeholder="6.45" maxlength = "15" readonly = ""></center></td>
                                                    <td>
                                                        <center>
                                                            <select id="flcanc5" name="flcanc5" class="form-control" style="width: 109%">
                                                                <option selected>Não</option>
                                                                <option>Sim</option>
                                                            </select>
                                                        </center>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><center><input type="text" class="form-control" placeholder="6" maxlength = "15" readonly =""></center></td>
                                                    <td>
                                                        <center>
                                                            <select id="cditem6" name="cditem6" class="form-control" onclick="colocapreco();">
                                                                <option value=55 selected>SERVIÇOS</option>
                                                                <option><?php echo $aOrde[0]["cditem6"];?></option>
                                                                <?php for($i=0;$i < count($aServ);$i++) { ?>
                                                                  <option value = "<?php echo $aServ[$i]["vlserv"];?>"><?php echo str_pad($aServ[$i]["cdserv"],1," ",STR_PAD_RIGHT)." - ".$aServ[$i]["deserv"];?></option>
                                                                <?php }?>
                                                                <option value=55 selected>PEÇAS</option>
                                                                <?php for($i=0;$i < count($aPeca);$i++) { ?>
                                                                  <option value = "<?php echo $aPeca[$i]["vlpeca"];?>"><?php echo str_pad($aPeca[$i]["cdpeca"],1," ",STR_PAD_RIGHT)." - ".$aPeca[$i]["depeca"];?></option>
                                                                <?php }?>
                                                            </select>
                                                        </center>
                                                    </td>
                                                    <td><center><input id="qtitem6" name="qtitem6" value = "0" onkeyup="calcula();" type="text" class="form-control" placeholder="13.45" maxlength = "15"></center></td>
                                                    <td><center><input id="vlitem6" name="vlitem6" value = "0.00" onkeyup="calcula();" type="text" class="form-control" placeholder="11.32" maxlength = "15"></center></td>
                                                    <td><center><input id="vloutr6" name="vloutr6" value = "0.00" onkeyup="calcula();" type="text" class="form-control" placeholder="43.23" maxlength = "15"></center></td>
                                                    <td><center><input id="vltota6" name="vltota6" value = "0.00" type="text" class="form-control" placeholder="6.45" maxlength = "15" readonly = ""></center></td>
                                                    <td>
                                                        <center>
                                                            <select id="flcanc6" name="flcanc6" class="form-control" style="width: 109%">
                                                                <option selected>Não</option>
                                                                <option>Sim</option>
                                                            </select>
                                                        </center>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><center><input type="text" class="form-control" placeholder="7" maxlength = "15" readonly =""></center></td>
                                                    <td>
                                                        <center>
                                                            <select id="cditem7" name="cditem7" class="form-control" onclick="colocapreco();">
                                                                <option value=55 selected>SERVIÇOS</option>
                                                                <option><?php echo $aOrde[0]["cditem7"];?></option>
                                                                <?php for($i=0;$i < count($aServ);$i++) { ?>
                                                                  <option value = "<?php echo $aServ[$i]["vlserv"];?>"><?php echo str_pad($aServ[$i]["cdserv"],1," ",STR_PAD_RIGHT)." - ".$aServ[$i]["deserv"];?></option>
                                                                <?php }?>
                                                                <option value=55 selected>PEÇAS</option>
                                                                <?php for($i=0;$i < count($aPeca);$i++) { ?>
                                                                  <option value = "<?php echo $aPeca[$i]["vlpeca"];?>"><?php echo str_pad($aPeca[$i]["cdpeca"],1," ",STR_PAD_RIGHT)." - ".$aPeca[$i]["depeca"];?></option>
                                                                <?php }?>
                                                            </select>
                                                        </center>
                                                    </td>
                                                    <td><center><input id="qtitem7" name="qtitem7" value = "0" onkeyup="calcula();" type="text" class="form-control" placeholder="13.45" maxlength = "15"></center></td>
                                                    <td><center><input id="vlitem7" name="vlitem7" value = "0.00" onkeyup="calcula();" type="text" class="form-control" placeholder="11.32" maxlength = "15"></center></td>
                                                    <td><center><input id="vloutr7" name="vloutr7" value = "0.00" onkeyup="calcula();" type="text" class="form-control" placeholder="43.23" maxlength = "15"></center></td>
                                                    <td><center><input id="vltota7" name="vltota7" value = "0.00" type="text" class="form-control" placeholder="6.45" maxlength = "15" readonly = ""></center></td>
                                                    <td>
                                                        <center>
                                                            <select id="flcanc7" name="flcanc7" class="form-control" style="width: 109%">
                                                                <option selected>Não</option>
                                                                <option>Sim</option>
                                                            </select>
                                                        </center>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><center><input type="text" class="form-control" placeholder="8" maxlength = "15" readonly =""></center></td>
                                                    <td>
                                                        <center>
                                                            <select id="cditem8" name="cditem8" class="form-control" onclick="colocapreco();">
                                                                <option value=55 selected>SERVIÇOS</option>
                                                                <option><?php echo $aOrde[0]["cditem8"];?></option>
                                                                <?php for($i=0;$i < count($aServ);$i++) { ?>
                                                                  <option value = "<?php echo $aServ[$i]["vlserv"];?>"><?php echo str_pad($aServ[$i]["cdserv"],1," ",STR_PAD_RIGHT)." - ".$aServ[$i]["deserv"];?></option>
                                                                <?php }?>
                                                                <option value=55 selected>PEÇAS</option>
                                                                <?php for($i=0;$i < count($aPeca);$i++) { ?>
                                                                  <option value = "<?php echo $aPeca[$i]["vlpeca"];?>"><?php echo str_pad($aPeca[$i]["cdpeca"],1," ",STR_PAD_RIGHT)." - ".$aPeca[$i]["depeca"];?></option>
                                                                <?php }?>
                                                            </select>
                                                        </center>
                                                    </td>
                                                    <td><center><input id="qtitem8" name="qtitem8" value = "0" onkeyup="calcula();" type="text" class="form-control" placeholder="13.45" maxlength = "15"></center></td>
                                                    <td><center><input id="vlitem8" name="vlitem8" value = "0.00" onkeyup="calcula();" type="text" class="form-control" placeholder="11.32" maxlength = "15"></center></td>
                                                    <td><center><input id="vloutr8" name="vloutr8" value = "0.00" onkeyup="calcula();" type="text" class="form-control" placeholder="43.23" maxlength = "15"></center></td>
                                                    <td><center><input id="vltota8" name="vltota8" value = "0.00" type="text" class="form-control" placeholder="6.45" maxlength = "15" readonly = ""></center></td>
                                                    <td>
                                                        <center>
                                                            <select id="flcanc1" name="flcanc1" class="form-control" style="width: 109%">
                                                                <option selected>Não</option>
                                                                <option>Sim</option>
                                                            </select>
                                                        </center>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><center><input type="text" class="form-control" placeholder="9" maxlength = "15" readonly =""></center></td>
                                                    <td>
                                                        <center>
                                                            <select id="cditem9" name="cditem9" class="form-control" onclick="colocapreco();">
                                                                <option value=55 selected>SERVIÇOS</option>
                                                                <option><?php echo $aOrde[0]["cditem9"];?></option>
                                                                <?php for($i=0;$i < count($aServ);$i++) { ?>
                                                                  <option value = "<?php echo $aServ[$i]["vlserv"];?>"><?php echo str_pad($aServ[$i]["cdserv"],1," ",STR_PAD_RIGHT)." - ".$aServ[$i]["deserv"];?></option>
                                                                <?php }?>
                                                                <option value=55 selected>PEÇAS</option>
                                                                <?php for($i=0;$i < count($aPeca);$i++) { ?>
                                                                  <option value = "<?php echo $aPeca[$i]["vlpeca"];?>"><?php echo str_pad($aPeca[$i]["cdpeca"],1," ",STR_PAD_RIGHT)." - ".$aPeca[$i]["depeca"];?></option>
                                                                <?php }?>
                                                            </select>
                                                        </center>
                                                    </td>
                                                    <td><center><input id="qtitem9" name="qtitem9" value = "0" onkeyup="calcula();" type="text" class="form-control" placeholder="13.45" maxlength = "15"></center></td>
                                                    <td><center><input id="vlitem9" name="vlitem9" value = "0.00" onkeyup="calcula();" type="text" class="form-control" placeholder="11.32" maxlength = "15"></center></td>
                                                    <td><center><input id="vloutr9" name="vloutr9" value = "0.00" onkeyup="calcula();" type="text" class="form-control" placeholder="43.23" maxlength = "15"></center></td>
                                                    <td><center><input id="vltota9" name="vltota9" value = "0.00" type="text" class="form-control" placeholder="6.45" maxlength = "15" readonly = ""></center></td>
                                                    <td>
                                                        <center>
                                                            <select id="flcanc9" name="flcanc9" class="form-control" style="width: 109%">
                                                                <option selected>Não</option>
                                                                <option>Sim</option>
                                                            </select>
                                                        </center>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><center><input type="text" class="form-control" placeholder="10" maxlength = "15" readonly =""></center></td>
                                                    <td>
                                                        <center>
                                                            <select id="cditem10" name="cditem10" class="form-control" onclick="colocapreco();">
                                                                <option value=55 selected>SERVIÇOS</option>
                                                                <option><?php echo $aOrde[0]["cditem10"];?></option>
                                                                <?php for($i=0;$i < count($aServ);$i++) { ?>
                                                                  <option value = "<?php echo $aServ[$i]["vlserv"];?>"><?php echo str_pad($aServ[$i]["cdserv"],1," ",STR_PAD_RIGHT)." - ".$aServ[$i]["deserv"];?></option>
                                                                <?php }?>
                                                                <option value=55 selected>PEÇAS</option>
                                                                <?php for($i=0;$i < count($aPeca);$i++) { ?>
                                                                  <option value = "<?php echo $aPeca[$i]["vlpeca"];?>"><?php echo str_pad($aPeca[$i]["cdpeca"],1," ",STR_PAD_RIGHT)." - ".$aPeca[$i]["depeca"];?></option>
                                                                <?php }?>
                                                            </select>
                                                        </center>
                                                    </td>
                                                    <td><center><input id="qtitem10" name="qtitem10" value = "0" onkeyup="calcula();" type="text" class="form-control" placeholder="13.45" maxlength = "15"></center></td>
                                                    <td><center><input id="vlitem10" name="vlitem10" value = "0.00" onkeyup="calcula();" type="text" class="form-control" placeholder="11.32" maxlength = "15"></center></td>
                                                    <td><center><input id="vloutr10" name="vloutr10" value = "0.00" onkeyup="calcula();" type="text" class="form-control" placeholder="43.23" maxlength = "15"></center></td>
                                                    <td><center><input id="vltota10" name="vltota10" value = "0.00" type="text" class="form-control" placeholder="6.45" maxlength = "15" readonly = ""></center></td>
                                                    <td>
                                                        <center>
                                                            <select id="flcanc10" name="flcanc10" class="form-control" style="width: 109%">
                                                                <option selected>Não</option>
                                                                <option>Sim</option>
                                                            </select>
                                                        </center>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class = "row">
                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <label class="control-label" for="declie">ISS</label>
                                            <input id="vlissg" name="vlissg" value="" type="text" placeholder="" class="form-control" maxlength = "100" readonly = "">
                                        </div>
                                    </div>
                                    <div class="col-sm-1"></div>
                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <label class="control-label" for="declie">INSS</label>
                                            <input id="vlinssg" name="vlinssg" value="" type="text" placeholder="" class="form-control" maxlength = "100" readonly = "">
                                        </div>
                                    </div>
                                    <div class="col-sm-1"></div>
                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <label class="control-label" for="declie">IRRF</label>
                                            <input id="vlirrfg" name="vlirrfg" value="" type="text" placeholder="" class="form-control" maxlength = "100" readonly = "">
                                        </div>
                                    </div>
                                    <div class="col-sm-1"></div>
                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <label class="control-label" for="declie">PIS/COFINS</label>
                                            <input id="vlpisg" name="vlpisg" value="" type="text" placeholder="" class="form-control" maxlength = "100" readonly = "">
                                        </div>
                                    </div>
                                </div>
                                <div class = "row">
                                    <div class="col-sm-2"></div>
                                    <div class="col-sm-2"></div>
                                    <div class="col-sm-2"></div>
                                    <div class="col-sm-2"></div>
                                    <div class="col-sm-1"></div>
                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <label class="control-label" for="declie">TOTAL GERAL</label>
                                            <input id="vltotalg" name="vltotalg" value="" type="text" placeholder="" class="form-control" maxlength = "100" readonly = "">
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <center>
                                        <?php if($acao == "edita") {?>
                                            <button class="btn btn-sm btn-primary" name = "edita" type="submit"><strong>Alterar</strong></button>
                                        <?php }?>
                                        <?php if($acao == "apaga") {?>
                                            <button class="btn btn-sm btn-danger" name = "apaga" type="submit"><strong>Apagar</strong></button>
                                        <?php }?>
                                        <button class="btn btn-sm btn-warning " type="button" onClick="history.go(-1)"><strong>Retornar</strong></button>
                                    </center>
                                </div>

                            </form>
                        </div>
                    </div>
                <!--/div-->
            </div>
        </div>
    </div>
    <!-- Mainly scripts -->
    <script src="../../templates/js/jquery-2.1.1.js"></script>
    <script src="../../templates/js/bootstrap.min.js"></script>
    <script src="../../templates/js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="../../templates/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

    <script src="../../templates/js/plugins/jeditable/jquery.jeditable.js"></script>
    <script src="../../templates/js/plugins/dataTables/datatables.min.js"></script>

    <!-- Flot -->
    <script src="../../templates/js/plugins/flot/jquery.flot.js"></script>
    <script src="../../templates/js/plugins/flot/jquery.flot.tooltip.min.js"></script>
    <script src="../../templates/js/plugins/flot/jquery.flot.spline.js"></script>
    <script src="../../templates/js/plugins/flot/jquery.flot.resize.js"></script>
    <script src="../../templates/js/plugins/flot/jquery.flot.pie.js"></script>
    <script src="../../templates/js/plugins/flot/jquery.flot.symbol.js"></script>
    <script src="../../templates/js/plugins/flot/jquery.flot.time.js"></script>

    <!-- Peity -->
    <script src="../../templates/js/plugins/peity/jquery.peity.min.js"></script>
    <script src="../../templates/js/demo/peity-demo.js"></script>

    <!-- Custom and plugin javascript -->
    <script src="../../templates/js/inspinia.js"></script>
    <script src="../../templates/js/plugins/pace/pace.min.js"></script>

    <!-- jQuery UI -->
    <script src="../../templates/js/plugins/jquery-ui/jquery-ui.min.js"></script>

    <!-- Jvectormap -->
    <script src="../../templates/js/plugins/jvectormap/jquery-jvectormap-2.0.2.min.js"></script>
    <script src="../../templates/js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>

    <!-- EayPIE -->
    <script src="../../templates/js/plugins/easypiechart/jquery.easypiechart.js"></script>

    <!-- Sparkline -->
    <script src="../../templates/js/plugins/sparkline/jquery.sparkline.min.js"></script>

    <!-- Sparkline demo data  -->
    <script src="../../templates/js/demo/sparkline-demo.js"></script>

   <!-- Data picker -->
    <script src="../../templates/js/plugins/datapicker/bootstrap-datepicker.js"></script>

    <!-- FooTable -->
    <script src="../../templates/js/plugins/footable/footable.all.min.js"></script>

    <!-- Page-Level Scripts -->
    <script>
        $(document).ready(function() {

            $('.footable').footable();

            $('#date_added').datepicker({
                todayBtn: "linked",
                keyboardNavigation: false,
                forceParse: false,
                calendarWeeks: true,
                autoclose: true
            });

            $('#date_modified').datepicker({
                todayBtn: "linked",
                keyboardNavigation: false,
                forceParse: false,
                calendarWeeks: true,
                autoclose: true
            });

        });

    </script>

    <script language="javascript">
        function calcula(){

            var qt1 = parseInt(document.getElementById('qtitem1').value, 10);
            var vl1 = parseInt(document.getElementById('vlitem1').value, 10);
            var ot1 = parseInt(document.getElementById('vloutr1').value, 10);
            var n1 = (qt1 * vl1) + ot1;

            var qt2 = parseInt(document.getElementById('qtitem2').value, 10);
            var vl2 = parseInt(document.getElementById('vlitem2').value, 10);
            var ot2 = parseInt(document.getElementById('vloutr2').value, 10);
            var n2 = (qt2 * vl2) + ot2;

            var qt3 = parseInt(document.getElementById('qtitem3').value, 10);
            var vl3 = parseInt(document.getElementById('vlitem3').value, 10);
            var ot3 = parseInt(document.getElementById('vloutr3').value, 10);
            var n3 = (qt3 * vl3) + ot3;

            var qt4 = parseInt(document.getElementById('qtitem4').value, 10);
            var vl4 = parseInt(document.getElementById('vlitem4').value, 10);
            var ot4 = parseInt(document.getElementById('vloutr4').value, 10);
            var n4 = (qt4 * vl4) + ot4;

            var qt5 = parseInt(document.getElementById('qtitem5').value, 10);
            var vl5 = parseInt(document.getElementById('vlitem5').value, 10);
            var ot5 = parseInt(document.getElementById('vloutr5').value, 10);
            var n5 = (qt5 * vl5) + ot5;

            var qt6 = parseInt(document.getElementById('qtitem6').value, 10);
            var vl6 = parseInt(document.getElementById('vlitem6').value, 10);
            var ot6 = parseInt(document.getElementById('vloutr6').value, 10);
            var n6 = (qt6 * vl6) + ot6;

            var qt7 = parseInt(document.getElementById('qtitem7').value, 10);
            var vl7 = parseInt(document.getElementById('vlitem7').value, 10);
            var ot7 = parseInt(document.getElementById('vloutr7').value, 10);
            var n7 = (qt7 * vl7) + ot7;

            var qt8 = parseInt(document.getElementById('qtitem8').value, 10);
            var vl8 = parseInt(document.getElementById('vlitem8').value, 10);
            var ot8 = parseInt(document.getElementById('vloutr8').value, 10);
            var n8 = (qt8 * vl8) + ot8;

            var qt9 = parseInt(document.getElementById('qtitem9').value, 10);
            var vl9 = parseInt(document.getElementById('vlitem9').value, 10);
            var ot9 = parseInt(document.getElementById('vloutr9').value, 10);
            var n9 = (qt9 * vl9) + ot9;

            var qt10 = parseInt(document.getElementById('qtitem10').value, 10);
            var vl10 = parseInt(document.getElementById('vlitem10').value, 10);
            var ot10 = parseInt(document.getElementById('vloutr10').value, 10);
            var n10 = (qt10 * vl10) + ot10;

            document.getElementById('vltota1').value = n1;
            document.getElementById('vltota2').value = n2;
            document.getElementById('vltota3').value = n3;
            document.getElementById('vltota4').value = n4;
            document.getElementById('vltota5').value = n5;
            document.getElementById('vltota6').value = n6;
            document.getElementById('vltota7').value = n7;
            document.getElementById('vltota8').value = n8;
            document.getElementById('vltota9').value = n9;
            document.getElementById('vltota10').value = n10;

            var n4 = n1 + n2 + n3 + n4 + n5 + n6 + n7 + n8 + n9 + n10;

            var iss = document.getElementById('iss').value;
            var inss = document.getElementById('inss').value;
            var pis = document.getElementById('pis').value;
            var irrf = document.getElementById('irrf').value;

            var issg = n4 * iss;
            var inssg = n4 * inss;
            var pisg = n4 * pis;
            var irrfg = n4 * irrf;

            document.getElementById('vlissg').value = issg;
            document.getElementById('vlinssg').value = inssg;
            document.getElementById('vlpisg').value = pisg;
            document.getElementById('vlirrfg').value = irrfg;

            document.getElementById('vltotalg').value = n4;

            document.getElementById('vltota').value = n4;
            document.getElementById('vlimpo').value = issg + inssg + pisg + irrfg;
            document.getElementById('vlpeca').value = n4;
            document.getElementById('vlserv').value = n4;
            document.getElementById('vloutr').value = ot1 + ot2 + ot3 + ot4 + ot5 + ot6 + ot7 + ot8 + ot9 + ot10;

        }

        function colocapreco(){

            document.getElementById('vlitem1').value = document.getElementById('cditem1').value;
            document.getElementById('qtitem1').value = 1;

            document.getElementById('vlitem2').value = document.getElementById('cditem2').value;
            document.getElementById('qtitem2').value = 1;

            document.getElementById('vlitem3').value = document.getElementById('cditem3').value;
            document.getElementById('qtitem3').value = 1;

            document.getElementById('vlitem4').value = document.getElementById('cditem4').value;
            document.getElementById('qtitem4').value = 1;

            document.getElementById('vlitem5').value = document.getElementById('cditem5').value;
            document.getElementById('qtitem5').value = 1;

            document.getElementById('vlitem6').value = document.getElementById('cditem6').value;
            document.getElementById('qtitem6').value = 1;

            document.getElementById('vlitem7').value = document.getElementById('cditem7').value;
            document.getElementById('qtitem7').value = 1;

            document.getElementById('vlitem8').value = document.getElementById('cditem8').value;
            document.getElementById('qtitem8').value = 1;

            document.getElementById('vlitem9').value = document.getElementById('cditem9').value;
            document.getElementById('qtitem9').value = 1;

            document.getElementById('vlitem10').value = document.getElementById('cditem10').value;
            document.getElementById('qtitem10').value = 1;

            setTimeout("calcula()",1);
        }

    </script>

    <script>

        $(document).ready(function(){
            $('.dataTables-example').DataTable({
                dom: '<"html5buttons"B>lTfgitp',
                buttons: [
                    { extend: 'copy'},
                    {extend: 'csv'},
                    {extend: 'excel', title: 'ExampleFile'},
                    {extend: 'pdf', title: 'ExampleFile'},

                    {extend: 'print',
                     customize: function (win){
                            $(win.document.body).addClass('white-bg');
                            $(win.document.body).css('font-size', '10px');

                            $(win.document.body).find('table')
                                    .addClass('compact')
                                    .css('font-size', 'inherit');
                    }
                    }
                ]

            });

            /* Init DataTables */
            var oTable = $('#editable').DataTable();

            /* Apply the jEditable handlers to the table */
            oTable.$('td').editable( '../example_ajax.php', {
                "callback": function( sValue, y ) {
                    var aPos = oTable.fnGetPosition( this );
                    oTable.fnUpdate( sValue, aPos[0], aPos[1] );
                },
                "submitdata": function ( value, settings ) {
                    return {
                        "row_id": this.parentNode.getAttribute('id'),
                        "column": oTable.fnGetPosition( this )[2]
                    };
                },

                "width": "90%",
                "height": "100%"
            } );


        });

        $(document).ready(function() {
            $('.chart').easyPieChart({
                barColor: '#f8ac59',
//                scaleColor: false,
                scaleLength: 5,
                lineWidth: 4,
                size: 80
            });

            $('.chart2').easyPieChart({
                barColor: '#1c84c6',
//                scaleColor: false,
                scaleLength: 5,
                lineWidth: 4,
                size: 80
            });

            var data2 = [
                [gd(2016, 1, 1), 400], [gd(2016, 2, 1), 300], [gd(2016, 3, 1), 180], [gd(2016, 4, 1), 150],
                [gd(2016, 5, 1), 88], [gd(2016, 6, 1), 455], [gd(2016, 7, 1), 93]
            ];

            var data3 = [
                [gd(2016, 1, 1), 800], [gd(2016, 2, 1), 500], [gd(2016, 3, 1), 600], [gd(2016, 4, 1), 700],
                [gd(2016, 5, 1), 178], [gd(2016, 6, 1), 555], [gd(2016, 7, 1), 993]
            ];

            var dataset = [
                {
                    label: "Receita Prevista",
                    data: data3,
                    color: "#1ab394",
                    bars: {
                        show: true,
                        align: "center",
                        barWidth: 24 * 60 * 60 * 600,
                        lineWidth:0
                    }

                }, {
                    label: "Receita Realizada",
                    data: data2,
                    yaxis: 2,
                    color: "#1C84C6",
                    lines: {
                        lineWidth:1,
                            show: true,
                            fill: true,
                        fillColor: {
                            colors: [{
                                opacity: 0.2
                            }, {
                                opacity: 0.4
                            }]
                        }
                    },
                    splines: {
                        show: false,
                        tension: 0.6,
                        lineWidth: 1,
                        fill: 0.1
                    },
                }
            ];


            var options = {
                xaxis: {
                    mode: "time",
                    tickSize: [3, "month"],
                    tickLength: 0,
                    axisLabel: "Date",
                    axisLabelUseCanvas: true,
                    axisLabelFontSizePixels: 12,
                    axisLabelFontFamily: 'Arial',
                    axisLabelPadding: 10,
                    color: "#d5d5d5"
                },
                yaxes: [{
                    position: "left",
                    max: 1070,
                    color: "#d5d5d5",
                    axisLabelUseCanvas: true,
                    axisLabelFontSizePixels: 12,
                    axisLabelFontFamily: 'Arial',
                    axisLabelPadding: 3
                }, {
                    position: "right",
                    clolor: "#d5d5d5",
                    axisLabelUseCanvas: true,
                    axisLabelFontSizePixels: 12,
                    axisLabelFontFamily: ' Arial',
                    axisLabelPadding: 67
                }
                ],
                legend: {
                    noColumns: 1,
                    labelBoxBorderColor: "#000000",
                    position: "nw"
                },
                grid: {
                    hoverable: false,
                    borderWidth: 0
                }
            };

            function gd(year, month, day) {
                return new Date(year, month - 1, day).getTime();
            }

            var previousPoint = null, previousLabel = null;

            $.plot($("#flot-dashboard-chart"), dataset, options);

            var mapData = {
                "US": 298,
                "SA": 200,
                "DE": 220,
                "FR": 540,
                "CN": 120,
                "AU": 760,
                "BR": 550,
                "IN": 200,
                "GB": 120,
            };

            $('#world-map').vectorMap({
                map: 'world_mill_en',
                backgroundColor: "transparent",
                regionStyle: {
                    initial: {
                        fill: '#e4e4e4',
                        "fill-opacity": 0.9,
                        stroke: 'none',
                        "stroke-width": 0,
                        "stroke-opacity": 0
                    }
                },

                series: {
                    regions: [{
                        values: mapData,
                        scale: ["#1ab394", "#22d6b1"],
                        normalizeFunction: 'polynomial'
                    }]
                },
            });
        });
    </script>
</body>
</html>
