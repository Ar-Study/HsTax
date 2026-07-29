@extends('layouts.app')
@section('title', 'Testimoni')
@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="fw-bold mb-0">Testimoni</h4>
            <small class="text-muted">Kelola testimoni klien yang ditampilkan di halaman depan</small>
        </div>
        <a href="{{ route('admin.testimonials.create') }}" class="btn btn-maroon"><i class="bi bi-plus-lg"></i> Tambah Testimoni</a>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show shadow-sm"> {{ session('success') }} <button type="button" class="btn-close" data-bs-dismiss="alert"></button> </div>
    @endif

    <div class="card">
        <div class="card-body">
            @if ($testimonials->isEmpty())
                <div class="text-center py-5 text-muted">
                    <i class="bi bi-star fs-1 d-block mb-3"></i>
                    <p>Belum ada testimoni. <a href="{{ route('admin.testimonials.create') }}">Tambah sekarang</a>.</p>
                </div>
            @else
                <div class="row g-4">
                    @foreach ($testimonials as $t)
                        <div class="col-md-6 col-lg-4">
                            <div class="card h-100 border">
                                <div class="card-body p-4">
                                    <div class="text-warning mb-2" style="font-size:0.9rem;letter-spacing:2px">{{ str_repeat('★', $t->stars) }}</div>
                                    <p class="card-text fst-italic small mb-3">"{{ $t->text }}"</p>
                                    <div class="d-flex align-items-center gap-3 mt-auto">
                                        <div class="d-flex align-items-center justify-content-center rounded-circle bg-maroon text-white fw-bold" style="width:40px;height:40px;font-size:1rem;">{{ $t->initial ?: substr($t->name, 0, 1) }}</div>
                                        <div>
                                            <div class="fw-bold small">{{ $t->name }}</div>
                                            <div class="text-muted" style="font-size:0.8rem">{{ $t->role }}</div>
                                        </div>
                                        @if (!$t->is_approved)
                                            <span class="badge bg-warning text-dark ms-auto">Pending</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="card-footer bg-white border-top-0 d-flex gap-2 justify-content-end pt-0 pb-3 px-4">
                                    <a href="{{ route('admin.testimonials.edit', $t) }}" class="btn btn-sm btn-outline-maroon"><i class="bi bi-pencil"></i> Edit</a>
                                    <form method="POST" action="{{ route('admin.testimonials.destroy', $t) }}" onsubmit="return confirm('Hapus testimoni ini?')">
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
