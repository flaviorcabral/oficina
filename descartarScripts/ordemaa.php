<?php

	include "banco.php";
	include "util.php";

	$cdorde = $_POST["cdorde"];

	switch (get_post_action('edita','apaga')) {
    case 'edita':

		$demens = "Atualização efetuada com sucesso!";

		ExcluirDados("ordem", "cdorde", $cdorde);
		ExcluirDados("ordemi", "cdorde", $cdorde);
		ExcluirDados("", "", "","delete from contas where cdtipo ='Pagar' and cdorig = '{$cdorde}'");

		$dtcada = date('Y-m-d');
		$Flag = true;

		$codItem=$_POST["cditem"];
		$qtdItem=$_POST["qtitem"];
		$vlrItem=$_POST["vlitem"];

		$cdclie = $_POST["cdclie"];
		$dtorde = $_POST["dtorde"];
		$vlorde = $_POST["vlorde"];
		$vlpago = $_POST["vlpago"];

		$vlorde = str_replace(".","",$vlorde);
		$vlorde = str_replace(",",".",$vlorde);

		$vlpago = str_replace(".","",$vlpago);
		$vlpago = str_replace(",",".",$vlpago);

		$qtitem = 0;
		for ($f =1; $f <= 20; $f++) {
			$primeiro = $codItem[$f];
			$aPrimeiro = explode("|", $codItem[$f]);
			if ($aPrimeiro[0] !== 'X'){
				$qtitem++;
			}
		}

		if ( $qtitem <= 0) {
			$demens = "É preciso informar os itens da OS!";
			$detitu = "Template Oficina | Cadastro de OS";
			header('Location: mensagem.php?demens='.$demens.'&detitu='.$detitu);
			$Flag=false;
		}

		if ( empty($cdclie) == true) {
			$demens = "É preciso informar o Cliente!";
			$detitu = "Template Oficina | Cadastro de OS";
			header('Location: mensagem.php?demens='.$demens.'&detitu='.$detitu);
			$Flag=false;
		}

		if ( empty(strtotime($dtorde)) == true) {
			$demens = "É preciso informar a data da OS!";
			$detitu = "Template Oficina | Cadastro de OS";
			header('Location: mensagem.php?demens='.$demens.'&detitu='.$detitu);
			$Flag=false;
		}

		if ($Flag == true) {

			//campos da tabela
			$aNomes=array();
			$aNomes[]= "cdorde";
			$aNomes[]= "cdclie";
			$aNomes[]= "veplac";
			$aNomes[]= "vemarc";
			$aNomes[]= "vemode";
			$aNomes[]= "veanom";
			$aNomes[]= "veanof";
			$aNomes[]= "vecorv";
			$aNomes[]= "cdsitu";
			$aNomes[]= "dtorde";
			$aNomes[]= "vlorde";
			$aNomes[]= "cdform";
			$aNomes[]= "qtform";
			$aNomes[]= "vlpago";
			$aNomes[]= "dtpago";
			$aNomes[]= "deobse";
			$aNomes[]= "flativ";
			$aNomes[]= "dtcada";


			//dados da tabela
			$aDados=array();
			$aDados[]= $_POST["cdorde"];
			$aDados[]= $_POST["cdclie"];
			$aDados[]= $_POST["veplac"];
			$aDados[]= $_POST["vemarc"];
			$aDados[]= $_POST["vemode"];
			$aDados[]= $_POST["veanom"];
			$aDados[]= $_POST["veanof"];
			$aDados[]= $_POST["vecorv"];
			$aDados[]= $_POST["cdsitu"];
			$aDados[]= $_POST["dtorde"];
			$aDados[]= $vlorde;
			$aDados[]= $_POST["cdform"];
			$aDados[]= $_POST["qtform"];
			$aDados[]= $vlpago;
			$aDados[]= $_POST["dtpago"];
			$aDados[]= $_POST["deobse"];
			$aDados[]= 'Sim';
			$aDados[]= $dtcada;

			IncluirDados("ordem", $aDados, $aNomes);

			$nritem=1;
			for ($f =1; $f <= 20; $f++) {
				$primeiro = $codItem[$f];
				$aPrimeiro = explode("|", $codItem[$f]);
				if ($aPrimeiro[0] !== 'X'){
					$cdpeca = $aPrimeiro[2];
					$qtpeca = $qtdItem[$f];
					$vlpeca = $vlrItem[$f];

					$vltota = $qtpeca*$vlpeca;

					$aNomes=array();
					$aNomes[]= "cdorde";
					$aNomes[]= "nritem";
					$aNomes[]= "cdpeca";
					$aNomes[]= "qtpeca";
					$aNomes[]= "vlpeca";
					$aNomes[]= "vltota";

					$aDados=array();
					$aDados[]= $cdorde;
					$aDados[]= $nritem++;
					$aDados[]= $cdpeca;
					$aDados[]= $qtpeca;
					$aDados[]= $vlpeca;
					$aDados[]= $vltota;

					IncluirDados("ordemi", $aDados, $aNomes);

				}
			}

			$aTrab= ConsultarDados("", "", "","select * from ordem where cdorde = '{$cdorde}'");
			$dtorde = $aTrab[0]["dtorde"];
			$qtform = $aTrab[0]["qtform"];

			for ($f =1; $f <= $qtform; $f++) {
				$vlcont = $aTrab[0]["vlorde"]/$qtform;

			    $dtcont=strtotime($dtorde . "+ {$f} months");
			    $dtcont=date("Y-m-d", $dtcont);

				$aNomes=array();
				$aNomes[]= "decont";
				$aNomes[]= "dtcont";
				$aNomes[]= "vlcont";
				$aNomes[]= "cdtipo";
				$aNomes[]= "cdquem";
				$aNomes[]= "cdorig";
				$aNomes[]= "flativ";
				$aNomes[]= "dtcada";

				$aDados=array();
				$aDados[]= 'Cliente a Receber';
				$aDados[]= $dtcont;
				$aDados[]= $vlcont;
				$aDados[]= 'Receber';
				$aDados[]= $aTrab[0]["cdclie"];
				$aDados[]= $aTrab[0]["cdorde"];
				$aDados[]= 'Sim';
				$aDados[]= $dtcada;

				IncluirDados("contas", $aDados, $aNomes);
			}

			$demens = "Alteração efetuada com sucesso!";
			$detitu = "Template Oficinas | Cadastro de OS";
			$devolt = "ordem.php";
			header('Location: mensagem.php?demens='.$demens.'&detitu='.$detitu.'&devolt='.$devolt);
		}

		break;
    case 'apaga':
		$demens = "Exclusão efetuada com sucesso!";

		ExcluirDados("ordem", "cdorde", $cdorde);
		ExcluirDados("ordemi", "cdorde", $cdorde);
		ExcluirDados("", "", "","delete from contas where cdtipo ='Receber' and cdorig = '{$cdorde}'");

		break;
    default:
		$demens = "Ocorreu um problema na atualização/exclusão. Se persistir contate o suporte!";
	}

	if ($flag2 == false) {
		$detitu = "Template Oficina; | Cadastro de OS";
		$devolt = "ordem.php";
		header('Location: mensagem.php?demens='.$demens.'&detitu='.$detitu.'&devolt='.$devolt);
	}

?>