<?php

include 'Bot.php';
include 'Cotacao.php';
include 'Cep.php';


$bot = new Bot();

$json_dados = fopen("dados.json","r");

$lista_ajuda = json_decode(fread($json_dados,10000),true);

fclose($json_dados);

if (isset($_GET['msg'])){
	$msg = strtolower($_GET['msg']);
	
	//aqui vai o callback do objeto bot;

	$bot->hears($msg, function(Bot $botty) {
		global $msg;
		global $lista_ajuda;	
		
		//array das expressões regulares das moedas

	$moedas = [
		'dolar' => 'USD-BRL',
		'euro' => 'EUR-BRL',
		'bitcoin' => 'BTC-BRL'
	];

	if(preg_match('/cotar/',$msg)==1){
		preg_match('/[^cotar].*/',$msg,$matches);
		
		$c = new Cotacao($botty->procurarPergunta($matches[0],$moedas));
		
		print($c->retorno()['name'] . '<br>');
            	print($c->retorno()['create_date'] . '<br>');
            	print($c->retorno()['high'] . '<br>');
            	print($c->retorno()['low'] . '<br>');

	}else if (preg_match('/endereco/',$msg)==1){
		preg_match('/[0-9]{5}-[0-9]{3}/',$msg,$matches_traco);
		preg_match('/[0-9]*$/',$msg,$matches_normal);

		if(strlen($matches_normal[0])==8){
			$matches = $matches_normal[0];
		}else{
			$matches = $matches_traco[0];
		}

		$matches = str_replace("-","",$matches);
		
		if(strlen($matches)!=8){
			$botty->reply("O CEP é inválido ou está no formato incorreto!");
			die();
		}

		//consultar o cep informado
		try{
			$cep = new Cep($matches);
			print($cep->getData()->address.'<br>');	
			print($cep->getData()->district.'<br>');
			print($cep->getData()->city.'<br>');
			print($cep->getData()->state.'<br>');		

		}catch (Exception $e){
			print($e->getMessage());
			die();

		}
		
		

			
	}else{ //para ajuda
		if($msg=='ajuda'){
			$botty -> reply($botty->procurarPergunta($msg,$lista_ajuda));	
		
		}else if ($botty->procurarPergunta($msg,$lista_ajuda)=='') {
			$botty->reply("Desculpe, não entendi sua pergunta. Tente [ajuda]");
		}else{
			$botty->reply($botty->procurarPergunta($msg,$lista_ajuda));
		}
	

	}

	});

	

}

?>
