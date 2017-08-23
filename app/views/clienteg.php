<?php

	include "banco.php";
	include "util.php";

	$data = date('Y-m-d');
	$cdclie = $_POST["cdclie"];
	$demail = $_POST["demail"];
	$Flag = true;

	if (strlen($cdclie) < 12 ) {
		$cdclie=RetirarMascara($cdclie,"cpf");
		if ( validaCPF($cdclie) == false) {
			$demens = "Cpf inválido!";
			$detitu = "Demonstração Auto Mecânica&copy; | Cadastro de Clientes";
			header('Location: mensagem.php?demens='.$demens.'&detitu='.$detitu);
			$Flag=false;
		}
	} Else {
		$cdclie=RetirarMascara($cdclie,"cnpj");
		if ( validaCNPJ($cdclie) == false) {
			$demens = "Cnpj inválido!";
			$detitu = "Demonstração Auto Mecânica&copy; | Cadastro de Clientes";
			header('Location: mensagem.php?demens='.$demens.'&detitu='.$detitu);
			$Flag=false;
		}
	}

	$aTrab = ConsultarDados("clientes", "cdclie", $cdclie);
	if ( count($aTrab) > 0) {
		$demens = "Cpf/Cnpj já cadastrado!";
		$detitu = "Demonstração Auto Mecânica&copy; | Cadastro de Clientes";
		header('Location: mensagem.php?demens='.$demens.'&detitu='.$detitu);
		$Flag=false;
	}

	if ($Flag == true) {

		//campos da tabela
		$aNomes=array();
		$aNomes[]= "cdclie";
		$aNomes[]= "declie";
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
		$aDados[]= $_POST["cdclie"];
		$aDados[]= $_POST["declie"];
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

		IncluirDados("clientes", $aDados, $aNomes);


		//gravar log
		//GravarIPLog($cdusua, "Alterar Meus Dados:");

		$demens = "Cadastro efetuado com sucesso!";
		$detitu = "Demonstração Auto Mecânica&copy; | Cadastro de Clientes";
		$devolt = "cliente.php";
		header('Location: mensagem.php?demens='.$demens.'&detitu='.$detitu.'&devolt='.$devolt);
	}

?>