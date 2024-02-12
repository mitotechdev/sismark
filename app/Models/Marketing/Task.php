<?php

namespace App\Models\Marketing;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Task extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $tables = 'tasks';

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }
}
