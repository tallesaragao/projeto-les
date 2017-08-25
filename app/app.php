<?php

include("config.php");
include("db.php");
include("users.php");
include("produtos.php");

function getPagina() {

	$uri = $_SERVER["REQUEST_URI"];
	//Quebrando a string para métodos GET e pegando o primeiro elemento do array resultante
	$uri = explode("?", $uri);
	$uri = $uri[0];

	$metodo = $_SERVER["REQUEST_METHOD"];

	if($metodo == "GET") {
		switch ($uri) {
			case "/":
				$produtos = getProdutos();
				include("pages/home.php");
				break;
			case "/home":
				$produtos = getProdutos();
				include("pages/home.php");
				break;
			case "/sobre":
				include("pages/sobre.php");
				break;
			case "/contato":
				include("pages/contato.php");
				break;
			case "/busca":
				$produtos = buscarProdutos($_GET["busca"]);
				include("pages/home.php");
				break;
			default:
				$produtos = getProdutos();
				include("pages/home.php");
				break;
		}
	}
	if($metodo == "POST") {
		switch ($uri) {
			case "/produto/salvar":
				salvarProduto($_POST);
				include("pages/home.php");
			default:
				include("pages/home.php");
				break;
		}
	}
}

?>