<?php

namespace App\Models\Status;

use App\Models\Marketing\Project;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Prospect extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $table = 'prospects';

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }
}
