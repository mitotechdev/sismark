<?php

namespace Tests\Unit;

use Carbon\Carbon;
use Ramsey\Uuid\Uuid;
use PHPUnit\Framework\TestCase;
use Illuminate\Support\Facades\Date;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function test_that_true_is_true(): void
    {
        $this->assertTrue(true);
    }

    public function test_random_number(): void
    {
        // echo (random_int(1000, 9999));
        // $data = random_int(1000,9999) + date(now('Y'));
        $data = date('y') . date('d') . date('m') . random_int(1000, 9999);
        echo ($data);
    }

    public function test_calculate_diff_day(): void
    {
        $tanggalPilihan = \Carbon\Carbon::parse('2024-02-20');
        $currentDate = now();
        $diff = $currentDate->diffInDays($tanggalPilihan);

        echo ($diff);
    }

    public function test_calculate_activities(): void
    {
        function calculateActivities($value) {
            switch ($value) {
                case 'Mapping':
                case 'Introduction':
                case 'Penetration':
                case 'Jartest':
                case 'Quotation':
                    return 'Prospect';
                case 'PO':
                case 'Supply & Maintenance':
                    return 'Hot Prospect';
                default:
                    echo 'Data tidak dikenali';
                    break;
            }
        }

        $sendValue = "Jartest";
        $getValue = calculateActivities($sendValue);
        echo $getValue;
    }
    
}
