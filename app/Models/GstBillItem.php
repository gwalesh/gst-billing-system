<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GstBillItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'gst_bill_id',
        'description',
        'price',
        'cgst_rate',
        'cgst_amount',
        'sgst_rate',
        'sgst_amount',
        'igst_rate',
        'igst_amount',
        'tax_amount',
        'discount_rate',
        'discount_amount'
    ];

    public function gstBill()
    {
        return $this->belongsTo(GstBill::class, 'gst_bill_id');
    }
}
