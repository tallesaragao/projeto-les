<?php if(isset($produtoEdit)): ?>
	<h2>Editar Produto</h2>
	<form action="/produto/editar" method="POST">
		<input type="hidden" name="id" value="<?php echo $produtoEdit['id_bebida']; ?>">
<?php else: ?>
	<h2>Adicionar Produto</h2>
	<form action="/produto/salvar" method="POST">
<?php endif; ?>
<?php if(isset($msg)): ?>
	<p><?php echo $msg ?></p>
<?php endif; ?>
	<fieldset>
		<label for="nome">Nome</label>
		<input type="text" name="nome" required value="<?php echo (isset($produtoEdit)? $produtoEdit['nome'] : ''); ?>"><br>
		<label for="quantidade">Quantidade</label>
		<input type="number" step="any" name="quantidade" required
		value="<?php echo (isset($produtoEdit)? $produtoEdit['quantidade'] : ''); ?>"><br>
		<label for="preco">Preço</label>
		<input type="number" step="any" name="preco" required
		value="<?php echo (isset($produtoEdit)? $produtoEdit['preco'] : ''); ?>"><br>
		<label for="fabricante">Fabricante</label>
		<input type="text" name="fabricante" required value="<?php echo (isset($produtoEdit)? $produtoEdit['fabricante'] : ''); ?>"><br>
		<label for="fornecedor">Fornecedor</label>
		<input type="text" name="fornecedor" required value="<?php echo (isset($produtoEdit)? $produtoEdit['fornecedor'] : ''); ?>"><br>
		<label for="categoria">Categoria</label>
		<input type="text" name="categoria" required value="<?php echo (isset($produtoEdit)? $produtoEdit['categoria'] : ''); ?>"><br>
		<label for="dataFabricacao">Data de fabricação</label>
		<input type="date" name="dataFabricacao" required 
		value="<?php echo (isset($produtoEdit)? $produtoEdit['dataFabricacao'] : ''); ?>"><br>
		<label for="dataValidade">Data de validade</label>
		<input type="date" name="dataValidade" required
		value="<?php echo (isset($produtoEdit)? $produtoEdit['dataValidade'] : ''); ?>"><br>
		<label for="alcoolica">Alcoólica?</label>
		<select name="alcoolica" required>
			<?php if(isset($produtoEdit)): ?>				
				<option disabled value="">Escolha sua opção</option>
			<?php else: ?>
				<option disabled selected value="">Escolha sua opção</option>
			<?php endif; ?>			
			<option value="1">Sim</option>
			<?php
				if(!isset($produtoEdit)) {
					echo "<option value='0'>Não</option>";
				}
				else {
					echo "<option value='0' selected>Não</option>";
				}
			?>
		</select><br>
		<label for="teorAlcool">Teor de álcool (%)</label>
		<input type="number" step="any" name="teorAlcool"
		value="<?php echo (isset($produtoEdit['teorAlcool'])? $produtoEdit['teorAlcool'] : ''); ?>"><br>
		<?php if(isset($produtoEdit)): ?>			
			<button type="submit">Alterar</button>
		<?php else: ?>
			<button type="submit">Salvar</button>
		<?php endif; ?>
		<a href="/">Cancelar</a>
	</fieldset>
</form>