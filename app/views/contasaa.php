<?php

	include "banco.php";
	include "util.php";

	$data = date('Y-m-d');
	$cdcont = $_POST["cdcont"];
	$vlcont = $_POST["vlcont"];
	$vlpago = $_POST["vlpago"];

	$vlcont= str_replace(".","",$vlcont);
	$vlcont= str_replace(",",".",$vlcont);
	$vlpago= str_replace(".","",$vlpago);
	$vlpago= str_replace(",",".",$vlpago);

	$Flag = true;

	if ($Flag == true) {

		switch (get_post_action('edita','apaga')) {
	    case 'edita':

			$demens = "Atualização efetuada com sucesso!";

			//campos da tabela
			$aNomes=array();

			$aNomes[]= "decont";
			$aNomes[]= "dtcont";
			$aNomes[]= "vlcont";
			$aNomes[]= "cdtipo";
			$aNomes[]= "vlpago";
			$aNomes[]= "dtpago";
			$aNomes[]= "cdquem";
			$aNomes[]= "cdorig";
			$aNomes[]= "deobse";
			$aNomes[]= "flativ";
			$aNomes[]= "dtcada";

			//dados da tabela
			$aDados=array();
			$aDados[]= $_POST["decont"];
			$aDados[]= $_POST["dtcont"];
			$aDados[]= $vlcont;
			$aDados[]= $_POST["cdtipo"];
			$aDados[]= $vlpago;
			$aDados[]= $_POST["dtpago"];
			$aDados[]= $_POST["cdquem"];
			$aDados[]= $_POST["cdorig"];
			$aDados[]= $_POST["deobse"];
			$aDados[]= "S";
			$aDados[]= date("Y-m-d");

			AlterarDados("contas", $aDados, $aNomes,"cdcont", $cdcont);
			break;
	    case 'apaga':
			$demens = "Exclusão efetuada com sucesso!";

			ExcluirDados("contas", "cdcont", $cdcont);

			break;
	    default:
			$demens = "Ocorreu um problema na atualização/exclusão. Se persistir contate o suporte!";
		}

		//gravar log
		//GravarIPLog($cdusua, "Alterar Meus Dados:");
		if ($flag2 == false) {
			$detitu = "Demonstração Auto Mecânica&copy; | Cadastro de Contas a Pagar/Receber";
			$devolt = "contas.php";
			header('Location: mensagem.php?demens='.$demens.'&detitu='.$detitu.'&devolt='.$devolt);
		}
	}

?>