<?php

namespace App\Exports;

use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithMapping;
use Illuminate\Database\Eloquent\Collection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class TasksExport implements FromCollection, WithMapping, WithHeadings, ShouldAutoSize, WithColumnWidths, WithStyles
{
    use Exportable;

    protected $data;
    private $index = 1;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function headings(): array
    {
        return [
            'NO',
            'START DATE',
            'END DATE',
            'CUSTOMER',
            'MARKET PROGRESS',
            'NAME TASK',
            'DESCRIPTION',
            'STATUS',
        ];

    }

    public function map($data): array
    {
        return [
            $this->index++,
            Carbon::parse($data->start_date)->format('d/m/Y'),
            Carbon::parse($data->due_date)->format('d/m/Y'),
            $data->customer->name_customer,
            $data->market_progress->name,
            $data->name_task,
            $data->desc_task,
            $data->status_task == 0 ? "Progress" : "Done",
        ];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 5,
            'G' => 80,
            'H' => 10,            
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->getStyle('A1:A1000')->applyFromArray(
            [
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_CENTER,
                    'vertical' => Alignment::VERTICAL_TOP,
                ]
            ]
        );
        $sheet->getStyle('B1:B1000')->applyFromArray(
            [
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_CENTER,
                    'vertical' => Alignment::VERTICAL_TOP,
                ]
            ]
        );
        $sheet->getStyle('C1:C1000')->applyFromArray(
            [
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_CENTER,
                    'vertical' => Alignment::VERTICAL_TOP,
                ]
            ]
        );
        $sheet->getStyle('D1:D1000')->applyFromArray(
            [
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_LEFT,
                    'vertical' => Alignment::VERTICAL_TOP,
                ]
            ]
        );
        $sheet->getStyle('E1:E1000')->applyFromArray(
            [
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_LEFT,
                    'vertical' => Alignment::VERTICAL_TOP,
                ]
            ]
        );
        $sheet->getStyle('F1:F1000')->applyFromArray(
            [
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_LEFT,
                    'vertical' => Alignment::VERTICAL_TOP,
                ]
            ]
        );
        $sheet->getStyle('A1:H1')->applyFromArray(
            [
                'font' => [
                    'bold' => true,
                ],
            ]
        );
        $sheet->getStyle('G2:G500')->applyFromArray(
            [
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_JUSTIFY,
                    'vertical' => Alignment::VERTICAL_CENTER,
                    'wrapText' => true,
                ],
            ]
        );
    }

    public function collection()
    {
        return new Collection($this->data);
    }
}
