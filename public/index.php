<?php 
require_once __DIR__ . '../../vendor/autoload.php';
$config = require_once(dirname(__FILE__).'/../config/main.php');

use App\core\App;


$ob = new App($config);
$ob->run();

?>