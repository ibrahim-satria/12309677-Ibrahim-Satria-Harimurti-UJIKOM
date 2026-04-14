<?php

namespace App\Http\Controllers;

use App\Exports\LendingExport;
use App\Models\Item;
use App\Models\Lending;
use App\Models\User;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class LendingController extends Controller
{
    public function index()
    {
        $lendings = Lending::with(['item', 'user'])->latest()->get();

        return view('staff.lendings.index', compact('lendings'));
    }

    public function create()
    {
        $users = User::all();
        $items = Item::all();

        return view('staff.lendings.create', compact('users', 'items'));
    }

    public function store(Request $request)
    {
        $validate = $request->validate([
            'user_id' => 'required|exists:users,id',
            'item_id' => 'required|exists:items,id',
            'total_lent' => 'required|integer|min:1',
        ]);

        $validate['lend_date'] = now();

        Lending::create($validate);

        return redirect()->route('staff.lendings.index')
            ->with('success', 'Lending created successfully.');
    }

    public function show(Lending $lending)
    {
        return view('staff.lendings.show', compact('lending'));
    }

    public function destroy(Lending $lending)
    {
        $lending->delete();

        return redirect()->route('staff.lendings.index')
            ->with('success', 'Lending deleted successfully.');
    }

    public function markReturned(Lending $lending)
    {
        $lending->update([
            'returned' => true,
            'return_date' => now(),
        ]);

        return redirect()->route('staff.lendings.index')
            ->with('success', 'Lending marked as returned.');
    }

    public function exportExcel()
    {
        return Excel::download(new LendingExport, 'lendings_' . now()->format('Y-m-d_H-i-s') . '.xlsx');
    }
}
