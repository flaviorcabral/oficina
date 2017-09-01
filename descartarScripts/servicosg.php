<?php

	include "banco.php";
	include "util.php";

	$data = date('Y-m-d');
	$cdserv = $_POST["cdserv"];
	$deserv = $_POST["deserv"];
	$qtserv = $_POST["qtserv"];
	$vlserv = $_POST["vlserv"];

	$vlserv= str_replace(".","",$vlserv);
	$vlserv= str_replace(",",".",$vlserv);

	$Flag = true;

	$aserv = ConsultarDados("", "", "","select * from servicos where cdserv = "."'{$cdserv}'");

	if (count($aserv) > 0) {
		$demens = "Código do serviço já cadastrado!";
		$detitu = "Demonstração Auto Mecânica&copy; | Cadastro de Serviços";
		header('Location: mensagem.php?demens='.$demens.'&detitu='.$detitu);
		$Flag=false;
	}

	if ($Flag == true) {

		//campos da tabela
		$aNomes=array();

		$aNomes[]= "cdserv";
		$aNomes[]= "deserv";
		$aNomes[]= "qtserv";
		$aNomes[]= "vlserv";

		//dados da tabela
		$aDados=array();
		$aDados[]= $cdserv;
		$aDados[]= $deserv;
		$aDados[]= $qtserv;
		$aDados[]= $vlserv;

		IncluirDados("servicos", $aDados, $aNomes);

		$demens = "Cadastro efetuado com sucesso!";
		$detitu = "Demonstração Auto Mecânica&copy; | Cadastro de Serviços";
		$devolt = "servicos.php";
		header('Location: mensagem.php?demens='.$demens.'&detitu='.$detitu.'&devolt='.$devolt);
	}

?>