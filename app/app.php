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
				$produtos = getProdutos();
				include("pages/home.php");
				break;
		}
	}
	if($metodo == "POST") {
		switch ($uri) {
			case "/produto/salvar":
				if(!salvarProduto($_POST)) {
					$msg = "Erro ao cadastrar a bebida.";
					$produtos = getProdutos();
					include("pages/home.php");
					break;
				}
				$msg = "Bebida cadastrada com sucesso.";
				$produtos = getProdutos();
				include("pages/home.php");
				break;
			case "/produto/editar":
				if(editarProduto($_POST)) {				
					$produtos = getProdutos();
					$msg = "Cadastro de bebida alterado com sucesso.";
					include("pages/home.php");
					break;
				}
				else {				
					$produtos = getProdutos();
					$msg = "Erro ao alterar o cadastro.";
					include("pages/home.php");
					break;
				}
			default:
				include("pages/home.php");
				break;
		}
	}
}

?>