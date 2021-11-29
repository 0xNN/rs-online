@extends('dashboard.base')

@section('content')

@include('sinkron.data-apd.modal')
  <div class="container-fluid">
    <div class="fade-in">
      @if (session('message'))
        <div class="alert alert-success">{{ session('message') }}</div>
      @endif
      <div class="card shadow">
        <div class="card-header">KETERANGAN</div>
        <div class="card-body">
          <table class="table table-sm table-bordered">
            <tr>
              <th class="align-middle"><i class="cil-check" style="color: green"></i></th>
              <th>Sudah pernah sinkronisasi <small class="text-success font-italic">( Data terintegrasi )</small></th>
            </tr>
            <tr>
              <th class="align-middle"><i class="cil-warning" style="color: red"></i></th>
              <th>Belum pernah sinkronisasi <small class="text-danger font-italic">( Data belum terintegrasi )</small></th>
            </tr>
          </table>
        </div>
      </div>
      <div class="card shadow-sm">
        <div class="card-header">Data APD
          <a href="{{ route('data-apd.create') }}" class="d-sm-inline-block btn btn-sm btn-success shadow-sm" id="tombol-utama">
            Tambah/Ubah
            {{-- <i class="cil-plus"></i> --}}
          </a>
        </div>
        <div class="card-body">
          {{-- <div class="table-responsive"> --}}
            <table id="dt-data-apd" class="table table-sm table-bordered dt-responsive nowrap" style="width:100%">
              <thead class="thead-info">
                <tr>
                  <th>#</th>
                  {{-- <th>ID</th> --}}
                  <th>Aksi</th>
                  <th>#</th>
                  <th>Kebutuhan</th>
                  <th>Jumlah Eksisting</th>
                  <th>Jumlah</th>
                  <th>Jumlah Diterima</th>
                </tr>
              </thead>
              <tbody></tbody>
            </table>
          {{-- </div> --}}
        </div>
      </div>
    </div>
  </div>
@endsection

@section('css')
<link rel="stylesheet" href="{{ asset('css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/responsive.dataTables.min.css') }}">
<link rel="stylesheet" href="{{ asset('dist/css/izitoast.min.css') }}">
<link rel="stylesheet" href="{{ asset('dist/css/iziModal.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/sweetalert2.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/jquery.datetimepicker.min.css') }}">
@endsection

@section('javascript')
{{-- <script src="{{ asset('js/main.js') }}" defer></script> --}}
<script src="{{ asset('js/jquery.min.js') }}"></script>
<script src="{{ asset('assets/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('dist/js/izitoast.min.js') }}"></script>
<script src="{{ asset('dist/js/iziModal.min.js') }}"></script>
<script src="{{ asset('js/select2.min.js') }}"></script>
<script src="{{ asset('js/sweetalert2.all.min.js') }}"></script>
<script src="{{ asset('js/jquery.datetimepicker.full.min.js') }}"></script>
<script src="{{ asset('js/plugins/jquery.validate.min.js') }}"></script>
<script>
  $(document).ready(function () {
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
  });

  $(document).ready(function () {
    var table = $('#dt-data-apd').DataTable({
      language: {
        url: '{{ asset('id.json') }}'
      },
      responsive: true,
      processing: true,
      serverSide: true,
      ajax: "{{ route('data-apd.index') }}",
      columns: [
        {data: 'DT_RowIndex', name: 'DT_RowIndex', searchable: false, orderable: false},
        // {data: 'id', name: 'id'},
        {data: 'action', name: 'action', searchable: false, orderable: false},
        {data: 'status_sinkron', name: 'status_sinkron', searchable: false, orderable: false},
        {data: 'kebutuhan', name: 'kebutuhan'},
        {data: 'jumlah_eksisting', name: 'jumlah_eksisting'},
        {data: 'jumlah', name: 'jumlah'},
        {data: 'jumlah_diterima', name: 'jumlah_diterima'},
      ],
      columnDefs: [ {
        className: 'dtr-control',
        orderable: false,
        targets:   []
      } ],
      order: [ 1, 'asc' ]
    });

    $('body').on('click','.sinkron',function(){
      var id = $(this).data('id');
      $.get('data-apd/'+id, function(data) {
        $('#modal-judul').html("Edit Post");
        $('#tombol-simpan').val("edit-post");
        $('#addUtamaModal').modal('show');
        $('#form-tambah-edit').trigger('reset');
        //set value masing-masing id berdasarkan data yg diperoleh dari ajax get request diatas
        $('#id').val(data.id);
        $('#id_kebutuhan').val(data.id_kebutuhan);
        $('#kebutuhan').val(data.kebutuhan);
        $('#jumlah_eksisting').val(data.jumlah_eksisting);
        $('#jumlah').val(data.jumlah);
        $('#jumlah_diterima').val(data.jumlah_diterima);
      });
    });

    if ($("#form-tambah-edit").length > 0) {
      $("#form-tambah-edit").validate({
          submitHandler: function (form) {
              var actionType = $('#tombol-simpan').val();
              $('#tombol-simpan').html('Sending..');
              $.ajax({
                  data: $('#form-tambah-edit')
                      .serialize(), //function yang dipakai agar value pada form-control seperti input, textarea, select dll dapat digunakan pada URL query string ketika melakukan ajax request
                  url: "{{ route('data-apd.sinkronisasi') }}", //url simpan data
                  type: "POST", //karena simpan kita pakai method POST
                  dataType: 'json', //data tipe kita kirim berupa JSON
                  success: function (data) { //jika berhasil
                      $('#form-tambah-edit').trigger("reset"); //form reset
                      $('#addUtamaModal').modal('hide'); //modal hide
                      $('#tombol-simpan').html('Simpan'); //tombol simpan
                      var oTable = $('#dt-data-apd').dataTable(); //inialisasi datatable
                      oTable.fnDraw(false); //reset datatable

                      if(data.code == 200) {
                        iziToast.success({
                            title: 'Successfully',
                            message: data.message,
                            position: 'bottomRight'
                        });
                      }

                      if(data.code == 401) {
                        iziToast.error({
                            title: 'Error',
                            message: data.message,
                            position: 'bottomRight'
                        });
                      }
                  },
                  error: function (data) { //jika error tampilkan error pada console
                      console.log('Error:', data);
                      $('#tombol-simpan').html('Simpan');
                  }
              });
          }
      })
    }

    $('body').on('click','.delete',function() {
      var dataId = $(this).data('id');
      var url = "{{ route('data-apd.destroy', ":dataId") }}";
      url = url.replace(':dataId', dataId);

      Swal.fire({
        title: 'Konfirmasi?',
        text: "Apakah anda yakin ingin menghapus data ini!",
        icon: 'warning',
        showCancelButton: true,
        cancelButtonText: "Tidak",
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, Hapus!'
      }).then((result) => {
        if (result.isConfirmed) {
          $.ajax({
            url: url, //eksekusi ajax ke url ini
            type: 'delete',
            beforeSend: function () {
                $('#tombol-utama-hapus').text('Hapus Data'); //set text untuk tombol hapus
            },
            success: function (data) { //jika sukses
              setTimeout(function () {
                var oTable = $('#dt-data-apd').dataTable();
                oTable.fnDraw(false); //reset datatable
              });
              Swal.fire(
                'Deleted!',
                data.message,
                'success'
              )
            }
          })
        }
      })
      // console.log(tanggal);
    });
  });
</script>
@endsection