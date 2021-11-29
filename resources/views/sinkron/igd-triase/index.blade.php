@extends('dashboard.base')

@section('content')

@include('sinkron.igd-triase.modal')
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
            <tr>
              <th class="align-middle"><button class="btn btn-info btn-sm sinkron-range"><i class="cil-loop-circular"></i></button></th>
              <th>
                <div class="input-group input-group-sm">
                  <div class="input-group-prepend">
                    <label class="input-group-text" for="inputGroupSelect01">Dari</label>
                  </div>
                  <input type="text" class="form-control" id="start_date" name="start_date">
                  <div class="input-group-prepend">
                    <label class="input-group-text" for="inputGroupSelect01">Sampai</label>
                  </div>
                  <input type="text" class="form-control" id="end_date" name="end_date">
                </div>
              </th>
            </tr>
          </table>
        </div>
      </div>
      <div class="card shadow-sm">
        <div class="card-header">Data IGD Triase
          <a href="{{ route('igd-triase.create') }}" class="d-sm-inline-block btn btn-sm btn-success shadow-sm" id="tombol-utama">
            Tambah/Ubah
            {{-- <i class="cil-plus"></i> --}}
          </a>
        </div>
        <div class="card-body">
          {{-- <div class="table-responsive"> --}}
            <table id="dt-rekap-igd-triase" class="table table-sm table-bordered dt-responsive nowrap" style="width:100%">
              <thead class="thead-info">
                <tr>
                  <th>#</th>
                  {{-- <th>ID</th> --}}
                  <th>Aksi</th>
                  <th>Tanggal</th>
                  {{-- <th>Status</th> --}}
                  <th>IGD Suspek</th>
                  <th>TGD Konfirmasi</th>
                  <th>G Ringan Murni Covid</th>
                  <th>G Ringan Komorbid</th>
                  <th>G Ringan Koinsiden</th>
                  <th>G Sedang</th>
                  <th>G Berat</th>
                  <th>IGD Dirujuk</th>
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
    var table = $('#dt-rekap-igd-triase').DataTable({
      language: {
        url: '{{ asset('id.json') }}'
      },
      responsive: true,
      processing: true,
      serverSide: true,
      ajax: "{{ route('igd-triase.index') }}",
      columns: [
        {data: 'DT_RowIndex', name: 'DT_RowIndex', searchable: false, orderable: false},
        // {data: 'id', name: 'id'},
        {data: 'action', name: 'action', searchable: false, orderable: false},
        {data: 'tanggal', name: 'tanggal'},
        // {data: 'status_sinkron', name: 'status_sinkron'},
        {data: 'igd_suspek', name: 'igd_suspek'},
        {data: 'igd_konfirmasi', name: 'igd_konfirmasi'},
        {data: 'g_ringan_murni_covid', name: 'g_ringan_murni_covid'},
        {data: 'g_ringan_komorbid', name: 'g_ringan_komorbid'},
        {data: 'g_ringan_koinsiden', name: 'g_ringan_koinsiden'},
        {data: 'g_sedang', name: 'g_sedang'},
        {data: 'g_berat', name: 'g_berat'},
        {data: 'igd_dirujuk', name: 'igd_dirujuk'},
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
      $.get('igd-triase/'+id, function(data) {
        $('#modal-judul').html("Edit Post");
        $('#tombol-simpan').val("edit-post");
        $('#addUtamaModal').modal('show');
        $('#form-tambah-edit').trigger('reset');
        //set value masing-masing id berdasarkan data yg diperoleh dari ajax get request diatas
        $('#id').val(data.id);
        $('#tanggal').val(data.tanggal).addClass(data.tanggal == null ? 'is-invalid': 'is-valid');
        $('#igd_suspek').val(data.igd_suspek).addClass(data.igd_suspek == null ? 'is-invalid': 'is-valid');
        $('#igd_konfirmasi').val(data.igd_konfirmasi).addClass(data.igd_konfirmasi == null ? 'is-invalid': 'is-valid');
        $('#g_ringan_murni_covid').val(data.g_ringan_murni_covid).addClass(data.g_ringan_murni_covid == null ? 'is-invalid': 'is-valid');
        $('#g_ringan_komorbid').val(data.g_ringan_komorbid).addClass(data.g_ringan_komorbid == null ? 'is-invalid': 'is-valid');
        $('#g_ringan_koinsiden').val(data.g_ringan_koinsiden).addClass(data.g_ringan_koinsiden == null ? 'is-invalid': 'is-valid');
        $('#g_sedang').val(data.g_sedang).addClass(data.g_sedang == null ? 'is-invalid': 'is-valid');
        $('#g_berat').val(data.g_berat).addClass(data.g_berat == null ? 'is-invalid': 'is-valid');
        $('#igd_dirujuk').val(data.igd_dirujuk).addClass(data.igd_dirujuk == null ? 'is-invalid': 'is-valid');
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
                  url: "{{ route('igd-triase.sinkronisasi') }}", //url simpan data
                  type: "POST", //karena simpan kita pakai method POST
                  dataType: 'json', //data tipe kita kirim berupa JSON
                  success: function (data) { //jika berhasil
                      $('#form-tambah-edit').trigger("reset"); //form reset
                      $('#addUtamaModal').modal('hide'); //modal hide
                      $('#tombol-simpan').html('Simpan'); //tombol simpan
                      var oTable = $('#dt-rekap-igd-triase').dataTable(); //inialisasi datatable
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

      var url = "{{ route('igd-triase.destroy', ":dataId") }}";
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
                var oTable = $('#dt-rekap-igd-triase').dataTable();
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

    jQuery('#start_date').datetimepicker({
      format:'Y-m-d',
      onShow:function( ct ){
      this.setOptions({
        maxDate:jQuery('#end_date').val()?jQuery('#end_date').val():false
      })
      },
      timepicker:false
    });
    jQuery('#end_date').datetimepicker({
      format:'Y-m-d',
      onShow:function( ct ){
      this.setOptions({
        minDate:jQuery('#start_date').val()?jQuery('#start_date').val():false
      })
      },
      timepicker:false
    });

    jQuery('.sinkron-range').click(function() {
      var start_date = $('#start_date').val();
      var end_date = $('#end_date').val();
      $(this).prop('disabled', true);
      $.ajax({
        data: {
          start_date: start_date,
          end_date: end_date
        },
        url: "{{ route('igd-triase.range') }}",
        type: "POST",
        dataType: "json",
        success: function(data) {
          if(data.code == 200) {
            $('.sinkron-range').prop('disabled', false);
            iziToast.success({
                title: 'Successfully',
                message: data.message,
                position: 'bottomRight'
            });
            var oTable = $('#dt-rekap-igd-triase').dataTable(); //inialisasi datatable
            oTable.fnDraw(false); //reset datatable
          } else {
            $('.sinkron-range').prop('disabled', false);
            iziToast.error({
                title: 'Successfully',
                message: data.message,
                position: 'bottomRight'
            });
            var oTable = $('#dt-rekap-igd-triase').dataTable(); //inialisasi datatable
            oTable.fnDraw(false); //reset datatable
          }
        },
        error: function(data) {
          console.log('Error:', data);
          $('.sinkron-range').prop('disabled', false);
        }
      });
      console.log(start_date);
    });
  });
</script>
@endsection