<?php

namespace App\Models\Transaction;

use App\Models\Backend\Branch;
use App\Models\Marketing\Project;
use App\Models\TaskManagement\Activity;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Quotation extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    // protected $tables = 'quotations';

    public function activities(): HasOne
    {
        return $this->hasOne(Activity::class, 'id', 'activity_id');
    }

    public function branch(): HasOne
    {
        return $this->hasOne(Branch::class,'id', 'branch_id');
    }
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function quotation_items(): HasMany
    {
        return $this->hasMany(QuotationItem::class, 'quotation_id');
    }

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

}
