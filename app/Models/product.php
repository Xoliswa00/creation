<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    /** @use HasFactory<\Database\Factories\ProductFactory> */
    use HasFactory;
    protected $fillable = [
        'company_id',
        'name',
        'description',
        'price',
        'billing_type',
        'vat_rate',
    ];
    public function company()
    {
        return $this->belongsTo(Company::class);
    }
      public function quoteItems()
    {
        return $this->hasMany(quote_items::class);
    }

    public function invoiceItems()
    {
        return $this->hasMany(invoice_items::class);
    }
    


}
