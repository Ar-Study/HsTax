@extends('layouts.app')
@section('title', 'Data Program - MosqueCare')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h4>Data Program</h4>
    <a href="{{ route('admin.programs.create') }}" class="btn btn-primary"><i class="bi bi-plus"></i> Tambah Program</a>
</div>
<div class="card">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-striped mb-0">
                <thead class="table-dark">
                    <tr>
                        <th>Nama</th>
                        <th>Tanggal Mulai</th>
                        <th>Tanggal Selesai</th>
                        <th class="text-end">Anggaran</th>
                        <th>Status</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($programs as $p)
                    <tr>
                        <td>{{ $p->name }}</td>
                        <td>{{ $p->start_date ? \Carbon\Carbon::parse($p->start_date)->format('d/m/Y') : '-' }}</td>
                        <td>{{ $p->end_date ? \Carbon\Carbon::parse($p->end_date)->format('d/m/Y') : '-' }}</td>
                        <td class="text-end">Rp {{ number_format($p->estimated_budget ?? 0, 0, ',', '.') }}</td>
                        <td>
                            @php
                                $status = $p->status ?? 'planned';
                                $badge = match($status) {
                                    'active' => 'success',
                                    'planned' => 'info',
                                    'completed' => 'secondary',
                                    'cancelled' => 'danger',
                                    default => 'secondary'
                                };
                            @endphp
                            <span class="badge bg-{{ $badge }}">{{ ucfirst($status) }}</span>
                        </td>
                        <td class="text-center">
                            <a href="{{ route('admin.programs.edit', $p) }}" class="btn btn-sm btn-warning"><i class="bi bi-pencil"></i></a>
                            <a href="{{ route('admin.programs.budgets.index', $p) }}" class="btn btn-sm btn-info"><i class="bi bi-cash"></i></a>
                            <form action="{{ route('admin.programs.destroy', $p) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus program ini?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="6" class="text-center py-3">Belum ada data program</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer">{{ $programs->links() }}</div>
</div>
@endsection
