@extends('layouts.app')

@section('title', 'Pengajuan Bantuan - MosqueCare')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold mb-0">Pengajuan Bantuan</h4>
    <a href="{{ route('jamaah.applications.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-lg"></i> Ajukan Bantuan
    </a>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Tanggal</th>
                        <th>Tipe</th>
                        <th>Jumlah Diminta</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($applications as $app)
                    <tr>
                        <td class="text-nowrap">{{ $app->created_at->format('d/m/Y') }}</td>
                        <td>{{ $app->assistance_type }}</td>
                        <td>Rp {{ number_format($app->amount_requested, 0, ',', '.') }}</td>
                        <td>
                            @php
                                $badgeClass = match($app->status) {
                                    'disetujui' => 'success',
                                    'ditolak' => 'danger',
                                    'selesai' => 'primary',
                                    default => 'warning'
                                };
                            @endphp
                            <span class="badge bg-{{ $badgeClass }}">{{ ucfirst($app->status) }}</span>
                        </td>
                        <td>
                            <a href="{{ route('jamaah.applications.show', $app) }}" class="btn btn-sm btn-outline-primary">
                                <i class="bi bi-eye"></i> Detail
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center text-muted py-5">
                            <i class="bi bi-inbox fs-1 d-block mb-2"></i>
                            Belum ada pengajuan bantuan. <a href="{{ route('jamaah.applications.create') }}">Ajukan sekarang</a>.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if ($applications->hasPages())
    <div class="card-footer bg-white border-top">
        {{ $applications->links() }}
    </div>
    @endif
</div>
@endsection
