@extends('layouts.appadmin')
@section('content')
<div class="dashboard-wrapper">
  <!-- Statistik Ringkas -->
  <div class="row g-4 mb-4 dashboard-stats">
    <div class="col-lg-6 col-md-6">
      <div class="stat-card">
        <div class="stat-icon"><i class="fas fa-dollar-sign"></i></div>
        <div class="stat-label">Total Pendapatan</div>
        <div class="stat-value">Rp {{ number_format($totalRevenue ?? 0, 0, ',', '.') }},-</div>
      </div>
    </div>
    <div class="col-lg-6 col-md-6">
      <div class="stat-card">
        <div class="stat-icon"><i class="fas fa-user-friends"></i></div>
        <div class="stat-label">Total Customer</div>
        <div class="stat-value">{{ $totalCustomers ?? 0 }} customer</div>
      </div>
    </div>
  </div>

  <div class="row g-4">
    <div class="col-12">
      <!-- Tabel Order -->
      <div class="order-table-card order-table-rounded">
        <div class="order-table-header order-table-grid-order">
          <div>ORDER ID</div>
          <div>NAMA</div>
          <div>BERAT</div>
          <div>ANTAR</div>
          <div>TIPE</div>
          <div>TOTAL</div>
        </div>
        <div class="order-table-body">
          @foreach($recentOrders ?? [] as $order)
          <div class="order-row order-table-grid-order">
            <div class="truncate order-id-col">{{ $order->id }}</div>
            <div>{{ $order->customer->name ?? '-' }}</div>
            <div class="text-end">{{ $order->weight ?? '3' }} KG</div>
            <div>{{ $order->antar ?? 'AMBIL DI TOKO' }}</div>
            <div>{{ $order->service->name ?? 'EXPRESS' }}</div>
            <div class="total-col">Rp{{ number_format($order->total_price ?? 0, 0, ',', '.') }},-</div>
          </div>
          @endforeach
        </div>
      </div>
    </div>
    <div class="col-12 d-flex flex-row gap-4 mt-4">
      <div class="tracking-table-card tracking-table-rounded flex-grow-1" style="max-width: 40%">
        <div class="tracking-table-header tracking-table-grid-tracking">
          <div>ORDER ID</div>
          <div>TRACKING</div>
        </div>
        <div class="tracking-table-body">
          @foreach($recentOrders ?? [] as $order)
          <div class="tracking-row tracking-table-grid-tracking">
            <div class="truncate">{{ $order->id }}</div>
            <div>{{ strtoupper($order->status) }}</div>
          </div>
          @endforeach
        </div>
      </div>
    <div class="chart-card chart-card-rounded flex-grow-1" style="max-width: 60%">
      <canvas id="customerChart" height="260"></canvas>
    </div>
    </div>
  </div>
