<?php

class Usuario{
	private $idusuario;
	private $deslogin;
	private $desemail;
	private $desapelido;
	private $dessenha;
	private $dtcadastro;


	public function getIdusuario(){

		return $this->idusuario;
	}
	public function setIdusuario($idusuario){

		$this->idusuario = $idusuario;
	}


	public function getDeslogin(){

		return $this->deslogin;
	}
	public function setDeslogin($deslogin){

		$this->deslogin = $deslogin;
	}


	public function getDesemail(){

		return $this ->desemail;
	}
	public function setDesemail($desemail){

		$this->desemail = $desemail;
	}


	public function getDesapelido(){

		return $this ->desapelido;
	}
	public function setDesapelido($desapelido){

		$this->desapelido = $desapelido;
	}


	public function getDessenha(){

		return $this->dessenha;
	}
	public function setDessenha($dessenha){

		$this ->dessenha = $dessenha;
	}


	public function getDtcadastro(){

		return $this->dtcadastro;
	}
	public function setDtcadastro($dtcadastro){
		
		$this->dtcadastro = $dtcadastro;
	}

	public function loadById($id){

		$sql = new Sql();

		$result = $sql -> select("SELECT * FROM tb_cadastro where idusuario = :ID", array(
			":ID"=>$id
		));

		if (count($result)>0){

			$this ->setData($result[0]);
			
		}
	}	

	public static function getList(){

		$sql = new Sql();

		return $sql -> select ("SELECT * FROM tb_cadastro ORDER BY deslogin;");
	}	

	public static function search($login){

		$sql = new Sql();

		return $sql -> select("SELECT * FROM tb_cadastro WHERE deslogin LIKE :SEARCH ORDER BY deslogin", array(
			':SEARCH' => "%".$login."%"
		));

	}

	public function login($login, $password){
		$sql = new Sql();

		$result = $sql -> select("SELECT * FROM tb_cadastro where deslogin = :LOGIN AND dessenha = :PASSWORD", array(
			":LOGIN"=>$login,
			":PASSWORD"=>$password
		));

		if (count($result)>0){


			$this ->setData($result[0]);

			
		} else{

			throw new Exception("Login e/ou senha inválidos.");
		} 
	}

	public function setData($data){

		$this -> setIdusuario($data['idusuario']);
		$this -> setDeslogin($data['deslogin']);
		$this -> setDesemail($data['desemail']);
		$this -> setDesapelido($data['desapelido']);
		$this -> setDessenha($data['dessenha']);
		$this -> setDtcadastro(new DateTime($data['dtcadastro']));

	}

	public function insert(){

		$sql = new Sql();

		$result = $sql -> select("CALL sp_cadastro_insert(:LOGIN,:EMAIL,:APELIDO,:PASSWORD)",array(
			':LOGIN'=>$this->getDeslogin(),
			':EMAIL'=>$this->getDesemail(),
			':APELIDO'=>$this->getDesapelido(),
			':PASSWORD'=>$this->getDessenha()
		));

		if (count($result)>0){
			$this ->setData($result[0]);
		}
	}

	public function __construct ($login= "", $email = "", $apelido = "", $senha =""){

		$this->setDeslogin($login);
		$this->setDesemail($email);
		$this->setDesapelido($apelido);
		$this->setDessenha($senha);
	}

	public function __toString(){

		return json_encode(array(
			"idusuario" => $this->getIdusuario(),
			"deslogin" => $this->getDeslogin(),
			"desemail" => $this->getDesemail(),
			"desapelido" => $this->getDesapelido(),
			"dessenha" => $this->getDessenha(),
			"dtcadastro" => $this->getDtcadastro()->format("d/m/Y H:i:s")

		));
	}
}	
?>