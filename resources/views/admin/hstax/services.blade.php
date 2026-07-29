@extends('layouts.app')
@section('title', 'Layanan - HS Tax CMS')
@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="fw-bold mb-0">Layanan Unggulan</h4>
            <small class="text-muted">Mengelola konten bagian "Kenapa HS Tax?" yang muncul di halaman depan</small>
        </div>
        <a href="{{ route('admin.cms.index') }}" class="btn btn-outline-maroon"><i class="bi bi-arrow-left"></i> Kembali</a>
    </div>

    <div class="card">
        <div class="card-body p-4">
            <p class="text-muted mb-4">
                Bagian "Kenapa HS Tax?" menampilkan 3 layanan unggulan. Saat ini data dikelola melalui file konfigurasi.
                Untuk mengubah konten ini, edit file <code>config/hstax.php</code> bagian <code>'why'</code>.
            </p>
            <div class="row g-4">
                @foreach (config('hstax.why') as $why)
                    <div class="col-md-4">
                        <div class="card border h-100">
                            <div class="card-body text-center p-4">
                                <div class="mb-3" style="font-size:2.5rem">{{ $why['icon'] }}</div>
                                <span class="badge bg-maroon mb-2">{{ $why['num'] }}</span>
                                <h5 class="fw-bold">{{ $why['title'] }}</h5>
                                <p class="small text-muted mb-0">{{ $why['text'] }}</p>
                                @if (!empty($why['featured']))
                                    <span class="badge bg-warning text-dark mt-2">Featured</span>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
