<?php
    $BDSERVIDOR = 'localhost';
    $BDUSUARIO = 'junio314_of';
    $BDSENHA = 'oficinas2407';
    $BDBANCO = 'junio314_of';

    $conexao = mysqli_connect($bdServidor, $bdUsuario, $bdSenha, $bdBanco);

    if (mysqli_connect_errno($conexao)) {
        echo "Problemas para conectar no banco de dados Oficina Light. Se o problema persistir, pedimos desculpas e, por favor, envie um e-mail para nós!";
        die();
    }

    $resultado=mysqli_query($conexao,"SET NAMES 'utf8'");
    $resultado=mysqli_query($conexao,'SET character_set_connection=utf8');
    $resultado=mysqli_query($conexao,'SET character_set_client=utf8');
    $resultado=mysqli_query($conexao,'SET character_set_results=utf8');

?>