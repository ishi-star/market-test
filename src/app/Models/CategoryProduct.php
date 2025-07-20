<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// 中間テーブルのモデルです
// class CategoryProduct extends Model
// {
//     use HasFactory;
// }
class CategoryProduct extends Pivot
{
    protected $table = 'category_products';

    protected $fillable = ['product_id', 'category_id'];
}