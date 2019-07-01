<?php 

namespace App\core;


class Router
{

	private static $routers = [];

	private $basePath;

	public function __construct($basePath)
	{
		$this->basePath = $basePath;
	}

	private function getRequestURI()
	{
		$url = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : '/';
		$url = str_replace($this->basePath, "", $url);
		$url = $url === '' || empty($url) ? '/' : $url; 

		return $url;
	}

	private function getRequestMethod()
	{

		$method = isset($_SERVER['REQUEST_METHOD']) ? $_SERVER['REQUEST_METHOD'] : "GET";

		return $method;
	}

	private static function addRoute($method, $url, $action)
	{
		self::$routers[] = [$method, $url, $action];
	}

	public static function get($url, $action)
	{
		self::addRoute('GET', $url, $action);
	}

	public function map()
	{
		$routers = static::$routers;
		$params = [];
		$checkRoute = false;

		$requestURL = $this->getRequestURI();
		$requestMethod = $this->getRequestMethod();

		
		foreach ($routers as $route) {
			list($method, $url, $action) = $route;

			if( strpos($method, $requestMethod) === FALSE )
				continue;

			if($url === '*')
			{
				$checkRoute = true;
			}elseif( strpos($url, '{') === FALSE ){
				if( (strcmp(strtolower($url), strtolower($requestURL)) === 0 ) )
				{
					$checkRoute = true;
				}else{
					continue;
				}
			}elseif( strpos($url, '}') === FALSE )
			{
				continue;
			}else{
				$routeParams   = explode('/', $url);
				$requestParams = explode('/', $requestURL);

				if(count($routeParams) !== count($requestParams)){
					continue;
				}

				foreach ($routeParams as $k => $rp) {
					if( preg_match('/^{\w+}$/',$rp) ){
						$params[] = $requestParams[$k];
					}
				}

				$checkRoute = true;
			}

			if( $checkRoute === true )
			{
				if(is_callable($action))
				{
					call_user_func_array($action, $params);
				}else if( is_string($action) )
				{
					$this->compleRoute($action, $params);
				}
				return;
			}
		}
		return;
	}

	private function compleRoute($action, $params)
	{

		if( count(explode('@', $action)) !== 2 ) {
			throw new AppException('Router error');
		}

		$className  = explode('@', $action)[0];
		$methodName = explode('@', $action)[1];

		$classNamespace = 'App\\controllers\\'.$className;

		if( class_exists('App\\controllers\\'.$className) )
		{
			Registry::getInstance()->controller = $className;
			$object = new $classNamespace;

			if( method_exists($classNamespace, $methodName) )
			{
				Registry::getInstance()->method = $methodName;
				call_user_func_array([$object, $methodName], $params);
			}else
			{
				throw new AppException("Method ". $methodName . "() not found");			}
		}else{
			throw new AppException("Class ".$classNamespace." not found");
		}
	}

	public function run()
	{
		$this->map();
	}
}
?>