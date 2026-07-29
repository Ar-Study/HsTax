@extends('layouts.app')
@section('title', 'Dashboard')
@section('content')
<div class="container-fluid">
    <div class="d-flex align-items-center gap-3 mb-4">
        <div>
            <h4 class="fw-bold mb-0">Dashboard</h4>
            <small class="text-muted">Overview konten website HS Tax</small>
        </div>
    </div>

    {{-- Stat Cards --}}
    <div class="row g-4 mb-4">
        <div class="col-xl-3 col-md-6">
            <div class="card border-0 rounded-4 shadow-sm p-3">
                <div class="d-flex align-items-center gap-3">
                    <div class="d-flex align-items-center justify-content-center rounded-3" style="width:48px;height:48px;background:#8B1A1A;color:#fff;font-size:1.3rem;">
                        <i class="bi bi-newspaper"></i>
                    </div>
                    <div>
                        <div class="text-muted small text-uppercase" style="letter-spacing:0.5px">Berita</div>
                        <div class="fs-3 fw-bold mt-1">{{ $total_news }}</div>
                        <small class="text-muted">{{ $published_news }} published</small>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card border-0 rounded-4 shadow-sm p-3">
                <div class="d-flex align-items-center gap-3">
                    <div class="d-flex align-items-center justify-content-center rounded-3" style="width:48px;height:48px;background:#2d6a4f;color:#fff;font-size:1.3rem;">
                        <i class="bi bi-box-seam"></i>
                    </div>
                    <div>
                        <div class="text-muted small text-uppercase" style="letter-spacing:0.5px">Paket</div>
                        <div class="fs-3 fw-bold mt-1">{{ $total_packages }}</div>
                        <small class="text-muted">{{ $active_packages }} aktif</small>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card border-0 rounded-4 shadow-sm p-3">
                <div class="d-flex align-items-center gap-3">
                    <div class="d-flex align-items-center justify-content-center rounded-3" style="width:48px;height:48px;background:#e9c46a;color:#1e1e24;font-size:1.3rem;">
                        <i class="bi bi-star"></i>
                    </div>
                    <div>
                        <div class="text-muted small text-uppercase" style="letter-spacing:0.5px">Testimoni</div>
                        <div class="fs-3 fw-bold mt-1">{{ $total_testimonials }}</div>
                        <small class="text-muted">{{ $approved_testimonials }} ditampilkan</small>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card border-0 rounded-4 shadow-sm p-3">
                <div class="d-flex align-items-center gap-3">
                    <div class="d-flex align-items-center justify-content-center rounded-3" style="width:48px;height:48px;background:#5a8a9e;color:#fff;font-size:1.3rem;">
                        <i class="bi bi-chat-dots"></i>
                    </div>
                    <div>
                        <div class="text-muted small text-uppercase" style="letter-spacing:0.5px">Komentar</div>
                        <div class="fs-3 fw-bold mt-1">{{ $total_comments }}
                            @if($pending_comments > 0)
                                <small class="fs-6 text-warning">({{ $pending_comments }} pending)</small>
                            @endif
                        </div>
                        <small class="text-muted">{{ $total_comments - $pending_comments }} disetujui</small>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Quick Actions --}}
    <div class="card border-0 rounded-4 shadow-sm mb-4">
        <div class="card-header bg-white fw-bold border-bottom-0 pt-3">
            <i class="bi bi-lightning me-1"></i> Quick Actions
        </div>
        <div class="card-body">
            <div class="d-flex flex-wrap gap-2">
                <a href="{{ route('admin.news.create') }}" class="btn" style="background:#8B1A1A;color:#fff;border-radius:50px;font-weight:600;">
                    <i class="bi bi-plus-lg"></i> Tambah Berita
                </a>
                <a href="{{ route('admin.packages.create') }}" class="btn btn-outline-secondary rounded-pill fw-medium">
                    <i class="bi bi-plus-lg"></i> Tambah Paket
                </a>
                <a href="{{ route('admin.testimonials.create') }}" class="btn btn-outline-secondary rounded-pill fw-medium">
                    <i class="bi bi-plus-lg"></i> Tambah Testimoni
                </a>
                <a href="{{ route('admin.cms.index') }}" class="btn btn-outline-secondary rounded-pill fw-medium">
                    <i class="bi bi-pencil"></i> Edit Halaman Depan
                </a>
            </div>
        </div>
    </div>

    <div class="row g-4">
        {{-- Recent News --}}
        <div class="col-lg-6">
            <div class="card border-0 rounded-4 shadow-sm h-100">
                <div class="card-header bg-white fw-bold border-bottom-0 pt-3 d-flex justify-content-between">
                    <span><i class="bi bi-newspaper me-1"></i> Berita Terbaru</span>
                    <a href="{{ route('admin.news.index') }}" class="btn btn-sm btn-outline-secondary rounded-pill">Lihat Semua</a>
                </div>
                <div class="card-body p-0">
                    @if($recent_news->count())
                        <div class="list-group list-group-flush">
                            @foreach($recent_news as $news)
                                <div class="list-group-item border-0 d-flex justify-content-between align-items-center py-3">
                                    <div>
                                        <a href="{{ route('admin.news.edit', $news) }}" class="text-decoration-none fw-medium">{{ Str::limit($news->title, 50) }}</a>
                                        <div class="small text-muted mt-1">{{ $news->created_at->format('d M Y') }}</div>
                                    </div>
                                    <span class="badge {{ $news->is_published ? 'bg-success' : 'bg-secondary' }} rounded-pill">
                                        {{ $news->is_published ? 'Published' : 'Draft' }}
                                    </span>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="p-4 text-center text-muted">Belum ada berita.</div>
                    @endif
                </div>
            </div>
        </div>

        {{-- Recent Comments --}}
        <div class="col-lg-6">
            <div class="card border-0 rounded-4 shadow-sm h-100">
                <div class="card-header bg-white fw-bold border-bottom-0 pt-3 d-flex justify-content-between">
                    <span><i class="bi bi-chat-dots me-1"></i> Komentar Terbaru</span>
                    <a href="{{ route('admin.comments.index') }}" class="btn btn-sm btn-outline-secondary rounded-pill">Lihat Semua</a>
                </div>
                <div class="card-body p-0">
                    @if($recent_comments->count())
                        <div class="list-group list-group-flush">
                            @foreach($recent_comments as $comment)
                                <div class="list-group-item border-0 py-3">
                                    <div class="d-flex justify-content-between">
                                        <strong class="small">{{ $comment->name }}</strong>
                                        <small class="text-muted">{{ $comment->created_at->diffForHumans() }}</small>
                                    </div>
                                    <p class="mb-0 small mt-1">{{ Str::limit($comment->content, 100) }}</p>
                                    @if(!$comment->is_approved)
                                        <span class="badge bg-warning text-dark mt-1 rounded-pill">Pending</span>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="p-4 text-center text-muted">Belum ada komentar.</div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    {{-- Info Cards --}}
    <div class="row g-4 mt-2">
        <div class="col-md-6">
            <div class="card border-0 rounded-4 text-white" style="background: linear-gradient(135deg, #8B1A1A 0%, #5A0D0D 100%);">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center gap-3">
                        <i class="bi bi-buildings fs-1 opacity-75"></i>
                        <div>
                            <h6 class="fw-bold mb-1">HS Tax — Jasa Konsultan Pajak</h6>
                            <p class="mb-0 small opacity-75">Solusi perpajakan terpercaya untuk UMKM & freelancer. Konsultasi, perencanaan, dan pelaporan pajak.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card border-0 rounded-4" style="background: linear-gradient(135deg, #D4AF37 0%, #e9c46a 100%); color: #3d0808;">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center gap-3">
                        <i class="bi bi-gear fs-1 opacity-75"></i>
                        <div>
                            <h6 class="fw-bold mb-1">Kelola Konten Website</h6>
                            <p class="mb-0 small opacity-75">Gunakan menu sidebar untuk mengelola berita, paket, testimoni, FAQ, dan halaman depan.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
