<?php

	include "banco.php";
	include "util.php";

	$cdusua = $_POST["cdusua"];
	$demail = $_POST["demail"];
	$dtcada = date('Y-m-d');
	$flativ	= "S";
	$Flag = true;

	if (strlen($cdusua) < 12 ) {
		$cdusua=RetirarMascara($cdusua,"cpf");
		if ( validaCPF($cdusua) == false) {
			$demens = "Cpf inválido!";
			$detitu = "Demonstração Auto Mecânica&copy; | Cadastro de Usuários";
			header('Location: mensagem.php?demens='.$demens.'&detitu='.$detitu);
			$Flag=false;
		}
	} Else {
		$cdusua=RetirarMascara($cdusua,"cnpj");
		if ( validaCNPJ($cdusua) == false) {
			$demens = "Cnpj inválido!";
			$detitu = "Demonstração Auto Mecânica&copy; | Cadastro de Usuários";
			header('Location: mensagem.php?demens='.$demens.'&detitu='.$detitu);
			$Flag=false;
		}
	}

	$aTrab = ConsultarDados("usuarios", "cdusua", $cdusua);
	if ( count($aTrab) > 0) {
		$demens = "Código já cadastrado!";
		$detitu = "Demonstração Auto Mecânica&copy; | Cadastro de Usuários";
		header('Location: mensagem.php?demens='.$demens.'&detitu='.$detitu);
		$Flag=false;
	}

	if ($Flag == true) {

		//uploads
		$uploaddir = 'img/'.$cdusua."_";
		$uploadfile1 = $uploaddir . basename($_FILES['defotom']['name']);

	    #Move o arquivo para o diretório de destino
	    move_uploaded_file( $_FILES["defotom"]["tmp_name"], $uploadfile1 );

		$defoto1=basename($_FILES['defotom']['name']);
		$desenh=md5(strtolower(substr($_POST["deusua"], 0,3)));
		if (empty($defoto1) == true){
		  $defoto="img/semfoto.jpg";
		} Else {
		  $defoto = $uploadfile1;
		}

		//campos da tabela
		$aNomes=array();
		$aNomes[]= "cdusua";
		$aNomes[]= "deusua";
		$aNomes[]= "desenh";
		$aNomes[]= "demail";
		$aNomes[]= "defoto";
		$aNomes[]= "cdtipo";
		$aNomes[]= "flativ";
		$aNomes[]= "dtcada";
		$aNomes[]= "nrtele";

		//dados da tabela
		$aDados=array();
		$aDados[]= $cdusua;
		$aDados[]= $_POST["deusua"];
		$aDados[]= $desenh;
		$aDados[]= $_POST["demail"];
		$aDados[]= $defoto;
		$aDados[]= $_POST["cdtipo"];
		$aDados[]= $flativ;
		$aDados[]= $dtcada;
		$aDados[]= $_POST["nrtele"];

		IncluirDados("usuarios", $aDados, $aNomes);

		//gravar log
		//GravarIPLog($cdusua, "Alterar Meus Dados:");

		$demens = "Cadastro efetuado com sucesso!";
		$detitu = "Demonstração Auto Mecânica&copy; | Cadastro de usuarios";
		$devolt = "usuarios.php";
		header('Location: mensagem.php?demens='.$demens.'&detitu='.$detitu.'&devolt='.$devolt);
	}

?>