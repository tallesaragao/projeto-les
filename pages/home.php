<h2>PHP com HTML</h2>
<ul>
	<?php exibirUsuarios() ?>
</ul>
<hr>
<h2>Pesquisa de produto</h2>
<form action="/busca" method="GET">
	<input type="text" name="busca">
	<button type="submit">Pesquisar</button>
</form>
<hr>
<h2>Lista de Produtos</h2>
<table>
	<thead>
		<tr>
			<th>Nome</th>
			<th>Descrição</th>
			<th>Valor</th>
		</tr>
	</thead>
<tbody>
	<?php foreach($produtos as $produto): ?>
		<tr>
			<td><?php echo $produto["titulo"] ?></td>
			<td><?php echo $produto["descricao"] ?></td>
			<td><?php echo number_format($produto["valor"], 2, ",", ".") ?></td>
		</tr>
	<?php endforeach; ?>
</tbody>
</table>
<hr>
<h2>Adicionar Produto</h2>
<?php if(isset($msg)): ?>
	<p><?php echo $msg ?></p>
<?php endif; ?>
<form action="produto/salvar" method="POST">
	<fieldset>
		<label for="nome">Nome</label>
		<input type="text" name="nome" required><br>
		<label for="quantidade">Quantidade</label>
		<input type="text" name="quantidade" required><br>
		<label for="fabricante">Fabricante</label>
		<input type="text" name="fabricante" required><br>
		<label for="fornecedor">Fornecedor</label>
		<input type="text" name="fornecedor" required><br>
		<label for="categoria">Categoria</label>
		<input type="text" name="categoria" required><br>
		<label for="dataFabricacao">Data de fabricação</label>
		<input type="date" name="dataFabricacao" required><br>
		<label for="dataValidade">Data de validade</label>
		<input type="date" name="dataValidade" required><br>
		<label for="alcoolica">Alcoólica?</label>
		<select name="alcoolica" required>
			<option disabled selected>Escolha sua opção</option>
			<option value="1">Sim</option>
			<option value="0">Não</option>
		</select><br>
		<label for="teorAlcool">Teor de álcool</label>
		<input type="text" name="teorAlcool"><br>
		<button type="submit">Salvar</button>
	</fieldset>
</form>