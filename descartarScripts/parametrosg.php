<?php

	include "banco.php";
	include "util.php";

	//campos da tabela
	$aNomes=array();
	$aNomes[]= "cdprop";
	$aNomes[]= "deprop";
	$aNomes[]= "nrinsc";
	$aNomes[]= "nrccm";
	$aNomes[]= "deende";
	$aNomes[]= "nrende";
	$aNomes[]= "decomp";
	$aNomes[]= "debair";
	$aNomes[]= "decida";
	$aNomes[]= "nrcepi";
	$aNomes[]= "cdesta";
	$aNomes[]= "nrtele";
	$aNomes[]= "nrcelu";
	$aNomes[]= "demail";

	//dados da tabela
	$aDados=array();
	$aDados[]= $_POST["cdprop"];
	$aDados[]= $_POST["deprop"];
	$aDados[]= $_POST["nrinsc"];
	$aDados[]= $_POST["nrccm"];
	$aDados[]= $_POST["deende"];
	$aDados[]= $_POST["nrende"];
	$aDados[]= $_POST["decomp"];
	$aDados[]= $_POST["debair"];
	$aDados[]= $_POST["decida"];
	$aDados[]= $_POST["nrcepi"];
	$aDados[]= $_POST["cdesta"];
	$aDados[]= $_POST["nrtele"];
	$aDados[]= $_POST["nrcelu"];
	$aDados[]= $_POST["demail"];

	AlterarDados("parametros", $aDados, $aNomes);

	$demens = "Parâmetros atualizados com sucesso!";
	$detitu = "Demonstração Auto Mecânica&copy; | Parâmetros do Sistema";
	$devolt = "index.php";
	header('Location: mensagem.php?demens='.$demens.'&detitu='.$detitu.'&devolt='.$devolt);

?>