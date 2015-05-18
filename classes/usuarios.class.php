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
			if($this->linhasafetadas==1):
				return TRUE;
			else:	
				return FALSE;
			endif;	
		}//doLogin, classe que fazer consulta se ta logado
		
		public function doLogout(){
			redireciona('?erro=1');
		}
	}//fim da classe Clientes
?>