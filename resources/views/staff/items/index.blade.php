@extends('layouts.dashboard')

@section('title', 'Items')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="mb-0">Items</h2>
            <div>
                <a href="{{ route('staff.items.export_excel') }}" class="btn btn-success">
                    <i class="bi bi-file-earmark-spreadsheet me-2"></i>Export Excel
                </a>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="table-light">
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Category</th>
                                <th>Total</th>
                                <th>Damaged</th>
                                <th>Stock</th>
                                <th>Borrowed</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($items as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->category->name ?? 'N/A' }}</td>
                                    <td>{{ $item->total }}</td>
                                    <td>{{ $item->repair }}</td>
                                    <td>{{ $item->stock }}</td>
                                    <td>{{ $item->borrowed_count }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center text-muted">No items found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
