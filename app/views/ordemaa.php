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

		$aCditem=$_POST["cditem"];
		$aQtitem=$_POST["qtitem"];
		$aVlitem=$_POST["vlitem"];

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
			$primeiro = $aCditem[$f];
			$aPrimeiro = explode("|", $aCditem[$f]);
			if ($aPrimeiro[0] !== 'X'){
				$qtitem++;
			}
		}

		if ( $qtitem <= 0) {
			$demens = "É preciso informar os itens da OS!";
			$detitu = "Demonstração Auto Mecânica&copy; | Cadastro de OS";
			header('Location: mensagem.php?demens='.$demens.'&detitu='.$detitu);
			$Flag=false;
		}

		if ( empty($cdclie) == true) {
			$demens = "É preciso informar o Cliente!";
			$detitu = "Demonstração Auto Mecânica&copy; | Cadastro de OS";
			header('Location: mensagem.php?demens='.$demens.'&detitu='.$detitu);
			$Flag=false;
		}

		if ( empty(strtotime($dtorde)) == true) {
			$demens = "É preciso informar a data da OS!";
			$detitu = "Demonstração Auto Mecânica&copy; | Cadastro de OS";
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

			//$aTrab= ConsultarDados("", "", "","select max(cdorde) cdorde from ordem where cdclie = '{$cdclie}' and dtorde = '{$dtorde}'");
			//$cdorde = $aTrab[0]["cdorde"];
			$nritem=1;
			for ($f =1; $f <= 20; $f++) {
				$primeiro = $aCditem[$f];
				$aPrimeiro = explode("|", $aCditem[$f]);
				if ($aPrimeiro[0] !== 'X'){
					$cdpeca = $aPrimeiro[2];
					$qtpeca = $aQtitem[$f];
					$vlpeca = $aVlitem[$f];

					//$vlpeca = str_replace(".","",$vlpeca);
					//$vlpeca = str_replace(",",".",$vlpeca);

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
				//$vlcont = number_format($vlcont,2,',','.');

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
			$detitu = "Demonstração Auto Mecânica&copy; | Cadastro de OS";
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
		$detitu = "Demonstração Auto Mecânica&copy; | Cadastro de OS";
		$devolt = "ordem.php";
		header('Location: mensagem.php?demens='.$demens.'&detitu='.$detitu.'&devolt='.$devolt);
	}

?>