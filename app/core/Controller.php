<?php 
namespace App\core;

use Jenssegers\Blade\Blade;


class Controller
{
	public function redirect($url, $isEnd = true, $responseCode = 302)
	{
		header('location: '.$url, true, $responseCode);
		if( $isEnd )
			die();
	}

	public function render($view, $data = [])
	{
		$controller = Registry::getInstance()->controller;
		$folderView = strtolower(str_replace('Controller', '', $controller));

		$rootDir    = Registry::getInstance()->config['rootDir'];

		$viewPath   = $rootDir.'/app/view/'.$folderView.'';

		$cacheView   = $rootDir.'/storage/view';

		$blade = new Blade($viewPath, $cacheView);

		echo $blade->make('index', $data);
	}
}

?>