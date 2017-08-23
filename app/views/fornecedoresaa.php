<?php

	include "banco.php";
	include "util.php";

	$data = date('Y-m-d');
	$cdforn = $_POST["cdforn"];

	$Flag = true;
	$flag2=false;

	if (strlen($cdforn) < 15 ) {
		$cdforn=RetirarMascara($cdforn,"cpf");
	} Else {
		$cdforn=RetirarMascara($cdforn,"cnpj");
	}

	if ($Flag == true) {

		switch (get_post_action('edita','apaga')) {
	    case 'edita':

			$demens = "Atualização efetuada com sucesso!";

			if ( $flag2 == true) {
			} Else {

				//campos da tabela
				$aNomes=array();
				//$aNomes[]= "cdforn";
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
				//$aDados[]= $_POST["cdforn"];
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
	
				AlterarDados("fornecedores", $aDados, $aNomes,"cdforn", $cdforn);
			}

			break;
	    case 'apaga':
			$demens = "Exclusão efetuada com sucesso!";

			//ExcluirDados("h_oficinas", "cdforn", $cdforn);

			//ExcluirDados("h_usuarios", "cdusua", $cdforn);

			$aNomes=array();
			$aNomes[]= "flativ";

			$aDados=array();
			$aDados[]= "N";

			//AlterarDados("h_fornecedores", $aDados, $aNomes,"cdforn", $cdforn);
			ExcluirDados("fornecedores", "cdforn", $cdforn);

			break;
	    default:
			$demens = "Ocorreu um problema na atualização/exclusão. Se persistir contate o Suporte!";
		}

		//gravar log
		//GravarIPLog($cdusua, "Alterar Meus Dados:");
		if ($flag2 == false) {
			$detitu = "Demonstração Auto Mecânica&copy; | Cadastro de fornecedores";
			$devolt = "fornecedores.php";
			header('Location: mensagem.php?demens='.$demens.'&detitu='.$detitu.'&devolt='.$devolt);
		}
	}

?>