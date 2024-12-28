<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Refunded extends Model
{
    use HasFactory;

    protected $table = 'refundeds';

    protected $guarded = [];



    public function refundedItems()
    {
        return $this->hasMany(RefundedItem::class);
    }


}
