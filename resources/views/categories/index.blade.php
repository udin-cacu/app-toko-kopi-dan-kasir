@extends('layouts.app')
@section('title','Kategori Produk')
@section('content')
<div class="card shadow rounded-2xl">
  <div class="card-body">
    <button class="btn btn-primary mb-3" data-toggle="modal" data-target="#modalNew">Tambah</button>
    <div class="table-responsive">
      <table id="datatable" class="table table-bordered table-striped" style="width:100%">
        <thead><tr><th>#</th><th>Nama</th><th>Jumlah Produk</th><th>Aksi</th></tr></thead>
      </table>
    </div>
  </div>
</div>

<div class="modal fade" id="modalNew"><div class="modal-dialog"><div class="modal-content">
  <div class="modal-header"><h5>Tambah Kategori</h5><button class="close" data-dismiss="modal">&times;</button></div>
  <div class="modal-body">
    <form id="formNew">@csrf
      <div class="form-group"><label>Nama</label><input name="name" class="form-control" required></div>
      <button class="btn btn-primary">Simpan</button>
    </form>
  </div>
</div></div></div>

<div class="modal fade" id="modalEdit"><div class="modal-dialog"><div class="modal-content">
  <div class="modal-header"><h5>Edit Kategori</h5><button class="close" data-dismiss="modal">&times;</button></div>
  <div class="modal-body">
    <form id="formEdit">@csrf
      <input type="hidden" name="id" id="edit_id">
      <div class="form-group"><label>Nama</label><input name="name" id="edit_name" class="form-control" required></div>
      <button class="btn btn-primary">Update</button>
    </form>
  </div>
</div></div></div>
@endsection

@push('scripts')
<script>
const table = $('#datatable').DataTable({
  ajax: '{{ route('categories.index') }}',
  columns: [
    { data: 'id' },
    { data: 'name' },
    { data: 'product_count' },
    { data: null, render: r => `
      <button class="btn btn-sm btn-info" onclick="edit(${r.id})">Edit</button>
      <button class="btn btn-sm btn-danger" onclick="del(${r.id})">Hapus</button>` }
  ]
});

$('#formNew').on('submit', function(e){ e.preventDefault();
  $.post('{{ route('categories.store') }}', $(this).serialize()).done(()=>{
    $('#modalNew').modal('hide'); table.ajax.reload();
  });
});

function edit(id){
  $.post('{{ route('categories.edit') }}',{_token:'{{ csrf_token() }}',id}).done(res=>{
    $('#edit_id').val(res.id); $('#edit_name').val(res.name); $('#modalEdit').modal('show');
  })
}
$('#formEdit').on('submit', function(e){ e.preventDefault();
  $.post('{{ route('categories.update') }}', $(this).serialize()).done(()=>{
    $('#modalEdit').modal('hide'); table.ajax.reload();
  });
});
function del(id){ if(!confirm('Hapus kategori?')) return;
  $.post('{{ route('categories.delete') }}',{_token:'{{ csrf_token() }}',id}).done(()=>table.ajax.reload());
}
</script>
@endpush
