<?php

	// incluindo bibliotecas de apoio
	include "banco.php";
	include "util.php";

	// receber as variaveis usuario (e-mail) e senha
    $data		=	date('Y-m-d H:i:s');
	$cdusua  	= 	$_POST["cdusua"];
	$desenh  	= 	$_POST["desenh"];
	$desenh1 	= 	$_POST["desenh1"];

	if (strlen($cdusua) < 15 ) {
		$cdusua=RetirarMascara($cdusua,"cpf");
	} Else {
		$cdusua=RetirarMascara($cdusua,"cnpj");
	}

	if (empty($desenh) == true ) {
		$demens = "É obrigatório informar a nova senha!";
		$detitu = "Aliança Auto Mecânica&copy; | Alterar Senha";
		$devolt = "minhasenha.php";
		header('Location: mensagem.php?demens='.$demens.'&detitu='.$detitu.'&devolt='.$devolt);
	} Else {

		if ($desenh !== $desenh1) {
			$demens = "As senhas informadas estão diferentes! Favor corrigir.";
			$detitu = "Aliança Auto Mecânica&copy; | Alterar Senha";
			$devolt = "minhasenha.php";
			header('Location: mensagem.php?demens='.$demens.'&detitu='.$detitu.'&devolt='.$devolt);
		} Else {
			//campos da tabela
			$aNomes=array();
			$aNomes[]= "desenh";

			// armazena em array
			$aDados=array();
			$aDados[]= md5($desenh);

			AlterarDados("usuarios",$aDados, $aNomes, "cdusua", $cdusua);

			//GravarIPLog($cdusua, "Alterar Senha");
			$delog = "Alteração da Própria Senha";
			GravarLog($cdusua, $delog);

			$demens = "Senha atualizada com sucesso!";
			$detitu = "Aliança Auto Mecânica&copy; | Alterar Senha";
			$devolt = "index.php";
			header('Location: mensagem.php?demens='.$demens.'&detitu='.$detitu.'&devolt='.$devolt);
		}
	}
?>