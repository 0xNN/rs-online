@extends('dashboard.base')

@section('content')

@include('sinkron.pasien-masuk.modal')
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
        <div class="card-header">Data Rekap Pasien Masuk 
          <a href="{{ route('pasien-masuk.create') }}" class="d-sm-inline-block btn btn-sm btn-success shadow-sm" id="tombol-utama">
            Tambah/Ubah
            {{-- <i class="cil-plus"></i> --}}
          </a>
        </div>
        <div class="card-body">
          {{-- <div class="table-responsive"> --}}
            <table id="dt-rekap-pasien-masuk" class="table table-sm table-bordered dt-responsive nowrap" style="width:100%">
              <thead class="thead-info">
                <tr>
                  <th>#</th>
                  {{-- <th>ID</th> --}}
                  <th>Aksi</th>
                  <th>Tanggal</th>
                  {{-- <th>Status</th> --}}
                  <th>IGD Suspect L</th>
                  <th>IGD Suspect P</th>
                  <th>IGD Confirm L</th>
                  <th>IGD Confirm P</th>
                  <th>RJ Suspect L</th>
                  <th>RJ Suspect P</th>
                  <th>RJ Confirm L</th>
                  <th>RJ Confirm P</th>
                  <th>RI Suspect L</th>
                  <th>RI Suspect P</th>
                  <th>RI Confirm L</th>
                  <th>RI Confirm P</th>
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
    var table = $('#dt-rekap-pasien-masuk').DataTable({
      language: {
        url: '{{ asset('id.json') }}'
      },
      responsive: true,
      processing: true,
      serverSide: true,
      ajax: "{{ route('pasien-masuk.index') }}",
      columns: [
        {data: 'DT_RowIndex', name: 'DT_RowIndex'},
        // {data: 'id', name: 'id'},
        {data: 'action', name: 'action'},
        {data: 'tanggal', name: 'tanggal'},
        // {data: 'status_sinkron', name: 'status_sinkron'},
        {data: 'igd_suspect_l', name: 'igd_suspect_l'},
        {data: 'igd_suspect_p', name: 'igd_suspect_p'},
        {data: 'igd_confirm_l', name: 'igd_confirm_l'},
        {data: 'igd_confirm_p', name: 'igd_confirm_p'},
        {data: 'rj_suspect_l', name: 'rj_suspect_l'},
        {data: 'rj_suspect_p', name: 'rj_suspect_p'},
        {data: 'rj_confirm_l', name: 'rj_confirm_l'},
        {data: 'rj_confirm_p', name: 'rj_confirm_p'},
        {data: 'ri_suspect_l', name: 'ri_suspect_l'},
        {data: 'ri_suspect_p', name: 'ri_suspect_p'},
        {data: 'ri_confirm_l', name: 'ri_confirm_l'},
        {data: 'ri_confirm_p', name: 'ri_confirm_p'},
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
      $.get('pasien-masuk/'+id, function(data) {
        $('#modal-judul').html("Edit Post");
        $('#tombol-simpan').val("edit-post");
        $('#addUtamaModal').modal('show');
        $('#form-tambah-edit').trigger('reset');
        //set value masing-masing id berdasarkan data yg diperoleh dari ajax get request diatas
        $('#id').val(data.id);
        $('#tanggal').val(data.tanggal).addClass(data.tanggal == null ? 'is-invalid': 'is-valid');
        $('#igd_suspect_l').val(data.igd_suspect_l).addClass(data.igd_suspect_l == null ? 'is-invalid': 'is-valid');
        $('#igd_suspect_p').val(data.igd_suspect_p).addClass(data.igd_suspect_p == null ? 'is-invalid': 'is-valid');
        $('#igd_confirm_l').val(data.igd_confirm_l).addClass(data.igd_confirm_l == null ? 'is-invalid': 'is-valid');
        $('#igd_confirm_p').val(data.igd_confirm_p).addClass(data.igd_confirm_p == null ? 'is-invalid': 'is-valid');
        $('#rj_suspect_l').val(data.rj_suspect_l).addClass(data.rj_suspect_l == null ? 'is-invalid': 'is-valid');
        $('#rj_suspect_p').val(data.rj_suspect_p).addClass(data.rj_suspect_p == null ? 'is-invalid': 'is-valid');
        $('#rj_confirm_l').val(data.rj_confirm_l).addClass(data.rj_confirm_l == null ? 'is-invalid': 'is-valid');
        $('#rj_confirm_p').val(data.rj_confirm_p).addClass(data.rj_confirm_p == null ? 'is-invalid': 'is-valid');
        $('#ri_suspect_l').val(data.ri_suspect_l).addClass(data.ri_suspect_l == null ? 'is-invalid': 'is-valid');
        $('#ri_suspect_p').val(data.ri_suspect_p).addClass(data.ri_suspect_p == null ? 'is-invalid': 'is-valid');
        $('#ri_confirm_l').val(data.ri_confirm_l).addClass(data.ri_confirm_l == null ? 'is-invalid': 'is-valid');
        $('#ri_confirm_p').val(data.ri_confirm_p).addClass(data.ri_confirm_p == null ? 'is-invalid': 'is-valid');
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
                  url: "{{ route('pasien-masuk.sinkronisasi') }}", //url simpan data
                  type: "POST", //karena simpan kita pakai method POST
                  dataType: 'json', //data tipe kita kirim berupa JSON
                  success: function (data) { //jika berhasil
                      $('#form-tambah-edit').trigger("reset"); //form reset
                      $('#addUtamaModal').modal('hide'); //modal hide
                      $('#tombol-simpan').html('Simpan'); //tombol simpan
                      var oTable = $('#dt-rekap-pasien-masuk').dataTable(); //inialisasi datatable
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
      var tanggal = $(this).data('tanggal');

      var url = "{{ route('pasien-masuk.destroy', ":dataId") }}";
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
                var oTable = $('#dt-rekap-pasien-masuk').dataTable();
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