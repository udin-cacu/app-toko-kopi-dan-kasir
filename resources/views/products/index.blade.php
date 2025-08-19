@extends('layouts.app')
@section('title','Produk')
@section('content')
<div class="card shadow rounded-2xl">
  <div class="card-body">
    <button class="btn btn-primary mb-3" data-toggle="modal" data-target="#modalNew">Tambah</button>
    <div class="table-responsive">
      <table id="datatable" class="table table-bordered table-striped" style="width:100%">
        <thead><tr><th>ID</th><th>Nama</th><th>Kategori</th><th>Harga</th><th>Stok</th><th>Aktif</th><th>Aksi</th></tr></thead>
      </table>
    </div>
  </div>
</div>

<div class="modal fade" id="modalNew"><div class="modal-dialog"><div class="modal-content">
  <div class="modal-header"><h5>Tambah Produk</h5><button class="close" data-dismiss="modal">&times;</button></div>
  <div class="modal-body">
    <form id="formNew">@csrf
      <div class="form-group"><label>Kategori</label>
        <select name="category_id" class="form-control" required>
          @foreach(\App\Models\Category::orderBy('name')->get() as $c)
            <option value="{{ $c->id }}">{{ $c->id }} - {{ $c->name }}</option>
          @endforeach
        </select>
      </div>
      <div class="form-group"><label>Nama</label><input name="name" class="form-control" required></div>
      <div class="form-group"><label>Harga</label><input name="price" type="number" class="form-control" required></div>
      <div class="form-group"><label>Stok</label><input name="stock" type="number" class="form-control" required></div>
      <div class="form-group form-check"><input type="checkbox" name="active" class="form-check-input" checked> <label class="form-check-label">Aktif</label></div>
      <button class="btn btn-primary">Simpan</button>
    </form>
  </div>
</div></div></div>

<div class="modal fade" id="modalEdit"><div class="modal-dialog"><div class="modal-content">
  <div class="modal-header"><h5>Edit Produk</h5><button class="close" data-dismiss="modal">&times;</button></div>
  <div class="modal-body">
    <form id="formEdit">@csrf
      <input type="hidden" name="id" id="edit_id">
      <div class="form-group"><label>Kategori</label>
        <select name="category_id" id="edit_category_id" class="form-control" required>
          @foreach(\App\Models\Category::orderBy('name')->get() as $c)
            <option value="{{ $c->id }}">{{ $c->id }} - {{ $c->name }}</option>
          @endforeach
        </select>
      </div>
      <div class="form-group"><label>Nama</label><input name="name" id="edit_name" class="form-control" required></div>
      <div class="form-group"><label>Harga</label><input name="price" id="edit_price" type="number" class="form-control" required></div>
      <div class="form-group"><label>Stok</label><input name="stock" id="edit_stock" type="number" class="form-control" required></div>
      <div class="form-group form-check"><input type="checkbox" name="active" id="edit_active" class="form-check-input"> <label class="form-check-label">Aktif</label></div>
      <button class="btn btn-primary">Update</button>
    </form>
  </div>
</div></div></div>
@endsection

@push('scripts')
<script>
const table = $('#datatable').DataTable({
  ajax: '{{ route('products.index') }}',
  columns: [
    { data: 'id' },
    { data: 'name' },
    { data: 'category' },
    { data: 'price', render: d=> 'Rp '+parseInt(d).toLocaleString('id-ID') },
    { data: 'stock' },
    { data: 'active', render: d => d?'<span class="badge badge-success">Ya</span>':'<span class="badge badge-secondary">Tidak</span>' },
    { data: null, render: r => `
      <button class="btn btn-sm btn-info" onclick="edit(${r.id})">Edit</button>
      <button class="btn btn-sm btn-danger" onclick="del(${r.id})">Hapus</button>` }
  ]
});

$('#formNew').on('submit',function(e){e.preventDefault();
  $.post('{{ route('products.store') }}', $(this).serialize()).done(()=>{ $('#modalNew').modal('hide'); table.ajax.reload(); })
});
function edit(id){
  $.post('{{ route('products.edit') }}',{_token:'{{ csrf_token() }}',id}).done(r=>{
    $('#edit_id').val(r.id); $('#edit_category_id').val(r.category_id); $('#edit_name').val(r.name);
    $('#edit_price').val(r.price); $('#edit_stock').val(r.stock); $('#edit_active').prop('checked', !!r.active);
    $('#modalEdit').modal('show');
  });
}
$('#formEdit').on('submit',function(e){e.preventDefault();
  $.post('{{ route('products.update') }}', $(this).serialize()).done(()=>{ $('#modalEdit').modal('hide'); table.ajax.reload(); })
});
function del(id){ if(!confirm('Hapus produk?')) return;
  $.post('{{ route('products.delete') }}',{_token:'{{ csrf_token() }}',id}).done(()=>table.ajax.reload()); }
</script>
@endpush
