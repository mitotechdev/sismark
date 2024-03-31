<?php

namespace App\Models\Inventory;

use App\Models\Sales\SalesOrderItem;
use App\Models\Transaction\QuotationItem;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Product extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $tables = 'products';

    public function quotation_item(): HasOne
    {
        return $this->hasOne(QuotationItem::class, 'product_id');
    }

    public function sales_order_item(): BelongsTo
    {
        return $this->belongsTo(SalesOrderItem::class);
    }

}
