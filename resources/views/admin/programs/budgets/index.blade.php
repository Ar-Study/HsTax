@extends('layouts.app')
@section('title', 'Anggaran Program: ' . $program->name)
@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h4>Anggaran Program: {{ $program->name }}</h4>
    <div>
        <a href="{{ route('admin.programs.budgets.create', $program) }}" class="btn btn-primary"><i class="bi bi-plus"></i> Tambah Anggaran</a>
        <a href="{{ route('admin.programs.index') }}" class="btn btn-secondary"><i class="bi bi-arrow-left"></i> Kembali</a>
    </div>
</div>
<div class="card">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-striped mb-0">
                <thead class="table-dark">
                    <tr>
                        <th>Item</th>
                        <th class="text-end">Estimasi Biaya</th>
                        <th class="text-end">Biaya Aktual</th>
                        <th>Status</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($budgets as $b)
                    <tr>
                        <td>{{ $b->item_name }}</td>
                        <td class="text-end">Rp {{ number_format($b->estimated_cost, 0, ',', '.') }}</td>
                        <td class="text-end">{{ $b->actual_cost ? 'Rp ' . number_format($b->actual_cost, 0, ',', '.') : '-' }}</td>
                        <td>
                            @php
                                $badge = match($b->status) {
                                    'planned' => 'warning',
                                    'realized' => 'success',
                                    default => 'secondary'
                                };
                            @endphp
                            <span class="badge bg-{{ $badge }}">{{ ucfirst($b->status) }}</span>
                        </td>
                        <td class="text-center">
                            <a href="{{ route('admin.programs.budgets.edit', [$program, $b]) }}" class="btn btn-sm btn-warning"><i class="bi bi-pencil"></i></a>
                            <form action="{{ route('admin.programs.budgets.destroy', [$program, $b]) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus anggaran ini?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="5" class="text-center py-3">Belum ada data anggaran</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
