@extends('layouts.app')
@section('title', 'Detail Jamaah - MosqueCare')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h4>Detail Jamaah</h4>
    <div>
        <a href="{{ route('admin.jamaah.edit', $jamaah) }}" class="btn btn-warning"><i class="bi bi-pencil"></i> Edit</a>
        <a href="{{ route('admin.jamaah.index') }}" class="btn btn-secondary"><i class="bi bi-arrow-left"></i> Kembali</a>
    </div>
</div>

<div class="row g-3 mb-4">
    <div class="col-md-6">
        <div class="card h-100">
            <div class="card-header"><strong>Informasi Umum</strong></div>
            <div class="card-body">
                <table class="table table-sm mb-0">
                    <tr><th style="width:140px">Nama</th><td>{{ $jamaah->name }}</td></tr>
                    <tr><th>Email</th><td>{{ $jamaah->email }}</td></tr>
                    <tr><th>Telepon</th><td>{{ $jamaah->phone ?? '-' }}</td></tr>
                    <tr><th>Alamat</th><td>{{ $jamaah->address ?? '-' }}</td></tr>
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card h-100">
            <div class="card-header"><strong>Informasi Tambahan</strong></div>
            <div class="card-body">
                <table class="table table-sm mb-0">
                    <tr><th style="width:140px">Pekerjaan</th><td>{{ $jamaah->pekerjaan ?? '-' }}</td></tr>
                    <tr><th>Kondisi Ekonomi</th>
                        <td>
                            @if($jamaah->kondisi_ekonomi)
                                <span class="badge bg-{{ $jamaah->kondisi_ekonomi === 'rendah' ? 'danger' : ($jamaah->kondisi_ekonomi === 'menengah' ? 'warning' : 'success') }}">
                                    {{ ucfirst($jamaah->kondisi_ekonomi) }}
                                </span>
                            @else
                                -
                            @endif
                        </td>
                    </tr>
                    <tr><th>Tanggungan</th><td>{{ $jamaah->tanggungan ?? 0 }} orang</td></tr>
                    <tr><th>Catatan</th><td>{{ $jamaah->notes ?? '-' }}</td></tr>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <strong>Riwayat Bantuan</strong>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-striped mb-0">
                <thead class="table-dark">
                    <tr>
                        <th>Tipe Bantuan</th>
                        <th>Jumlah</th>
                        <th>Tanggal</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($histories as $history)
                    <tr>
                        <td>{{ $history->assistance_type ?? $history->type ?? '-' }}</td>
                        <td>Rp {{ number_format($history->amount ?? 0, 0, ',', '.') }}</td>
                        <td>{{ $history->date ? \Carbon\Carbon::parse($history->date)->format('d/m/Y') : ($history->created_at ? $history->created_at->format('d/m/Y') : '-') }}</td>
                        <td>
                            @php $status = $history->status ?? 'completed'; @endphp
                            <span class="badge bg-{{ $status === 'approved' || $status === 'completed' ? 'success' : ($status === 'pending' ? 'warning' : ($status === 'rejected' ? 'danger' : 'secondary')) }}">
                                {{ ucfirst($status) }}
                            </span>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="4" class="text-center py-3">Belum ada riwayat bantuan</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
