<?php

namespace App\Models\Sales;

use App\Models\Partner\Customer;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class SalesOrder extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $tables = 'sales_orders';
    protected $casts = [
        'order_date' => 'datetime',
        'term' => 'datetime',
    ];

    public function sales_order_items(): HasMany
    {
        return $this->hasMany(SalesOrderItem::class, 'sales_order_id');
    }

    public function customer(): HasOne
    {
        return $this->hasOne(Customer::class, 'id', 'customer_id');
    }
}

