<?php

namespace App\Models\Marketing;

use App\Models\Status\MarketProgress;
use App\Models\Status\Prospect;
use App\Models\Transaction\Quotation;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Project extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $tables = 'projects';

    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class, 'project_id');
    }

    public function quotations(): HasMany
    {
        return $this->hasMany(Quotation::class, 'project_id');
    }

    public function prospect(): HasOne
    {
        return $this->hasOne(Prospect::class, 'id', 'prospect_id');
    }

    public function market_progress(): HasOne
    {
        return $this->hasOne(MarketProgress::class, 'id', 'market_progress_id');
    }
}
