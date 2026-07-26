<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    //
    protected $fillable = [
        "supplier_name",
        "email",
        "mobile",
        "address",
        "gst_number",
        "status"
    ];
}
