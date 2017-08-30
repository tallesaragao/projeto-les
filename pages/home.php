<h2>Adicionar bebida</h2>
<form>	
	<button type="submit" formaction="/produto/form" name="operacao" value="salvar">Nova bebida</button>
</form>
<hr>
<h2>Pesquisa de bebidas</h2>
<?php if(isset($msg)): ?>
	<p><?php echo $msg ?></p>
<?php endif; ?>
<form>
	<input type="text" name="busca" placeholder="Pesquisar por:">
	<select name="filtro">
		<option value="nome">Nome</option>
		<option value="preco">Faixa de preço (R$)</option>
		<option value="categoria">Categoria</option>
		<option value="fornecedor">Fornecedor</option>
	</select>
	<button type="submit" formaction="/produto/busca" name="operacao" value="pesquisar">Pesquisar</button>
</form>
<hr>
<h2>Lista de bebidas</h2>
<table>
	<thead>
		<tr>
			<th>Nome</th>
			<th>Quantidade</th>
			<th>Mínima</th>
			<th>Máxima</th>
			<th>Preço (R$)</th>
			<th>Fabricante</th>
			<th>Fornecedor</th>
			<th>Categoria</th>
			<th>Data de Fab.</th>
			<th>Validade</th>
			<th>Alcoólica?</th>
			<th>Teor de Álcool (%)</th>
			<th>Ingredientes</th>
		</tr>
	</thead>
<tbody>
	<?php foreach($produtos as $produto): ?>
		<form>
			<tr>
				<td><?php echo $produto["nome"] ?></td>
				<td><?php echo $produto["quantidade"] ?></td>
				<td><?php echo $produto["minima"] ?></td>
				<td><?php echo $produto["maxima"] ?></td>
				<td><?php echo $produto["preco"] ?></td>
				<td><?php echo $produto["fabricante"] ?></td>
				<td><?php echo $produto["fornecedor"] ?></td>
				<td><?php echo $produto["categoria"] ?></td>
				<td><?php echo $produto["dataFabricacao"] ?></td>
				<td><?php echo $produto["dataValidade"] ?></td>
				<?php if($produto["alcoolica"] == 1): ?>
					<td>Sim</td>
				<?php else: ?>
					<td>Não</td>
				<?php endif; ?>
				<td><?php echo $produto["teorAlcool"] ?></td>
				<td><?php echo $produto["ingredientes"] ?></td>
				<td><button type="submit" formaction="/produto/editar" name="operacao" value="alterar">Editar</button></td>
				<td><button type="submit" formaction="/produto/excluir" onclick="return confirmaExclusao()">Excluir</button></td>
				<input type="hidden" name="id" value="<?php echo $produto['id_bebida'] ?>">
			</tr>
		</form>
	<?php endforeach; ?>
	</form>
</tbody>
</table>

<script type="text/javascript">
	function confirmaExclusao() {
		if (confirm("Deseja realmente excluir?") == false) {
			return false;
		}
	}
</script>