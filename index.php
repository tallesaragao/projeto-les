<?php

function getInfo($atributo) {
	$dados = ["SiteModelo","Programando com PHP"];
	return $dados[$atributo];
}


?>
<!DOCTYPE html>
<html>
<head>
	<title>Título</title>
</head>
<body>
	<h2>PHP com HTML</h2>
	<p><?php echo getInfo(1) ?>
</body>
</html>