<?php

class Sql extends PDO{

	private $conn;

	public function __construct(){

		$this -> conn = new PDO("mysql:host=localhost;dbname=dbphp","root","root");
		// Esse metodo construtor inicia toda vez a conexão quando chamado a classe SQL.
	}

	private function setParams($statment, $parameters = array()){
		// Aqui eu faço o tratamento dos parametros que vão dentro do prepare(:ID,:SENHA);
		// Estou construindo bindParam;
		foreach ($parameters as $key => $value) {
			
			$this -> setParam($key,$value);
		}
	}

	private function setParam($statment, $key, $value){
		// Aqui eu crio o bindParam sozinho
		$stmt -> bindParam($key, $value);
	}

	public function query($rawQuery, $parametros = array()){
		// Aqui faz o prepare();
		$stmt = $this -> conn -> prepare($rawQuery);

		$this -> setParams($stmt, $parametros);

		$stmt->execute();

		return $stmt;
		
	}

	public function select($rawQuery,$params = array()):array
	{

		$stmt = $this -> query($rawQuery,$params);

		return $stmt -> fetchAll(PDO::FETCH_ASSOC);

	}

}

?>
