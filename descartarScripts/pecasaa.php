<?php

	include "banco.php";
	include "util.php";

	$data = date('Y-m-d');
	$cdpeca = $_POST["cdpeca"];
	$depeca = $_POST["depeca"];
	$qtpeca = $_POST["qtpeca"];
	$vlpeca = $_POST["vlpeca"];

	$vlpeca= str_replace(".","",$vlpeca);
	$vlpeca= str_replace(",",".",$vlpeca);

	$Flag = true;

	if ($Flag == true) {

		switch (get_post_action('edita','apaga')) {
	    case 'edita':

			$demens = "Atualização efetuada com sucesso!";

			//campos da tabela
			$aNomes=array();

			//$aNomes[]= "cdveic";
			$aNomes[]= "depeca";
			$aNomes[]= "qtpeca";
			$aNomes[]= "vlpeca";

			//dados da tabela
			$aDados=array();
			//$aDados[]= $_POST["cdveic"];
			$aDados[]= $depeca;
			$aDados[]= $qtpeca;
			$aDados[]= $vlpeca;

			AlterarDados("pecas", $aDados, $aNomes,"cdpeca", $cdpeca);
			break;
	    case 'apaga':
			$demens = "Exclusão efetuada com sucesso!";

			ExcluirDados("pecas", "cdpeca", $cdpeca);

			break;
	    default:
			$demens = "Ocorreu um problema na atualização/exclusão. Se persistir contate o suporte!";
		}

		//gravar log
		//GravarIPLog($cdusua, "Alterar Meus Dados:");
		if ($flag2 == false) {
			$detitu = "Demonstração Auto Mecânica&copy; | Cadastro de Peças";
			$devolt = "pecas.php";
			header('Location: mensagem.php?demens='.$demens.'&detitu='.$detitu.'&devolt='.$devolt);
		}
	}

?>