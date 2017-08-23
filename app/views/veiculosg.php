<?php

	include "banco.php";
	include "util.php";

	$data = date('Y-m-d');
	$deplac = trim($_POST["deplac"]);

	$pos = strpos($_POST["cdclie"], "-");
	$cdclie = trim(substr($_POST["cdclie"],0,$pos));

	$Flag = true;

	$aVeic = ConsultarDados("", "", "","select * from m_veiculos where deplac = "."'{deplac}'"." and cdclie = "."'{$cdclie}'");

	if (count($aVeic)-1 > 0) {
		$demens = "Cliente já possui um veículo com essa placa!";
		$detitu = "Demonstração Auto Mecânica&copy; | Cadastro de Veículos";
		header('Location: mensagem.php?demens='.$demens.'&detitu='.$detitu);
		$Flag=false;
	}

	if ($Flag == true) {

		//campos da tabela
		$aNomes=array();

		//$aNomes[]= "cdveic";
		$aNomes[]= "deplac";
		$aNomes[]= "deanof";
		$aNomes[]= "deanom";
		$aNomes[]= "demarc";
		$aNomes[]= "demode";
		$aNomes[]= "decor";
		$aNomes[]= "cdclie";
		$aNomes[]= "flativ";
		$aNomes[]= "dtcada";

		//dados da tabela
		$aDados=array();
		//$aDados[]= $_POST["cdveic"];
		$aDados[]= $_POST["deplac"];
		$aDados[]= $_POST["deanof"];
		$aDados[]= $_POST["deanom"];
		$aDados[]= $_POST["demarc"];
		$aDados[]= $_POST["demode"];
		$aDados[]= $_POST["decor"];
		$aDados[]= $cdclie;
		$aDados[]= "S";
		$aDados[]= $data;

		IncluirDados("m_veiculos", $aDados, $aNomes);

		$demens = "Cadastro efetuado com sucesso!";
		$detitu = "Demonstração Auto Mecânica&copy; | Cadastro de Veículos";
		$devolt = "veiculos.php";
		header('Location: mensagem.php?demens='.$demens.'&detitu='.$detitu.'&devolt='.$devolt);
	}

?>