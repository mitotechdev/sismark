<?php

namespace App\Models\Partner;

use App\Models\UserManagement\SalesUser;
use App\Models\Backend\Branch;
use App\Models\Sales\SalesOrder;
use App\Models\Transaction\Invoice;
use App\Models\Transaction\PoInternal;
use App\Models\Transaction\Sppb;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Customer extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $tables = 'customers';
    protected $casts = [
        'foundation_date' => 'datetime'
    ];

    public function branch(): HasOne
    {
        return $this->hasOne(Branch::class, 'id', 'branch_id');
    }
    
    public function sales_user(): BelongsTo
    {
        return $this->belongsTo(SalesUser::class);
    }

    public function po_internal(): HasMany
    {
        return $this->hasMany(PoInternal::class, 'customer_id');
    }

    public function sppb(): HasMany
    {
        return $this->hasMany(Sppb::class, 'customer_id');
    }

    public function invoice(): HasMany
    {
        return $this->hasMany(Invoice::class, 'customer_id');
    }

    public function customer_personalia(): HasMany
    {
        return $this->hasMany(CustomerPersonalia::class, 'customer_id');
    }

    public function customer_branch(): HasMany
    {
        return $this->hasMany(CustomerBranch::class, 'customer_id');
    }

    public function sales_order(): BelongsTo
    {
        return $this->belongsTo(SalesOrder::class);
    }


}
