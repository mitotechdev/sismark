<?php

namespace App\Models\Transaction;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Finance\Tax;
use App\Models\Backend\Branch;
use App\Models\Finance\Payment;
use App\Models\Status\Approval;
use App\Models\Marketing\Project;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Quotation extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($quotation) {
            $quotation->generateCode();
        });
    }

    // Generate code based on requirements
    protected function generateCode()
    {
        $lastQuotation = static::latest()->first(); // Get the latest quotation

        // Extract the month and year from the current date
        $currentMonth = now()->format('m');
        $currentYear = now()->format('y');

        // Convert the month to Roman numeral
        $romanMonth = $this->toRoman($currentMonth);

        // Generate the code format
        $code = sprintf('%03d', $lastQuotation ? ($lastQuotation->id + 1) : 1) . '/SPH/MITO/' . $romanMonth . '/' . $currentYear;

        // Assign the generated code to the 'code' attribute
        $this->code = $code;
    }

    // Function to convert month to Roman numeral
    protected function toRoman($number)
    {
        // Define the Roman numeral equivalents for each digit
        $map = [
            'M' => 1000, 'CM' => 900, 'D' => 500, 'CD' => 400,
            'C' => 100, 'XC' => 90, 'L' => 50, 'XL' => 40,
            'X' => 10, 'IX' => 9, 'V' => 5, 'IV' => 4, 'I' => 1
        ];

        $result = '';
        foreach ($map as $roman => $value) {
            // Repeat the Roman numeral while the value is less than the number
            while ($number >= $value) {
                $result .= $roman;
                $number -= $value;
            }
        }
        return $result;
    }

    public function branch(): BelongsTo
    {
        return $this->belongsTo(Branch::class, 'branch_id', 'id');
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
    
    public function approval(): BelongsTo
    {
        return $this->belongsTo(Approval::class, 'approval_id', 'id');
    }



}
