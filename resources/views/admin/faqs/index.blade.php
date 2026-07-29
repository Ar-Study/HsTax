@extends('layouts.app')
@section('title', 'FAQ')
@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="fw-bold mb-0">FAQ</h4>
            <small class="text-muted">Kelola pertanyaan & jawaban yang sering diajukan</small>
        </div>
        <a href="{{ route('admin.faqs.create') }}" class="btn btn-maroon"><i class="bi bi-plus-lg"></i> Tambah FAQ</a>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show shadow-sm"> {{ session('success') }} <button type="button" class="btn-close" data-bs-dismiss="alert"></button> </div>
    @endif

    <div class="card">
        <div class="card-body">
            @if ($faqs->isEmpty())
                <div class="text-center py-5 text-muted">
                    <i class="bi bi-question-circle fs-1 d-block mb-3"></i>
                    <p>Belum ada FAQ. <a href="{{ route('admin.faqs.create') }}">Tambah sekarang</a>.</p>
                </div>
            @else
                <div class="accordion" id="faqAccordion">
                    @foreach ($faqs as $faq)
                        <div class="accordion-item border-0 mb-2">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed bg-light fw-bold" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#faq{{ $faq->id }}">
                                    {{ $faq->question }}
                                </button>
                            </h2>
                            <div id="faq{{ $faq->id }}" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body d-flex justify-content-between align-items-start gap-3">
                                    <p class="mb-0">{{ $faq->answer }}</p>
                                    <div class="d-flex gap-1 flex-shrink-0">
                                        <a href="{{ route('admin.faqs.edit', $faq) }}" class="btn btn-sm btn-outline-maroon"><i class="bi bi-pencil"></i></a>
                                        <form method="POST" action="{{ route('admin.faqs.destroy', $faq) }}" onsubmit="return confirm('Hapus FAQ ini?')">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                                        </form>
                                    </div>
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
