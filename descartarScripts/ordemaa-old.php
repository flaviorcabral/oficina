<?php

	include "banco.php";
	include "util.php";

	$data = date('Y-m-d');
	$cdorde = $_POST["cdorde"];
	$cdclie = $_POST["cdclie"];

	$Flag = true;

	if (strlen($cdclie) < 15 ) {
		$cdclie=RetirarMascara($cdclie,"cpf");
	} Else {
		$cdclie=RetirarMascara($cdclie,"cnpj");
	}

	$dtemis = traduz_data_para_banco($_POST["dtemis"]);
	$dtemis = strtotime($dtemis);
	$dtemis = date("Y-m-d", $dtemis);

	$nrnota = $_POST["nrnota"];
	$vlserv = $_POST["vlserv"];
	$vlpeca = $_POST["vlpeca"];
	$vlimpo = $_POST["vlimpo"];
	$vltota = $_POST["vltota"];
	$vloutr = $_POST["vloutr"];
	$flcanc = $_POST["flcanc"];
	$flpago = $_POST["flpago"];
	$flstat = $_POST["flstat"];

	$vlserv= str_replace(".","",$vlserv);
	$vlpeca= str_replace(".","",$vlpeca);
	$vlimpo= str_replace(".","",$vlimpo);
	$vloutr= str_replace(".","",$vloutr);
	$vltota= str_replace(".","",$vltota);

	$vlserv= str_replace(",",".",$vlserv);
	$vlpeca= str_replace(",",".",$vlpeca);
	$vlimpo= str_replace(",",".",$vlimpo);
	$vloutr= str_replace(",",".",$vloutr);
	$vltota= str_replace(",",".",$vltota);

	$vlitem1 = $_POST["vlitem1"];
	$vlitem1= str_replace(".","",$vlitem1);
	$vlitem1= str_replace(",",".",$vlitem1);

	$vloutr1 = $_POST["vloutr1"];
	$vloutr1= str_replace(".","",$vloutr1);
	$vloutr1= str_replace(",",".",$vloutr1);

    $aPara = ConsultarDados("", "", "", "select * from m_parametros");
    $iss=$aPara[0]["iss"]/100;
    $inss=$aPara[0]["inss"]/100;
    $irrf=$aPara[0]["irrf"]/100;
    $pis=$aPara[0]["pis"]/100;

	if ($Flag == true) {

		switch (get_post_action('edita','apaga')) {
	    case 'edita':

			$demens = "Atualização efetuada com sucesso!";

			//campos da tabela
			$aNomes=array();

			$aNomes[]= "cdclie";
			$aNomes[]= "dtemis";
			$aNomes[]= "nrnota";
			$aNomes[]= "vlserv";
			$aNomes[]= "vlpeca";
			$aNomes[]= "vlimpo";
			$aNomes[]= "vltota";
			$aNomes[]= "vloutr";
			$aNomes[]= "flcanc";
			$aNomes[]= "flpago";
			$aNomes[]= "flstat";

			//dados da tabela
			$aDados=array();
			$aDados=array();
			$aDados[]= $cdclie;
			$aDados[]= $dtemis;
			$aDados[]= $nrnota;
			$aDados[]= $vlserv;
			$aDados[]= $vlpeca;
			$aDados[]= $vlimpo;
			$aDados[]= $vltota;
			$aDados[]= $vloutr;
			$aDados[]= $flcanc;
			$aDados[]= $flpago;
			$aDados[]= $flstat;

			AlterarDados("m_ordem", $aDados, $aNomes,"cdorde", $cdorde);
			break;
	    case 'apaga':
			$demens = "Exclusão efetuada com sucesso!";

			ExcluirDados("m_ordem", "cdorde", $cdorde);

			break;
	    default:
			$demens = "Ocorreu um problema na atualização/exclusão. Se persistir contate o suporte!";
		}

		//gravar log
		//GravarIPLog($cdusua, "Alterar Meus Dados:");
		if ($flag2 == false) {
			$detitu = "Nova Aliança Auto Mecânica&copy; | Cadastro de Ordem de Serviços";
			$devolt = "ordem.php";
			header('Location: mensagem.php?demens='.$demens.'&detitu='.$detitu.'&devolt='.$devolt);
		}
	}

?>