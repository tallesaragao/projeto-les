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

function salvarProduto($request) {
	try {
		$conexao = getConnection();
		$sql = "insert into bebida(nome, quantidade, fabricante, fornecedor, categoria, dataFabricacao, dataValidade, alcoolica, teorAlcool)
				values(:nome, :quantidade, :fabricante, :fornecedor, :categoria, STR_TO_DATE(:dataFabricacao, '%d/%m/%Y'),
				STR_TO_DATE(:dataValidade, '%d/%m/%Y'), :alcoolica, :teorAlcool);";
		$stmt = $conexao->prepare($sql);
		$stmt->bindValue(":nome", $request["nome"]);
		$stmt->bindValue(":quantidade", $request["quantidade"]);
		$stmt->bindValue(":fabricante", $request["fabricante"]);
		$stmt->bindValue(":fornecedor", $request["fornecedor"]);
		$stmt->bindValue(":categoria", $request["categoria"]);
		$stmt->bindValue(":dataFabricacao", $request["dataFabricacao"]);
		$stmt->bindValue(":dataValidade", $request["dataValidade"]);
		$stmt->bindValue(":alcoolica", $request["alcoolica"]);
		$stmt->bindValue(":teorAlcool", $request["teorAlcool"]);
		$stmt->execute();
	} catch(Exception $e) {
		var_dump($e->getMessage());exit;
	}
}

?>