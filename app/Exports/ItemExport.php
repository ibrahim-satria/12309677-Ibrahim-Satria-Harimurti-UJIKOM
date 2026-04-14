<?php

namespace App\Exports;

use App\Models\Item;
use App\Models\Lending;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class ItemExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize, WithEvents
{
    public function collection()
    {
        return Item::with('category')->latest()->get();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Name',
            'Category',
            'Total',
            'Damaged',
            'Stock',
            'Borrowed',
            'Created At',
            'Updated At',
        ];
    }

    public function map($item): array
    {
        $borrowed = Lending::where('item_id', $item->id)
            ->where('returned', false)
            ->sum('total_lent');

        return [
            $item->id,
            $item->name,
            $item->category->name ?? 'N/A',
            $item->total,
            $item->repair,
            $item->total - $item->repair - $borrowed,
            $borrowed,
            $item->created_at->format('Y-m-d H:i:s'),
            $item->updated_at->format('Y-m-d H:i:s'),
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();

                // Insert a new row at the top
                $sheet->insertNewRowBefore(1, 2);

                // Set the title with current time
                $currentDate = now()->format('d M Y H:i:s');
                $sheet->setCellValue('A1', "Data Inventaris Barang (Dibuat pada: $currentDate)");

                // Merge cells for the title
                $sheet->mergeCells('A1:I1');

                // Style the title
                $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(14);
                $sheet->getStyle('A1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            },
        ];
    }
}
