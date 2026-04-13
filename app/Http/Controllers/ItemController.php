<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Category;
use App\Models\Lending;
use App\Exports\ItemExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = Item::with('category')->latest()->get()->map(function ($item) {
            $borrowed = Lending::where('item_id', $item->id)->where('returned', false)->sum('total_lent');
            $item->stock = $item->total - $item->repair - $borrowed;
            $item->borrowed_count = $borrowed;
            return $item;
        });

        return view('admin.items.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.items.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'total' => 'required|integer|min:0',
            'repair' => 'required|integer|min:0',
        ]);

        Item::create($validated);

        return redirect()->route('admin.items.index')->with('success', 'Item created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Item $item)
    {
        $lendings = Lending::where('item_id', $item->id)->with('user')->get();
        return view('admin.items.show', compact('item', 'lendings'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Item $item)
    {
        $categories = Category::all();
        return view('admin.items.edit', compact('item', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Item $item)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'total' => 'required|integer|min:0',
            'repair' => 'required|integer|min:0',
        ]);

        $item->update($validated);

        return redirect()->route('admin.items.index')->with('success', 'Item updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Item $item)
    {
        $item->delete();

        return redirect()->route('admin.items.index')->with('success', 'Item deleted successfully.');
    }

    public function exportExcel()
    {
        return Excel::download(new ItemExport, 'items_' . now()->format('Y-m-d_H-i-s') . '.xlsx');
    }

    public function addDamaged(Request $request, Item $item)
    {
        $validated = $request->validate([
            'additional_damaged' => 'required|integer|min:0',
        ]);

        $item->increment('repair', $validated['additional_damaged']);

        return redirect()->route('admin.items.show', $item)->with('success', 'Damaged count updated successfully.');
    }
}   
