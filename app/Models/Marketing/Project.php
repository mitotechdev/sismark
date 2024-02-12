<?php

namespace App\Models\Marketing;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Project extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $tables = 'projects';

    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class, 'project_id');
    }
}
