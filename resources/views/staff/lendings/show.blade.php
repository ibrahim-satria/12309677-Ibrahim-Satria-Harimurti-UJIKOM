@extends('layouts.dashboard')

@section('title', 'Lending Details')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="mb-4">
            <a href="{{ route('staff.lendings.index') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left me-2"></i>Back
            </a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <h5 class="card-title mb-4">Lending #{{ $lending->id }}</h5>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <p class="text-muted mb-1">User</p>
                        <p class="fw-bold">{{ $lending->user->name }}</p>
                    </div>
                    <div class="col-md-6">
                        <p class="text-muted mb-1">Item</p>
                        <p class="fw-bold">{{ $lending->item->name }}</p>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <p class="text-muted mb-1">Total Lent</p>
                        <p class="fw-bold">{{ $lending->total_lent }}</p>
                    </div>
                    <div class="col-md-6">
                        <p class="text-muted mb-1">Status</p>
                        <p>
                            @if($lending->returned)
                                <span class="badge bg-success">Returned</span>
                            @else
                                <span class="badge bg-warning">Borrowed</span>
                            @endif
                        </p>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <p class="text-muted mb-1">Lend Date</p>
                        <p class="fw-bold">{{ $lending->lend_date->format('d M Y') }}</p>
                    </div>
                    <div class="col-md-6">
                        <p class="text-muted mb-1">Return Date</p>
                        <p class="fw-bold">{{ $lending->return_date ? $lending->return_date->format('d M Y') : '-' }}</p>
                    </div>
                </div>

                <div class="d-flex gap-2">
                    @if(!$lending->returned)
                        <form action="{{ route('staff.lendings.return', $lending) }}" method="POST" class="d-inline">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="btn btn-success">
                                <i class="bi bi-check me-2"></i>Mark as Returned
                            </button>
                        </form>
                    @endif
                    <form action="{{ route('staff.lendings.destroy', $lending) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">
                            <i class="bi bi-trash me-2"></i>Delete
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection