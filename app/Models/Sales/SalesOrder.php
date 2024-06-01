<?php

namespace App\Models\Sales;

use App\Models\User;
use App\Models\Finance\Tax;
use App\Models\Backend\Branch;
use App\Models\Finance\Payment;
use App\Models\Status\Approval;
use App\Models\Customer\Customer;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SalesOrder extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $casts = [
        'order_date' => 'datetime'
    ];

    public function paid()
    {
        $this->update([
            'paid' => true,
        ]);
    }
    
    public function sales_order_items(): HasMany
    {
        return $this->hasMany(SalesOrderItem::class, 'sales_order_id');
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'id');
    }

    public function sales(): BelongsTo
    {
        return $this->belongsTo(User::class, 'sales_id', 'id');
    }

    public function tax(): BelongsTo
    {
        return $this->belongsTo(Tax::class, 'tax_id', 'id');
    }
    
    public function approval(): BelongsTo
    {
        return $this->belongsTo(Approval::class, 'approval_id', 'id');
    }

    public function branch(): BelongsTo
    {
        return $this->belongsTo(Branch::class, 'branch_id', 'id');
    }

    public function scopeTotalRevenueByStatusSalesOrder($query, $status)
    {
        return $query->with('customer', 'sales_order_items', 'tax')
                     ->whereHas('approval', function($query) {
                        $query->where('tag_status', '<>', 'rej');
                     })
                     ->where('branch_id', Auth::user()->branch_id)
                     ->where(DB::raw("DATE_FORMAT(order_date, '%Y')"), date('Y'))
                     ->where('paid', $status)
                     ->latest();
    }

    public static function calculateTotalRevenueByStatus($status)
    {
        return self::totalRevenueByStatusSalesOrder($status)->get()->reduce(function ($carry, $bill) {
            $total = $bill->sales_order_items->sum('total_amount');
            $ppn = $total * ($bill->tax->tax_value);
            return $carry + $total + $ppn;
        }, 0);
    }

}

