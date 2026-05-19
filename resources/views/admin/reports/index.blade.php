@extends('layouts.app')
@section('title', 'Laporan - MosqueCare')
@section('content')
<h4 class="mb-4">Laporan</h4>

<div class="row g-4">
    <div class="col-md-3">
        <a href="{{ route('admin.reports.financial') }}" class="text-decoration-none">
            <div class="card border-primary text-primary h-100">
                <div class="card-body text-center">
                    <h5><i class="bi bi-cash-stack fs-1"></i></h5>
                    <h5 class="card-title mt-2">Laporan Keuangan</h5>
                    <p class="card-text small">Rekap keuangan masjid</p>
                </div>
            </div>
        </a>
    </div>
    <div class="col-md-3">
        <a href="{{ route('admin.reports.donation') }}" class="text-decoration-none">
            <div class="card border-success text-success h-100">
                <div class="card-body text-center">
                    <h5><i class="bi bi-gift fs-1"></i></h5>
                    <h5 class="card-title mt-2">Laporan Donasi</h5>
                    <p class="card-text small">Rekap donasi masuk</p>
                </div>
            </div>
        </a>
    </div>
    <div class="col-md-3">
        <a href="{{ route('admin.reports.program') }}" class="text-decoration-none">
            <div class="card border-warning text-warning h-100">
                <div class="card-body text-center">
                    <h5><i class="bi bi-folder fs-1"></i></h5>
                    <h5 class="card-title mt-2">Laporan Program</h5>
                    <p class="card-text small">Rekap program & anggaran</p>
                </div>
            </div>
        </a>
    </div>
    <div class="col-md-3">
        <a href="{{ route('admin.reports.assistance') }}" class="text-decoration-none">
            <div class="card border-info text-info h-100">
                <div class="card-body text-center">
                    <h5><i class="bi bi-heart fs-1"></i></h5>
                    <h5 class="card-title mt-2">Laporan Bantuan</h5>
                    <p class="card-text small">Rekap bantuan keluar</p>
                </div>
            </div>
        </a>
    </div>
</div>
@endsection
