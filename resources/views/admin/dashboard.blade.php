@extends('layouts.admin')

@section('title', 'Dashboard Admin')

@section('content')
<div class="container mx-auto">

    <h2 class="text-2xl font-bold mb-6">📊 Dashboard Statistik</h2>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">

        {{-- TOTAL BARANG --}}
        <div class="bg-white shadow-md rounded-xl p-5 border">
            <h3 class="text-lg font-semibold">Total Barang</h3>
            <p class="text-4xl font-bold mt-2 text-blue-600">{{ $totalBarang }}</p>
        </div>

        {{-- STATUS --}}
        <div class="bg-white shadow-md rounded-xl p-5 border">
            <h3 class="text-lg font-semibold mb-2">Barang per Status</h3>
            <div class="relative h-[230px]">
                <canvas id="statusChart"></canvas>
            </div>
        </div>

        {{-- NEGARA --}}
        <div class="bg-white shadow-md rounded-xl p-5 border">
            <h3 class="text-lg font-semibold mb-2">Barang per Negara Asal</h3>
            <div class="relative h-[230px]">
                <canvas id="negaraChart"></canvas>
            </div>
        </div>

    </div>

    {{-- TREND --}}
    <div class="bg-white p-5 shadow-md rounded-xl border">
        <h3 class="text-lg font-semibold mb-2">Trend 7 Hari Terakhir</h3>
        <div class="relative h-[260px]">
            <canvas id="trendChart"></canvas>
        </div>
    </div>

</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {

    // ================= DATA =================
    const statusLabels = {!! json_encode(array_keys($barangPerStatus)) !!};
    const statusValues = {!! json_encode(array_values($barangPerStatus)) !!};

    const negaraLabels = {!! json_encode($barangPerNegara->pluck('nama_negara')) !!};
    const negaraValues = {!! json_encode($barangPerNegara->pluck('total')) !!};

    const trendLabels = {!! json_encode($trend->keys()) !!};
    const trendValues = {!! json_encode($trend->values()) !!};

    // ================= PIE STATUS =================
    new Chart(document.getElementById('statusChart'), {
        type: 'pie',
        data: {
            labels: statusLabels,
            datasets: [{
                data: statusValues,
                backgroundColor: ['#3b82f6', '#22c55e', '#ef4444']
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { position: 'bottom' }
            }
        }
    });

    // ================= PIE NEGARA =================
    new Chart(document.getElementById('negaraChart'), {
        type: 'pie',
        data: {
            labels: negaraLabels,
            datasets: [{
                data: negaraValues,
                backgroundColor: ['#8b5cf6', '#facc15', '#10b981', '#0ea5e9']
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { position: 'bottom' }
            }
        }
    });

    // ================= LINE TREND =================
    new Chart(document.getElementById('trendChart'), {
        type: 'line',
        data: {
            labels: trendLabels,
            datasets: [{
                label: 'Jumlah Barang',
                data: trendValues,
                borderColor: '#22c55e',
                backgroundColor: 'rgba(34,197,94,0.2)',
                fill: true,
                tension: 0.4
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: { beginAtZero: true }
            },
            plugins: {
                legend: { display: false }
            }
        }
    });

});
</script>
@endsection
