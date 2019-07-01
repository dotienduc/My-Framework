<?php 

namespace App\core;

class App
{
	private static $instance = NULL;
	private $router;

	function __construct($config)
	{

		$this->router = new Router($config['basePath']);

		Registry::getInstance()->config = $config;
	}

	public function run()
	{
		$this->router->run();
	}
}

?>