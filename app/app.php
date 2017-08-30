<?php

include("db.php");
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
				$produtos = buscarProdutos(NULL);
				include("pages/home.php");
				break;
			case "/produto":
				$produtos = buscarProdutos(NULL);
				include("pages/home.php");
				break;
			case "/produto/":
				$produtos = buscarProdutos(NULL);
				include("pages/home.php");
				break;
			case "/produto/busca":
				$produtos = buscarProdutos($_GET);
				include("pages/home.php");
				break;
			case "/produto/form":
				include("pages/form.php");
				break;
			case "/produto/excluir":
				excluirProduto($_GET);
				header("location:../");
			case "/produto/editar":
				$id = $_GET["id"];
				$produtoEdit = buscaPorId($id);
				include("pages/form.php");
				break;
			default:
				$produtos = buscarProdutos(NULL);
				include("pages/erro404.php");
				break;
		}
	}
	if($metodo == "POST") {
		switch ($uri) {
			case "/produto/salvar":
				$msg = salvarProduto($_POST);
				if($msg == "OK") {
					$msg = "Bebida cadastrada com sucesso.";
					$produtos = buscarProdutos(NULL);
					include("pages/home.php");
					break;
				}
				$produtoEdit = $_POST;
				include("pages/form.php");
				break;
			case "/produto/editar":
				$msg = editarProduto($_POST);
				if($msg == "OK") {		
					$produtos = buscarProdutos(NULL);
					$msg = "Cadastro de bebida alterado com sucesso.";
					include("pages/home.php");
					break;
				}
				else {
					$produtoEdit = $_POST;
					include("pages/form.php");
					break;
				}
			default:
				include("pages/erro404.php");
				break;
		}
	}
}

?>