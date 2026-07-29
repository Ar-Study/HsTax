@extends('layouts.app')

@section('title', 'Kelola Komentar - HS Tax CMS')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4>Kelola Komentar</h4>
    </div>

    <div class="card">
        <div class="card-body">
            @if ($comments->isEmpty())
                <p class="text-muted">Belum ada komentar.</p>
            @else
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Komentar</th>
                                <th>Berita Terkait</th>
                                <th>Status</th>
                                <th>Tanggal</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($comments as $comment)
                                <tr>
                                    <td>{{ $comment->name }}</td>
                                    <td>{{ Str::limit($comment->content, 80) }}</td>
                                    <td>{{ $comment->news ? $comment->news->title : '-' }}</td>
                                    <td>
                                        @if ($comment->is_approved)
                                            <span class="badge bg-success">Disetujui</span>
                                        @else
                                            <span class="badge bg-warning text-dark">Pending</span>
                                        @endif
                                    </td>
                                    <td>{{ $comment->created_at->format('d M Y') }}</td>
                                    <td>
                                        <div class="d-flex gap-1">
                                            <a href="{{ route('admin.comments.show', $comment) }}" class="btn btn-sm btn-outline-info">Detail</a>
                                            @if (!$comment->is_approved)
                                                <form method="POST" action="{{ route('admin.comments.approve', $comment) }}">
                                                    @csrf @method('PUT')
                                                    <button type="submit" class="btn btn-sm btn-outline-success">Setujui</button>
                                                </form>
                                            @else
                                                <form method="POST" action="{{ route('admin.comments.reject', $comment) }}">
                                                    @csrf @method('PUT')
                                                    <button type="submit" class="btn btn-sm btn-outline-warning">Tolak</button>
                                                </form>
                                            @endif
                                            <form method="POST" action="{{ route('admin.comments.destroy', $comment) }}" onsubmit="return confirm('Hapus komentar ini?')">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger">Hapus</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                {{ $comments->links() }}
            @endif
        </div>
    </div>
</div>

<style>
    .btn-maroon { background: #8B1A1A; color: #fff; border: none; }
    .btn-maroon:hover { background: #5A0D0D; color: #fff; }
    .card { border: 1px solid #e5dfd9; border-radius: 16px; }
</style>
@endsection
