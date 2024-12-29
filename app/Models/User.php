<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
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
        'phone',
        'is_active',
        'box_access',
        'edit_invoices_access',
        'role',
        'shop_id',
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
        'password' => 'hashed',
    ];


    public function products()
    {
        return $this->hasMany(Product::class);
    }
    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }
    public function categories()
    {
        return $this->hasMany(Category::class);
    }

    public function boxesOperations()
    {
        return $this->hasMany(BoxOperation::class);
    }

    public function expenses()
    {
        return $this->hasMany(Expense::class);
    }
    public function invoice()
    {
        return $this->hasMany(Invoice::class);
    }

 
}
