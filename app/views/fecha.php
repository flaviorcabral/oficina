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

    $aOrde= ConsultarDados("", "", "","select * from m_ordem");

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
                            <span class="m-r-sm text-muted welcome-message">Benvindo a <strong>Demonstração Auto Mecânica&copy;</strong></span>
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
                                                        class="fa fa-calculator"></i> Fechamento de Ordem de Serviços
                            </button>
                        </div>

                        <div class="ibox-content">
                            <div class="pull-left">
                                <a onclick="#" href="ordemi.php" class="btn btn-warning ">Incluir</a>
                            </div>
                            <br>
                            <br>
                            <br>
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover dataTables-example" >
                                    <thead>
                                        <tr>
                                            <th>No. Controle</th>
                                            <th>Cliente</th>
                                            <th>Emissão</th>
                                            <th>Valor Total</th>
                                            <th>Valor Tributos</th>
                                            <th>Situação</th>
                                            <th class="text-right" data-sort-ignore="true">Ação</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php for ($f =0; $f <= (count($aOrde)-1); $f++) { ?>
                                            <tr class="gradeX">

                                                <?php $coluna1 = $aOrde[$f]["cdorde"]; ?>
                                                <?php $coluna2 = $aOrde[$f]["cdclie"]; ?>
                                                <?php $coluna3 = traduz_data_para_exibir($aOrde[$f]["dtemis"]); ?>
                                                <?php $coluna4 = $aOrde[$f]["vltota"]; ?>
                                                <?php $coluna5 = $aOrde[$f]["vlimpo"]; ?>
                                                <?php $coluna6 = $aOrde[$f]["flstat"]; ?>

                                                <?php
                                                $coluna6="C";
                                                switch ($coluna6) {
                                                     case 'P':
                                                         $coluna6 = "Pendente";
                                                         break;

                                                     case 'A':
                                                         $coluna6 = "Andamento";
                                                         break;

                                                     case 'C':
                                                         $coluna6 = "Concluído";
                                                         break;

                                                     case 'E':
                                                         $coluna6 = "Entregue";
                                                         break;
                                                     
                                                     default:
                                                         $coluna6 = " ";
                                                         break;
                                                 } 

                                                 $coluna4 = number_format($coluna4,2,',','.');       
                                                 $coluna5 = number_format($coluna5,2,',','.');       

                                                ?> 

                                                <?php $ver = "ordemacoes.php?acao=ver&chave=".$coluna1; ?>
                                                <?php $edita = "ordemacoes.php?acao=edita&chave=".$coluna1; ?>
                                                <?php $apaga = "ordemacoes.php?acao=apaga&chave=".$coluna1; ?>
                                                <?php $imprime = "ordemp.php?acao=imprime&chave=".$coluna1; ?>

                                                <td><?php print $coluna1; ?></td>
                                                <td><?php print $coluna2; ?></td>
                                                <td><?php print $coluna3; ?></td>
                                                <td><?php print $coluna4; ?></td>
                                                <td><?php print $coluna5; ?></td>
                                                <td><?php print $coluna6; ?></td>

                                                <td class="text-right">

                                                    <div class="btn-group">
                                                        <button class="fa fa-eye btn-white btn btn-xs" name="ver" type="button" onclick="window.open('<?php echo $ver;?>','_parent')"></button>
                                                        <button class="fa fa-edit btn-white btn btn-xs" name="edita" type="button" onclick="window.open('<?php echo $edita;?>','_parent')"></button>
                                                        <button class="fa fa-trash btn-white btn btn-xs" name="apaga" type="button" onclick="window.open('<?php echo $apaga;?>','_parent')"></button>
                                                        <button class="fa fa-print btn-white btn btn-xs" name="imprime" type="button" onclick="window.open('<?php echo $imprime;?>','_parent')"></button>
                                                    </div>
                                                </td>

                                            </tr>
                                        <?php }; ?>    
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>No. Controle</th>
                                            <th>Cliente</th>
                                            <th>Emissão</th>
                                            <th>Valor Total</th>
                                            <th>Valor Tributos</th>
                                            <th>Situação</th>
                                            <th class="text-right" data-sort-ignore="true">Ação</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <br>

                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover">
                                    <caption><strong>* AJUDA</strong></caption>
                                    <thead>
                                        <tr>
                                            <th width=5>Comando</th>
                                            <th width=100>Descrição</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td >Show</td>
                                            <td >Controla a quantidade de linhas a serem apresentadas na tabela.</td>
                                        </tr>
                                        <tr>
                                            <td >entriesSearch</td>
                                            <td >É a pesquisa. Apresenta os dados filtrados conforme o conteúdo digitado.</td>
                                        </tr>
                                        <tr>
                                            <td >Copy</td>
                                            <td >Copia o conteúdo da tabela para a memória (clipboard).</td>
                                        </tr>
                                        <tr>
                                            <td >CSV</td>
                                            <td >Exporta os dados da tabela para um arquivo no formato CSV (arquivo texto com as informações separadas por vírgula).</td>
                                        </tr>
                                        <tr>
                                            <td >Excel</td>
                                            <td >Exporta os dados da tabela para um arquivo no formato EXCEL.</td>
                                        </tr>
                                        <tr>
                                            <td >PDF</td>
                                            <td >Exporta os dados da tabela para um arquivo no formato PDF.</td>
                                        </tr>
                                        <tr>
                                            <td >Print</td>
                                            <td >Imprime os dados da tabela.</td>
                                        </tr>
                                        <tr>
                                            <td >Previous</td>
                                            <td >Retorna uma página da tabela.</td>
                                        </tr>
                                        <tr>
                                            <td >Next</td>
                                            <td >Avança uma página da tabela.</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
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
</body>
</html>
