@extends('layouts.app')
@section('title', 'Edit FAQ')
@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold mb-0">Edit FAQ</h4>
        <a href="{{ route('admin.faqs.index') }}" class="btn btn-outline-maroon"><i class="bi bi-arrow-left"></i> Kembali</a>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger"><ul class="mb-0">@foreach ($errors->all() as $e) <li>{{ $e }}</li> @endforeach</ul></div>
    @endif

    <div class="card">
        <div class="card-body p-4">
            <form method="POST" action="{{ route('admin.faqs.update', $faq) }}">
                @csrf @method('PUT')
                <div class="row g-4">
                    <div class="col-12">
                        <label class="form-label fw-medium">Pertanyaan <span class="text-danger">*</span></label>
                        <input type="text" name="question" class="form-control" required value="{{ $faq->question }}">
                    </div>
                    <div class="col-12">
                        <label class="form-label fw-medium">Jawaban <span class="text-danger">*</span></label>
                        <textarea name="answer" class="form-control" rows="5" required>{{ $faq->answer }}</textarea>
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-maroon"><i class="bi bi-save"></i> Update FAQ</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
