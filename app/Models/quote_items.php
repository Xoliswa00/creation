<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class quote_items extends Model
{
    /** @use HasFactory<\Database\Factories\QuoteItemsFactory> */
    use HasFactory;
    protected $fillable = [
        'quote_id',
        'product_id',
        'quantity',
        'unit_price',
        'vat_amount',
        'total',
    ];
    public function quote()
    {
        return $this->belongsTo(Quote::class);
    }
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    
}
