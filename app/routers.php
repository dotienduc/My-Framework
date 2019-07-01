<?php 

use App\core\Controller;
use \App\core\Router;
	
Router::get('/', function(){
	echo "OK 2";
});

Router::get('/home/{id}', 'HomeController@index');

Router::get('/test', function(){
	$t = new Controller;
	$t->render('index');
});

