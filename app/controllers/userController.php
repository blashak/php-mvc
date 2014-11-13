<?php

class userController
{
	private static $action;
	private static $user;
	private static $collUsers;
	
	
	function userController() {
		
		if(isset($_GET['action']) && $_GET['action'] != '') {
			$this->setAction($_GET['action']);
		} elseif(isset($_POST['action']) && $_POST['action'] != '') {
			$this->setAction($_POST['action']);
		}
		
		(isset(self::$action)) ? $this->processingAction() : $this->byDefault();
	}
	
	private function byDefault() {
		if (isset($_GET['id']) && $_GET['id'] !== '') {
			
			$filter = array();
			$filter['where'] = 'users.user_id = '.$_GET['id'];
			
			$this->setUser(User::get($filter));
		}
	}
	
	private function processingAction() {
		
		$error = false;
		
		switch(self::getAction()) {
			
			case 'get':
				
				$filter = array();
				$filter['limit'] = '7';
				
				$this->setCollUsers(User::get($filter));
				
				include CURRENT_PATH.'/app/views/lists/users.php';
				
				break;
			case 'getMore':
				
				$filter = array();
				if(isset($_POST['nRegistre'])): $filter['limit'] = $_POST['nRegistre'].' , 7'; else: $filter['limit'] = ''; endif;
				
				if($filter['limit'] != '') {
					$this->setCollUsers(User::get($filter));
					include CURRENT_PATH.'/app/views/lists/users.php';
				}
				
				break;
				
			case 'save':
				
				try {
					
					$data = array();
					if (!isset($_POST['name']) || $_POST['name'] === '') $error = true; else $data['name'] = $_POST['name'];
					
					if($error) throw new Exception('Error saving');
					
					$user = new User($data);
					$user->save();
					
					if ($user->getId() === '') throw new Exception('Error saving');
						
					header('Location:'.ABSOLUTE_URL);
					
				} catch (Exception $e) {
					$e->getMessage();
					exit;
				}
				
				break;
				
			case 'update':
				
				try {
					
					if (!isset($_POST['id']) || $_POST['id'] === '') $error = true; else $id = $_POST['id'];
					if (!isset($_POST['name']) || $_POST['name'] === '') $error = true; else $name = $_POST['name'];
					
					if($error) throw new Exception('Error update');

					$filter = array();
					$filter['where'] = 'users.user_id = '.$id;
					
					$user = User::get($filter);
					
					if (count($user) === 0)
						throw new Exception('Error update');
					
					$user[0]->setName($name);
					$result = $user[0]->update();
					
					if (!$result)
						throw new Exception('Error update');
					
					header('Location:'.ABSOLUTE_URL);
					
				} catch (Exception $e) {
					echo $e->getMessage();
					exit;
				}
				
				break;
				
			case 'delete':
				
				try {
						
					if (!isset($_POST['id']) || $_POST['id'] === '') $error = true; else $id = $_POST['id'];
						
					if($error) throw new Exception('Error delete');
				
					$filter = array();
					$filter['where'] = 'users.user_id = '.$id;
						
					$user = User::get($filter);
						
					if (count($user) === 0)
						throw new Exception('Error delete');
						
					$result = $user[0]->delete();
						
					if (!$result)
						throw new Exception('Error delete');
						
				} catch (Exception $e) {
					echo $e->getMessage();
					exit;
				}
				
				break;
				
			default:
				
				try {
					$this->notExistAction();
				} catch (Exception $e) {
					$e->getMessage();
					exit;
				}
				
				break;
		}
	}
	
	private function setAction($action) {
		self::$action = $action;
	}
	
	public static function getAction() {
		return self::$action;
	}
	
	private function setUser($user) {
		self::$user = $user;
	}
	
	public static function getUser() {
		return self::$user;
	}
	
	private function setCollUsers($collUsers) {
		self::$collUsers = $collUsers;
	}
	
	public static function getCollUsers() {
		return self::$collUsers;
	}
	
	
	private function notExistAction() {
		throw new Exception('The action does not exist');
	}
}