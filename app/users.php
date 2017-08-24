<?php 

function getUsuarios() {
	$dados = [ ["nome"=>"Talles","email"=>"talles.aragao@gmail.com"],
			["nome"=>"Murillo","email"=>"murillo.aragao@gmail.com"],
			["nome"=>"Zeca","email"=>"zeca.pagodinho@gmail.com"]
	];
	return $dados;
}

function exibirUsuarios() {
	$dados = getUsuarios();
	$html = "";
	foreach($dados as $dado) {
		$nome = $dado["nome"];
		$email = $dado["email"];
		$html .= "<li>Nome: $nome - E-mail: $email</li>";
	}
	echo $html;
}

?>