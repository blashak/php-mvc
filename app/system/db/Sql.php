<?php

class Sql {

	private $type;
	private $action;
	private $table;
	private $data = array();
	private $fields;
	private $values;
	private $filter;
	private $query;
	
	public function getQuery() {
		return nl2br($this->generate());
	}
	
	public function getAction() {
		return $this->action;
	}
	
	public function addType($type='sql') {
		$this->type = $type;
	}
	
	public function addAction($action) {
		$this->action = $action;
	}
	
	public function addQuery($query) {
		$this->query = $query;
	}
	
	public function addTable($table) {
		$this->table = $table;
	}
	
	public function addFields($data) {
		$this->fields = implode(', ', array_keys($data));
	}
	
	public function addFilter(array $filter = null) {
		if(isset($filter))
		{
			$filterSql = new FilterSql($filter);
			$this->filter = $filterSql;
		}
	}
	
	public function addValues($data) {
		$x = 0;
		
		foreach ($data as $key => $value) {
			if(is_numeric($value)) {
				if($x == 0)
				{
					$this->values .= $value;
				}
				else
				{
					$this->values .= ', ' . $value;
				}
			} else {
				if($x == 0)
				{
					$this->values  .= "'". $value . "'";
				}
				else
				{
					$this->values  .= ", '". $value . "'";
				}
			}
			
			++$x;
		}

	}
	
	public function addData($data) {
		$this->data = $data;
	}
	
	public function generate() {
		
		if ($this->action == 'Insert') {
			$this->query = 'INSERT INTO'.$this->table.' ('.$this->fields.') VALUES ('.$this->values.')';
			return $this->query;
		}
		elseif ($this->action == 'Select') {
			return $this->query.$this->filter;
			
		}
		elseif ($this->action == 'Update') {
			$this->query = "UPDATE ".$this->table." SET ";
			
			$x_data = count($this->data);
			$x = 1;
			
			foreach($this->data as $k => $v){
				$this->query .= $k."='".$this->data[$k];
				
				if($x < $x_data){
					$this->query .= "',";
				}
			
				$x++;
			}
			$this->query .= "' ".$this->filter;

			return $this->query;

		}
		elseif ($this->action == 'Delete') {
			$this->query = 'DELETE FROM '.$this->table.$this->filter;
			
			return $this->query;
		}
		
		
	}
	
	public function __toString() {
		return $this->generate();
	}
}
?>