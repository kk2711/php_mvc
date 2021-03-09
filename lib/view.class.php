<?php
	
	class View {
		
		protected $data;
		
		protected $path;
		
		protected static function getDefaultViewPath() {
			$router = App::getRouter();
			if(!$router){
				return false;
			}
			$controller_dir = $router->getController();
			$tamplate_name = $router->getMethodPrefix().$router->getAction().'.html';
			//print_r($router->getController());
			//print_r($router->getMethodPrefix().$router->getAction());
			//print_r(VIEWS_PATH.DS.$controller_dir.DS.$tamplate_name);
			return VIEWS_PATH.DS.$controller_dir.DS.$tamplate_name;
		}
		
		public function __construct($data = array(), $path = null) {
			
			if(!$path) {
				
				$path = self::getDefaultViewPath();
				//var_dump(self::getDefaultViewPath());
				
			}
			
			if(!file_exists($path)) {
				throw new Exception('Template file is not found in path: '.$path);
			}
			$this->path = $path;
			$this->data = $data;
		}
		
		public function render() {
			
			$data = $this->data;
			
			ob_start();
			include($this->path);
			//print_r("<br/>");
			//print_r($this->path);
			$content = ob_get_clean();
			  
			return $content;
		}
		
	}