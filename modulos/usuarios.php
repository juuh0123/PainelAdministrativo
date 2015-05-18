<?php
require_once(dirname(dirname(__FILE__))."/funcoes.php");
protegeArquivo(basename(__FILE__));
loadJS('jquery-validate');
loadJS('jquery-validate-messages');
 //$teste = dirname(__FILE__);
 //echo $teste;
	switch($tela):
		case 'login':
			if(isset($_POST['logar']))://logar é do form
				$user = new usuarios();
				$user->setValor('login', $_POST['usuario']);//campo do form
				$user->setValor('senha', $_POST['senha']);
				if($user->doLogin($user)):
					redireciona('painel.php');
				else:
					redireciona('?erro=2');	
				endif;	
			endif;	
			?>
			<script type="text/javascript">
				$(document).ready(function(){
					$(".userForm").validate({
						rules:{
							usuario:{required:true, minlength:3},
							senha:{required:true, rangelength:[4,10]},
						}
					});
				});
			</script>
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
						<?php
							@$erro = $_GET['erro'];
							switch($erro):
								case 1:
									echo '<div class="sucesso">Você fez logoff do sistema.</div>';
									break;
								case 2:
									echo '<div class="erro">Dados incorretos ou usuário inativo.</div>';
									break;
								case 3:
									echo '<div class="erro">Faça login antes de acessar a página solicitada.</div>';	
									break;
							endswitch;
						?>
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