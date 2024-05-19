<?php

namespace App\Models\Customer;

use App\Models\Backend\Branch;
use App\Models\Marketing\Project;
use App\Models\Marketing\Task;
use App\Models\Sales\SalesOrder;
use App\Models\Status\TypeCustomer;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Customer extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $casts = [
        'foundation_date' => 'datetime',
    ];

    public function type_customer(): BelongsTo
    {
        return $this->belongsTo(TypeCustomer::class, 'type_customer_id', 'id');
    }

    public function projects(): HasMany
    {
        return $this->hasMany(Project::class, 'customer_id', 'id');
    }

    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class, 'customer_id', 'id');
    }

    public function branch(): BelongsTo
    {
        return $this->belongsTo(Branch::class, 'branch_id', 'id');
    }
    
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function personalia(): HasMany
    {
        return $this->hasMany(Personalia::class, 'customer_id', 'id')->latest();
    }

    public function customer_branch(): HasMany
    {
        return $this->hasMany(CustomerBranch::class, 'customer_id', 'id');
    }

    public function sales_order(): HasMany
    {
        return $this->hasMany(SalesOrder::class, 'customer_id', 'id');
    }


}
