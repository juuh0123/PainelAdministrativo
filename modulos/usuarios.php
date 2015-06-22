<?php
require_once(dirname(dirname(__FILE__))."/funcoes.php");
protegeArquivo(basename(__FILE__));
loadJS('jquery-validate');
loadJS('jquery-validate-messages');
 //$teste = dirname(__FILE__);
 //echo $teste;
	switch($tela):
		case 'login':
			$sessao = new sessao();
			if($sessao->getNvars()>0 || $sessao->getVar('logado') == TRUE) redireciona('painel.php');
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
		case 'incluir':
			echo '<h2>Cadastro de usuários</h2>';
			
			if(isset($_POST['cadastrar'])):
				$user = new usuarios(array(
					'nome'=>$_POST['nome'],
					'email'=>$_POST['email'],
					'login'=>$_POST['login'],
					'senha'=>codificaSenha($_POST['senha']),
				   	'administrador'=>(@$_POST['adm']=='on') ? 's' : 'n',
				));
				if($user->existeRegistro('login',$_POST['login'])):
					printMSG('Este login já está cadastrado, escolha outro nome de usuário.','erro');
					$duplicado = TRUE;
				endif;
				if($user->existeRegistro('email',$_POST['email'])):
					printMSG('Este email já está cadastrado, escolha outro endereço.','erro');
					$duplicado = TRUE;
				endif;
				if(@$duplicado != TRUE):
					$user->inserir($user);
					if($user->linhasafetadas==1):
						 printMSG('Dados inseridos com sucesso. <a href="'.ADMURL.'?m=usuarios&t=listar">Exibir cadastros</a>');
						unset($_POST);
					endif;
				endif;	
			endif;
			/*TELA DE CADASTRO DE USUÁRIOS*/	
			?>	
			<script type="text/javascript">
				$(document).ready(function(){
					$(".userForm").validate({
						rules:{
							nome:{required:true, minlength:3},
							email:{required:true, email:true},
							login:{required:true, minlength:5},
							senha:{required:true, rangelength:[4,10]},
							senhaconf:{required:true, equalTo:"#senha"},
						}
					});
				});
			</script>
				<form class="userForm" method="post" action="">
						<fieldset>
							<legend>Informe os dados para cadastro</legend>
							<ul>
								<li><label for="nome">Nome:</label>
								<input type="text" size="50" name="nome" value="<?php //echo $_POST['nome'] ?>"/></li>	
								<li><label for="email">Email:</label>
								<input type="text" size="50" name="email" value="<?php //echo $_POST['email'] ?>"/></li>
								<li><label for="login">Login:</label>
								<input type="text" size="35" name="login" value="<?php //echo $_POST['login'] ?>"/></li>
								<li><label for="senha">Senha:</label>
								<input type="password" size="25" name="senha" id="senha" value="<?php //echo $_POST['senha'] ?>"/></li>
								<li><label for="senhaconf">Repita a senha:</label>
								<input type="password" size="25" name="senhaconf" value="<?php //echo $_POST['senhaconf'] ?>"/></li>	
								<li><label for="adm">Administrador:</label>
								<input type="checkbox" name="adm" <?php if(!isAdmin()) echo 'disabled="disabled"'; if(@$_POST['adm']) echo 'checked="checked"'; ?> /> dar controle total ao usuário</li>	
								<li class="center"><input type="button" onclick="location.href='?m=usuarios&t=listar'" value="Cancelar"/>
									<input type="submit" name="cadastrar" value="Salvar dados"/></li>		
							</ul>
						</fieldset>
				</form>
			<?php	
			break;
		case 'listar':
			echo '<h2>Usuários cadastrados</h2>';
			break;
		default:
			echo '<p>A tela solicita não existe.</p>';
			break;		
	endswitch;	 

?>