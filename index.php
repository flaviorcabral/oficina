<?php

ini_set ('display_errors', 1 );
error_reporting ( E_ALL | E_STRICT );
error_reporting (0);

include_once 'config.php';

$con = new Controller();
$con->pagLogin();

?>
<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Template | Acesso </title>

    <link href="templates/css/bootstrap.min.css" rel="stylesheet">
    <link href="templates/font-awesome/css/font-awesome.css" rel="stylesheet">

    <link href="templates/css/animate.css" rel="stylesheet">
    <link href="templates/css/style.css" rel="stylesheet">

</head>

<body class="gray-bg">

    <div class="middle-box text-center loginscreen animated fadeInDown">
        <div>
            <h3>Bem vindo</h3>
            <div class="m-b-sm">
                    <img alt="<< Colocar imagem logo oficina >>" class="img-square img-responsive" src="" style="width: 210px">
            </div>
            <p>Simplificando a gestão Oficinas</p>
            <p><strong>Informe os dados de acesso.</strong></p>
            <form class="m-t" role="form" method="post" action="app/views/validaacesso.php">
                <div class="form-group">
                    <input id="cdusua" name = "cdusua" type="text" class="form-control" placeholder="código" required="">
                </div>
                <div class="form-group">
                    <input id="desenh" name = "desenh" type="password" class="form-control" placeholder="senha" required="">
                </div>
                <button type="submit" name="login" class="btn btn-warning block full-width m-b">Acessar</button>
            </form>
            <p class="m-t"> <small>Template oficina 2017</small> </p>
        </div>
    </div>

    <!-- Mainly scripts -->
    <script src="templates/js/jquery-2.1.1.js"></script>
    <script src="templates/js/bootstrap.min.js"></script>

</body>

</html>
