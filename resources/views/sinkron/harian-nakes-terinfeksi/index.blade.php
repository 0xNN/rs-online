@extends('dashboard.base')

@section('content')

@include('sinkron.harian-nakes-terinfeksi.modal')
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
                  <input type="text" class="form-control" id="start_date" name="start_date" placeholder="YYYY-MM-DD" readonly>
                  <div class="input-group-prepend">
                    <label class="input-group-text" for="inputGroupSelect01">Sampai</label>
                  </div>
                  <input type="text" class="form-control" id="end_date" name="end_date" placeholder="YYYY-MM-DD" readonly>
                </div>
              </th>
            </tr>
          </table>
        </div>
      </div>
      <div class="card shadow-sm">
        <div class="card-header">Data Harian Nakes Terinfeksi
          <a href="{{ route('harian-nakes-terinfeksi.create') }}" class="d-sm-inline-block btn btn-sm btn-success shadow-sm" id="tombol-utama">
            Tambah/Ubah
            {{-- <i class="cil-plus"></i> --}}
          </a>
        </div>
        <div class="card-body">
          {{-- <div class="table-responsive"> --}}
            <table id="dt-rekap-harian-nakes-terinfeksi" class="table table-sm table-bordered dt-responsive nowrap" style="width:100%">
              <thead class="thead-info">
                <tr>
                  <th>#</th>
                  {{-- <th>ID</th> --}}
                  <th>Aksi</th>
                  <th>Tanggal</th>
                  {{-- <th>Status</th> --}}
                  <th class="text-capitalize"><div class="text-capitalize">co <div class="text-capitalize">ass</th>
                  <th class="text-capitalize"><div class="text-capitalize">residen</th>
                  <th class="text-capitalize"><div class="text-capitalize">intership</th>
                  <th class="text-capitalize"><div class="text-capitalize">dokter <div class="text-capitalize">spesialis</th>
                  <th class="text-capitalize"><div class="text-capitalize">dokter <div class="text-capitalize">umum</th>
                  <th class="text-capitalize"><div class="text-capitalize">dokter <div class="text-capitalize">gigi</th>
                  <th class="text-capitalize"><div class="text-capitalize">perawat</th>
                  <th class="text-capitalize"><div class="text-capitalize">bidan</th>
                  <th class="text-capitalize"><div class="text-capitalize">apoteker</th>
                  <th class="text-capitalize"><div class="text-capitalize">radiografer</th>
                  <th class="text-capitalize"><div class="text-capitalize">analis <div class="text-capitalize">lab</th>
                  <th class="text-capitalize"><div class="text-capitalize">nakes <div class="text-capitalize">lainnya</th>
                  {{-- <th class="text-capitalize">jumlah <div class="text-capitalize">tenaga <div class="text-capitalize">bidan</th>
                  <th class="text-capitalize">sudah <div class="text-capitalize">periksa <div class="text-capitalize">bidan</th>
                  <th class="text-capitalize">hasil <div class="text-capitalize">pcr <div class="text-capitalize">bidan</th>
                  <th class="text-capitalize">jumlah <div class="text-capitalize">tenaga <div class="text-capitalize">apoteker</th>
                  <th class="text-capitalize">sudah <div class="text-capitalize">periksa <div class="text-capitalize">apoteker</th>
                  <th class="text-capitalize">hasil <div class="text-capitalize">pcr <div class="text-capitalize">apoteker</th>
                  <th class="text-capitalize">jumlah <div class="text-capitalize">tenaga <div class="text-capitalize">radiografer</th>
                  <th class="text-capitalize">sudah <div class="text-capitalize">periksa <div class="text-capitalize">radiografer</th>
                  <th class="text-capitalize">hasil <div class="text-capitalize">pcr <div class="text-capitalize">radiografer</th>
                  <th class="text-capitalize">jumlah <div class="text-capitalize">tenaga <div class="text-capitalize">analis <div class="text-capitalize">lab</th>
                  <th class="text-capitalize">sudah <div class="text-capitalize">periksa <div class="text-capitalize">analis <div class="text-capitalize">lab</th>
                  <th class="text-capitalize">hasil <div class="text-capitalize">pcr <div class="text-capitalize">analis <div class="text-capitalize">lab</th>
                  <th class="text-capitalize">jumlah <div class="text-capitalize">tenaga <div class="text-capitalize">co <div class="text-capitalize">ass</th>
                  <th class="text-capitalize">sudah <div class="text-capitalize">periksa <div class="text-capitalize">co <div class="text-capitalize">ass</th>
                  <th class="text-capitalize">hasil <div class="text-capitalize">pcr <div class="text-capitalize">co <div class="text-capitalize">ass</th>
                  <th class="text-capitalize">jumlah <div class="text-capitalize">tenaga <div class="text-capitalize">internship</th>
                  <th class="text-capitalize">sudah <div class="text-capitalize">periksa <div class="text-capitalize">internship</th>
                  <th class="text-capitalize">hasil <div class="text-capitalize">pcr <div class="text-capitalize">internship</th>
                  <th class="text-capitalize">jumlah <div class="text-capitalize">tenaga <div class="text-capitalize">nakes <div class="text-capitalize">lainnya</th>
                  <th class="text-capitalize">sudah <div class="text-capitalize">periksa <div class="text-capitalize">nakes <div class="text-capitalize">lainnya</th>
                  <th class="text-capitalize">hasil <div class="text-capitalize">pcr <div class="text-capitalize">nakes <div class="text-capitalize">lainnya</th>
                  <th class="text-capitalize">rekap <div class="text-capitalize">jumlah <div class="text-capitalize">tenaga</th>
                  <th class="text-capitalize">rekap <div class="text-capitalize">jumlah <div class="text-capitalize">sudah <div class="text-capitalize">diperiksa</th>
                  <th class="text-capitalize">rekap <div class="text-capitalize">jumlah <div class="text-capitalize">hasil <div class="text-capitalize">pcr</th> --}}
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
    var table = $('#dt-rekap-harian-nakes-terinfeksi').DataTable({
      language: {
        url: '{{ asset('id.json') }}'
      },
      responsive: true,
      processing: true,
      serverSide: true,
      ajax: "{{ route('harian-nakes-terinfeksi.index') }}",
      columns: [
        {data: 'DT_RowIndex', name: 'DT_RowIndex', searchable: false, orderable: false},
        // {data: 'id', name: 'id'},
        {data: 'action', name: 'action', searchable: false, orderable: false},
        {data: 'tanggal', name: 'tanggal'},
        // {data: 'status_sinkron', name: 'status_sinkron', orderable: false},
        {data: 'co_ass', name: 'co_ass', orderable: false},
        {data: 'residen', name: 'residen', orderable: false},
        {data: 'intership', name: 'intership', orderable: false},
        {data: 'dokter_spesialis', name: 'dokter_spesialis', orderable: false},
        {data: 'dokter_umum', name: 'dokter_umum', orderable: false},
        {data: 'dokter_gigi', name: 'dokter_gigi', orderable: false},
        {data: 'perawat', name: 'perawat', orderable: false},
        {data: 'bidan', name: 'bidan', orderable: false},
        {data: 'apoteker', name: 'apoteker', orderable: false},
        {data: 'radiografer', name: 'radiografer', orderable: false},
        {data: 'analis_lab', name: 'analis_lab', orderable: false},
        {data: 'nakes_lainnya', name: 'nakes_lainnya', orderable: false},
        // {data: 'jumlah_tenaga_bidan', name: 'jumlah_tenaga_bidan', orderable: false},
        // {data: 'sudah_periksa_bidan', name: 'sudah_periksa_bidan', orderable: false},
        // {data: 'hasil_pcr_bidan', name: 'hasil_pcr_bidan', orderable: false},
        // {data: 'jumlah_tenaga_apoteker', name: 'jumlah_tenaga_apoteker', orderable: false},
        // {data: 'sudah_periksa_apoteker', name: 'sudah_periksa_apoteker', orderable: false},
        // {data: 'hasil_pcr_apoteker', name: 'hasil_pcr_apoteker', orderable: false},
        // {data: 'jumlah_tenaga_radiografer', name: 'jumlah_tenaga_radiografer', orderable: false},
        // {data: 'sudah_periksa_radiografer', name: 'sudah_periksa_radiografer', orderable: false},
        // {data: 'hasil_pcr_radiografer', name: 'hasil_pcr_radiografer', orderable: false},
        // {data: 'jumlah_tenaga_analis_lab', name: 'jumlah_tenaga_analis_lab', orderable: false},
        // {data: 'sudah_periksa_analis_lab', name: 'sudah_periksa_analis_lab', orderable: false},
        // {data: 'hasil_pcr_analis_lab', name: 'hasil_pcr_analis_lab', orderable: false},
        // {data: 'jumlah_tenaga_co_ass', name: 'jumlah_tenaga_co_ass', orderable: false},
        // {data: 'sudah_periksa_co_ass', name: 'sudah_periksa_co_ass', orderable: false},
        // {data: 'hasil_pcr_co_ass', name: 'hasil_pcr_co_ass', orderable: false},
        // {data: 'jumlah_tenaga_internship', name: 'jumlah_tenaga_internship', orderable: false},
        // {data: 'sudah_periksa_internship', name: 'sudah_periksa_internship', orderable: false},
        // {data: 'hasil_pcr_internship', name: 'hasil_pcr_internship', orderable: false},
        // {data: 'jumlah_tenaga_nakes_lainnya', name: 'jumlah_tenaga_nakes_lainnya', orderable: false},
        // {data: 'sudah_periksa_nakes_lainnya', name: 'sudah_periksa_nakes_lainnya', orderable: false},
        // {data: 'hasil_pcr_nakes_lainnya', name: 'hasil_pcr_nakes_lainnya', orderable: false},
        // {data: 'rekap_jumlah_tenaga', name: 'rekap_jumlah_tenaga', orderable: false},
        // {data: 'rekap_jumlah_sudah_diperiksa', name: 'rekap_jumlah_sudah_diperiksa', orderable: false},
        // {data: 'rekap_jumlah_hasil_pcr', name: 'rekap_jumlah_hasil_pcr', orderable: false},
        {data: 'tanggal_input', name: 'tanggal_input', orderable: false},
        {data: 'tanggal_sinkron', name: 'tanggal_sinkron', orderable: false},
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
      $.get('harian-nakes-terinfeksi/'+id, function(data) {
        $('#modal-judul').html("Edit Post");
        $('#tombol-simpan').val("edit-post");
        $('#addUtamaModal').modal('show');
        $('#form-tambah-edit').trigger('reset');
        //set value masing-masing id berdasarkan data yg diperoleh dari ajax get request diatas
        $('#id').val(data.id);
        $('#tanggal').val(data.tanggal).addClass(data.tanggal == null ? 'is-invalid': 'is-valid');
        $('#co_ass').val(data.co_ass).addClass(data.co_ass == null ? 'is-invalid': 'is-valid');
        $('#residen').val(data.residen).addClass(data.residen == null ? 'is-invalid': 'is-valid');
        $('#intership').val(data.intership).addClass(data.intership == null ? 'is-invalid': 'is-valid');
        $('#dokter_spesialis').val(data.dokter_spesialis).addClass(data.dokter_spesialis == null ? 'is-invalid': 'is-valid');
        $('#dokter_umum').val(data.dokter_umum).addClass(data.dokter_umum == null ? 'is-invalid': 'is-valid');
        $('#dokter_gigi').val(data.dokter_gigi).addClass(data.dokter_gigi == null ? 'is-invalid': 'is-valid');
        $('#perawat').val(data.perawat).addClass(data.perawat == null ? 'is-invalid': 'is-valid');
        $('#bidan').val(data.bidan).addClass(data.bidan == null ? 'is-invalid': 'is-valid');
        $('#apoteker').val(data.apoteker).addClass(data.apoteker == null ? 'is-invalid': 'is-valid');
        $('#radiografer').val(data.radiografer).addClass(data.radiografer == null ? 'is-invalid': 'is-valid');
        $('#analis_lab').val(data.analis_lab).addClass(data.analis_lab == null ? 'is-invalid': 'is-valid');
        $('#nakes_lainnya').val(data.nakes_lainnya).addClass(data.nakes_lainnya == null ? 'is-invalid': 'is-valid');
        $('#co_ass_meninggal').val(data.co_ass_meninggal).addClass(data.co_ass_meninggal == null ? 'is-invalid': 'is-valid');
        $('#residen_meninggal').val(data.residen_meninggal).addClass(data.residen_meninggal == null ? 'is-invalid': 'is-valid');
        $('#intership_meninggal').val(data.intership_meninggal).addClass(data.intership_meninggal == null ? 'is-invalid': 'is-valid');
        $('#dokter_spesialis_meninggal').val(data.dokter_spesialis_meninggal).addClass(data.dokter_spesialis_meninggal == null ? 'is-invalid': 'is-valid');
        $('#dokter_umum_meninggal').val(data.dokter_umum_meninggal).addClass(data.dokter_umum_meninggal == null ? 'is-invalid': 'is-valid');
        $('#dokter_gigi_meninggal').val(data.dokter_gigi_meninggal).addClass(data.dokter_gigi_meninggal == null ? 'is-invalid': 'is-valid');
        $('#perawat_meninggal').val(data.perawat_meninggal).addClass(data.perawat_meninggal == null ? 'is-invalid': 'is-valid');
        $('#bidan_meninggal').val(data.bidan_meninggal).addClass(data.bidan_meninggal == null ? 'is-invalid': 'is-valid');
        $('#apoteker_meninggal').val(data.apoteker_meninggal).addClass(data.apoteker_meninggal == null ? 'is-invalid': 'is-valid');
        $('#radiografer_meninggal').val(data.radiografer_meninggal).addClass(data.radiografer_meninggal == null ? 'is-invalid': 'is-valid');
        $('#analis_lab_meninggal').val(data.analis_lab_meninggal).addClass(data.analis_lab_meninggal == null ? 'is-invalid': 'is-valid');
        $('#nakes_lainnya_meninggal').val(data.nakes_lainnya_meninggal).addClass(data.nakes_lainnya_meninggal == null ? 'is-invalid': 'is-valid');
        $('#co_ass_dirawat').val(data.co_ass_dirawat).addClass(data.co_ass_dirawat == null ? 'is-invalid': 'is-valid');
        $('#co_ass_isoman').val(data.co_ass_isoman).addClass(data.co_ass_isoman == null ? 'is-invalid': 'is-valid');
        $('#co_ass_sembuh').val(data.co_ass_sembuh).addClass(data.co_ass_sembuh == null ? 'is-invalid': 'is-valid');
        $('#residen_dirawat').val(data.residen_dirawat).addClass(data.residen_dirawat == null ? 'is-invalid': 'is-valid');
        $('#residen_isoman').val(data.residen_isoman).addClass(data.residen_isoman == null ? 'is-invalid': 'is-valid');
        $('#residen_sembuh').val(data.residen_sembuh).addClass(data.residen_sembuh == null ? 'is-invalid': 'is-valid');
        $('#intership_dirawat').val(data.intership_dirawat).addClass(data.intership_dirawat == null ? 'is-invalid': 'is-valid');
        $('#intership_isoman').val(data.intership_isoman).addClass(data.intership_isoman == null ? 'is-invalid': 'is-valid');
        $('#intership_sembuh').val(data.intership_sembuh).addClass(data.intership_sembuh == null ? 'is-invalid': 'is-valid');
        $('#dokter_spesialis_dirawat').val(data.dokter_spesialis_dirawat).addClass(data.dokter_spesialis_dirawat == null ? 'is-invalid': 'is-valid');
        $('#dokter_spesialis_isoman').val(data.dokter_spesialis_isoman).addClass(data.dokter_spesialis_isoman == null ? 'is-invalid': 'is-valid');
        $('#dokter_spesialis_sembuh').val(data.dokter_spesialis_sembuh).addClass(data.dokter_spesialis_sembuh == null ? 'is-invalid': 'is-valid');
        $('#dokter_umum_dirawat').val(data.dokter_umum_dirawat).addClass(data.dokter_umum_dirawat == null ? 'is-invalid': 'is-valid');
        $('#dokter_umum_isoman').val(data.dokter_umum_isoman).addClass(data.dokter_umum_isoman == null ? 'is-invalid': 'is-valid');
        $('#dokter_umum_sembuh').val(data.dokter_umum_sembuh).addClass(data.dokter_umum_sembuh == null ? 'is-invalid': 'is-valid');
        $('#dokter_gigi_dirawat').val(data.dokter_gigi_dirawat).addClass(data.dokter_gigi_dirawat == null ? 'is-invalid': 'is-valid');
        $('#dokter_gigi_isoman').val(data.dokter_gigi_isoman).addClass(data.dokter_gigi_isoman == null ? 'is-invalid': 'is-valid');
        $('#dokter_gigi_sembuh').val(data.dokter_gigi_sembuh).addClass(data.dokter_gigi_sembuh == null ? 'is-invalid': 'is-valid');
        $('#bidan_dirawat').val(data.bidan_dirawat).addClass(data.bidan_dirawat == null ? 'is-invalid': 'is-valid');
        $('#bidan_isoman').val(data.bidan_isoman).addClass(data.bidan_isoman == null ? 'is-invalid': 'is-valid');
        $('#bidan_sembuh').val(data.bidan_sembuh).addClass(data.bidan_sembuh == null ? 'is-invalid': 'is-valid');
        $('#apoteker_dirawat').val(data.apoteker_dirawat).addClass(data.apoteker_dirawat == null ? 'is-invalid': 'is-valid');
        $('#apoteker_isoman').val(data.apoteker_isoman).addClass(data.apoteker_isoman == null ? 'is-invalid': 'is-valid');
        $('#apoteker_sembuh').val(data.apoteker_sembuh).addClass(data.apoteker_sembuh == null ? 'is-invalid': 'is-valid');
        $('#radiografer_dirawat').val(data.radiografer_dirawat).addClass(data.radiografer_dirawat == null ? 'is-invalid': 'is-valid');
        $('#radiografer_isoman').val(data.radiografer_isoman).addClass(data.radiografer_isoman == null ? 'is-invalid': 'is-valid');
        $('#radiografer_sembuh').val(data.radiografer_sembuh).addClass(data.radiografer_sembuh == null ? 'is-invalid': 'is-valid');
        $('#analis_lab_dirawat').val(data.analis_lab_dirawat).addClass(data.analis_lab_dirawat == null ? 'is-invalid': 'is-valid');
        $('#analis_lab_isoman').val(data.analis_lab_isoman).addClass(data.analis_lab_isoman == null ? 'is-invalid': 'is-valid');
        $('#analis_lab_sembuh').val(data.analis_lab_sembuh).addClass(data.analis_lab_sembuh == null ? 'is-invalid': 'is-valid');
        $('#nakes_lainnya_dirawat').val(data.nakes_lainnya_dirawat).addClass(data.nakes_lainnya_dirawat == null ? 'is-invalid': 'is-valid');
        $('#nakes_lainnya_isoman').val(data.nakes_lainnya_isoman).addClass(data.nakes_lainnya_isoman == null ? 'is-invalid': 'is-valid');
        $('#nakes_lainnya_sembuh').val(data.nakes_lainnya_sembuh).addClass(data.nakes_lainnya_sembuh == null ? 'is-invalid': 'is-valid');
        $('#perawat_dirawat').val(data.perawat_dirawat).addClass(data.perawat_dirawat == null ? 'is-invalid': 'is-valid');
        $('#perawat_isoman').val(data.perawat_isoman).addClass(data.perawat_isoman == null ? 'is-invalid': 'is-valid');
        $('#perawat_sembuh').val(data.perawat_sembuh).addClass(data.perawat_sembuh == null ? 'is-invalid': 'is-valid');
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
                  url: "{{ route('harian-nakes-terinfeksi.sinkronisasi') }}", //url simpan data
                  type: "POST", //karena simpan kita pakai method POST
                  dataType: 'json', //data tipe kita kirim berupa JSON
                  success: function (data) { //jika berhasil
                      $('#form-tambah-edit').trigger("reset"); //form reset
                      $('#addUtamaModal').modal('hide'); //modal hide
                      $('#tombol-simpan').html('Simpan'); //tombol simpan
                      var oTable = $('#dt-rekap-harian-nakes-terinfeksi').dataTable(); //inialisasi datatable
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

      var url = "{{ route('harian-nakes-terinfeksi.destroy', ":dataId") }}";
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
                var oTable = $('#dt-rekap-harian-nakes-terinfeksi').dataTable();
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
        url: "{{ route('harian-nakes-terinfeksi.range') }}",
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
            var oTable = $('#dt-rekap-harian-nakes-terinfeksi').dataTable(); //inialisasi datatable
            oTable.fnDraw(false); //reset datatable
          } else {
            $('.sinkron-range').prop('disabled', false);
            iziToast.error({
                title: 'Successfully',
                message: data.message,
                position: 'bottomRight'
            });
            var oTable = $('#dt-rekap-harian-nakes-terinfeksi').dataTable(); //inialisasi datatable
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