<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Models\Backend\Branch;
use App\Models\Customer\Customer;
use App\Models\Marketing\Project;
use App\Models\Marketing\Task;
use App\Models\Sales\SalesOrder;
use App\Models\Transaction\Quotation;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = ['id'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function deactivate()
    {
        $this->update([
            'status' => 'inactive',
        ]);
    }

    public function activate()
    {
        $this->update([
            'status' => 'active',
        ]);
    }

    public function branch(): HasOne
    {
        return $this->hasOne(Branch::class, 'id', 'branch_id');
    }

    public function projects(): HasMany
    {
        return $this->hasMany(Project::class);
    }

    public function quotation(): HasMany
    {
        return $this->hasMany(Quotation::class, 'id', 'user_id');
    }

    public function sales_order(): HasMany
    {
        return $this->hasMany(SalesOrder::class, 'sales_id', 'id');
    }

    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class, 'user_id', 'id');
    }

    public function customers(): HasMany
    {
        return $this->hasMany(Customer::class, 'user_id', 'id');
    }
}
