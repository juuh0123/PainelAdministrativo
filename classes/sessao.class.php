<?php
require_once(dirname(__FILE__).'/autoload.php'); //não chamo o funcoes.php, chamo o autoload->funcoes
protegeArquivo(basename(__FILE__));//tenho que chamar em todas minhas classes

class sessao{
	protected $id;
	protected $nvars;
	
	public function __construct($inicia = true){
		if($inicia == TRUE):
			$this->start();
		endif;		
	}//construtor
	
	public function start(){
		session_start();
		$this->id = session_id();
		$this->setNvars();
	}//metodo start
	
	private function setNvars(){
		$this->nvars = sizeof($_SESSION); //vai pegar todas váriaveis da sessao
	}//metodo setNvars
	
	public function getNvars(){
		return $this->nvars; //retorna o numero de variaveis da sessao
	}//metodo getNvars
	
	public function setVar($var, $valor){ //setar o valor 
		$_SESSION[$var] = $valor; //exemplo $nome = junior
		$this->setNvars();
	}//metodo setVar
	
	public function unsetVar($var){
		unset($_SESSION[$var]);
		$this->setNvars();
	}//metodo unsetVar
	
	public function getVar($var){
		if(isset($_SESSION[$var])):
			return $_SESSION[$var];
		else:
			return NULL;
		endif;	
	}//metodo getVar
	
	public function destroy($inicia = false){
		session_unset();
		session_destroy();
		$this->setNvars(); //atualiza o numero de variaves
		if($inicia == TRUE):
			$this->start();
		endif;		
	}//metodo destroy
	
	public function printAll(){ //ela vai printar todas varias da nossa sessao
		foreach($_SESSION as $k => $v):
			printf("%s = %s<br />", $k, $v);
		endforeach;	
	}//metodo printAll
}//class sessao
?>