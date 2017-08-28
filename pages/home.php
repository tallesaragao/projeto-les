<h2>Pesquisa de produto</h2>
<?php if(isset($msg)): ?>
	<p><?php echo $msg ?></p>
<?php endif; ?>
<form>
	<input type="text" name="busca">
	<button type="submit" formaction="/busca">Pesquisar</button>
	<a href="/produto/form">Adicionar produto</a>
</form>
<hr>
<h2>Lista de Produtos</h2>
<table>
	<thead>
		<tr>
			<th>Nome</th>
			<th>Quantidade</th>
			<th>Fabricante</th>
			<th>Fornecedor</th>
			<th>Categoria</th>
			<th>Data de Fab.</th>
			<th>Validade</th>
			<th>Alcoólica?</th>
			<th>Teor de Álcool (%)</th>
		</tr>
	</thead>
<tbody>
	<?php foreach($produtos as $produto): ?>
		<form>
			<tr>
				<td><?php echo $produto["nome"] ?></td>
				<td><?php echo $produto["quantidade"] ?></td>
				<td><?php echo $produto["fabricante"] ?></td>
				<td><?php echo $produto["fornecedor"] ?></td>
				<td><?php echo $produto["categoria"] ?></td>
				<td><?php echo $produto["dataFabricacao"] ?></td>
				<td><?php echo $produto["dataValidade"] ?></td>
				<td><?php echo $produto["alcoolica"] ?></td>
				<td><?php echo $produto["teorAlcool"] ?></td>
				<td><button type="submit" formaction="/produto/editar">Editar</button></td>
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