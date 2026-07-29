@extends('layouts.app')

@section('title', 'Kelola Berita - HS Tax CMS')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4>Kelola Berita</h4>
        <a href="{{ route('admin.news.create') }}" class="btn btn-maroon">+ Tambah Berita</a>
    </div>

    <div class="card">
        <div class="card-body">
            @if ($news->isEmpty())
                <p class="text-muted">Belum ada berita.</p>
            @else
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Judul</th>
                                <th>Penulis</th>
                                <th>Status</th>
                                <th>Tanggal</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($news as $item)
                                <tr>
                                    <td>{{ $item->title }}</td>
                                    <td>{{ $item->author ?? '-' }}</td>
                                    <td>
                                        @if ($item->is_published)
                                            <span class="badge bg-success">Terbit</span>
                                        @else
                                            <span class="badge bg-secondary">Draft</span>
                                        @endif
                                    </td>
                                    <td>{{ $item->created_at->format('d M Y') }}</td>
                                    <td class="d-flex gap-1">
                                        <a href="{{ route('admin.news.edit', $item) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                                        <form method="POST" action="{{ route('admin.news.destroy', $item) }}" onsubmit="return confirm('Hapus berita ini?')">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                {{ $news->links() }}
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
