<?php

namespace App\Exports;

use App\Models\Item;
use App\Models\Lending;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ItemExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize
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
}
