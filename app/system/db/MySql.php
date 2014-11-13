<?php

class MySql implements DataBaseHandler {	
	private $user;
	private $password;
	private $server;
	private $base;
	private $conn;
	
	public function connect()
	{
		
		switch (ENVIROMENT) {
			case 'development': //Desarrollo
				//Configuracion mysql
				$this->user = 'root';
				$this->password = '123';
				$this->server = 'localhost';
				$this->base = 'mvc';
		
				break;
		}
		
		
		$this->conn = new mysqli(
			$this->server,
			$this->user,
			$this->password,
			$this->base
		);
		
		$this->conn->set_charset("utf8");

	}
	
	/**
	 * Limpia los datos de SQL Injection
	 * 
	 * (non-PHPdoc)
	 * @see DataBaseHandler::cleanString()
	 */
	public function cleanString($data) {
		
		if(gettype($data) == 'array') {
		
			$dataTemp = array();
			
			foreach ($data as $k => $v) {
				$dataTemp[$this->conn->real_escape_string($k)] = $this->conn->real_escape_string($data[$k]);
			}
		
		}
		else {
			$dataTemp = $this->conn->real_escape_string($data);
		}
		
		return $dataTemp;
	}
	
	public function executeQuery(Sql $sql) {
		$result = $this->conn->query($sql);
		return $result;
	}
	
	public function getLastId() {
		return mysqli_insert_id($this->conn);
	}
	
	public  function disconnect() {
		$this->conn->close();
	}
}
?>