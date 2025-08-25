@extends('layouts.app')
@section('title','Produk')
@section('content')
<div class="card shadow rounded-2xl">
  <div class="card-body">
    <button class="btn btn-primary mb-3" data-toggle="modal" onclick="Tambah();" >Tambah</button>
    <div class="table-responsive">
      <table id="datatable" class="table table-bordered table-striped" style="width:100%">
        <thead>
          <tr>
            <th>Nomor</th>
            <th>Nama</th>
            <th>Kategori</th>
            <th>Harga</th>
            <th>Stok</th>
            <th>Aktif</th>
            <th>Gambar</th>
            <th>Aksi</th>
          </tr>
        </thead>
      </table>
    </div>
  </div>
</div>

<!-- Modal Tambah -->
<div class="modal fade" id="new">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5>Tambah Produk</h5>
        <button class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label>Kategori</label>
          <select name="category_id" id="category_id" class="form-control" required>
            @foreach(\App\Models\Category::orderBy('name')->get() as $c)
            <option value="{{ $c->id }}">{{ $c->id }} - {{ $c->name }}</option>
            @endforeach
          </select>
        </div>
        <div class="form-group">
          <label>Nama</label>
          <input name="name" class="form-control" id="name" required>
        </div>
        <div class="form-group">
          <label>Harga</label>
          <input name="price" type="number" class="form-control" id="price" required>
        </div>
        <div class="form-group">
          <label>Stok</label>
          <input name="stock" type="number" class="form-control" id="stock" required>
        </div>

        <div class="form-group" align="left" id="upload">
          <div class="photos"></div>
          <input class="imgsedit" name="img" type="hidden">
          <div onclick="$('#uploadfoto').click();" class="card-body" style="height: 100px;padding-top: 2.2rem;" align="center">
            <button class="btn btn-warning btn-block btn-sm">
              <i style="font-size:30px;color: #c5c5c5;" class="fa fa-camera"></i>
            </button>
          </div>
          <input id="uploadfoto" name="file" type="file" style="display:none;"/>
        </div>

        <div class="form-group form-check">
          <input type="checkbox" name="active" class="form-check-input" checked> 
          <label class="form-check-label">Aktif</label>
        </div>
        <button class="btn btn-primary" onclick="Simpan();">Simpan</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal Edit -->
<div class="modal fade" id="modalEdit">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5>Edit Produk</h5>
        <button class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <form id="formEdit">@csrf
          <input type="hidden" name="id" id="edit_id">
          <div class="form-group">
            <label>Kategori</label>
            <select name="category_id" id="edit_category_id" class="form-control" required>
              @foreach(\App\Models\Category::orderBy('name')->get() as $c)
              <option value="{{ $c->id }}">{{ $c->id }} - {{ $c->name }}</option>
              @endforeach
            </select>
          </div>
          <div class="form-group">
            <label>Nama</label>
            <input name="name" id="edit_name" class="form-control" required>
          </div>
          <div class="form-group">
            <label>Harga</label>
            <input name="price" id="edit_price" type="number" class="form-control" required>
          </div>
          <div class="form-group">
            <label>Stok</label>
            <input name="stock" id="edit_stock" type="number" class="form-control" required>
          </div>
          <div class="form-group form-check">
            <input type="checkbox" name="active" id="edit_active" class="form-check-input"> 
            <label class="form-check-label">Aktif</label>
          </div>
          <button class="btn btn-primary">Update</button>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection

@push('scripts')
<script>

  const table = $('#datatable').DataTable({
    ajax: '{{ route('products.index') }}',
    /*pageLength: 20,
    processing: true,
    serverSide: true,*/
    columns: [
      /*{ data: 'id' },*/
      {
        data: null,
        name: 'no',
        orderable: false,
        searchable: false,
        render: function (data, type, row, meta) {
          return meta.row + meta.settings._iDisplayStart + 1;
        }
      },
      { data: 'name' },
      { data: 'category' },
      { data: 'price', render: d=> 'Rp '+parseInt(d).toLocaleString('id-ID') },
      { data: 'stock' },
      { data: 'active', 
        render: d => d?'<span class="badge badge-success">Ya</span>':'<span class="badge badge-secondary">Tidak</span>' 
      },
      { 
        render: function ( data, type, row ) {

          return '<img class="file" width="50%" src="/assets2/images/'+row.img+'">';

        }
      },
      { data: null, 
        render: r => `<button class="btn btn-sm btn-info" onclick="edit(${r.id})">Edit</button>
        <button class="btn btn-sm btn-danger" onclick="del(${r.id})">Hapus</button>` 
      }

    ]
  });

  /*$('#formNew').on('submit', function(e)

    {e.preventDefault();

    $.post('{{ route('products.store') }}',

      $(this).serialize()).done(()=>{ 

        $('#modalNew').modal('hide'); 

        table.ajax.reload(); })

    });*/

  function Tambah(){

    $('#new').modal('show');

  }

  function Simpan(){


    $.ajax({
      type: 'POST',
      url: "{{ route('products.store') }}",
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      data: {
        '_token': $('input[name=_token]').val(),
        'name': $('#name').val(),
        'price': $('#price').val(),
        'stock': $('#stock').val(),
        'category_id': $('#category_id').val(),
        'img': $('.imgsedit').val(),

      },
      success: function(data) {

        $('#new').modal('hide');

        swal({
          title: "Success",
          text: "Products Transaksi Berhasil Tersimpan",
          icon: "success",
          buttons: false,
          timer: 2000,
        });

        table.ajax.reload();


      }

    });

  }

  function edit(id){

    $.post('{{ route('products.edit') }}',

      {_token:'{{ csrf_token() }}',id}).done(r=>{
        $('#edit_id').val(r.id); 
        $('#edit_category_id').val(r.category_id);
        $('#edit_name').val(r.name);
        $('#edit_price').val(r.price); 
        $('#edit_stock').val(r.stock); 
        $('#edit_active').prop('checked', !!r.active);


        $('#modalEdit').modal('show');
      });
    }

    $('#formEdit').on('submit', function(e)

      {e.preventDefault();

      $.post('{{ route('products.update') }}', 

        $(this).serialize()).done(()=>{ 

          $('#modalEdit').modal('hide'); 

          table.ajax.reload(); })
      });


    function del(id){ 

      if(!confirm('Hapus produk?')) 

        return;

      $.post('{{ route('products.delete') }}',

        {_token:'{{ csrf_token() }}',id}).done(()=>table.ajax.reload()); 
    }


    $("#uploadfoto").on("change", function() {

      $('.loading').attr('style','display: block');

      var formData = new FormData();
      formData.append('file', $('#uploadfoto')[0].files[0]);

      $.ajax({
        url: "{{ route('products.upload') }}",
        method:"POST",
        data: formData,
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        dataType:'JSON',
        contentType: false,
        cache: false,
        processData: false,

        success:function(data) {

          $('.loading').attr('style','display: none');

          if(data.status == '1'){

            $('.photos').html("<img width='100%' src='/assets2/images/"+data.name+"'>"); 
            $('.imgsedit').val(data.name);  
            $('#fotolama').attr('style','display: none');       

          } else {

            swal({
              title: "Gagal!",
              text: "Pastikan File yang Anda Upload Benar!",
              icon: "error",
              buttons: false,
              timer: 2000,
            });


          }
        }
      });

    });
  </script>
  @endpush
