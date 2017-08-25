<?php

function getConnection() {
	$conexao = new \PDO("mysql:host=localhost;dbname=cursophp", "root", "123");
	return $conexao;
}

?>