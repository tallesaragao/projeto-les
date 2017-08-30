<?php 
	$metodo = $_SERVER["REQUEST_METHOD"];
	if($metodo == "GET") {
		$operacao = $_GET;
	}
	else {
		$operacao = $_POST;
	}
?>
<?php if($operacao["operacao"] == "alterar"): ?>
	<h2>Editar bebida</h2>
	<form action="/produto/editar" method="POST">
		<input type="hidden" name="id_bebida" value="<?php echo $produtoEdit['id_bebida']; ?>">
<?php else: ?>
	<h2>Adicionar bebida</h2>
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
		<label for="minima">Quantidade Mínima</label>
		<input type="number" step="any" name="minima" required
		value="<?php echo (isset($produtoEdit)? $produtoEdit['minima'] : ''); ?>"><br>
		<label for="maxima">Quantidade Máxima</label>
		<input type="number" step="any" name="maxima" required
		value="<?php echo (isset($produtoEdit)? $produtoEdit['maxima'] : ''); ?>"><br>
		<label for="preco">Preço (R$)</label>
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
			<?php
				$html = "";
				if($_GET["operacao"] == "alterar") {
					if($produtoEdit["alcoolica"] == 1) {
						$html = "<option value='1' selected>Sim</option>".
								"<option value='0'>Não</option>";
					}
					else {						
						$html = "<option value='1'>Sim</option>".
								"<option value='0' selected>Não</option>";
					}
				}
				else {
					if(isset($produtoEdit) && $produtoEdit["alcoolica"] == 0) {						
						$html = "<option value='1'>Sim</option>".
								"<option value='0' selected>Não</option>";
					}
					else {					
						$html = "<option value='1'>Sim</option>".
								"<option value='0'>Não</option>";						
					}
				}
				echo $html;
			?>
		</select><br>
		<label for="teorAlcool">Teor de álcool (%)</label>
		<input type="number" step="any" name="teorAlcool"
		value="<?php echo (isset($produtoEdit['teorAlcool'])? $produtoEdit['teorAlcool'] : ''); ?>"><br>
		<label for="ingredientes">Ingredientes</label>
		<textarea name="ingredientes">
			<?php echo (isset($produtoEdit)? $produtoEdit['ingredientes'] : ''); ?>
		</textarea><br>
		<?php if($operacao["operacao"] == "alterar"): ?>			
			<button type="submit" name="operacao" value="alterar">Alterar</button>
		<?php else: ?>
			<button type="submit" name="operacao" value="salvar">Salvar</button>
		<?php endif; ?>
		<a href="/produto">Cancelar</a>
	</fieldset>
</form>