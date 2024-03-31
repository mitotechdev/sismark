<?php

namespace App\Models\Status;

use App\Models\Marketing\Project;
use App\Models\Marketing\Task;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MarketProgress extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $table = 'market_progresses';

    public function task(): BelongsTo
    {
        return $this->belongsTo(Task::class);
    }
    
    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }
}
