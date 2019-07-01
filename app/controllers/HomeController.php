<?php 
namespace App\controllers;

// require "../config/bootstrap.php";

use App\core\Controller;
use App\core\App;

class HomeController extends Controller
{
	function __construct()
	{
	}

	public function index($id)
	{
		// $user = \User::Create([    'name' => "Kshiitj Soni",    'email' => "kshitij206@gmail.com",    'password' => password_hash("1234",PASSWORD_BCRYPT), ]);

		// print_r($user->todo()->create([

		// 	'todo' => "Working with Eloquent Without PHP",

		// 	'category' => "eloquent",

		// 	'description' => "Testing the work using eloquent without laravel"

		// ]));

		// $product = \Product::where('price', $id)->get();
		// echo $product;
	}
}
?>