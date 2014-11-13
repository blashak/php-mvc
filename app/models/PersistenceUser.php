<?php

class PersistenceUser
{
	public function get(array $filter = null) {
		$db = new DataBase(new MySql());
		$sql = new Sql();
		
		$filter = $db->cleanString($filter);
		
		$sql->addAction('Select');
		
		$query = '
			SELECT
				*
			FROM users
		';

		$sql->addQuery($query);
		
		$sql->addFilter($filter);
		//echo $sql->getQuery();
		return $db->execute($sql);
	}
	
	public function save($data) {
	
		$db = new DataBase(new MySql());
		$sql = new Sql();
	
		$data = $db->cleanString($data);
	
		$sql->addAction('Insert');
		$sql->addTable(' users ');
		$sql->addFields($data);
		$sql->addValues($data);
	
		//echo $sql->getQuery();
		return $db->execute($sql);
	}
	
	public function update($id,$data) {
		$db = new DataBase(new MySql());
		$sql = new Sql();
		
		$id = $db->cleanString($id);
		$data = $db->cleanString($data);
	
		$sql->addAction('Update');
		$sql->addTable('users');
	
		$filter = array();
		$filter['where'] = 'user_id = '.$id;
	
		$sql->addFilter($filter);
	
		$sql->addData($data);
		
		return $db->execute($sql);
	}
	
	public function delete($id) {
		$db = new DataBase(new MySql());
		$sql = new Sql();
	
		$data = $db->cleanString($id);
	
		$sql->addAction('Delete');
		$sql->addTable(' users ');
	
		$filter = array();
		$filter['where'] = 'user_id = '.$id;
	
		$sql->addFilter($filter);
	
		return $db->execute($sql);
	}
	
}

?>