<?php

namespace App\Models\Finance;

use App\Models\Sales\SalesOrder;
use App\Models\Transaction\Quotation;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Payment extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function quotation(): HasOne
    {
        return $this->hasOne(Quotation::class, 'payment_id', 'id');
    }

    public function sales_order(): HasOne
    {
        return $this->hasOne(SalesOrder::class, 'payment_id', 'id');
    }
}
