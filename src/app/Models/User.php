<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

        // プロフィール（1対1）
    public function profile()
    {
        return $this->hasOne(Profile::class);
    }

    // 出品した商品（1対多）
    public function products()
    {
        return $this->hasMany(Product::class);
    }

    // 購入した商品（1対多）
    public function soldItems()
    {
        return $this->hasMany(SoldItem::class);
    }

    // コメント（1対多）
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    // いいねした商品（多対多）
    public function likes()
    {
        return $this->belongsToMany(Product::class, 'likes');
    }
}
