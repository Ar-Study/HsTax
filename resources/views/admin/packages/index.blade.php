@extends('layouts.app')
@section('title', 'Paket Layanan')
@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="fw-bold mb-0">Paket Layanan</h4>
            <small class="text-muted">Kelola paket layanan HS Tax yang ditampilkan di halaman depan</small>
        </div>
        <a href="{{ route('admin.packages.create') }}" class="btn btn-maroon"><i class="bi bi-plus-lg"></i> Tambah Paket</a>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show shadow-sm"> {{ session('success') }} <button type="button" class="btn-close" data-bs-dismiss="alert"></button> </div>
    @endif

    <div class="card">
        <div class="card-body">
            @if ($packages->isEmpty())
                <div class="text-center py-5 text-muted">
                    <i class="bi bi-box-seam fs-1 d-block mb-3"></i>
                    <p>Belum ada paket layanan. <a href="{{ route('admin.packages.create') }}">Tambah sekarang</a>.</p>
                </div>
            @else
                <div class="row g-4">
                    @foreach ($packages as $pkg)
                        <div class="col-md-6 col-lg-4">
                            <div class="card h-100 border position-relative {{ $pkg->is_popular ? 'border-maroon shadow' : '' }}">
                                @if ($pkg->is_popular)
                                    <span class="position-absolute top-0 start-50 translate-middle badge bg-maroon rounded-pill px-3 py-2" style="font-size:11px;letter-spacing:0.5px">POPULER</span>
                                @endif
                                <div class="card-body p-4">
                                    <div class="d-flex align-items-center gap-3 mb-3">
                                        <span style="font-size:2rem">{{ $pkg->icon }}</span>
                                        <div>
                                            <h5 class="fw-bold mb-0">{{ $pkg->name }}</h5>
                                            <small class="text-muted">{{ $pkg->desc }}</small>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <span class="fs-3 fw-bold text-maroon">{{ $pkg->price }}</span>
                                        @if ($pkg->period)
                                            <small class="text-muted"> / {{ $pkg->period }}</small>
                                        @endif
                                    </div>
                                    @if ($pkg->features)
                                        <ul class="list-unstyled small mb-3">
                                            @foreach ($pkg->features as $f)
                                                <li class="py-1"><i class="bi bi-check-circle text-maroon me-2"></i>{{ $f }}</li>
                                            @endforeach
                                        </ul>
                                    @endif
                                </div>
                                <div class="card-footer bg-white border-top-0 d-flex gap-2 justify-content-end pt-0 pb-3 px-4">
                                    <a href="{{ route('admin.packages.edit', $pkg) }}" class="btn btn-sm btn-outline-maroon"><i class="bi bi-pencil"></i> Edit</a>
                                    <form method="POST" action="{{ route('admin.packages.destroy', $pkg) }}" onsubmit="return confirm('Hapus paket {{ $pkg->name }}?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i> Hapus</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
