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
	$conexao = getConnection();
	$sql = "insert into bebida(nome, quantidade, fabricante, fornecedor, categoria, dataFabricacao, dataValidade, alcoolica, teorAlcool) values(:nome, :quantidade, :fabricante, :fornecedor, :categoria, :dataFabricacao, :dataValidade, :alcoolica, :teorAlcool);";
	$stmt = $conexao->prepare($sql);
	$nome = $request["nome"];
	$quantidade = $request["quantidade"];
	$fabricante = $request["fabricante"];
	$fornecedor = $request["fornecedor"];
	$categoria = $request["categoria"];

	$dataFabricacaoString = $request["dataFabricacao"];
	$date = mysql_real_escape_string($dataFabricacaoString);
	$time = strtotime($dataFabricacaoString);
	$dataFabricacao = date("d/m/Y", $time);

	var_dump($dataFabricacao);exit;
	$dataValidadeString = $request["dataValidade"];
	$alcoolica = $request["alcoolica"];
	$teorAlcool = $request["teorAlcool"];
	$stmt->bindValue(":nome", $request["nome"]);
	$stmt->bindValue(":quantidade", $request["quantidade"]);
	$stmt->bindValue(":fabricante", $request["fabricante"]);
	$stmt->bindValue(":fornecedor", $request["fornecedor"]);
	$stmt->bindValue(":categoria", $request["categoria"]);
	$stmt->bindValue(":dataFabricacao", $request["dataFabricacao"]);
	$stmt->bindValue(":dataValidade", $request["dataValidade"]);
	$stmt->bindValue(":alcoolica", $request["alcoolica"]);
	//$stmt->bindValue(":teorAlcool", $request["teorAlcool"]);
	$stmt->execute();
	var_dump($conexao->lastInsertId());exit;
	//return $conexao->lastInsertId();
}

?>