<?php
	//Essa clase vai ser reponsável por carregar todas classes do sistema sem ter que ficar dando include em cada uma, de maneira automática
	protegeArquivo(basename(__FILE__));
	$pathlocal = dirname(__FILE__);
	require_once(dirname($pathlocal)."/funcoes.php");
	function __autoload($classe){
		$classe = str_replace('..', '', $classe);
		require_once(dirname(__FILE__)."/$classe.class.php");
	}//__autoload
?>
