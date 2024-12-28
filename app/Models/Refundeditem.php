<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Refundeditem extends Model
{
    use HasFactory;

 protected $fillable = ['refunded_id', 'invoice_item_id', 'quantity'];

    public function refunded()
    {
        return $this->belongsTo(Refunded::class);
    }

    public function invoiceItem()
    {
        return $this->belongsTo(Invoice_item::class);
    }


}
