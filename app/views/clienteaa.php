<?php

	include "banco.php";
	include "util.php";

	$data = date('Y-m-d');
	$cdclie = $_POST["cdclie"];

	$Flag = true;
	$flag2=false;

	if (strlen($cdclie) < 15 ) {
		$cdclie=RetirarMascara($cdclie,"cpf");
	} Else {
		$cdclie=RetirarMascara($cdclie,"cnpj");
	}

	if ($Flag == true) {

		switch (get_post_action('edita','apaga')) {
	    case 'edita':

			$demens = "Atualização efetuada com sucesso!";

			if ( $flag2 == true) {
			} Else {

				//campos da tabela
				$aNomes=array();
				//$aNomes[]= "cdclie";
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
				//$aDados[]= $_POST["cdclie"];
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
	
				AlterarDados("clientes", $aDados, $aNomes,"cdclie", $cdclie);
			}

			break;
	    case 'apaga':
			$demens = "Exclusão efetuada com sucesso!";

			//ExcluirDados("h_oficinas", "cdclie", $cdclie);

			//ExcluirDados("h_usuarios", "cdusua", $cdclie);

			$aNomes=array();
			$aNomes[]= "flativ";

			$aDados=array();
			$aDados[]= "N";

			//AlterarDados("h_clientes", $aDados, $aNomes,"cdclie", $cdclie);
			ExcluirDados("clientes", "cdclie", $cdclie);

			break;
	    default:
			$demens = "Ocorreu um problema na atualização/exclusão. Se persistir contate o Suporte!";
		}

		//gravar log
		//GravarIPLog($cdusua, "Alterar Meus Dados:");
		if ($flag2 == false) {
			$detitu = "Demonstração Auto Mecânica&copy; | Cadastro de Clientes";
			$devolt = "cliente.php";
			header('Location: mensagem.php?demens='.$demens.'&detitu='.$detitu.'&devolt='.$devolt);
		}
	}

?>