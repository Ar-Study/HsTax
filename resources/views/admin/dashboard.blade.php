@extends('layouts.app')

@section('title', 'Dashboard Admin - MosqueCare')

@section('content')
<div class="container-fluid">
    <h4 class="mb-4">Dashboard Admin</h4>

    <div class="row g-3 mb-4">
        <div class="col-md-3">
            <div class="card border-primary text-primary h-100">
                <div class="card-body text-center">
                    <h5 class="card-title"><i class="bi bi-people fs-1"></i></h5>
                    <p class="card-text display-6 fw-bold">{{ $total_jamaah }}</p>
                    <p class="card-text">Total Jamaah</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-success text-success h-100">
                <div class="card-body text-center">
                    <h5 class="card-title"><i class="bi bi-cash-stack fs-1"></i></h5>
                    <p class="card-text display-6 fw-bold">Rp {{ number_format($total_donations, 0, ',', '.') }}</p>
                    <p class="card-text">Total Donasi</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-warning text-warning h-100">
                <div class="card-body text-center">
                    <h5 class="card-title"><i class="bi bi-clock-history fs-1"></i></h5>
                    <p class="card-text display-6 fw-bold">{{ $pending_applications }}</p>
                    <p class="card-text">Pengajuan Pending</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-info text-info h-100">
                <div class="card-body text-center">
                    <h5 class="card-title"><i class="bi bi-folder fs-1"></i></h5>
                    <p class="card-text display-6 fw-bold">{{ $active_programs }}</p>
                    <p class="card-text">Program Aktif</p>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-3">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>Donasi Terbaru</span>
                    <a href="{{ route('admin.donations.index') }}" class="btn btn-sm btn-outline-primary">Lihat Semua</a>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-sm mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>Tanggal</th>
                                    <th>Jamaah</th>
                                    <th>Tipe</th>
                                    <th class="text-end">Jumlah</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($recent_donations as $donation)
                                <tr>
                                    <td>{{ $donation->donation_date->format('d/m/Y') }}</td>
                                    <td>{{ $donation->jamaah->name ?? 'Anonim' }}</td>
                                    <td><span class="badge bg-secondary">{{ $donation->type }}</span></td>
                                    <td class="text-end">Rp {{ number_format($donation->amount, 0, ',', '.') }}</td>
                                </tr>
                                @empty
                                <tr><td colspan="4" class="text-center text-muted py-3">Belum ada donasi</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>Pengajuan Bantuan Terbaru</span>
                    <a href="{{ route('admin.applications.index') }}" class="btn btn-sm btn-outline-primary">Lihat Semua</a>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-sm mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>Tanggal</th>
                                    <th>Jamaah</th>
                                    <th>Tipe</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($recent_applications as $app)
                                <tr>
                                    <td>{{ $app->application_date->format('d/m/Y') }}</td>
                                    <td>{{ $app->jamaah->name }}</td>
                                    <td>{{ $app->assistance_type }}</td>
                                    <td>
                                        @switch($app->status)
                                            @case('pending') <span class="badge bg-warning">Pending</span> @break
                                            @case('approved') <span class="badge bg-success">Disetujui</span> @break
                                            @case('rejected') <span class="badge bg-danger">Ditolak</span> @break
                                            @case('postponed') <span class="badge bg-info">Ditunda</span> @break
                                        @endswitch
                                    </td>
                                </tr>
                                @empty
                                <tr><td colspan="4" class="text-center text-muted py-3">Belum ada pengajuan</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <span>Grafik Donasi Bulanan ({{ date('Y') }})</span>
                </div>
                <div class="card-body">
                    <canvas id="donationChart" height="100"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
const ctx = document.getElementById('donationChart').getContext('2d');
new Chart(ctx, {
    type: 'line',
    data: {
        labels: {!! json_encode(['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des']) !!},
        datasets: [{
            label: 'Total Donasi (Rp)',
            data: {!! json_encode(array_values(array_replace(array_fill(1, 12, 0), $monthly_donations->toArray()))) !!},
            borderColor: '#0d6efd',
            backgroundColor: 'rgba(13, 110, 253, 0.1)',
            fill: true,
            tension: 0.4
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: { display: false }
        },
        scales: {
            y: {
                beginAtZero: true,
                ticks: {
                    callback: function(value) { return 'Rp ' + value.toLocaleString('id-ID'); }
                }
            }
        }
    }
});
</script>
@endpush
@endsection
