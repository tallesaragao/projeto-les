<?php 

function validarCampos($request) {
	$valido = true;
	$msg = "";
	$nome = $request["nome"];
	$minima = $request["minima"];
	$maxima = $request["maxima"];
	$quantidade = $request["quantidade"];
	$preco = $request["preco"];
	$fabricante = $request["fabricante"];
	$fornecedor = $request["fornecedor"];
	$categoria = $request["categoria"];
	$dataFabricacao = $request["dataFabricacao"];
	$dataValidade = $request["dataValidade"];
	$alcoolica = $request["alcoolica"];
	$teorAlcool = $request["teorAlcool"];
	$ingredientes = $request["ingredientes"];
	if(trim($nome) == "") {
		$valido = false;
		$msg .= "Nome é obrigatório\n";
	}
	if(trim($minima) == "") {
		$valido = false;
		$msg .= "Quantidade mínima é obrigatória.\n";
	}
	if(trim($maxima) == "") {
		$valido = false;
		$msg .= "Quantidade máxima é obrigatória.\n";
	}
	if(trim($quantidade) == "") {
		$valido = false;
		$msg .= "Quantidade é obrigatória.\n";
	}
	else {
		if($quantidade < $minima || $quantidade > $maxima) {
			$valido = false;
			$msg .= "Quantidade deve estar dentro dos limites.\n";
		}
	}
	if(trim($preco) == "") {
		$valido = false;
		$msg .= "Preço é obrigatório.\n";
	}
	else {
		if($preco <= 0) {

		$valido = false;
		$msg .= "Preço deve ser positivo.\n";
		}
	}	
	if(trim($fabricante) == "") {
		$valido = false;
		$msg .= "Fabricante é obrigatório.\n";
	}
	if(trim($fornecedor) == "") {
		$valido = false;
		$msg .= "Fornecedor é obrigatório.\n";
	}
	if(trim($categoria) == "") {
		$valido = false;
		$msg .= "Categoria é obrigatória.\n";
	}
	if(trim($dataFabricacao) == "") {
		$valido = false;
		$msg .= "Data de Fabricação é obrigatória.\n";
	}
	if(trim($dataValidade) == "") {
		$valido = false;
		$msg .= "Data de Validade é obrigatória.\n";
	}
	else {
		$tempoFabricacao = strtotime($dataFabricacao);
		$tempoValidade = strtotime($dataValidade);
		if($tempoValidade <= $tempoFabricacao) {
			$valido = false;
			$msg .= "Datas inconsistentes.\n";
		}
	}
	if(trim($alcoolica) == "") {
		$valido = false;
		$msg .= "É obrigatório informar se a bebida é alcoólica.\n";
	}
	else {	
		if($alcoolica == 1 && trim($teorAlcool) == "") {
			$valido = false;
			$msg .= "É obrigatório informar o teor de álcool para bebidas alcoólicas.\n";
		}
	}
	if(trim($ingredientes) == "") {
		$valido = false;
		$msg .= "Ingredientes são obrigatórios.\n";
	}
	if($valido) {
		$msg = "OK";
	}
	return $msg;
}

function buscarProdutos($request) {
	$conexao = getConnection();
	$busca = $request["busca"];
	$filtro = $request["filtro"];
	$stmt = NULL;
	switch ($filtro) {
		case "nome":
			$sql = "select * from bebida where nome like :nome ";
			$stmt = $conexao->prepare($sql);
			$busca = "%".$busca."%";
			$stmt->bindValue(":nome", $busca);
			break;
		case "preco":
			$sql = "select * from bebida where preco <= :preco";
			$stmt = $conexao->prepare($sql);
			$stmt->bindValue(":preco", $busca);
			break;
		case "categoria":
			$sql = "select * from bebida where categoria like :categoria";
			$stmt = $conexao->prepare($sql);
			$busca = "%".$busca."%";
			$stmt->bindValue(":categoria", $busca);
			break;
		case "fornecedor":
			$sql = "select * from bebida where fornecedor like :fornecedor";
			$stmt = $conexao->prepare($sql);
			$busca = "%".$busca."%";
			$stmt->bindValue(":fornecedor", $busca);
			break;
		default:
			$sql = "select * from bebida";
			$stmt = $conexao->prepare($sql);
			break;
	}
	$stmt->execute();
	$produtos = $stmt->fetchAll();
	return $produtos;
}

function buscaPorId($id) {
	$conexao = getConnection();
	$sql = "select * from bebida where id_bebida=:id_bebida";
	$stmt = $conexao->prepare($sql);
	$stmt->bindValue(":id_bebida", $id);
	$stmt->execute();
	$produto = $stmt->fetch(\PDO::FETCH_ASSOC);
	return $produto;
}

function salvarProduto($request) {
	$msg = validarCampos($request);
	if($msg != "OK") {
		return $msg;
	}
	try {
		$conexao = getConnection();
		$sql = "insert into bebida(nome, quantidade, minima, maxima, preco, fabricante, fornecedor, categoria, dataFabricacao, dataValidade, alcoolica, teorAlcool, ingredientes)
				values(:nome, :quantidade, :minima, :maxima, :preco, :fabricante, :fornecedor, :categoria, STR_TO_DATE(:dataFabricacao, '%Y-%m-%d'),
				STR_TO_DATE(:dataValidade, '%Y-%m-%d'), :alcoolica, :teorAlcool, :ingredientes);";
		$stmt = $conexao->prepare($sql);
		$stmt->bindValue(":nome", $request["nome"]);
		$stmt->bindValue(":quantidade", $request["quantidade"]);
		$stmt->bindValue(":minima", $request["minima"]);
		$stmt->bindValue(":maxima", $request["maxima"]);
		$stmt->bindValue(":preco", $request["preco"]);
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
		$stmt->bindValue(":ingredientes", $request["ingredientes"]);
		$stmt->execute();
		if($conexao->lastInsertId()) {
			$msg = "OK";
		}
		else {
			$msg = "Erro ao salvar.";
		}
		return $msg;
	} catch(Exception $e) {
		var_dump($e->getMessage());exit;
	}
}

function excluirProduto($request) {
	$conexao = getConnection();
	$sql = "delete from bebida where id_bebida=:id_bebida";
	$stmt = $conexao->prepare($sql);
	$stmt->bindValue(":id_bebida", $request["id"]);
	$stmt->execute();
}

function editarProduto($request) {
	$msg = validarCampos($request);
	if($msg != "OK") {
		return $msg;
	}
	$conexao = getConnection();
	$sql = "update bebida set nome=:nome, quantidade=:quantidade, minima=:minima, maxima=:maxima, preco=:preco, fabricante=:fabricante, fornecedor=:fornecedor, categoria=:categoria, dataFabricacao=STR_TO_DATE(:dataFabricacao, '%Y-%m-%d'), dataValidade=STR_TO_DATE(:dataValidade, '%Y-%m-%d'), alcoolica=:alcoolica, teorAlcool=:teorAlcool, ingredientes=:ingredientes where id_bebida=:id_bebida;";
	$stmt = $conexao->prepare($sql);
	$stmt->bindValue(":nome", $request["nome"]);
	$stmt->bindValue(":quantidade", $request["quantidade"]);
	$stmt->bindValue(":minima", $request["minima"]);
	$stmt->bindValue(":maxima", $request["maxima"]);
	$stmt->bindValue(":preco", $request["preco"]);
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
	$stmt->bindValue(":ingredientes", $request["ingredientes"]);	
	$stmt->bindValue(":id_bebida", $request["id_bebida"]);
	if(!$stmt->execute()) {
		$msg = "Erro ao alterar.";
	}
	return $msg;

}

?>