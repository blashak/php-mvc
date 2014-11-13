<?php

class User
{
	
	private $user_id;
	private $name;	
	
	public function User($data = null) {
		if(gettype($data) == 'array') {
			foreach ($data as $k => $v) {
				if(property_exists($this, $k)) {
					$this->$k = $data[$k];
				}
			}
		}
	}
	
	public static function get(array $filter) {
	 	$persistenceUser = new PersistenceUser();
		$data = $persistenceUser->get($filter);

		if(count($data) > 0) {
			foreach ($data as $k => $v) {
				$user[] = new User($data[$k]);
			}
			return $user;
		} else { return []; }
	}
	
	public function getId() {
		return (int) $this->user_id;
	}
	
	
	public function getName() {
		return $this->name;
	}
	
	public function setName($name) {
		$this->name = $name;
	}
	
	private function generateArray() {
		$data = array();
	
		if (isset($this->name)) $data['name'] = $this->name;
		
		return $data;
	}
	
	public function save() {
		$persistenceUser = new PersistenceUser();
		$this->user_id = $persistenceUser->save($this->generateArray());
	}

	public function update() {
		$data = $this->generateArray();
	
		$persistenceUser = new PersistenceUser();
		return $persistenceUser->update($this->user_id, $data);
	}
	
	public function delete() {
		$persistenceUser = new PersistenceUser();
		return $persistenceUser->delete($this->user_id);
	}
	
}

?>
