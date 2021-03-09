<?php
	
	class Router {
		protected $uri;
		
		protected $controller;
		
		protected $action;
		
		protected $params;
		
		protected $route;
		
		protected $method_prefix;
		
		protected $language;
		
		public function getUri() {
			return $this->uri;
		}
		
		public function getController() {
			
			return $this->controller;
		}
		
		public function getAction() {
			return $this->action;
		}
		
		public function getParams() {
			
			return $this->params;
		}
		
		
		public function getRoute() {
			
			return $this->route;
		}
		
		public function getMethodPrefix() {
			
			return $this->method_prefix;
		}
		
		public function getLangauge() {
			
			return $this->language;
		}
		
		public function  __construct($uri) {
			
			$this->uri = urldecode(trim($uri, '/'));
			//echo "URI Value: ";
			//echo "<pre>"; print_r($this->uri);
			
			// Get defualts
			$routes = Config::get('routes');
			//echo "Config Routes Value: ";
			//echo "<pre>"; print_r($routes);
			$this->route = Config::get('default_route');
			
			$this->method_prefix = isset($routes[$this->route]) ? $routes[$this->route] : '';
			$this->language = Config::get('defualt_language');
			$this->controller = Config::get('defualt_controller');
			$this->action = Config::get('defualt_action');
			
			$uri_parts = explode('?', $this->uri);
			//echo "<pre>"; print_r($uri_parts);
			
			
			// Get path like /lng/controller/action/param1/param2/.../...
			$pat = $uri_parts[0];
			$path = ltrim(substr($pat,7), '/');
		

			//echo "<pre>"; print_r($path);
			
			
			
			$path_parts = explode('/', $path);
			//echo "Path Parts:";
			//echo "<pre>"; print_r($path_parts);
			
			//echo "Router Keys:";
			//echo "<pre>"; print_r(array_keys($routes));
			
			//echo "Current element of path: ";
			//echo "<pre>"; print_r(in_array(strtolower(current($path_parts)), array_keys($routes)));
			//echo "<pre>"; print_r(count($path_parts));
			
		 	if(count($path_parts)) {
			
				//Get route or language at first element
			
				if(in_array(strtolower(current($path_parts)), array_keys($routes))) {
					
					 
					$this->route = strtolower(current($path_parts));
					$this->method_prefix = isset($routes[$this->route]) ? $routes[$this->route] : '';
					array_shift($path_parts);
				}elseif(in_array(strtolower(current($path_parts)), Config::get('languages'))) {
					
					$this->language = strtolower(current($path_parts));
					array_shift($path_parts);
				}
				
				// Get controller - next element of array
				if(current($path_parts)) {
					$this->controller = strtolower(current($path_parts));
					array_shift($path_parts);
					
				}
				
				// Get action
				if(current($path_parts)) {
					$this->action = strtolower(current($path_parts));
					array_shift($path_parts);
					
				}
				
				// Get params - all the rest
				$this->params = $path_parts;
				
			}
			
		}
		
		public static function redirect($location) {
			header("Location: $location"); 
		}
		
		
		
	}
	
	