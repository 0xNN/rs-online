@extends('dashboard.base')

@section('content')

@include('sinkron.data-ruangan-tempat-tidur.modal')
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
        <div class="card-header">Data Ruangan & Tempat Tidur
          <a href="{{ route('data-ruangan-tempat-tidur.create') }}" class="d-sm-inline-block btn btn-sm btn-success shadow-sm" id="tombol-utama">
            Tambah/Ubah
            {{-- <i class="cil-plus"></i> --}}
          </a>
        </div>
        <div class="card-body">
          {{-- <div class="table-responsive"> --}}
            <table id="dt-data-ruangan-tempat-tidur" class="table table-sm table-bordered dt-responsive nowrap" style="width:100%">
              <thead class="thead-info">
                <tr>
                  <th>#</th>
                  {{-- <th>ID</th> --}}
                  <th>Aksi</th>
                  <th>#</th>
                  <th>TT</th>
                  <th>Ruang</th>
                  <th>Jml Ruang</th>
                  <th>Jumlah</th>
                  <th>Terpakai</th>
                  <th>Antrian</th>
                  <th>Prepare</th>
                  <th>Prepare Plan</th>
                  <th>Covid</th>
                  <th>Tanggal Input</th>
                  <th>Tanggal Sinkron</th>
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
    var table = $('#dt-data-ruangan-tempat-tidur').DataTable({
      language: {
        url: '{{ asset('id.json') }}'
      },
      responsive: true,
      processing: true,
      serverSide: true,
      ajax: "{{ route('data-ruangan-tempat-tidur.index') }}",
      columns: [
        {data: 'DT_RowIndex', name: 'DT_RowIndex', searchable: false, orderable: false},
        // {data: 'id', name: 'id'},
        {data: 'action', name: 'action', searchable: false, orderable: false},
        {data: 'status_sinkron', name: 'status_sinkron', searchable: false, orderable: false},
        {data: 'tt', name: 'tt'},
        {data: 'ruang', name: 'ruang'},
        {data: 'jumlah_ruang', name: 'jumlah_ruang'},
        {data: 'jumlah', name: 'jumlah'},
        {data: 'terpakai', name: 'terpakai'},
        {data: 'antrian', name: 'antrian'},
        {data: 'prepare', name: 'prepare'},
        {data: 'prepare_plan', name: 'prepare_plan'},
        {data: 'covid', name: 'covid'},
        {data: 'tanggal_input', name: 'tanggal_input'},
        {data: 'tanggal_sinkron', name: 'tanggal_sinkron'},
      ],
      columnDefs: [ {
        className: 'dtr-control',
        orderable: false,
        targets:   [1]
      } ],
      order: [ 1, 'asc' ]
    });

    $('body').on('click','.sinkron',function(){
      var id = $(this).data('id');
      $.get('data-ruangan-tempat-tidur/'+id, function(data) {
        $('#modal-judul').html("Edit Post");
        $('#tombol-simpan').val("edit-post");
        $('#addUtamaModal').modal('show');
        $('#form-tambah-edit').trigger('reset');
        //set value masing-masing id berdasarkan data yg diperoleh dari ajax get request diatas
        $('#id').val(data.id);
        $('#tt').val(data.tt);
        $('#id_tt').val(data.id_tt).addClass(data.id_tt == null ? 'is-invalid': 'is-valid');
        $('#ruang').val(data.ruang).addClass(data.ruang == null ? 'is-invalid': 'is-valid');
        $('#jumlah_ruang').val(data.jumlah_ruang).addClass(data.jumlah_ruang == null ? 'is-invalid': 'is-valid');
        $('#jumlah').val(data.jumlah).addClass(data.jumlah == null ? 'is-invalid': 'is-valid');
        $('#terpakai').val(data.terpakai).addClass(data.terpakai == null ? 'is-invalid': 'is-valid');
        $('#antrian').val(data.antrian).addClass(data.antrian == null ? 'is-invalid': 'is-valid');
        $('#prepare').val(data.prepare).addClass(data.prepare == null ? 'is-invalid': 'is-valid');
        $('#prepare_plan').val(data.prepare_plan).addClass(data.prepare_plan == null ? 'is-invalid': 'is-valid');
        $('#covid').val(data.covid).addClass(data.covid == null ? 'is-invalid': 'is-valid');
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
                  url: "{{ route('data-ruangan-tempat-tidur.sinkronisasi') }}", //url simpan data
                  type: "POST", //karena simpan kita pakai method POST
                  dataType: 'json', //data tipe kita kirim berupa JSON
                  success: function (data) { //jika berhasil
                      $('#form-tambah-edit').trigger("reset"); //form reset
                      $('#addUtamaModal').modal('hide'); //modal hide
                      $('#tombol-simpan').html('Simpan'); //tombol simpan
                      var oTable = $('#dt-data-ruangan-tempat-tidur').dataTable(); //inialisasi datatable
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
      var idTTt = $(this).data('id_t_tt');

      var url = "{{ route('data-ruangan-tempat-tidur.destroy', ":dataId") }}";
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
                var oTable = $('#dt-data-ruangan-tempat-tidur').dataTable();
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
      console.log(tanggal);
    });
  });
</script>
@endsection