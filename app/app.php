<?php

include("config.php");
include("users.php");
include("produtos.php");

function getPagina() {

	$uri = $_SERVER["REQUEST_URI"];
	$metodo = $_SERVER["REQUEST_METHOD"];

	if($metodo == "GET") {
		switch ($uri) {
			case "/":
				include("pages/home.php");
				break;
			case "/home":
				include("pages/home.php");
				break;
			case "/sobre":
				include("pages/sobre.php");
				break;
			case "/contato":
				include("pages/contato.php");
				break;
			default:
				include("pages/home.php");
				break;
		}
	}
}

?>