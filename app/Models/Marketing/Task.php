<?php

namespace App\Models\Marketing;

use App\Models\Status\MarketProgress;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Task extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $tables = 'tasks';

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    public function market_progress(): HasOne
    {
        return $this->hasOne(MarketProgress::class, 'id', 'market_progress_id');
    }
}
