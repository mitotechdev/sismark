<?php

namespace App\Models\Sales;

use App\Models\Inventory\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class SalesOrderItem extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $tables ='sales_order_items';

    public function sales_order(): BelongsTo
    {
        return $this->belongsTo(SalesOrder::class, 'sales_order_item_id');
    }

    public function product(): HasOne
    {
        return $this->hasOne(Product::class, 'id', 'product_id');
    }
}
