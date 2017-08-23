<?php

	include "banco.php";
	include "util.php";

	$cdusua = $_POST["cdusua"];
	$defoto1 = $_POST["defoto1"];

	switch (get_post_action('edita','apaga')) {
    case 'edita':

		//uploads
		$uploaddir = 'img/'.$cdusua."_";
		$uploadfile1 = $uploaddir . basename($_FILES['defotom']['name']);

	    #Move o arquivo para o diretório de destino
	    move_uploaded_file( $_FILES["defotom"]["tmp_name"], $uploadfile1 );

		$defotom=basename($_FILES['defotom']['name']);

		if (empty($defotom) == true) {
			$defoto= $defoto1;
		} Else {
			$defoto= $uploadfile1;
		}

		$demens = "Atualização efetuada com sucesso!";

		//campos da tabela
		$aNomes=array();
		$aNomes[]= "deusua";
		$aNomes[]= "demail";
		$aNomes[]= "defoto";
		$aNomes[]= "cdtipo";
		$aNomes[]= "flativ";
		$aNomes[]= "nrtele";

		//dados da tabela
		$aDados=array();
		$aDados[]= $_POST["deusua"];
		$aDados[]= $_POST["demail"];
		$aDados[]= $defoto;
		$aDados[]= $_POST["cdtipo"];
		$aDados[]= $_POST["flativ"];
		$aDados[]= $_POST["nrtele"];

		AlterarDados("usuarios", $aDados, $aNomes,"cdusua", $cdusua);

		break;
    case 'apaga':
		$demens = "Exclusão efetuada com sucesso!";

		//ExcluirDados("h_oficinas", "cdofic", $cdofic);

		//ExcluirDados("h_usuarios", "cdusua", $cdofic);

		$aNomes=array();
		$aNomes[]= "flativ";

		$aDados=array();
		$aDados[]= "N";

		//AlterarDados("usuarios", $aDados, $aNomes,"cdusua", $cdusua);
		ExcluirDados("usuarios", "cdusua", $cdusua);

		break;
    default:
		$demens = "Ocorreu um problema na atualização/exclusão. Se persistir contate o suporte!";
	}

	//gravar log
	//GravarIPLog($cdusua, "Alterar Meus Dados:");
	if ($flag2 == false) {
		$detitu = "Demonstração Auto Mecânica&copy; | Cadastro de Usuários";
		$devolt = "usuarios.php";
		header('Location: mensagem.php?demens='.$demens.'&detitu='.$detitu.'&devolt='.$devolt);
	}

?>