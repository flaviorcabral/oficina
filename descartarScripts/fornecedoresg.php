<?php

	include "banco.php";
	include "util.php";

	$data = date('Y-m-d');
	$cdforn = $_POST["cdforn"];
	$demail = $_POST["demail"];
	$Flag = true;

	if (strlen($cdforn) < 12 ) {
		$cdforn=RetirarMascara($cdforn,"cpf");
		if ( validaCPF($cdforn) == false) {
			$demens = "Cpf inválido!";
			$detitu = "Demonstração Auto Mecânica&copy; | Cadastro de fornecedores";
			header('Location: mensagem.php?demens='.$demens.'&detitu='.$detitu);
			$Flag=false;
		}
	} Else {
		$cdforn=RetirarMascara($cdforn,"cnpj");
		if ( validaCNPJ($cdforn) == false) {
			$demens = "Cnpj inválido!";
			$detitu = "Demonstração Auto Mecânica&copy; | Cadastro de fornecedores";
			header('Location: mensagem.php?demens='.$demens.'&detitu='.$detitu);
			$Flag=false;
		}
	}

	$aTrab = ConsultarDados("fornecedores", "cdforn", $cdforn);
	if ( count($aTrab) > 0) {
		$demens = "Cpf/Cnpj já cadastrado!";
		$detitu = "Demonstração Auto Mecânica&copy; | Cadastro de fornecedores";
		header('Location: mensagem.php?demens='.$demens.'&detitu='.$detitu);
		$Flag=false;
	}

	if ($Flag == true) {

		//campos da tabela
		$aNomes=array();
		$aNomes[]= "cdforn";
		$aNomes[]= "deforn";
		$aNomes[]= "cdtipo";
		$aNomes[]= "nrinsc";
		$aNomes[]= "nrccm";
		$aNomes[]= "nrrg";
		$aNomes[]= "deende";
		$aNomes[]= "nrende";
		$aNomes[]= "decomp";
		$aNomes[]= "debair";
		$aNomes[]= "decida";
		$aNomes[]= "cdesta";
		$aNomes[]= "nrcepi";
		$aNomes[]= "nrtele";
		$aNomes[]= "nrcelu";
		$aNomes[]= "demail";
		$aNomes[]= "deobse";
		$aNomes[]= "flativ";
		$aNomes[]= "dtcada";

		//dados da tabela
		$aDados=array();
		$aDados[]= $_POST["cdforn"];
		$aDados[]= $_POST["deforn"];
		$aDados[]= $_POST["cdtipo"];
		$aDados[]= $_POST["nrinsc"];
		$aDados[]= $_POST["nrccm"];
		$aDados[]= $_POST["nrrg"];
		$aDados[]= $_POST["deende"];
		$aDados[]= $_POST["nrende"];
		$aDados[]= $_POST["decomp"];
		$aDados[]= $_POST["debair"];
		$aDados[]= $_POST["decida"];
		$aDados[]= $_POST["cdesta"];
		$aDados[]= $_POST["nrcepi"];
		$aDados[]= $_POST["nrtele"];
		$aDados[]= $_POST["nrcelu"];
		$aDados[]= $_POST["demail"];
		$aDados[]= $_POST["deobse"];
		$aDados[]= "S";
		$aDados[]= $data;

		IncluirDados("fornecedores", $aDados, $aNomes);


		//gravar log
		//GravarIPLog($cdusua, "Alterar Meus Dados:");

		$demens = "Cadastro efetuado com sucesso!";
		$detitu = "Demonstração Auto Mecânica&copy; | Cadastro de fornecedores";
		$devolt = "fornecedores.php";
		header('Location: mensagem.php?demens='.$demens.'&detitu='.$detitu.'&devolt='.$devolt);
	}

?>