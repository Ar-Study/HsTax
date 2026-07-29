@extends('layouts.app')

@section('title', 'Detail Komentar - HS Tax CMS')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4>Detail Komentar</h4>
        <a href="{{ route('admin.comments.index') }}" class="btn btn-outline-secondary">&larr; Kembali</a>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="mb-3">
                <strong>Nama:</strong>
                <p>{{ $comment->name }}</p>
            </div>
            @if ($comment->email)
            <div class="mb-3">
                <strong>Email:</strong>
                <p>{{ $comment->email }}</p>
            </div>
            @endif
            @if ($comment->news)
            <div class="mb-3">
                <strong>Berita Terkait:</strong>
                <p>{{ $comment->news->title }}</p>
            </div>
            @endif
            <div class="mb-3">
                <strong>Status:</strong>
                <p>
                    @if ($comment->is_approved)
                        <span class="badge bg-success">Disetujui</span>
                    @else
                        <span class="badge bg-warning text-dark">Pending</span>
                    @endif
                </p>
            </div>
            <div class="mb-3">
                <strong>Komentar:</strong>
                <p class="border rounded p-3 bg-light">{{ $comment->content }}</p>
            </div>
            <div class="mb-3">
                <strong>Tanggal:</strong>
                <p>{{ $comment->created_at->format('d M Y H:i') }}</p>
            </div>

            <div class="d-flex gap-2">
                @if (!$comment->is_approved)
                    <form method="POST" action="{{ route('admin.comments.approve', $comment) }}">
                        @csrf @method('PUT')
                        <button type="submit" class="btn btn-success">Setujui</button>
                    </form>
                @else
                    <form method="POST" action="{{ route('admin.comments.reject', $comment) }}">
                        @csrf @method('PUT')
                        <button type="submit" class="btn btn-warning">Tolak</button>
                    </form>
                @endif
                <form method="POST" action="{{ route('admin.comments.destroy', $comment) }}" onsubmit="return confirm('Hapus komentar ini?')">
                    @csrf @method('DELETE')
                    <button type="submit" class="btn btn-danger">Hapus</button>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
    .card { border: 1px solid #e5dfd9; border-radius: 16px; }
</style>
@endsection
