<?php  

use Illuminate\Database\Eloquent\Model as Eloquent;

class Product extends Eloquent
{
	protected $fillable = ["id", "product", "price"];
}