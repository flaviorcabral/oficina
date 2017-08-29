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
    case 'imprime':
        $titulo = "Impressão";
        break;
    default:
        header('Location: fichacadastral.php');
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

    $aItem = ConsultarDados("ordemi", "cdorde", $chave);

    $aOrde = ConsultarDados("ordem", "cdorde", $chave);
    $pos = strpos($aOrde[0]["cdclie"], "-");
    $cdclie = substr($aOrde[0]["cdclie"], 0, $pos-1);

    $aClie = ConsultarDados("clientes", "cdclie", $cdclie);
    $declie = $aClie[0]["declie"];

    $dtorde = $aOrde[0]["dtorde"];
    $dtorde = strtotime($dtorde);
    $dtorde = date("d-m-Y", $dtorde);

    $aPara = ConsultarDados("", "", "", "select * from parametros");

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

<body class="white-bg">
	<div class="wrapper wrapper-content p-xl">
        <h1><center>Ordem de Serviço</center></h1>
        <p><center><img src="templates/img/logoalianca.png" alt="logo" width="250" height="150" ></center></p>
        <h2><center><?php echo $aPara[0]["deprop"]; ?></center></h2>
        <h3><center><?php echo 'CNPJ               : '.$aPara[0]["cdprop"]; ?></center></h3>
        <h3><center><?php echo 'CCM                : '.$aPara[0]["nrccm"]; ?></center></h3>
        <!--h3><center><?php echo 'INSCRIÇÃO ESTADUAL : '.$aPara[0]["nrinsc"]; ?></center></h3-->
        <h5><center><?php echo $aPara[0]["deende"].", ".$aPara[0]["nrende"].", ".$aPara[0]["decomp"].", ".$aPara[0]["debair"].", ".$aPara[0]["decida"].", ".$aPara[0]["cdesta"].", ".$aPara[0]["nrcepi"]; ?></center></h5>
		<!--div class="ibox-content p-xl"-->
            <center>
                <table class="table-striped table-bordered">
                    <tr>
                        <td>Data de Abertura</td>
                        <td>: <?php echo $dtorde; ?></td>
                    </tr>
                    <tr>
                        <td>Número OS</td>
                        <td>: <?php echo $aOrde[0]["cdorde"]; ?></td>
                    </tr>
                    <tr>
                        <td>Cliente</td>
                        <td>: <?php echo $aClie[0]["cdclie"]." - ".$aClie[0]["declie"]; ?></td>
                    </tr>
                    <tr>
                        <td>Endereço</td>
                        <td>: <?php echo $aClie[0]["deende"].", ".$aClie[0]["nrende"].", ".$aClie[0]["decomp"]; ?></td>
                    </tr>
                    <tr>
                        <td>Bairro</td>
                        <td>: <?php echo $aClie[0]["debair"]; ?></td>
                    </tr>
                    <tr>
                        <td>Cidade</td>
                        <td>: <?php echo $aClie[0]["decida"]; ?></td>
                    </tr>
                    <tr>
                        <td>Estado</td>
                        <td>: <?php echo $aClie[0]["cdesta"]; ?></td>
                    </tr>
                    <tr>
                        <td>Cep</td>
                        <td>: <?php echo $aClie[0]["nrcepi"]; ?></td>
                    </tr>
                    <tr>
                        <td>Telefone</td>
                        <td>: <?php echo $aClie[0]["nrtele"]; ?></td>
                    </tr>
                    <tr>
                        <td>Situação</td>
                        <td>: <?php echo $aOrde[0]["cdsitu"]; ?></td>
                    </tr>
                    <tr>
                        <td>Placa do Veículo</td>
                        <td>: <?php echo $aOrde[0]["veplac"]; ?></td>
                    </tr>
                    <tr>
                        <td>Marca do Veículo</td>
                        <td>: <?php echo $aOrde[0]["vemarc"]; ?></td>
                    </tr>
                    <tr>
                        <td>Modelo do Veículo</td>
                        <td>: <?php echo $aOrde[0]["vemode"]; ?></td>
                    </tr>
                    <tr>
                        <td>Cor do Veículo</td>
                        <td>: <?php echo $aOrde[0]["vecorv"]; ?></td>
                    </tr>
                    <tr>
                        <td>Ano de Fabricação</td>
                        <td>: <?php echo $aOrde[0]["veanof"]; ?></td>
                    </tr>
                    <tr>
                        <td>Ano Modelo</td>
                        <td>: <?php echo $aOrde[0]["veanom"]; ?></td>
                    </tr>
                </table>
            </center>
            <br>            
            <div class="row">
                <div class="table responsive">
                    <table class="table table-striped table-bordered ">
                        <thead>
                            <th style = "width:10%">Sequência</th>
                            <th style = "width:40%">Produto/Peça/Serviço</th>
                            <th style = "width:10%">Quantidade</th>
                            <th style = "width:10%">Valor Unitário</th>
                            <th style = "width:20%">Valor Total</th>
                        </thead>
                        <tbody>
                            <?php for ($f =1; $f <= 10; $f++) { ?>
                                <?php $cditem = "cditem[".trim($f)."]"; ?>
                                <?php $qtitem = "qtitem[".trim($f)."]"; ?>
                                <?php $vlitem = "vlitem[".trim($f)."]"; ?>
                                <?php $vltota = "vltota[".trim($f)."]"; ?>
                                <tr>
                                    <?php if (isset($aItem[$f-1]["cdpeca"])) {?>
                                        <td><?php echo $f;?></td>
                                        <td><center><?php echo $aItem[$f-1]["cdpeca"]; ?></center></td>
                                        <td><center><input id = "<?php echo $qtitem;?>" name="<?php echo $qtitem;?>" value = "<?php echo number_format($aItem[$f-1]["qtpeca"],0,",",".") ;?>" onkeyup="mascara(this, 'soNumeros'); calcula();" type="text" class="form-control" placeholder="" maxlength = "15" readonly=""></center></td>
                                        <td><center><input id = "<?php echo $vlitem;?>" name="<?php echo $vlitem;?>" value = "<?php echo number_format($aItem[$f-1]["vlpeca"],2,",",".") ;?>" onkeyup="mascara(this, 'soNumeros'); calcula();" type="text" class="form-control" placeholder="" maxlength = "15" readonly=""></center></td>
                                        <td><center><input id = "<?php echo $vltota;?>" name="<?php echo $vltota;?>" value = "<?php echo number_format($aItem[$f-1]["vltota"],2,",",".") ;?>" type="text" class="form-control" placeholder="" maxlength = "15" readonly = ""></center></td>
                                    <?php }?>
                                </tr>
                            <?php }?>
                            <tr>
                                <td colspan="4">Total</td>
                                <td colspan="5"><?php echo number_format($aOrde[0]["vlorde"],2,",","."); ?></td></tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <table>
                <tr>
                    <td>Forma de Pagamento</td>
                    <td>: <?php echo $aOrde[0]["cdform"]; ?></td>
                </tr>
                <tr>
                    <td>Quantidade de Parcelas</td>
                    <td>: <?php echo $aOrde[0]["qtform"]; ?></td>
                </tr>
                <tr>
                    <td>Observações</td>
                    <td>: <?php echo $aOrde[0]["deobse"]; ?></td>
                </tr>
            </table>
            <br>
            <br>
            <center><small><strong>Comprovante para simples conferência. Sem teor fiscal.</strong></small></center>

 		<!--/div-->
	</div>
    <!-- Mainly scripts -->
    <script src="../../templates/js/jquery-2.1.1.js"></script>
    <script src="../../templates/js/bootstrap.min.js"></script>
    <script src="../../templates/js/plugins/metisMenu/jquery.metisMenu.js"></script>

    <!-- Custom and plugin javascript -->
    <script src="../../templates/js/inspinia.js"></script>

    <script type="text/javascript">
        window.print();
    </script>
</body>

</html>

