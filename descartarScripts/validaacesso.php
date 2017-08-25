<?php 	
	
	// incluindo bibliotecas de apoio
	include "banco.php";
	include "util.php";

	// receber as variaveis usuario (e-mail) e senha
	$cdusua = $_POST["cdusua"];
	$desenh = trim(md5($_POST["desenh"]));
	$sql="select * from usuarios where left(flativ,1) ='S' and cdusua = "."'{$cdusua}'";

	// verificar se email de usuario e senha conferem com o cadastro
	$aDados = ConsultarDados("", "", "",$sql);

	if (count($aDados) > 0 ) {

		$desenhbd = trim($aDados[0]["desenh"]);

		if ($desenhbd == $desenh) {
			// dados ok
			$cdusua=$aDados[0]["cdusua"];
			$deusua=$aDados[0]["deusua"];
			$cdtipo=substr($aDados[0]["cdtipo"],0,1);
			$defoto=$aDados[0]["defoto"];
			$demail=$aDados[0]["demail"];

			setcookie("cdusua",$cdusua);
			setcookie("deusua",$deusua);
			setcookie("cdtipo",$cdtipo);
			setcookie("defoto",$defoto);
			setcookie("demail",$demail);

		    $delog = "Acesso ao Sistema";
		    GravarLog($cdusua, $delog);

			header('Location: home.php');

		} else {
			// senha NÃO confere
			$demens = "A senha não confere. Tente novamente!";
			$detitu = "Template oficina | Acesso";
			header('Location: mensagem.php?demens='.$demens.'&detitu='.$detitu);
		}

	} 
	else {
		// e-mail NÃO encontrado
		$demens = "Usuário não cadastrado ou inativo!";
		$detitu = "Template oficina | Acesso";
		header('Location: mensagem.php?demens='.$demens.'&detitu='.$detitu);
	}

?>