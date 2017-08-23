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
        header('Location: fichacadastral.php');
    }

    //codigo do usuario
    if (isset($_COOKIE['cdusua'])) {
        $cdusua = $_COOKIE['cdusua'];
    }

    //codigo do usuario
    if (isset($_COOKIE['cdusua'])) {
        $cdusua = $_COOKIE['cdusua'];
    } Else {
        header('Location: index.html');
    }

    // nome do usuario
    if (isset($_COOKIE['deusua'])) {
        $deusua = $_COOKIE['deusua'];
    } Else {
        header('Location: index.html');
    }

    //tipo de usuario
    if (isset($_COOKIE['cdtipo'])) {
        $cdtipo = $_COOKIE['cdtipo'];
    } Else {
        header('Location: index.html');
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
    if ($cdtipo == "F") {
        $detipo="Funcionário";
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

    $aClie = ConsultarDados("clientes", "cdclie", $chave);
    $aEsta = ConsultarDados("", "", "","select * from estados order by cdesta");

?>
<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Demonstração Auto Mecânica&copy; | Principal </title>

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
                            <span class="m-r-sm text-muted welcome-message">Benvindo ao <strong>Demonstração Auto Mecânica&copy;</strong></span>
                        </li>
                        <li>
                            <a href="../../index.php">
                                <i class="fa fa-sign-out"></i> Sair
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
            <div class="wrapper wrapper-content">
                <!--div class="col-lg-12"-->
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <button type="button" class="btn btn-warning btn-lg btn-block"><i
                                                        class="fa fa-user"></i> Cadastro de Clientes - <small><?php echo $titulo; ?></small>
                            </button>
                        </div>

                        <div class="ibox-content">
                            <form class="form-horizontal" method="POST" enctype="multipart/form-data" action="clienteaa.php">
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
                                <br>
                                <?php if($acao == "edita") {?>
                                    <div class="row">
                                        <!--div class="col-lg-6"-->
                                            <br>
                                            <div class="form-group">
                                                <label class="col-md-2 control-label" for="textinput">Cpf/Cnpj</label>
                                                <div class="col-md-3">
                                                    <input id="cdclie" name="cdclie" type="text" value="<?php echo $aClie[0]["cdclie"];?>" placeholder="" class="form-control" maxlength = "14" autofocus readonly="">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-md-2 control-label" for="textinput">Nome/Razão Social</label>
                                                <div class="col-md-8 ">
                                                    <input id="declie" name="declie" value="<?php echo $aClie[0]["declie"];?>" type="text" placeholder="" class="form-control" maxlength = "100" required="">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-md-2 control-label" for="textinput">Tipo de Empresa</label>
                                                <div class="col-md-10">
                                                    <select name="cdtipo" id="cdtipo">
                                                        <?php if (substr($aClie[0]["cdtipo"], 0,1) == "J") {?>
                                                            <option selected= "selected">Jurídica</option>
                                                            <option>Física</option>
                                                        <?php } Else {?>
                                                            <option>Jurídica</option>
                                                            <option  selected= "selected">Física</option>
                                                        <?php }?>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-md-2 control-label" for="textinput">Inscrição Estadual</label>
                                                <div class="col-md-8">
                                                    <input id="nrinsc" name="nrinsc" value="<?php echo $aClie[0]["nrinsc"];?>" type="text" placeholder="Isento" class="form-control" maxlength = "20">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-md-2 control-label" for="textinput">Inscrição Municipal</label>
                                                <div class="col-md-8">
                                                    <input id="nrccm" name="nrccm" value="<?php echo $aClie[0]["nrccm"];?>" type="text" placeholder="" class="form-control" maxlength = "20">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-md-2 control-label" for="textinput">RG</label>
                                                <div class="col-md-8">
                                                    <input id="nrrg" name="nrrg" value="<?php echo $aClie[0]["nrrg"];?>" type="text" placeholder="" class="form-control" maxlength = "20">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-md-2 control-label" for="textinput">Cep</label>
                                                <div class="col-md-2">
                                                    <input id="nrcepi" name="nrcepi" value="<?php echo $aClie[0]["nrcepi"];?>" onblur="pesquisacep(this.value);" type="text" placeholder="" class="form-control" maxlength = "08">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-md-2 control-label" for="textinput">Endereço</label>
                                                <div class="col-md-8">
                                                    <input id="deende" name="deende" value="<?php echo $aClie[0]["deende"];?>" type="text" placeholder="" class="form-control" maxlength = "100">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-md-2 control-label" for="textinput">Número</label>
                                                <div class="col-md-2">
                                                    <input id="nrende" name="nrende" value="<?php echo $aClie[0]["nrende"];?>" type="number" placeholder="" class="form-control" maxlength = "10">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-md-2 control-label" for="textinput">Complemento</label>
                                                <div class="col-md-4">
                                                    <input id="decomp" name="decomp" value="<?php echo $aClie[0]["decomp"];?>" type="text" placeholder="" class="form-control" maxlength = "50">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-md-2 control-label" for="textinput">Bairro</label>
                                                <div class="col-md-4">
                                                    <input id="debair" name="debair" value="<?php echo $aClie[0]["debair"];?>" type="text" placeholder="" class="form-control" maxlength = "50">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-md-2 control-label" for="textinput">Cidade</label>
                                                <div class="col-md-4">
                                                    <input id="decida" name="decida" value="<?php echo $aClie[0]["decida"];?>" type="text" placeholder="" class="form-control" maxlength = "50">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-md-2 control-label" for="textinput">Estado</label>
                                                <div class="col-md-4">
                                                    <input id="cdesta" name="cdesta" value="<?php echo $aClie[0]["cdesta"];?>" type="text" placeholder="" class="form-control" maxlength = "02">
                                                    <!--select name="cdesta" id="cdesta" style="width:350px;"-->
                                                        <!--?php for($i=0;$i < count($aEsta);$i++) { ?-->
                                                          <!--?php if ($aClie[0]["cdesta"] == str_pad($aEsta[$i]["cdesta"],02," ",STR_PAD_LEFT)." - ".$aEsta[$i]["deesta"]) {?-->
                                                            <!--option selected =""><?php echo str_pad($aEsta[$i]["cdesta"],02," ",STR_PAD_LEFT)." - ".$aEsta[$i]["deesta"];?></option-->
                                                          <!--?php } Else {?-->
                                                            <!--option><?php echo str_pad($aEsta[$i]["cdesta"],02," ",STR_PAD_LEFT)." - ".$aEsta[$i]["deesta"];?></option-->
                                                          <!--?php }?-->
                                                        <!--?php }?-->
                                                    <!--/select-->
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-md-2 control-label" for="textinput">Telefone</label>
                                                <div class="col-md-4">
                                                    <input id="nrtele" name="nrtele" value="<?php echo $aClie[0]["nrtele"];?>" type="text" placeholder="(11) 1234-1234" class="form-control" maxlength = "20">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-md-2 control-label" for="textinput">Celular</label>
                                                <div class="col-md-4">
                                                    <input id="nrcelu" name="nrcelu" value="<?php echo $aClie[0]["nrcelu"];?>" type="text" placeholder="(11) 9-1234-1234" class="form-control" maxlength = "20">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-md-2 control-label" for="textinput">E-Mail</label>
                                                <div class="col-md-8">
                                                    <input id="demail" name="demail" value="<?php echo $aClie[0]["demail"];?>" type="email" placeholder="seuemail@seuprovedor.com.br" class="form-control" maxlength = "255">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-md-2 control-label" for="textinput">Observações</label>
                                                <div class="col-md-8">
                                                    <textarea class="form-control" id="deobse" wrap="physical" cols=50 rows=3 name="deobse" placeholder=""><?php echo $aClie[0]["deobse"];?></textarea>
                                                </div>
                                            </div>

                                        <!--/div-->
                                    </div>
                                <?php }?>
                                <?php if($acao !== "edita") {?>
                                    <div class="row">
                                        <!--div class="col-lg-6"-->
                                            <br>
                                            <div class="form-group">
                                                <label class="col-md-2 control-label" for="textinput">Cpf/Cnpj</label>
                                                <div class="col-md-3">
                                                    <input id="cdclie" name="cdclie" type="text" value="<?php echo $aClie[0]["cdclie"];?>" placeholder="" class="form-control" maxlength = "14" autofocus readonly="">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-md-2 control-label" for="textinput">Nome/Razão Social</label>
                                                <div class="col-md-8 ">
                                                    <input id="declie" name="declie" value="<?php echo $aClie[0]["declie"];?>" type="text" placeholder="" class="form-control" maxlength = "100" readonly="">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-md-2 control-label" for="textinput">Tipo de Empresa</label>
                                                <div class="col-md-10">
                                                    <select name="cdtipo" id="cdtipo" disabled ="">
                                                        <?php if (substr($aClie[0]["cdtipo"], 0,1) == "J") {?>
                                                            <option selected= "selected">Jurídica</option>
                                                            <option>Física</option>
                                                        <?php } Else {?>
                                                            <option>Jurídica</option>
                                                            <option  selected= "selected">Física</option>
                                                        <?php }?>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-md-2 control-label" for="textinput">Inscrição Estadual</label>
                                                <div class="col-md-8">
                                                    <input id="nrinsc" name="nrinsc" value="<?php echo $aClie[0]["nrinsc"];?>" type="text" placeholder="Isento" class="form-control" maxlength = "20" readonly="">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-md-2 control-label" for="textinput">Inscrição Municipal</label>
                                                <div class="col-md-8">
                                                    <input id="nrccm" name="nrccm" value="<?php echo $aClie[0]["nrccm"];?>" type="text" placeholder="" class="form-control" maxlength = "20" readonly="">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-md-2 control-label" for="textinput">RG</label>
                                                <div class="col-md-8">
                                                    <input id="nrrg" name="nrrg" value="<?php echo $aClie[0]["nrrg"];?>" type="text" placeholder="" class="form-control" maxlength = "20" readonly="">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-md-2 control-label" for="textinput">Endereço</label>
                                                <div class="col-md-8">
                                                    <input id="deende" name="deende" value="<?php echo $aClie[0]["deende"];?>" type="text" placeholder="" class="form-control" maxlength = "100" readonly="">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-md-2 control-label" for="textinput">Número</label>
                                                <div class="col-md-2">
                                                    <input id="nrende" name="nrende" value="<?php echo $aClie[0]["nrende"];?>" type="number" placeholder="" class="form-control" maxlength = "10" readonly="">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-md-2 control-label" for="textinput">Complemento</label>
                                                <div class="col-md-4">
                                                    <input id="decomp" name="decomp" value="<?php echo $aClie[0]["decomp"];?>" type="text" placeholder="" class="form-control" maxlength = "50" readonly="">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-md-2 control-label" for="textinput">Bairro</label>
                                                <div class="col-md-4">
                                                    <input id="debair" name="debair" value="<?php echo $aClie[0]["debair"];?>" type="text" placeholder="" class="form-control" maxlength = "50" readonly="">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-md-2 control-label" for="textinput">Cidade</label>
                                                <div class="col-md-4">
                                                    <input id="decida" name="decida" value="<?php echo $aClie[0]["decida"];?>" type="text" placeholder="" class="form-control" maxlength = "50" readonly="">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-md-2 control-label" for="textinput">Cep</label>
                                                <div class="col-md-2">
                                                    <input id="nrcepi" name="nrcepi" value="<?php echo $aClie[0]["nrcepi"];?>" type="text" placeholder="" class="form-control" maxlength = "08" readonly="">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-md-2 control-label" for="textinput">Estado</label>
                                                <div class="col-md-4">
                                                    <input id="cdesta" name="cdesta" value="<?php echo $aClie[0]["cdesta"];?>" type="text" placeholder="" class="form-control" maxlength = "02" readonly="">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-md-2 control-label" for="textinput">Telefone</label>
                                                <div class="col-md-4">
                                                    <input id="nrtele" name="nrtele" value="<?php echo $aClie[0]["nrtele"];?>" type="text" placeholder="(11) 1234-1234" class="form-control" maxlength = "20" readonly="">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-md-2 control-label" for="textinput">Celular</label>
                                                <div class="col-md-4">
                                                    <input id="nrcelu" name="nrcelu" value="<?php echo $aClie[0]["nrcelu"];?>" type="text" placeholder="(11) 9-1234-1234" class="form-control" maxlength = "20" readonly="">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-md-2 control-label" for="textinput">E-Mail</label>
                                                <div class="col-md-8">
                                                    <input id="demail" name="demail" value="<?php echo $aClie[0]["demail"];?>" type="email" placeholder="seuemail@seuprovedor.com.br" class="form-control" maxlength = "255" readonly="">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-md-2 control-label" for="textinput">Observações</label>
                                                <div class="col-md-8">
                                                    <textarea class="form-control" id="deobse" wrap="physical" cols=50 rows=3 name="deobse" placeholder="" readonly=""><?php echo $aClie[0]["deobse"];?></textarea>
                                                </div>
                                            </div>

                                        <!--/div-->
                                    </div>
                                <?php }?>
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

    <script type="text/javascript" >
    
        function limpa_formulário_cep() {
                //Limpa valores do formulário de cep.
                document.getElementById('deende').value=("");
                document.getElementById('debair').value=("");
                document.getElementById('decida').value=("");
                document.getElementById('cdesta').value=("");
        }

        function meu_callback(conteudo) {
            if (!("erro" in conteudo)) {
                //Atualiza os campos com os valores.
                document.getElementById('deende').value=(conteudo.logradouro);
                document.getElementById('debair').value=(conteudo.bairro);
                document.getElementById('decida').value=(conteudo.localidade);
                document.getElementById('cdesta').value=(conteudo.uf);
            } //end if.
            else {
                //CEP não Encontrado.
                limpa_formulário_cep();
                alert("CEP não encontrado.");
            }
        }
        
        function pesquisacep(valor) {

            //Nova variável "cep" somente com dígitos.
            var cep = valor.replace(/\D/g, '');

            //Verifica se campo cep possui valor informado.
            if (cep != "") {

                //Expressão regular para validar o CEP.
                var validacep = /^[0-9]{8}$/;

                //Valida o formato do CEP.
                if(validacep.test(cep)) {

                    //Preenche os campos com "..." enquanto consulta webservice.
                    document.getElementById('deende').value="...";
                    document.getElementById('debair').value="...";
                    document.getElementById('decida').value="...";
                    document.getElementById('cdesta').value="...";

                    //Cria um elemento javascript.
                    var script = document.createElement('script');

                    //Sincroniza com o callback.
                    script.src = '//viacep.com.br/ws/'+ cep + '/json/?callback=meu_callback';

                    //Insere script no documento e carrega o conteúdo.
                    document.body.appendChild(script);

                } //end if.
                else {
                    //cep é inválido.
                    limpa_formulário_cep();
                    alert("Formato de CEP inválido.");
                }
            } //end if.
            else {
                //cep sem valor, limpa formulário.
                limpa_formulário_cep();
            }
        };

    </script>


</body>
</html>
