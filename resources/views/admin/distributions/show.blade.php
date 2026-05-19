@extends('layouts.app')
@section('title', 'Detail Distribusi - MosqueCare')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h4>Detail Distribusi</h4>
    <a href="{{ route('admin.distributions.index') }}" class="btn btn-secondary"><i class="bi bi-arrow-left"></i> Kembali</a>
</div>

<div class="card">
    <div class="card-body">
        <table class="table table-sm mb-0">
            <tr><th style="width:180px">Tanggal Distribusi</th><td>{{ $distribution->distribution_date ? \Carbon\Carbon::parse($distribution->distribution_date)->format('d/m/Y') : '-' }}</td></tr>
            <tr><th>Jamaah</th><td>{{ $distribution->application->jamaah->name ?? '-' }}</td></tr>
            <tr><th>Tipe Bantuan</th><td>{{ $distribution->application->assistance_type ?? '-' }}</td></tr>
            <tr><th>Jumlah</th><td>Rp {{ number_format($distribution->amount, 0, ',', '.') }}</td></tr>
            <tr><th>Metode</th><td>{{ ucfirst($distribution->method ?? $distribution->distribution_method) }}</td></tr>
            <tr><th>Distributor</th><td>{{ $distribution->distributor ?? '-' }}</td></tr>
            <tr><th>Keterangan</th><td>{{ $distribution->notes ?? '-' }}</td></tr>
            <tr><th>Dibuat</th><td>{{ $distribution->created_at->format('d/m/Y H:i') }}</td></tr>
        </table>
    </div>
</div>
@endsection
