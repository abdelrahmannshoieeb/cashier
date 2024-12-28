<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    
    protected $guarded = [];

    public function getBuyingPriceAttribute()
    {
        return $this->attributes['buying price'];
    }

    public function setBuyingPriceAttribute($value)
    {
        $this->attributes['buying price'] = $value;
    }
    

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function invoice_items()
    {
        return $this->hasMany(Invoice_item::class);
    }

    public function stock(){
        return $this->hasMany(Stock::class);
        
    }
}
