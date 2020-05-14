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

			$row = $result[0];

			$this -> setIdusuario($row['idusuario']);
			$this -> setDeslogin($row['deslogin']);
			$this -> setDesemail($row['desemail']);
			$this -> setDesapelido($row['desapelido']);
			$this -> setDessenha($row['dessenha']);
			$this -> setDtcadastro(new DateTime($row['dtcadastro']));
		}
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