<?php 
	require_once('funcoes.php');
	verificaLogin();
	echo 'Eu sou o painel.php';
	
?>
<p><a href="?logoff=true">Sair</a></p>
<p><?php $sessao = new sessao();
		 $sessao->printAll();
	?>
</p>