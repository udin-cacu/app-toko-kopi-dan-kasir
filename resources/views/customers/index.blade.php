@extends('layouts.app')
@section('title','Pelanggan')
@section('content')
<div class="card shadow rounded-2xl">
  <div class="card-body">
    <button class="btn btn-primary mb-3" data-toggle="modal" data-target="#modalNew">Tambah</button>
    <div class="table-responsive">
      <table id="datatable" class="table table-bordered table-striped" style="width:100%">
        <thead><tr><th>ID</th><th>Nama</th><th>Telepon</th><th>Email</th><th>Aksi</th></tr></thead>
      </table>
    </div>
  </div>
</div>

<div class="modal fade" id="modalNew"><div class="modal-dialog"><div class="modal-content">
  <div class="modal-header"><h5>Tambah Pelanggan</h5><button class="close" data-dismiss="modal">&times;</button></div>
  <div class="modal-body">
    <form id="formNew">@csrf
      <div class="form-group"><label>Nama</label><input name="name" class="form-control" required></div>
      <div class="form-group"><label>Telepon</label><input name="phone" class="form-control"></div>
      <div class="form-group"><label>Email</label><input name="email" type="email" class="form-control"></div>
      <button class="btn btn-primary">Simpan</button>
    </form>
  </div>
</div></div></div>

<div class="modal fade" id="modalEdit"><div class="modal-dialog"><div class="modal-content">
  <div class="modal-header"><h5>Edit Pelanggan</h5><button class="close" data-dismiss="modal">&times;</button></div>
  <div class="modal-body">
    <form id="formEdit">@csrf
      <input type="hidden" name="id" id="edit_id">
      <div class="form-group"><label>Nama</label><input name="name" id="edit_name" class="form-control" required></div>
      <div class="form-group"><label>Telepon</label><input name="phone" id="edit_phone" class="form-control"></div>
      <div class="form-group"><label>Email</label><input name="email" id="edit_email" type="email" class="form-control"></div>
      <button class="btn btn-primary">Update</button>
    </form>
  </div>
</div></div></div>
@endsection

@push('scripts')
<script>
const table = $('#datatable').DataTable({
  ajax: '{{ route('customers.index') }}',
  columns: [
    { data: 'id' },{ data: 'name' },{ data: 'phone' },{ data: 'email' },
    { data: null, render: r=>`<button class='btn btn-sm btn-info' onclick='edit(${r.id})'>Edit</button>
      <button class='btn btn-sm btn-danger' onclick='del(${r.id})'>Hapus</button>` }
  ]
});
$('#formNew').on('submit',e=>{e.preventDefault(); $.post('{{ route('customers.store') }}', $('#formNew').serialize()).done(()=>{ $('#modalNew').modal('hide'); table.ajax.reload(); });});
function edit(id){ $.post('{{ route('customers.edit') }}',{_token:'{{ csrf_token() }}',id}).done(r=>{ $('#edit_id').val(r.id);$('#edit_name').val(r.name);$('#edit_phone').val(r.phone);$('#edit_email').val(r.email);$('#modalEdit').modal('show');}); }
$('#formEdit').on('submit',e=>{e.preventDefault(); $.post('{{ route('customers.update') }}',$('#formEdit').serialize()).done(()=>{ $('#modalEdit').modal('hide'); table.ajax.reload(); });});
function del(id){ if(!confirm('Hapus pelanggan?')) return; $.post('{{ route('customers.delete') }}',{_token:'{{ csrf_token() }}',id}).done(()=>table.ajax.reload()); }
</script>
@endpush
