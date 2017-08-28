<?php 

function getProdutos() {
	$produtos = array(
		["titulo"=>"PHP Básico", "descricao"=>"Curso de PHP Básico", "valor"=>"129.90"],
		["titulo"=>"PHP com PDO", "descricao"=>"Curso de PHP com PDO", "valor"=>"159.90"],
		["titulo"=>"PHP OO", "descricao"=>"Curso de PHP Orientado a Objetos", "valor"=>"199.90"]
	);

	$conexao = getConnection();
	$sql = "select * from bebida";
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

function buscaPorId($id) {
	$conexao = getConnection();
	$sql = "select * from bebida where id_bebida=:id";
	$stmt = $conexao->prepare($sql);
	$stmt->bindValue(":id", $id);
	$stmt->execute();
	$produto = $stmt->fetch(\PDO::FETCH_ASSOC);
	return $produto;
}

function salvarProduto($request) {
	try {
		$conexao = getConnection();
		$sql = "insert into bebida(nome, quantidade, fabricante, fornecedor, categoria, dataFabricacao, dataValidade, alcoolica, teorAlcool)
				values(:nome, :quantidade, :fabricante, :fornecedor, :categoria, STR_TO_DATE(:dataFabricacao, '%Y-%m-%d'),
				STR_TO_DATE(:dataValidade, '%Y-%m-%d'), :alcoolica, :teorAlcool);";
		$stmt = $conexao->prepare($sql);
		$stmt->bindValue(":nome", $request["nome"]);
		$stmt->bindValue(":quantidade", $request["quantidade"]);
		$stmt->bindValue(":fabricante", $request["fabricante"]);
		$stmt->bindValue(":fornecedor", $request["fornecedor"]);
		$stmt->bindValue(":categoria", $request["categoria"]);
		$stmt->bindValue(":dataFabricacao", $request["dataFabricacao"]);
		$stmt->bindValue(":dataValidade", $request["dataValidade"]);
		$stmt->bindValue(":alcoolica", $request["alcoolica"]);
		if($request["teorAlcool"] === "") {
			$stmt->bindValue(":teorAlcool", NULL);
		}
		else {
			$stmt->bindValue(":teorAlcool", $request["teorAlcool"]);
		}
		$stmt->execute();
		return $conexao->lastInsertId();
	} catch(Exception $e) {
		var_dump($e->getMessage());exit;
	}
}

function excluirProduto($request) {
	$conexao = getConnection();
	$sql = "delete from bebida where id_bebida=:id";
	$stmt = $conexao->prepare($sql);
	$stmt->bindValue(":id", $request["id"]);
	$stmt->execute();
}

function editarProduto($request) {
	$conexao = getConnection();
	$sql = "update bebida set nome=:nome, quantidade=:quantidade, fabricante=:fabricante, fornecedor=:fornecedor, categoria=:categoria, dataFabricacao=STR_TO_DATE(:dataFabricacao, '%Y-%m-%d'), dataValidade=STR_TO_DATE(:dataValidade, '%Y-%m-%d'), alcoolica=:alcoolica, teorAlcool=:teorAlcool where id_bebida=:id;";
	$stmt = $conexao->prepare($sql);
	$stmt->bindValue(":nome", $request["nome"]);
	$stmt->bindValue(":quantidade", $request["quantidade"]);
	$stmt->bindValue(":fabricante", $request["fabricante"]);
	$stmt->bindValue(":fornecedor", $request["fornecedor"]);
	$stmt->bindValue(":categoria", $request["categoria"]);
	$stmt->bindValue(":dataFabricacao", $request["dataFabricacao"]);
	$stmt->bindValue(":dataValidade", $request["dataValidade"]);
	$stmt->bindValue(":alcoolica", $request["alcoolica"]);
	if($request["teorAlcool"] === "") {
		$stmt->bindValue(":teorAlcool", NULL);
	}
	else {
		$stmt->bindValue(":teorAlcool", $request["teorAlcool"]);
	}
	$stmt->bindValue(":id", $request["id"]);
	return $stmt->execute();

}

?>