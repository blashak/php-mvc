<?php

class Router
{
	public function Router() {
		$this->processingPage();
	}
	
	private function processingPage() {	
		
		switch(CURRENT_PAGE) {
			
			case 'index':
				$indexController = new IndexController();
				break;
			
			case 'user':
				$userController = new userController();
				break;
			
			default:
				$this->notExistPage();
				break;
				
		}
		
	}
	
	private function notExistPage() {
		header('Location:'.ABSOLUTE_URL);
	}
}

?>