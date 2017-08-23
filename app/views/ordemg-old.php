<?php

	include "banco.php";
	include "util.php";

	$data = date('Y-m-d');
	$pos = strpos($_POST["cdclie"], "-");
	$cdclie = trim(substr($_POST["cdclie"],0,$pos));

	$dtemis = traduz_data_para_banco($_POST["dtemis"]);
	$dtemis = strtotime($dtemis);
	$dtemis = date("Y-m-d", $dtemis);

	$nrnota = $_POST["nrnota"];
	$vlserv = $_POST["vlserv"];
	$vlpeca = $_POST["vlpeca"];
	$vlimpo = $_POST["vlimpo"];
	$vltota = $_POST["vltota"];
	$vloutr = $_POST["vloutr"];
	$flcanc = $_POST["flcanc"];
	$flpago = $_POST["flpago"];
	$flstat = $_POST["flstat"];

	$vlserv= str_replace(".","",$vlserv);
	$vlpeca= str_replace(".","",$vlpeca);
	$vlimpo= str_replace(".","",$vlimpo);
	$vloutr= str_replace(".","",$vloutr);
	$vltota= str_replace(".","",$vltota);

	$vlserv= str_replace(",",".",$vlserv);
	$vlpeca= str_replace(",",".",$vlpeca);
	$vlimpo= str_replace(",",".",$vlimpo);
	$vloutr= str_replace(",",".",$vloutr);
	$vltota= str_replace(",",".",$vltota);

	$Flag = true;

	//$aPeca = ConsultarDados("", "", "","select * from m_pecas where cdpeca = "."'{$cdpeca}'");

	//if (count($aPeca) > 0) {
	//	$demens = "Código da peça já cadastrado!";
	//	$detitu = "Nova Aliança Auto Mecânica&copy; | Cadastro de Peças";
	//	header('Location: mensagem.php?demens='.$demens.'&detitu='.$detitu);
	//	$Flag=false;
	//}

	if ($Flag == true) {

		//campos da tabela
		$aNomes=array();

		$aNomes[]= "cdclie";
		$aNomes[]= "dtemis";
		$aNomes[]= "nrnota";
		$aNomes[]= "vlserv";
		$aNomes[]= "vlpeca";
		$aNomes[]= "vlimpo";
		$aNomes[]= "vltota";
		$aNomes[]= "vloutr";
		$aNomes[]= "flcanc";
		$aNomes[]= "flpago";
		$aNomes[]= "flstat";

		//dados da tabela
		$aDados=array();
		$aDados[]= $cdclie;
		$aDados[]= $dtemis;
		$aDados[]= $nrnota;
		$aDados[]= $vlserv;
		$aDados[]= $vlpeca;
		$aDados[]= $vlimpo;
		$aDados[]= $vltota;
		$aDados[]= $vloutr;
		$aDados[]= $flcanc;
		$aDados[]= $flpago;
		$aDados[]= $flstat;

		IncluirDados("m_ordem", $aDados, $aNomes);

		$demens = "Cadastro efetuado com sucesso!";
		$detitu = "Nova Aliança Auto Mecânica&copy; | Cadastro de Ordem de Serviços";
		$devolt = "ordem.php";
		header('Location: mensagem.php?demens='.$demens.'&detitu='.$detitu.'&devolt='.$devolt);
	}

?>