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

	if ($Flag == true) {

		switch (get_post_action('edita','apaga')) {
	    case 'edita':

			$demens = "Atualização efetuada com sucesso!";

			//campos da tabela
			$aNomes=array();

			//$aNomes[]= "cdveic";
			$aNomes[]= "deserv";
			$aNomes[]= "qtserv";
			$aNomes[]= "vlserv";

			//dados da tabela
			$aDados=array();
			//$aDados[]= $_POST["cdveic"];
			$aDados[]= $deserv;
			$aDados[]= $qtserv;
			$aDados[]= $vlserv;

			AlterarDados("servicos", $aDados, $aNomes,"cdserv", $cdserv);
			break;
	    case 'apaga':
			$demens = "Exclusão efetuada com sucesso!";

			ExcluirDados("servicos", "cdserv", $cdserv);

			break;
	    default:
			$demens = "Ocorreu um problema na atualização/exclusão. Se persistir contate o suporte!";
		}

		//gravar log
		//GravarIPLog($cdusua, "Alterar Meus Dados:");
		if ($flag2 == false) {
			$detitu = "Demonstração Auto Mecânica&copy; | Cadastro de Serviços";
			$devolt = "servicos.php";
			header('Location: mensagem.php?demens='.$demens.'&detitu='.$detitu.'&devolt='.$devolt);
		}
	}

?>