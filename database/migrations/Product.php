<?php 

require_once __DIR__ . '../../../vendor/autoload.php';

use Illuminate\Database\Capsule\Manager as Capsule;

Capsule::schema()->create('products', function($table){

	$table->increments('id');

	$table->string('product');

	$table->float('price');
});