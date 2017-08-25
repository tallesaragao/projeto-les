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
<ul>
	<?php foreach($produtos as $produto): ?>
		<li><?php echo $produto["titulo"]." - ".$produto["descricao"]." - R$ ".number_format($produto["valor"], 2, ",", ".") ?></li>
	<?php endforeach; ?>
</ul>
<hr>
<h2>Adicionar Produto</h2>
<form action="produto/salvar" method="POST">
	<label for="titulo">Título</label>
	<input type="text" name="titulo">
	<label for="descricao">Título</label>
	<input type="text" name="descricao">
	<label for="valor">Título</label>
	<input type="text" name="valor">
	<button type="submit">Salvar</button>
</form>