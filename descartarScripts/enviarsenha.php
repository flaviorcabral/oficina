<?php 	
	
	// incluindo bibliotecas de apoio
	include "banco.php";
	include "util.php";

	$demail= $_POST ["demail"];					// email para o qual será enviada a nova senha
	$desenh= GerarSenha(); 	// gera automaticamente uma nova senha

	// envia para o e-mail
	$paraquem= $demail;
	$dequem = "suporte@rcx5plasticos.com.br";
	$assunto = "Aliança Auto Mecânica : Sua nova senha";
	//$corpo = "cpf: ".$_POST["cdusua"]." - email: ".$_POST["demail"]." - ".$datahoje;
	$corpo="Olá, segue sua nova senha conforme solicitado: ".$desenh;
	
	EnviarEmail($paraquem, $dequem, $assunto, $corpo);

	// grava a nova senha
	$desenh= md5($desenh);
	GravarNovaSenha($demail,$desenh);

	$aDados = ConsultarDados("m_usuarios", "demail", $demail,"select * from m_usuarios where flativ ='S' and demail = "."'{$demail}'");
	$cdusua="99999999999";
	if (count($aDados) > 0 ) {
		$cdusua=$aDados[0]["cdusua"];
	}
	$delog = "Geração automática de senha e envio de nova senha para o e-mail informado: Esqueceu a Senha";
	GravarLog($cdusua, $delog);

	// apresenta mensagem enviada
	$demens = "Uma nova senha foi enviada para o e-mail informado!";
	$detitu = "Aliança Auto Mecânica | Nova Senha";
	$devolt = "index.html";
	header('Location: mensagem.php?demens='.$demens.'&detitu='.$detitu.'&devolt='.$devolt);
?>
