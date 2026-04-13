@extends('layouts.dashboard')

@section('title', 'Create Item')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="mb-0">Create Item</h2>
            <a href="{{ route('admin.items.index') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left me-2"></i>Back to Items
            </a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <form action="{{ route('admin.items.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="category_id" class="form-label">Category</label>
                        <select name="category_id" id="category_id" class="form-select" required>
                            <option value="">Select Category</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label">Item Name</label>
                        <input type="text" name="name" id="name" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="total" class="form-label">Total Quantity</label>
                        <input type="number" name="total" id="total" class="form-control" min="0" required>
                    </div>
                    <div class="mb-3">
                        <label for="repair" class="form-label">Damaged Quantity</label>
                        <input type="number" name="repair" id="repair" class="form-control" min="0" value="0" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Create Item</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection