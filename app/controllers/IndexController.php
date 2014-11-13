<?php

class IndexController
{
	private static $action;
	
	function IndexController() {
		
		if(isset($_GET['action']) && $_GET['action'] != '') {
			$this->setAction($_GET['action']);
		} elseif(isset($_POST['action']) && $_POST['action'] != '') {
			$this->setAction($_POST['action']);
		}
		
		(isset(self::$action)) ? $this->processingAction() : $this->byDefault();
	}
	
	private function byDefault() { }
	
	private function processingAction($action) {
		
		switch($action) {
			
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
	
	private function notExistAction() {
		throw new Exception('The action does not exist');
	}
}