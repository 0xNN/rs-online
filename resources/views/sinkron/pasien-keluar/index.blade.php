@extends('dashboard.base')

@section('content')

@include('sinkron.pasien-keluar.modal')
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
        <div class="card-header">Data Rekap Pasien Keluar
          <a href="{{ route('pasien-keluar.create') }}" class="d-sm-inline-block btn btn-sm btn-success shadow-sm" id="tombol-utama">
            Tambah/Ubah
            {{-- <i class="cil-plus"></i> --}}
          </a>
        </div>
        <div class="card-body">
          {{-- <div class="table-responsive"> --}}
            <table id="dt-rekap-pasien-keluar" class="table table-sm table-bordered dt-responsive nowrap" style="width:100%">
              <thead class="thead-info">
                <tr>
                  <th>#</th>
                  {{-- <th>ID</th> --}}
                  <th>Aksi</th>
                  <th>Tanggal</th>
                  {{-- <th>Status</th> --}}
                  <th>Sembuh</th>
                  <th>Discarded</th>
                  <th>Meninggal Komorbid</th>
                  <th>Meninggal -Komorbid</th>
                  <th>Meninggal Prob Pre Komorbid</th>
                  <th>Meninggal Prob Neo Komorbid</th>
                  <th>Meninggal Prob Bayi Komorbid</th>
                  <th>Meninggal Prob Balita Komorbid</th>
                  <th>Meninggal Prob Anak Komorbid</th>
                  <th>Meninggal Prob Remaja Komorbid</th>
                  <th>Meninggal Prob Dws Komorbid</th>
                  <th>Meninggal Prob Lansia Komorbid</th>
                  <th>Meninggal Prob Pre -Komorbid</th>
                  <th>Meninggal Prob Neo -Komorbid</th>
                  <th>Meninggal Prob Bayi -Komorbid</th>
                  <th>Meninggal Prob Balita -Komorbid</th>
                  <th>Meninggal Prob Anak -Komorbid</th>
                  <th>Meninggal Prob Remaja -Komorbid</th>
                  <th>Meninggal Prob Dws -Komorbid</th>
                  <th>Meninggal Prob Lansia -Komorbid</th>
                  <th>Meninggal Discarded Komorbid</th>
                  <th>Meninggal Discarded -Komorbid</th>
                  <th>Dirujuk</th>
                  <th>Isman</th>
                  <th>APS</th>
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
    var table = $('#dt-rekap-pasien-keluar').DataTable({
      language: {
        url: '{{ asset('id.json') }}'
      },
      responsive: true,
      processing: true,
      serverSide: true,
      ajax: "{{ route('pasien-keluar.index') }}",
      columns: [
        {data: 'DT_RowIndex', name: 'DT_RowIndex'},
        // {data: 'id', name: 'id'},
        {data: 'action', name: 'action'},
        {data: 'tanggal', name: 'tanggal'},
        // {data: 'status_sinkron', name: 'status_sinkron'},
        {data: 'sembuh', name: 'sembuh'},
        {data: 'discarded', name: 'discarded'},
        {data: 'meninggal_komorbid', name: 'meninggal_komorbid'},
        {data: 'meninggal_tanpa_komorbid', name: 'meninggal_tanpa_komorbid'},
        {data: 'meninggal_prob_pre_komorbid', name: 'meninggal_prob_pre_komorbid'},
        {data: 'meninggal_prob_neo_komorbid', name: 'meninggal_prob_neo_komorbid'},
        {data: 'meninggal_prob_bayi_komorbid', name: 'meninggal_prob_bayi_komorbid'},
        {data: 'meninggal_prob_balita_komorbid', name: 'meninggal_prob_balita_komorbid'},
        {data: 'meninggal_prob_anak_komorbid', name: 'meninggal_prob_anak_komorbid'},
        {data: 'meninggal_prob_remaja_komorbid', name: 'meninggal_prob_remaja_komorbid'},
        {data: 'meninggal_prob_dws_komorbid', name: 'meninggal_prob_dws_komorbid'},
        {data: 'meninggal_prob_lansia_komorbid', name: 'meninggal_prob_lansia_komorbid'},
        {data: 'meninggal_prob_pre_tanpa_komorbid', name: 'meninggal_prob_pre_tanpa_komorbid'},
        {data: 'meninggal_prob_neo_tanpa_komorbid', name: 'meninggal_prob_neo_tanpa_komorbid'},
        {data: 'meninggal_prob_bayi_tanpa_komorbid', name: 'meninggal_prob_bayi_tanpa_komorbid'},
        {data: 'meninggal_prob_balita_tanpa_komorbid', name: 'meninggal_prob_balita_tanpa_komorbid'},
        {data: 'meninggal_prob_anak_tanpa_komorbid', name: 'meninggal_prob_anak_tanpa_komorbid'},
        {data: 'meninggal_prob_remaja_tanpa_komorbid', name: 'meninggal_prob_remaja_tanpa_komorbid'},
        {data: 'meninggal_prob_dws_tanpa_komorbid', name: 'meninggal_prob_dws_tanpa_komorbid'},
        {data: 'meninggal_prob_lansia_tanpa_komorbid', name: 'meninggal_prob_lansia_tanpa_komorbid'},
        {data: 'meninggal_discarded_komorbid', name: 'meninggal_discarded_komorbid'},
        {data: 'meninggal_discarded_tanpa_komorbid', name: 'meninggal_discarded_tanpa_komorbid'},
        {data: 'dirujuk', name: 'dirujuk'},
        {data: 'isman', name: 'isman'},
        {data: 'aps', name: 'aps'},
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
      $.get('pasien-keluar/'+id, function(data) {
        $('#modal-judul').html("Edit Post");
        $('#tombol-simpan').val("edit-post");
        $('#addUtamaModal').modal('show');
        $('#form-tambah-edit').trigger('reset');
        //set value masing-masing id berdasarkan data yg diperoleh dari ajax get request diatas
        $('#id').val(data.id);
        $('#tanggal').val(data.tanggal).addClass(data.tanggal == null ? 'is-invalid': 'is-valid');
        $('#sembuh').val(data.sembuh).addClass(data.sembuh == null ? 'is-invalid': 'is-valid');
        $('#discarded').val(data.discarded).addClass(data.discarded == null ? 'is-invalid': 'is-valid');
        $('#meninggal_komorbid').val(data.meninggal_komorbid).addClass(data.meninggal_komorbid == null ? 'is-invalid': 'is-valid');
        $('#meninggal_tanpa_komorbid').val(data.meninggal_tanpa_komorbid).addClass(data.meninggal_tanpa_komorbid == null ? 'is-invalid': 'is-valid');
        $('#meninggal_prob_pre_komorbid').val(data.meninggal_prob_pre_komorbid).addClass(data.meninggal_prob_pre_komorbid == null ? 'is-invalid': 'is-valid');
        $('#meninggal_prob_neo_komorbid').val(data.meninggal_prob_neo_komorbid).addClass(data.meninggal_prob_neo_komorbid == null ? 'is-invalid': 'is-valid');
        $('#meninggal_prob_bayi_komorbid').val(data.meninggal_prob_bayi_komorbid).addClass(data.meninggal_prob_bayi_komorbid == null ? 'is-invalid': 'is-valid');
        $('#meninggal_prob_balita_komorbid').val(data.meninggal_prob_balita_komorbid).addClass(data.meninggal_prob_balita_komorbid == null ? 'is-invalid': 'is-valid');
        $('#meninggal_prob_anak_komorbid').val(data.meninggal_prob_anak_komorbid).addClass(data.meninggal_prob_anak_komorbid == null ? 'is-invalid': 'is-valid');
        $('#meninggal_prob_remaja_komorbid').val(data.meninggal_prob_remaja_komorbid).addClass(data.meninggal_prob_remaja_komorbid == null ? 'is-invalid': 'is-valid');
        $('#meninggal_prob_dws_komorbid').val(data.meninggal_prob_dws_komorbid).addClass(data.meninggal_prob_dws_komorbid == null ? 'is-invalid': 'is-valid');
        $('#meninggal_prob_lansia_komorbid').val(data.meninggal_prob_lansia_komorbid).addClass(data.meninggal_prob_lansia_komorbid == null ? 'is-invalid': 'is-valid');
        $('#meninggal_prob_pre_tanpa_komorbid').val(data.meninggal_prob_pre_tanpa_komorbid).addClass(data.meninggal_prob_pre_tanpa_komorbid == null ? 'is-invalid': 'is-valid');
        $('#meninggal_prob_neo_tanpa_komorbid').val(data.meninggal_prob_neo_tanpa_komorbid).addClass(data.meninggal_prob_neo_tanpa_komorbid == null ? 'is-invalid': 'is-valid');
        $('#meninggal_prob_bayi_tanpa_komorbid').val(data.meninggal_prob_bayi_tanpa_komorbid).addClass(data.meninggal_prob_bayi_tanpa_komorbid == null ? 'is-invalid': 'is-valid');
        $('#meninggal_prob_balita_tanpa_komorbid').val(data.meninggal_prob_balita_tanpa_komorbid).addClass(data.meninggal_prob_balita_tanpa_komorbid == null ? 'is-invalid': 'is-valid');
        $('#meninggal_prob_anak_tanpa_komorbid').val(data.meninggal_prob_anak_tanpa_komorbid).addClass(data.meninggal_prob_anak_tanpa_komorbid == null ? 'is-invalid': 'is-valid');
        $('#meninggal_prob_remaja_tanpa_komorbid').val(data.meninggal_prob_remaja_tanpa_komorbid).addClass(data.meninggal_prob_remaja_tanpa_komorbid == null ? 'is-invalid': 'is-valid');
        $('#meninggal_prob_dws_tanpa_komorbid').val(data.meninggal_prob_dws_tanpa_komorbid).addClass(data.meninggal_prob_dws_tanpa_komorbid == null ? 'is-invalid': 'is-valid');
        $('#meninggal_prob_lansia_tanpa_komorbid').val(data.meninggal_prob_lansia_tanpa_komorbid).addClass(data.meninggal_prob_lansia_tanpa_komorbid == null ? 'is-invalid': 'is-valid');
        $('#meninggal_discarded_komorbid').val(data.meninggal_discarded_komorbid).addClass(data.meninggal_discarded_komorbid == null ? 'is-invalid': 'is-valid');
        $('#meninggal_discarded_tanpa_komorbid').val(data.meninggal_discarded_tanpa_komorbid).addClass(data.meninggal_discarded_tanpa_komorbid == null ? 'is-invalid': 'is-valid');
        $('#dirujuk').val(data.dirujuk).addClass(data.dirujuk == null ? 'is-invalid': 'is-valid');
        $('#isman').val(data.isman).addClass(data.isman == null ? 'is-invalid': 'is-valid');
        $('#aps').val(data.aps).addClass(data.aps == null ? 'is-invalid': 'is-valid');
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
                  url: "{{ route('pasien-keluar.sinkronisasi') }}", //url simpan data
                  type: "POST", //karena simpan kita pakai method POST
                  dataType: 'json', //data tipe kita kirim berupa JSON
                  success: function (data) { //jika berhasil
                      $('#form-tambah-edit').trigger("reset"); //form reset
                      $('#addUtamaModal').modal('hide'); //modal hide
                      $('#tombol-simpan').html('Simpan'); //tombol simpan
                      var oTable = $('#dt-rekap-pasien-keluar').dataTable(); //inialisasi datatable
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

      var url = "{{ route('pasien-keluar.destroy', ":dataId") }}";
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
                var oTable = $('#dt-rekap-pasien-keluar').dataTable();
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