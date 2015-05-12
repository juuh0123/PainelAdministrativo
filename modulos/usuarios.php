<?php
 require_once(dirname(dirname(__FILE__))."/funcoes.php");
 protegeArquivo(basename(__FILE__));

 //$teste = dirname(__FILE__);
 //echo $teste;
 
	switch($tela):
		case 'login':
			?>
			<div id="loginForm">
				<form class="userForm" method="post" action="">
					<fieldset>
						<legend>Acesso restrito, identifique-se</legend>
						<ul>
							<li>
								<label for="usuario">Usuário:</label>
								<input type="text" size="35" name="usuario" value="<?php //echo $_POST['usuario']; ?>" />
							</li>
							<li>
								<label for="senha">Senha:</label>
								<input type="password" size="35" name="senha" value="<?php //echo $_POST['senha']; ?>" />
							</li>
							<li class="center"><input class="radius5" type="submit" name="logar" value="Login"/></li>
						</ul>
					</fieldset>
				</form>
			</div>	
			<?php
			break;
		default:
			echo '<p>A tela solicita não existe.</p>';
			break;		
	endswitch;	 

?>