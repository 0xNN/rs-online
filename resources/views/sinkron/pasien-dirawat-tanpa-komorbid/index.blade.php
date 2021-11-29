@extends('dashboard.base')

@section('content')

@include('sinkron.pasien-dirawat-tanpa-komorbid.modal')
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
        <div class="card-header">Data Rekap Pasien Dirawat Tanpa Komorbid
          <a href="{{ route('pasien-dirawat-tanpa-komorbid.create') }}" class="d-sm-inline-block btn btn-sm btn-success shadow-sm" id="tombol-utama">
            Tambah/Ubah
            {{-- <i class="cil-plus"></i> --}}
          </a>
        </div>
        <div class="card-body">
          {{-- <div class="table-responsive"> --}}
            <table id="dt-rekap-pasien-dirawat-tanpa-komorbid" class="table table-sm table-bordered dt-responsive nowrap" style="width:100%">
              <thead class="thead-info">
                <tr>
                  <th>#</th>
                  {{-- <th>ID</th> --}}
                  <th>Aksi</th>
                  <th>Tanggal</th>
                  {{-- <th>Status</th> --}}
                  <th>Icu Ventilator S. L</th>
                  <th>Icu Ventilator S. P</th>
                  <th>Icu Ventilator C. L</th>
                  <th>Icu Ventilator C. P</th>
                  <th>Icu -Ventilator S. L</th>
                  <th>Icu -Ventilator S. P</th>
                  <th>Icu -Ventilator C. L</th>
                  <th>Icu -Ventilator C. P</th>
                  <th>Icu T.N Ventilator S. L</th>
                  <th>Icu T.N Ventilator S. P</th>
                  <th>Icu T.N Ventilator C. L</th>
                  <th>Icu T.N Ventilator C. P</th>
                  <th>Icu T.N -Ventilator S. L</th>
                  <th>Icu T.N -Ventilator S. P</th>
                  <th>Icu T.N -Ventilator C. L</th>
                  <th>Icu T.N -Ventilator C. P</th>
                  <th>Isolasi T.N S. L</th>
                  <th>Isolasi T.N S. P</th>
                  <th>Isolasi T.N C. L</th>
                  <th>Isolasi T.N C. P</th>
                  <th>Isolasi -T.N S. L</th>
                  <th>Isolasi -T.N S. P</th>
                  <th>Isolasi -T.N C. L</th>
                  <th>Isolasi -T.N C. P</th>
                  <th>Nicu Khusus Covid S. L</th>
                  <th>Nicu Khusus Covid S. P</th>
                  <th>Nicu Khusus Covid C. L</th>
                  <th>Nicu Khusus Covid C. P</th>
                  <th>Picu Khusus Covid S. L</th>
                  <th>Picu Khusus Covid S. P</th>
                  <th>Picu Khusus Covid C. L</th>
                  <th>Picu Khusus Covid C. P</th>
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
    var table = $('#dt-rekap-pasien-dirawat-tanpa-komorbid').DataTable({
      language: {
        url: '{{ asset('id.json') }}'
      },
      responsive: true,
      processing: true,
      serverSide: true,
      ajax: "{{ route('pasien-dirawat-tanpa-komorbid.index') }}",
      columns: [
        {data: 'DT_RowIndex', name: 'DT_RowIndex', searchable: false, orderable: false},
        // {data: 'id', name: 'id'},
        {data: 'action', name: 'action', searchable: false, orderable: false},
        {data: 'tanggal', name: 'tanggal'},
        // {data: 'status_sinkron', name: 'status_sinkron'},
        {data: 'icu_dengan_ventilator_suspect_l', name: 'icu_dengan_ventilator_suspect_l'},
        {data: 'icu_dengan_ventilator_suspect_p', name: 'icu_dengan_ventilator_suspect_p'},
        {data: 'icu_dengan_ventilator_confirm_l', name: 'icu_dengan_ventilator_confirm_l'},
        {data: 'icu_dengan_ventilator_confirm_p', name: 'icu_dengan_ventilator_confirm_p'},
        {data: 'icu_tanpa_ventilator_suspect_l', name: 'icu_tanpa_ventilator_suspect_l'},
        {data: 'icu_tanpa_ventilator_suspect_p', name: 'icu_tanpa_ventilator_suspect_p'},
        {data: 'icu_tanpa_ventilator_confirm_l', name: 'icu_tanpa_ventilator_confirm_l'},
        {data: 'icu_tanpa_ventilator_confirm_p', name: 'icu_tanpa_ventilator_confirm_p'},
        {data: 'icu_tekanan_negatif_dengan_ventilator_suspect_l', name: 'icu_tekanan_negatif_dengan_ventilator_suspect_l'},
        {data: 'icu_tekanan_negatif_dengan_ventilator_suspect_p', name: 'icu_tekanan_negatif_dengan_ventilator_suspect_p'},
        {data: 'icu_tekanan_negatif_dengan_ventilator_confirm_l', name: 'icu_tekanan_negatif_dengan_ventilator_confirm_l'},
        {data: 'icu_tekanan_negatif_dengan_ventilator_confirm_p', name: 'icu_tekanan_negatif_dengan_ventilator_confirm_p'},
        {data: 'icu_tekanan_negatif_tanpa_ventilator_suspect_l', name: 'icu_tekanan_negatif_tanpa_ventilator_suspect_l'},
        {data: 'icu_tekanan_negatif_tanpa_ventilator_suspect_p', name: 'icu_tekanan_negatif_tanpa_ventilator_suspect_p'},
        {data: 'icu_tekanan_negatif_tanpa_ventilator_confirm_l', name: 'icu_tekanan_negatif_tanpa_ventilator_confirm_l'},
        {data: 'icu_tekanan_negatif_tanpa_ventilator_confirm_p', name: 'icu_tekanan_negatif_tanpa_ventilator_confirm_p'},
        {data: 'isolasi_tekanan_negatif_suspect_l', name: 'isolasi_tekanan_negatif_suspect_l'},
        {data: 'isolasi_tekanan_negatif_suspect_p', name: 'isolasi_tekanan_negatif_suspect_p'},
        {data: 'isolasi_tekanan_negatif_confirm_l', name: 'isolasi_tekanan_negatif_confirm_l'},
        {data: 'isolasi_tekanan_negatif_confirm_p', name: 'isolasi_tekanan_negatif_confirm_p'},
        {data: 'isolasi_tanpa_tekanan_negatif_suspect_l', name: 'isolasi_tanpa_tekanan_negatif_suspect_l'},
        {data: 'isolasi_tanpa_tekanan_negatif_suspect_p', name: 'isolasi_tanpa_tekanan_negatif_suspect_p'},
        {data: 'isolasi_tanpa_tekanan_negatif_confirm_l', name: 'isolasi_tanpa_tekanan_negatif_confirm_l'},
        {data: 'isolasi_tanpa_tekanan_negatif_confirm_p', name: 'isolasi_tanpa_tekanan_negatif_confirm_p'},
        {data: 'nicu_khusus_covid_suspect_l', name: 'nicu_khusus_covid_suspect_l'},
        {data: 'nicu_khusus_covid_suspect_p', name: 'nicu_khusus_covid_suspect_p'},
        {data: 'nicu_khusus_covid_confirm_l', name: 'nicu_khusus_covid_confirm_l'},
        {data: 'nicu_khusus_covid_confirm_p', name: 'nicu_khusus_covid_confirm_p'},
        {data: 'picu_khusus_covid_suspect_l', name: 'picu_khusus_covid_suspect_l'},
        {data: 'picu_khusus_covid_suspect_p', name: 'picu_khusus_covid_suspect_p'},
        {data: 'picu_khusus_covid_confirm_l', name: 'picu_khusus_covid_confirm_l'},
        {data: 'picu_khusus_covid_confirm_p', name: 'picu_khusus_covid_confirm_p'},
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
      $.get('pasien-dirawat-tanpa-komorbid/'+id, function(data) {
        $('#modal-judul').html("Edit Post");
        $('#tombol-simpan').val("edit-post");
        $('#addUtamaModal').modal('show');
        $('#form-tambah-edit').trigger('reset');
        //set value masing-masing id berdasarkan data yg diperoleh dari ajax get request diatas
        $('#id').val(data.id);
        $('#tanggal').val(data.tanggal).addClass(data.tanggal == null ? 'is-invalid': 'is-valid');
        $('#icu_dengan_ventilator_suspect_l').val(data.icu_dengan_ventilator_suspect_l).addClass(data.icu_dengan_ventilator_suspect_l == null ? 'is-invalid': 'is-valid');
        $('#icu_dengan_ventilator_suspect_p').val(data.icu_dengan_ventilator_suspect_p).addClass(data.icu_dengan_ventilator_suspect_p == null ? 'is-invalid': 'is-valid');
        $('#icu_dengan_ventilator_confirm_l').val(data.icu_dengan_ventilator_confirm_l).addClass(data.icu_dengan_ventilator_confirm_l == null ? 'is-invalid': 'is-valid');
        $('#icu_dengan_ventilator_confirm_p').val(data.icu_dengan_ventilator_confirm_p).addClass(data.icu_dengan_ventilator_confirm_p == null ? 'is-invalid': 'is-valid');
        $('#icu_tanpa_ventilator_suspect_l').val(data.icu_tanpa_ventilator_suspect_l).addClass(data.icu_tanpa_ventilator_suspect_l == null ? 'is-invalid': 'is-valid');
        $('#icu_tanpa_ventilator_suspect_p').val(data.icu_tanpa_ventilator_suspect_p).addClass(data.icu_tanpa_ventilator_suspect_p == null ? 'is-invalid': 'is-valid');
        $('#icu_tanpa_ventilator_confirm_l').val(data.icu_tanpa_ventilator_confirm_l).addClass(data.icu_tanpa_ventilator_confirm_l == null ? 'is-invalid': 'is-valid');
        $('#icu_tanpa_ventilator_confirm_p').val(data.icu_tanpa_ventilator_confirm_p).addClass(data.icu_tanpa_ventilator_confirm_p == null ? 'is-invalid': 'is-valid');
        $('#icu_tekanan_negatif_dengan_ventilator_suspect_l').val(data.icu_tekanan_negatif_dengan_ventilator_suspect_l).addClass(data.icu_tekanan_negatif_dengan_ventilator_suspect_l == null ? 'is-invalid': 'is-valid');
        $('#icu_tekanan_negatif_dengan_ventilator_suspect_p').val(data.icu_tekanan_negatif_dengan_ventilator_suspect_p).addClass(data.icu_tekanan_negatif_dengan_ventilator_suspect_p == null ? 'is-invalid': 'is-valid');
        $('#icu_tekanan_negatif_dengan_ventilator_confirm_l').val(data.icu_tekanan_negatif_dengan_ventilator_confirm_l).addClass(data.icu_tekanan_negatif_dengan_ventilator_confirm_l == null ? 'is-invalid': 'is-valid');
        $('#icu_tekanan_negatif_dengan_ventilator_confirm_p').val(data.icu_tekanan_negatif_dengan_ventilator_confirm_p).addClass(data.icu_tekanan_negatif_dengan_ventilator_confirm_p == null ? 'is-invalid': 'is-valid');
        $('#icu_tekanan_negatif_tanpa_ventilator_suspect_l').val(data.icu_tekanan_negatif_tanpa_ventilator_suspect_l).addClass(data.icu_tekanan_negatif_tanpa_ventilator_suspect_l == null ? 'is-invalid': 'is-valid');
        $('#icu_tekanan_negatif_tanpa_ventilator_suspect_p').val(data.icu_tekanan_negatif_tanpa_ventilator_suspect_p).addClass(data.icu_tekanan_negatif_tanpa_ventilator_suspect_p == null ? 'is-invalid': 'is-valid');
        $('#icu_tekanan_negatif_tanpa_ventilator_confirm_l').val(data.icu_tekanan_negatif_tanpa_ventilator_confirm_l).addClass(data.icu_tekanan_negatif_tanpa_ventilator_confirm_l == null ? 'is-invalid': 'is-valid');
        $('#icu_tekanan_negatif_tanpa_ventilator_confirm_p').val(data.icu_tekanan_negatif_tanpa_ventilator_confirm_p).addClass(data.icu_tekanan_negatif_tanpa_ventilator_confirm_p == null ? 'is-invalid': 'is-valid');
        $('#isolasi_tekanan_negatif_suspect_l').val(data.isolasi_tekanan_negatif_suspect_l).addClass(data.isolasi_tekanan_negatif_suspect_l == null ? 'is-invalid': 'is-valid');
        $('#isolasi_tekanan_negatif_suspect_p').val(data.isolasi_tekanan_negatif_suspect_p).addClass(data.isolasi_tekanan_negatif_suspect_p == null ? 'is-invalid': 'is-valid');
        $('#isolasi_tekanan_negatif_confirm_l').val(data.isolasi_tekanan_negatif_confirm_l).addClass(data.isolasi_tekanan_negatif_confirm_l == null ? 'is-invalid': 'is-valid');
        $('#isolasi_tekanan_negatif_confirm_p').val(data.isolasi_tekanan_negatif_confirm_p).addClass(data.isolasi_tekanan_negatif_confirm_p == null ? 'is-invalid': 'is-valid');
        $('#isolasi_tanpa_tekanan_negatif_suspect_l').val(data.isolasi_tanpa_tekanan_negatif_suspect_l).addClass(data.isolasi_tanpa_tekanan_negatif_suspect_l == null ? 'is-invalid': 'is-valid');
        $('#isolasi_tanpa_tekanan_negatif_suspect_p').val(data.isolasi_tanpa_tekanan_negatif_suspect_p).addClass(data.isolasi_tanpa_tekanan_negatif_suspect_p == null ? 'is-invalid': 'is-valid');
        $('#isolasi_tanpa_tekanan_negatif_confirm_l').val(data.isolasi_tanpa_tekanan_negatif_confirm_l).addClass(data.isolasi_tanpa_tekanan_negatif_confirm_l == null ? 'is-invalid': 'is-valid');
        $('#isolasi_tanpa_tekanan_negatif_confirm_p').val(data.isolasi_tanpa_tekanan_negatif_confirm_p).addClass(data.isolasi_tanpa_tekanan_negatif_confirm_p == null ? 'is-invalid': 'is-valid');
        $('#nicu_khusus_covid_suspect_l').val(data.nicu_khusus_covid_suspect_l).addClass(data.nicu_khusus_covid_suspect_l == null ? 'is-invalid': 'is-valid');
        $('#nicu_khusus_covid_suspect_p').val(data.nicu_khusus_covid_suspect_p).addClass(data.nicu_khusus_covid_suspect_p == null ? 'is-invalid': 'is-valid');
        $('#nicu_khusus_covid_confirm_l').val(data.nicu_khusus_covid_confirm_l).addClass(data.nicu_khusus_covid_confirm_l == null ? 'is-invalid': 'is-valid');
        $('#nicu_khusus_covid_confirm_p').val(data.nicu_khusus_covid_confirm_p).addClass(data.nicu_khusus_covid_confirm_p == null ? 'is-invalid': 'is-valid');
        $('#picu_khusus_covid_suspect_l').val(data.picu_khusus_covid_suspect_l).addClass(data.picu_khusus_covid_suspect_l == null ? 'is-invalid': 'is-valid');
        $('#picu_khusus_covid_suspect_p').val(data.picu_khusus_covid_suspect_p).addClass(data.picu_khusus_covid_suspect_p == null ? 'is-invalid': 'is-valid');
        $('#picu_khusus_covid_confirm_l').val(data.picu_khusus_covid_confirm_l).addClass(data.picu_khusus_covid_confirm_l == null ? 'is-invalid': 'is-valid');
        $('#picu_khusus_covid_confirm_p').val(data.picu_khusus_covid_confirm_p).addClass(data.picu_khusus_covid_confirm_p == null ? 'is-invalid': 'is-valid');
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
                  url: "{{ route('pasien-dirawat-tanpa-komorbid.sinkronisasi') }}", //url simpan data
                  type: "POST", //karena simpan kita pakai method POST
                  dataType: 'json', //data tipe kita kirim berupa JSON
                  success: function (data) { //jika berhasil
                      $('#form-tambah-edit').trigger("reset"); //form reset
                      $('#addUtamaModal').modal('hide'); //modal hide
                      $('#tombol-simpan').html('Simpan'); //tombol simpan
                      var oTable = $('#dt-rekap-pasien-dirawat-tanpa-komorbid').dataTable(); //inialisasi datatable
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

      var url = "{{ route('pasien-dirawat-tanpa-komorbid.destroy', ":dataId") }}";
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
                var oTable = $('#dt-rekap-pasien-dirawat-tanpa-komorbid').dataTable();
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