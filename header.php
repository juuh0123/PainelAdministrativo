<?php require_once("funcoes.php"); 
protegeArquivo(basename(__FILE__));
verificaLogin();
$sessao = new sessao();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pt_BR" lang="pt_BR">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Painel Administrativo</title>
		<?php
			loadCSS('reset');
			loadCSS('style');
			loadJS('jquery');
			loadJS('geral');
		?>
	</head>
	<body class="painel">
		<div id="wrapper">
			<div id="header">
				<h1>Painel de Administração</h1>
			</div><!--header-->
			<div id="wrap-content">
				
			