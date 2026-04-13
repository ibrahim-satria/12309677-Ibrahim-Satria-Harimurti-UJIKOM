@extends('layouts.dashboard')

@section('title', 'Lendings')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="mb-0">Lendings</h2>
                <div>
                    <a href="{{ route('staff.lendings.export_excel') }}" class="btn btn-success me-2">
                        <i class="bi bi-file-earmark-spreadsheet me-2"></i>Export Excel
                    </a>
                    <a href="{{ route('staff.lendings.create') }}" class="btn btn-primary">
                        <i class="bi bi-plus-circle me-2"></i>Add Lending
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th>ID</th>
                                    <th>User</th>
                                    <th>Item</th>
                                    <th>Total Lent</th>
                                    <th>Lend Date</th>
                                    <th>Return Date</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($lendings as $lending)
                                    <tr>
                                        <td>{{ $lending->id }}</td>
                                        <td>{{ $lending->user->name }}</td>
                                        <td>{{ $lending->item->name }}</td>
                                        <td>{{ $lending->total_lent }}</td>
                                        <td>
                                            {{ $lending->lend_date ? \Carbon\Carbon::parse($lending->lend_date)->format('d M Y H:i') : '-' }}
                                        </td>

                                        <td>
                                            {{ $lending->return_date ? \Carbon\Carbon::parse($lending->return_date)->format('d M Y') : '-' }}
                                        </td>
                                        <td>
                                            @if ($lending->returned)
                                                <span class="badge bg-success">Returned</span>
                                            @else
                                                <span class="badge bg-warning">Borrowed</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('staff.lendings.show', $lending) }}"
                                                    class="btn btn-sm btn-outline-info">
                                                    <i class="bi bi-eye"></i>
                                                </a>
                                                @if (!$lending->returned)
                                                    <form action="{{ route('staff.lendings.return', $lending) }}"
                                                        method="POST" class="d-inline">
                                                        @csrf
                                                        @method('PATCH')
                                                        <button type="submit" class="btn btn-sm btn-outline-success">
                                                            <i class="bi bi-check"></i>
                                                        </button>
                                                    </form>
                                                @endif
                                                <form action="{{ route('staff.lendings.destroy', $lending) }}"
                                                    method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-outline-danger"
                                                        onclick="return confirm('Are you sure?')">
                                                        <i class="bi bi-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center text-muted">No lendings found.</td>
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
