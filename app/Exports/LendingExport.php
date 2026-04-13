<?php

namespace App\Exports;

use App\Models\Lending;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class LendingExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize, WithEvents
{
    public function collection()
    {
        return Lending::with('user', 'item')->latest()->get();
    }

    public function headings(): array
    {
        return [
            'ID',
            'User',
            'Item',
            'Total Lent',
            'Lend Date',
            'Return Date',
            'Status',
            'Created At',
        ];
    }

    public function map($lending): array
    {
        return [
            $lending->id,
            $lending->user->name,
            $lending->item->name,
            $lending->total_lent,
            $lending->lend_date ? $lending->lend_date->format('Y-m-d H:i') : '-',
            $lending->return_date ? $lending->return_date->format('Y-m-d H:i') : 'Not returned',
            $lending->returned ? 'Returned' : 'Borrowed',
            $lending->created_at->format('Y-m-d H:i:s'),
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();
                
                // Insert a new row at the top
                $sheet->insertNewRowBefore(1, 2);
                
                // Set the title
                $sheet->setCellValue('A1', 'Judul Peminjaman/Pengembalian barang');
                
                // Merge cells for the title
                $sheet->mergeCells('A1:H1');
                
                // Style the title
                $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(14);
                $sheet->getStyle('A1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            },
        ];
    }
}