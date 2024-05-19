<?php

namespace App\Models\Backend;

use App\Models\Customer\Customer;
use App\Models\Marketing\Project;
use App\Models\Sales\SalesOrder;
use App\Models\Transaction\InvoiceToSppb;
use App\Models\Transaction\Quotation;
use App\Models\Transaction\Sppb;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Branch extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $tables = 'branches';

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function quotation(): HasOne
    {
        return $this->hasOne(Quotation::class, 'branch_id', 'id');
    }

    public function project(): HasOne
    {
        return $this->hasOne(Project::class, 'branch_id', 'id');
    }

    public function customer(): HasOne
    {
        return $this->hasOne(Customer::class, 'branch_id', 'id');
    }

    public function sales_order(): HasOne
    {
        return $this->hasOne(SalesOrder::class, 'branch_id', 'id');
    }
}
