<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    
        protected $fillable = [
        'user_id',
        'condition_id',
        'img_url',
        'name',
        'price',
        'brand_name',
        'description',

    ];

        public function isSold()
    {
        return $this->soldProduct()->exists();
    }

    public function soldProduct()
    {
        return $this->hasOne(SoldProduct::class);
    }
        public function user()
    {
        return $this->belongsTo(User::class);
    }

    // 商品の状態（コンディション）
    public function condition()
    {
        return $this->belongsTo(Condition::class);
    }

    // 商品のカテゴリー（多対多）
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_products', 'product_id', 'category_id');

    }

    // コメント（1対多）
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    // いいねしたユーザー（多対多）
    public function likes()
    {
        return $this->belongsToMany(User::class, 'likes');
    }

    // 売却履歴（1対1または1対多）
    public function soldproducts()
    {
        return $this->hasOne(SoldItem::class);
    }
}

