@extends('layouts.app')
@section('title','Laporan Penjualan')
@section('content')
<div class="card shadow rounded-2xl">
  <div class="card-body">
    <div class="form-row mb-3">
      <div class="col"><input id="from" type="date" class="form-control"></div>
      <div class="col"><input id="to" type="date" class="form-control"></div>
      <div class="col-auto"><button id="filter" class="btn btn-primary">Filter</button></div>
    </div>
    <div class="table-responsive">
      <table id="datatable" class="table table-bordered table-striped" style="width:100%">
        <thead>
          <tr>
            <th>Invoice</th>
            <th>Pelanggan</th>
            <th>Kasir</th>
            <th>Total</th>
            <th>Tanggal</th>
            <th>Channel</th>
          </tr>
        </thead>
      </table>
    </div>
  </div>
</div>
@endsection

@push('scripts')
<script>
  const table = $('#datatable').DataTable({
    ajax: { url: '{{ route('reports.sales') }}', data: d=>{ d.from=$('#from').val(); d.to=$('#to').val(); } },
    columns: [
      { data: 'invoice' },
      { data: 'customer', defaultContent: '-' },
      { data: 'cashier' },
      { data: 'total', render: d=>'Rp '+Number(d).toLocaleString('id-ID') },
      { data: 'created_at' },
      { data: 'channel' },
    ]
  });
  $('#filter').on('click', ()=> table.ajax.reload());
</script>
@endpush
