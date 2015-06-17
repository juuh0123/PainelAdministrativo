<?php include('header.php'); 

//if(isset($_GET['m'])) $modulo = $_GET['m']; código do ricardo porém me retornava uma notice quando não era inicializada
//if(isset($_GET['t'])) $tela = $_GET['t']; resolvido com o código abaixo

if(isset($_GET['m'])): 
	$modulo = $_GET['m'];
else: 
	$modulo = "";
endif;
if(isset($_GET['t'])):
	 $tela = $_GET['t'];
else:
	$tela = "";
endif; 		
?>
<div id="content">
	<?php 
		if($modulo && $tela):
			loadModulo($modulo, $tela);
		else:
			echo '<p>Escolha uma opção de menu ao lado.</>';
		endif;		
	?>
</div><!--content-->
<?php include('sidebar.php'); ?>
<?php include('footer.php'); ?>