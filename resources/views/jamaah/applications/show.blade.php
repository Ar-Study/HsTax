@extends('layouts.app')

@section('title', 'Detail Pengajuan - MosqueCare')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-header bg-white border-bottom d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0">Detail Pengajuan Bantuan</h5>
                <a href="{{ route('jamaah.applications.index') }}" class="btn btn-sm btn-outline-secondary">
                    <i class="bi bi-arrow-left"></i> Kembali
                </a>
            </div>
            <div class="card-body">
                <table class="table table-borderless mb-0">
                    <tr>
                        <th width="180" class="text-muted">Tanggal Pengajuan</th>
                        <td>{{ $application->created_at->format('d F Y H:i') }}</td>
                    </tr>
                    <tr>
                        <th class="text-muted">Tipe Bantuan</th>
                        <td>{{ $application->assistance_type }}</td>
                    </tr>
                    <tr>
                        <th class="text-muted">Jumlah Diminta</th>
                        <td class="fw-bold">Rp {{ number_format($application->amount_requested, 0, ',', '.') }}</td>
                    </tr>
                    <tr>
                        <th class="text-muted">Status</th>
                        <td>
                            @php
                                $badgeClass = match($application->status) {
                                    'disetujui' => 'success',
                                    'ditolak' => 'danger',
                                    'selesai' => 'primary',
                                    default => 'warning'
                                };
                            @endphp
                            <span class="badge bg-{{ $badgeClass }} fs-6">{{ ucfirst($application->status) }}</span>
                        </td>
                    </tr>
                    <tr>
                        <th class="text-muted">Deskripsi</th>
                        <td>{{ $application->description ?? '-' }}</td>
                    </tr>
                    @if ($application->notes)
                    <tr>
                        <th class="text-muted">Catatan Admin</th>
                        <td>{{ $application->notes }}</td>
                    </tr>
                    @endif
                </table>
            </div>
        </div>

        @if ($application->distributions && $application->distributions->count() > 0)
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white border-bottom">
                <h5 class="card-title mb-0">Distribusi Bantuan</h5>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Tanggal</th>
                                <th>Jumlah</th>
                                <th>Metode</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($application->distributions as $dist)
                            <tr>
                                <td class="text-nowrap">{{ $dist->distribution_date->format('d/m/Y') }}</td>
                                <td>Rp {{ number_format($dist->amount, 0, ',', '.') }}</td>
                                <td>{{ $dist->method ?? '-' }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>
@endsection
