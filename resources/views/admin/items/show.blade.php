@extends('layouts.dashboard')

@section('title', 'Item Details')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="mb-0">Item: {{ $item->name }}</h2>
            <a href="{{ route('admin.items.index') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left me-2"></i>Back to Items
            </a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-4">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <h5>Item Information</h5>
                <p><strong>Name:</strong> {{ $item->name }}</p>
                <p><strong>Category:</strong> {{ $item->category->name ?? 'N/A' }}</p>
                <p><strong>Total:</strong> {{ $item->total }}</p>
                <p><strong>Damaged:</strong> {{ $item->repair }}</p>
                <p><strong>Stock:</strong> {{ $item->total - $item->repair - $lendings->where('returned', false)->sum('total_lent') }}</p>
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <h5>Lending History</h5>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="table-light">
                            <tr>
                                <th>User</th>
                                <th>Quantity Lent</th>
                                <th>Return Date</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($lendings as $lending)
                                <tr>
                                    <td>{{ $lending->user->name ?? 'N/A' }}</td>
                                    <td>{{ $lending->total_lent }}</td>
                                    <td>{{ $lending->return_date ? $lending->return_date->format('d M Y') : 'N/A' }}</td>
                                    <td>
                                        @if($lending->returned)
                                            <span class="badge bg-success">Returned</span>
                                        @else
                                            <span class="badge bg-warning">Borrowed</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center text-muted">No lending records.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="card border-0 shadow-sm mt-3">
            <div class="card-body">
                <h5>Add Damaged Items</h5>
                <form action="{{ route('admin.items.add-damaged', $item) }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="additional_damaged" class="form-label">Additional Damaged Quantity</label>
                        <input type="number" name="additional_damaged" id="additional_damaged" class="form-control" min="0" required>
                    </div>
                    <button type="submit" class="btn btn-danger">Add Damaged</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection