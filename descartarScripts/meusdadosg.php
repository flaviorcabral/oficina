<?php

	// incluindo bibliotecas de apoio
	include "banco.php";
	include "util.php";

	// receber as variaveis usuario (e-mail) e senha
	$cdusua = $_POST["cdusua"];
	$demail = $_POST["demail"];
	$deusua = $_POST["deusua"];
	$defoto = $_POST["defoto"];

	$Flag=true;

	if ($Flag == true) {

		if (strlen($cdusua) < 15 ) {
			$cdusua=RetirarMascara($cdusua,"cpf");
		} Else {
			$cdusua=RetirarMascara($cdusua,"cnpj");
		}

		// tratando o upload da foto
		$uploaddir = 'img/'.$cdusua;
		$uploadfile = $uploaddir . basename($_FILES['defoto']['name']);

		// upload do arquivo da foto
		move_uploaded_file($_FILES['defoto']['tmp_name'], $uploadfile);

		//USUARIOS

		//campos da tabela
		$aNomes=array();
		$aNomes[]= "deusua";
		$aNomes[]= "demail";
		$aNomes[]= "defoto";
		$aNomes[]= "nrtele";

		// armazena em array
		$aDados=array();
		$aDados[]= $_POST["deusua"]; //deusua;
		$aDados[]= $_POST["demail"]; //demail;
		$defoto1=basename($_FILES['defoto']['name']);
		if (empty($defoto1) == true) {
			$aDados[]= $defoto; 	 //defoto;
		} Else {
			$aDados[]= $uploadfile; 	 //defoto;
			$defoto= $uploadfile;
		}
		$aDados[]=$_POST["nrtele"];

		AlterarDados("usuarios", $aDados, $aNomes, "cdusua", $cdusua);

		setcookie("deusua",$deusua);
		setcookie("defoto",$defoto);
		setcookie("demail",$demail);

		$delog = "Alteração de Próprios Dados (Nome/Foto/E-Mail)";
		GravarLog($cdusua, $delog);

		//gravar log
		//GravarIPLog($cdusua, "Alterar Meus Dados:");

		$demens = "Cadastro atualizado com sucesso!";
		$detitu = "Aliança Auto Mecânica&copy; | Meus Dados";
		$devolt = "index.php";
		header('Location: mensagem.php?demens='.$demens.'&detitu='.$detitu.'&devolt='.$devolt);
	}

?>