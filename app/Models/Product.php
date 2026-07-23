<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //
    protected $fillable = ["category_id", "supplier_id", "product_code", "product_name", "purchase_price", "selling_price", "stock", "image", "status"];
}
