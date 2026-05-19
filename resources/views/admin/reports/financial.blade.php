@extends('layouts.app')
@section('title', 'Laporan Keuangan - MosqueCare')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h4>Laporan Keuangan</h4>
    <a href="{{ route('admin.reports.index') }}" class="btn btn-secondary"><i class="bi bi-arrow-left"></i> Kembali</a>
</div>

<div class="row g-3 mb-4">
    <div class="col-md-4">
        <div class="card border-success text-success h-100">
            <div class="card-body text-center">
                <h5><i class="bi bi-cash-stack fs-2"></i></h5>
                <p class="card-text small">Total Donasi</p>
                <p class="display-6 fw-bold">Rp {{ number_format($totalDonations, 0, ',', '.') }}</p>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card border-danger text-danger h-100">
            <div class="card-body text-center">
                <h5><i class="bi bi-box-arrow-up fs-2"></i></h5>
                <p class="card-text small">Total Distribusi</p>
                <p class="display-6 fw-bold">Rp {{ number_format($totalDistributions, 0, ',', '.') }}</p>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card border-primary text-primary h-100">
            <div class="card-body text-center">
                <h5><i class="bi bi-wallet2 fs-2"></i></h5>
                <p class="card-text small">Saldo Akhir</p>
                <p class="display-6 fw-bold">Rp {{ number_format($totalDonations - $totalDistributions, 0, ',', '.') }}</p>
            </div>
        </div>
    </div>
</div>

<div class="row g-3 mb-4">
    <div class="col-md-6">
        <div class="card h-100">
            <div class="card-header"><strong>Donasi per Tipe</strong></div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-striped mb-0">
                        <thead class="table-dark">
                            <tr>
                                <th>Tipe</th>
                                <th class="text-end">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($donasiByType as $item)
                            <tr>
                                <td>{{ ucfirst($item->type) }}</td>
                                <td class="text-end">Rp {{ number_format($item->total, 0, ',', '.') }}</td>
                            </tr>
                            @empty
                            <tr><td colspan="2" class="text-center py-3">Belum ada data</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card h-100">
            <div class="card-header"><strong>Grafik Donasi Bulanan ({{ date('Y') }})</strong></div>
            <div class="card-body">
                <canvas id="financialChart" height="200"></canvas>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
const monthlyData = {!! json_encode($monthlyDonations ?? []) !!};
const labels = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];
const values = Array(12).fill(0);
monthlyData.forEach(function(item) {
    values[item.month - 1] = item.total;
});
const ctx = document.getElementById('financialChart').getContext('2d');
new Chart(ctx, {
    type: 'bar',
    data: {
        labels: labels,
        datasets: [{
            label: 'Total Donasi (Rp)',
            data: values,
            backgroundColor: 'rgba(13, 110, 253, 0.6)',
            borderColor: '#0d6efd',
            borderWidth: 1
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
