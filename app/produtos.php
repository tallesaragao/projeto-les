<?php 

function getProdutos() {
	$produtos = array(
		["titulo"=>"PHP Básico", "descricao"=>"Curso de PHP Básico", "valor"=>"129.90"],
		["titulo"=>"PHP com PDO", "descricao"=>"Curso de PHP com PDO", "valor"=>"159.90"],
		["titulo"=>"PHP OO", "descricao"=>"Curso de PHP Orientado a Objetos", "valor"=>"199.90"]
	);

	$conexao = getConnection();
	$sql = "select * from produto";
	$result = $conexao->query($sql);
	$produtos = $result->fetchAll();
	return $produtos;
}

function buscarProdutos($busca) {
	$produtos = getProdutos();
	$resultado = array();
	//$busca = strtoupper($busca);
	foreach($produtos as $produto) {
		//$tituloProduto = strtoupper($produto["titulo"]);
		$produtoExiste = in_array(strtoupper($busca), array_map('strtoupper', $produto));
		if($produtoExiste) {
			array_push($resultado, $produto);
		}
	}
	return $resultado;
}

function salvarProduto($request) {
	$conexao = getConnection();
	$sql = "insert into produto(titulo, descricao, valor) values(:titulo, :descricao, :valor);";
	$stmt = $conexao->prepare($sql);
	$stmt->bindValue(":titulo", $request["titulo"]);
	$stmt->bindValue(":descricao", $request["descricao"]);
	$stmt->bindValue(":valor", $request["valor"]);
	$stmt->execute();
	return $conexao->lastInsertId();
}

?>