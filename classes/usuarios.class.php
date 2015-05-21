<?php
require_once(dirname(__FILE__).'/autoload.php'); //não chamo o funcoes.php, chamo o autoload->funcoes
protegeArquivo(basename(__FILE__));//tenho que chamar em todas minhas classes
	class usuarios extends base{
		public function __construct($campos=array()){
			parent::__construct();
			$this->tabela = "usuarios";
			if(sizeof($campos)<=0):
				$this->camposValores = array(
				"nome" => NULL,
				"email" => NULL,
				"login" => NULL,
				"senha" => NULL,
				"ativo" => NULL,
				"administrador" => NULL,
				"dataCad" => NULL,
				);
			else:
				$this->camposValores = $campos;
			endif;
			$this->campoPk = "id";	
		}//construct
	
		public function doLogin($objeto){
			$objeto->extrasSelect = "WHERE login='".$objeto->getValor('login')."' AND senha='".codificaSenha($objeto->getValor('senha'))."' AND
			ativo='s'";
			$this->select($objeto);
			$sessao = new sessao();
			if($this->linhasafetadas==1):
				$usLogado = $objeto->retornaDados();
				$sessao->setVar('iduser', $usLogado->id);
				$sessao->setVar('nomeuser', $usLogado->nome);
				$sessao->setVar('loginuser', $usLogado->login);
				$sessao->setVar('logado', true);
				$sessao->setVar('ip', $_SERVER['REMOTE_ADDR']);	
				return TRUE;
			else:	
				$sessao->destroy(TRUE);
				return FALSE;
			endif;	
		}//doLogin, classe que fazer consulta se ta logado
		
		public function doLogout(){
			$sessao = new sessao();
			$sessao->destroy(TRUE);
			redireciona('?erro=1');
		}
	}//fim da classe Clientes
?>