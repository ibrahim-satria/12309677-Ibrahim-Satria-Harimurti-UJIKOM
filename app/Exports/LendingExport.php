<?php

namespace App\Exports;

use App\Models\Lending;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class LendingExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize
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
            $lending->lend_date->format('Y-m-d'),
            $lending->return_date ? $lending->return_date->format('Y-m-d') : 'Not returned',
            $lending->returned ? 'Returned' : 'Borrowed',
            $lending->created_at->format('Y-m-d H:i:s'),
        ];
    }
}