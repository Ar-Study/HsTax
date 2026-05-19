@extends('layouts.app')
@section('title', 'Data Jamaah - MosqueCare')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h4>Data Jamaah</h4>
    <a href="{{ route('admin.jamaah.create') }}" class="btn btn-primary"><i class="bi bi-plus"></i> Tambah Jamaah</a>
</div>
<div class="card">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-striped mb-0">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Telepon</th>
                        <th>Pekerjaan</th>
                        <th>Ekonomi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($jamaah as $j)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $j->name }}</td>
                        <td>{{ $j->email }}</td>
                        <td>{{ $j->phone ?? '-' }}</td>
                        <td>{{ $j->pekerjaan ?? '-' }}</td>
                        <td><span class="badge bg-{{ $j->kondisi_ekonomi === 'rendah' ? 'danger' : ($j->kondisi_ekonomi === 'menengah' ? 'warning' : 'success') }}">{{ $j->kondisi_ekonomi ?? '-' }}</span></td>
                        <td>
                            <a href="{{ route('admin.jamaah.show', $j) }}" class="btn btn-sm btn-info"><i class="bi bi-eye"></i></a>
                            <a href="{{ route('admin.jamaah.edit', $j) }}" class="btn btn-sm btn-warning"><i class="bi bi-pencil"></i></a>
                            <form action="{{ route('admin.jamaah.destroy', $j) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus jamaah ini?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="7" class="text-center py-3">Belum ada data jamaah</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer">{{ $jamaah->links() }}</div>
</div>
@endsection
