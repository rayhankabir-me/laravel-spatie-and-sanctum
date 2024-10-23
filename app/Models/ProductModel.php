<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductModel extends Model
{
    use HasFactory;

    protected $table = 'products'; // Assuming you will have a 'products' table later
    protected $fillable = ['name', 'category_id', 'status', 'price'];
}
