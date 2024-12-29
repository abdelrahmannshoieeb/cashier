<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $guarded = [];
    public function items()
    {
        return $this->hasMany(Invoice_item::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }


    public function refundsInitiated()
    {
        return $this->has(Refunded::class, 'current_invoice_id');
    }


    public function refundsReceived()
    {
        return $this->hasMany(Refunded::class, 'refunded_invoice_id');
    }
}
