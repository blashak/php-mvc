<?php

class DataBase {
	private $handler;
	private $filter;
	
	public function DataBase(DataBaseHandler $handler) {
		
		$this->handler = $handler;
		$this->handler->connect();
	}
	
	public function cleanString($data = null) {
		if(isset($data)) {
			return $this->handler->cleanString($data);
		}
		else { return null;}
	}
	
	public function execute(Sql $sql) {
		$result = $this->handler->executeQuery($sql);
		
		if($result == true) {
			if ($sql->getAction() == 'Insert') {
				if($result == true) {
					return $this->handler->getLastId();
				}
			}
			elseif ($sql->getAction() == 'Select') {
				$resultQuery = array();
				
				while ($row = mysqli_fetch_assoc($result)) {
						
					$resultQuery[] = $row;
				}
				
				return $resultQuery;
			}
			else {
				$this->handler->disconnect();
				return $result;
			}
		}
		else { 'error en la querys'; }
		
	}
}

?>