</div>
<style>
.dashboard-wrapper {
  width: 100%;
}
.dashboard-stats .stat-card {
  background: #0a3d62;
  color: #fff;
  border-radius: 24px;
  padding: 32px 24px 24px 24px;
  text-align: center;
  box-shadow: 0 2px 12px rgba(10,61,98,0.08);
  position: relative;
  min-height: 170px;
}
.stat-icon {
  font-size: 38px;
  margin-bottom: 12px;
  color: #fff;
}
.stat-label {
  font-size: 18px;
  font-weight: 600;
  margin-bottom: 4px;
}
.stat-value {
  font-size: 22px;
  font-weight: bold;
}
.order-table-card, .tracking-table-card {
  overflow-x: auto;
}
.order-table-grid-order {
  display: grid;
  grid-template-columns: 2fr 2.5fr 1.2fr 2fr 1.5fr 1.7fr;
  align-items: center;
  text-align: left;
}
.order-table-header.order-table-grid-order {
  font-weight: bold;
  font-size: 17px;
  text-align: center;
  background: #1e5a99;
  color: #fff;
  border-radius: 24px 24px 0 0;
  padding: 18px 32px;
}
.order-table-body {
  display: flex;
  flex-direction: column;
  padding: 0 32px;
}
.order-row.order-table-grid-order > div {
  padding: 6px 0;
  text-align: center;
}
.order-row .text-end {
  text-align: right;
}
.order-row .truncate {
  max-width: 120px;
  overflow: hidden;
  text-overflow: ellipsis;
  white-space: nowrap;
}
.tracking-table-grid-tracking {
  display: grid;
  grid-template-columns: 2.5fr 1.2fr;
  align-items: center;
  text-align: left;
}
.tracking-table-header.tracking-table-grid-tracking {
  font-weight: bold;
  font-size: 16px;
  text-align: center;
  background: #1e5a99;
  color: #fff;
  border-radius: 24px 24px 0 0;
  padding: 14px 32px;
}
.tracking-table-body {
  display: flex;
  flex-direction: column;
  padding: 0 32px;
}
.tracking-row.tracking-table-grid-tracking > div {
  padding: 6px 0;
  text-align: center;
}
.tracking-row .truncate {
  max-width: 120px;
  overflow: hidden;
  text-overflow: ellipsis;
  white-space: nowrap;
}
.chart-card {
  background: #fff;
  border-radius: 24px;
  box-shadow: 0 2px 12px rgba(10,61,98,0.08);
  padding: 24px 24px 16px 24px;
  min-height: 340px;
  display: flex;
  align-items: center;
  justify-content: center;
}
.order-table-rounded {
  border-radius: 20px;
  background: #0a3d62;
  box-shadow: 0 4px 16px rgba(10,61,98,0.12);
  padding-bottom: 12px;
}
.order-table-header.order-table-grid-order {
  background: transparent;
  color: #fff;
  border-radius: 20px 20px 0 0;
  padding: 16px 24px 10px 24px;
  font-size: 18px;
  font-weight: bold;
  display: grid;
  grid-template-columns: 2fr 2.5fr 1.2fr 2fr 1.5fr 1.7fr;
  gap: 0;
}
.order-table-body {
  background: transparent;
  padding: 0 24px 0 24px;
}
.order-row.order-table-grid-order {
  background: #2366a8;
  color: #fff;
  border-radius: 20px;
  margin-bottom: 10px;
  font-size: 16px;
  font-weight: 500;
  display: grid;
  grid-template-columns: 2fr 2.5fr 1.2fr 2fr 1.5fr 1.7fr;
  align-items: center;
  min-height: 44px;
}
.order-row > div {
  text-align: center;
  padding: 6px 0;
}
.order-row .order-id-col {
  text-align: left;
  font-size: 14px;
  font-weight: 500;
  padding-left: 18px;
  letter-spacing: 0.5px;
}
.order-row .total-col {
  text-align: right;
  font-size: 16px;
  font-weight: bold;
  padding-right: 18px;
}
.order-table-header.order-table-grid-order > div:first-child {
  text-align: left;
  padding-left: 18px;
}
.order-table-header.order-table-grid-order > div:last-child {
  text-align: right;
  padding-right: 18px;
}
.tracking-table-rounded {
  border-radius: 20px;
  background: #0a3d62;
  box-shadow: 0 4px 16px rgba(10,61,98,0.12);
  padding-bottom: 12px;
}
.tracking-table-header.tracking-table-grid-tracking {
  background: transparent;
  color: #fff;
  border-radius: 20px 20px 0 0;
  padding: 12px 24px 8px 24px;
  font-size: 16px;
  font-weight: bold;
  display: grid;
  grid-template-columns: 2.5fr 1.2fr;
  gap: 0;
}
.tracking-table-body {
  background: transparent;
  padding: 0 24px 0 24px;
}
.tracking-row.tracking-table-grid-tracking {
  background: #2366a8;
  color: #fff;
  border-radius: 20px;
  margin-bottom: 10px;
  font-size: 15px;
  font-weight: 500;
  display: grid;
  grid-template-columns: 2.5fr 1.2fr;
  align-items: center;
  text-align: center;
  min-height: 38px;
}
.chart-card.chart-card-rounded {
  border-radius: 20px;
  background: #fff;
  box-shadow: 0 4px 16px rgba(10,61,98,0.12);
  min-height: 270px;
  display: flex;
  align-items: center;
  justify-content: center;
}
</style>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
  // Data dummy untuk grafik batang
  const barData = {
    labels: ['Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab', 'Min'],
    datasets: [{
      label: 'Order',
      data: [12, 19, 8, 15, 10, 17, 14],
      backgroundColor: '#1e5a99',
      borderRadius: 8,
      barThickness: 28
    }]
  };
  const ctx = document.getElementById('orderBarChart').getContext('2d');
  new Chart(ctx, {
    type: 'bar',
    data: barData,
    options: {
      responsive: true,
      plugins: {
        legend: { display: false },
        title: { display: false }
      },
      scales: {
        x: { grid: { display: false } },
        y: { grid: { color: '#eaf3fa' }, beginAtZero: true }
      }
    }
  });
});
</script>
@endpush
@endsection
