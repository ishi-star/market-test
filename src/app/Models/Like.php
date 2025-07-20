<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;



// Laravelでは中間テーブルを直接操作しない場合はモデル不要ですが必要ならこう定義する。
// class Like extends Model
// {
//     use HasFactory;
// }
class Like extends Pivot
{
    protected $table = 'likes';

    protected $fillable = ['user_id', 'product_id'];
}