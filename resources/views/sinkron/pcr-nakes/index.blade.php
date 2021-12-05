@extends('dashboard.base')

@section('content')

@include('sinkron.pcr-nakes.modal')
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
        <div class="card-header">Data PCR Nakes
          <a href="{{ route('pcr-nakes.create') }}" class="d-sm-inline-block btn btn-sm btn-success shadow-sm" id="tombol-utama">
            Tambah/Ubah
            {{-- <i class="cil-plus"></i> --}}
          </a>
        </div>
        <div class="card-body">
          {{-- <div class="table-responsive"> --}}
            <table id="dt-rekap-pcr-nakes" class="table table-sm table-bordered dt-responsive nowrap" style="width:100%">
              <thead class="thead-info">
                <tr>
                  <th>#</th>
                  {{-- <th>ID</th> --}}
                  <th>Aksi</th>
                  <th>Tanggal</th>
                  {{-- <th>Status</th> --}}
                  <th class="text-capitalize">jumlah <div class="text-capitalize">tenaga <div class="text-capitalize">dokter <div class="text-capitalize">umum</th>
                  <th class="text-capitalize">sudah <div class="text-capitalize">periksa <div class="text-capitalize">dokter <div class="text-capitalize">umum</th>
                  <th class="text-capitalize">hasil <div class="text-capitalize">pcr <div class="text-capitalize">dokter <div class="text-capitalize">umum</th>
                  <th class="text-capitalize">jumlah <div class="text-capitalize">tenaga <div class="text-capitalize">dokter <div class="text-capitalize">spesialis</th>
                  <th class="text-capitalize">sudah <div class="text-capitalize">periksa <div class="text-capitalize">dokter <div class="text-capitalize">spesialis</th>
                  <th class="text-capitalize">hasil <div class="text-capitalize">pcr <div class="text-capitalize">dokter <div class="text-capitalize">spesialis</th>
                  <th class="text-capitalize">jumlah <div class="text-capitalize">tenaga <div class="text-capitalize">dokter <div class="text-capitalize">gigi</th>
                  <th class="text-capitalize">sudah <div class="text-capitalize">periksa <div class="text-capitalize">dokter <div class="text-capitalize">gigi</th>
                  <th class="text-capitalize">hasil <div class="text-capitalize">pcr <div class="text-capitalize">dokter <div class="text-capitalize">gigi</th>
                  <th class="text-capitalize">jumlah <div class="text-capitalize">tenaga <div class="text-capitalize">residen</th>
                  <th class="text-capitalize">sudah <div class="text-capitalize">periksa <div class="text-capitalize">residen</th>
                  <th class="text-capitalize">hasil <div class="text-capitalize">pcr <div class="text-capitalize">residen</th>
                  <th class="text-capitalize">jumlah <div class="text-capitalize">tenaga <div class="text-capitalize">perawat</th>
                  <th class="text-capitalize">sudah <div class="text-capitalize">periksa <div class="text-capitalize">perawat</th>
                  <th class="text-capitalize">hasil <div class="text-capitalize">pcr <div class="text-capitalize">perawat</th>
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
    var table = $('#dt-rekap-pcr-nakes').DataTable({
      language: {
        url: '{{ asset('id.json') }}'
      },
      responsive: true,
      processing: true,
      serverSide: true,
      ajax: "{{ route('pcr-nakes.index') }}",
      columns: [
        {data: 'DT_RowIndex', name: 'DT_RowIndex', searchable: false, orderable: false},
        // {data: 'id', name: 'id'},
        {data: 'action', name: 'action', searchable: false, orderable: false},
        {data: 'tanggal', name: 'tanggal'},
        // {data: 'status_sinkron', name: 'status_sinkron', orderable: false},
        {data: 'jumlah_tenaga_dokter_umum', name: 'jumlah_tenaga_dokter_umum', orderable: false},
        {data: 'sudah_periksa_dokter_umum', name: 'sudah_periksa_dokter_umum', orderable: false},
        {data: 'hasil_pcr_dokter_umum', name: 'hasil_pcr_dokter_umum', orderable: false},
        {data: 'jumlah_tenaga_dokter_spesialis', name: 'jumlah_tenaga_dokter_spesialis', orderable: false},
        {data: 'sudah_periksa_dokter_spesialis', name: 'sudah_periksa_dokter_spesialis', orderable: false},
        {data: 'hasil_pcr_dokter_spesialis', name: 'hasil_pcr_dokter_spesialis', orderable: false},
        {data: 'jumlah_tenaga_dokter_gigi', name: 'jumlah_tenaga_dokter_gigi', orderable: false},
        {data: 'sudah_periksa_dokter_gigi', name: 'sudah_periksa_dokter_gigi', orderable: false},
        {data: 'hasil_pcr_dokter_gigi', name: 'hasil_pcr_dokter_gigi', orderable: false},
        {data: 'jumlah_tenaga_residen', name: 'jumlah_tenaga_residen', orderable: false},
        {data: 'sudah_periksa_residen', name: 'sudah_periksa_residen', orderable: false},
        {data: 'hasil_pcr_residen', name: 'hasil_pcr_residen', orderable: false},
        {data: 'jumlah_tenaga_perawat', name: 'jumlah_tenaga_perawat', orderable: false},
        {data: 'sudah_periksa_perawat', name: 'sudah_periksa_perawat', orderable: false},
        {data: 'hasil_pcr_perawat', name: 'hasil_pcr_perawat', orderable: false},
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
      $.get('pcr-nakes/'+id, function(data) {
        $('#modal-judul').html("Edit Post");
        $('#tombol-simpan').val("edit-post");
        $('#addUtamaModal').modal('show');
        $('#form-tambah-edit').trigger('reset');
        //set value masing-masing id berdasarkan data yg diperoleh dari ajax get request diatas
        $('#id').val(data.id);
        $('#tanggal').val(data.tanggal).addClass(data.tanggal == null ? 'is-invalid': 'is-valid');
        $('#jumlah_tenaga_dokter_umum').val(data.jumlah_tenaga_dokter_umum).addClass(jumlah_tenaga_dokter_umum == null ? 'is-invalid': 'is-valid');
        $('#sudah_periksa_dokter_umum').val(data.sudah_periksa_dokter_umum).addClass(sudah_periksa_dokter_umum == null ? 'is-invalid': 'is-valid');
        $('#hasil_pcr_dokter_umum').val(data.hasil_pcr_dokter_umum).addClass(hasil_pcr_dokter_umum == null ? 'is-invalid': 'is-valid');
        $('#jumlah_tenaga_dokter_spesialis').val(data.jumlah_tenaga_dokter_spesialis).addClass(jumlah_tenaga_dokter_spesialis == null ? 'is-invalid': 'is-valid');
        $('#sudah_periksa_dokter_spesialis').val(data.sudah_periksa_dokter_spesialis).addClass(sudah_periksa_dokter_spesialis == null ? 'is-invalid': 'is-valid');
        $('#hasil_pcr_dokter_spesialis').val(data.hasil_pcr_dokter_spesialis).addClass(hasil_pcr_dokter_spesialis == null ? 'is-invalid': 'is-valid');
        $('#jumlah_tenaga_dokter_gigi').val(data.jumlah_tenaga_dokter_gigi).addClass(jumlah_tenaga_dokter_gigi == null ? 'is-invalid': 'is-valid');
        $('#sudah_periksa_dokter_gigi').val(data.sudah_periksa_dokter_gigi).addClass(sudah_periksa_dokter_gigi == null ? 'is-invalid': 'is-valid');
        $('#hasil_pcr_dokter_gigi').val(data.hasil_pcr_dokter_gigi).addClass(hasil_pcr_dokter_gigi == null ? 'is-invalid': 'is-valid');
        $('#jumlah_tenaga_residen').val(data.jumlah_tenaga_residen).addClass(jumlah_tenaga_residen == null ? 'is-invalid': 'is-valid');
        $('#sudah_periksa_residen').val(data.sudah_periksa_residen).addClass(sudah_periksa_residen == null ? 'is-invalid': 'is-valid');
        $('#hasil_pcr_residen').val(data.hasil_pcr_residen).addClass(hasil_pcr_residen == null ? 'is-invalid': 'is-valid');
        $('#jumlah_tenaga_perawat').val(data.jumlah_tenaga_perawat).addClass(jumlah_tenaga_perawat == null ? 'is-invalid': 'is-valid');
        $('#sudah_periksa_perawat').val(data.sudah_periksa_perawat).addClass(sudah_periksa_perawat == null ? 'is-invalid': 'is-valid');
        $('#hasil_pcr_perawat').val(data.hasil_pcr_perawat).addClass(hasil_pcr_perawat == null ? 'is-invalid': 'is-valid');
        $('#jumlah_tenaga_bidan').val(data.jumlah_tenaga_bidan).addClass(jumlah_tenaga_bidan == null ? 'is-invalid': 'is-valid');
        $('#sudah_periksa_bidan').val(data.sudah_periksa_bidan).addClass(sudah_periksa_bidan == null ? 'is-invalid': 'is-valid');
        $('#hasil_pcr_bidan').val(data.hasil_pcr_bidan).addClass(hasil_pcr_bidan == null ? 'is-invalid': 'is-valid');
        $('#jumlah_tenaga_apoteker').val(data.jumlah_tenaga_apoteker).addClass(jumlah_tenaga_apoteker == null ? 'is-invalid': 'is-valid');
        $('#sudah_periksa_apoteker').val(data.sudah_periksa_apoteker).addClass(sudah_periksa_apoteker == null ? 'is-invalid': 'is-valid');
        $('#hasil_pcr_apoteker').val(data.hasil_pcr_apoteker).addClass(hasil_pcr_apoteker == null ? 'is-invalid': 'is-valid');
        $('#jumlah_tenaga_radiografer').val(data.jumlah_tenaga_radiografer).addClass(jumlah_tenaga_radiografer == null ? 'is-invalid': 'is-valid');
        $('#sudah_periksa_radiografer').val(data.sudah_periksa_radiografer).addClass(sudah_periksa_radiografer == null ? 'is-invalid': 'is-valid');
        $('#hasil_pcr_radiografer').val(data.hasil_pcr_radiografer).addClass(hasil_pcr_radiografer == null ? 'is-invalid': 'is-valid');
        $('#jumlah_tenaga_analis_lab').val(data.jumlah_tenaga_analis_lab).addClass(jumlah_tenaga_analis_lab == null ? 'is-invalid': 'is-valid');
        $('#sudah_periksa_analis_lab').val(data.sudah_periksa_analis_lab).addClass(sudah_periksa_analis_lab == null ? 'is-invalid': 'is-valid');
        $('#hasil_pcr_analis_lab').val(data.hasil_pcr_analis_lab).addClass(hasil_pcr_analis_lab == null ? 'is-invalid': 'is-valid');
        $('#jumlah_tenaga_co_ass').val(data.jumlah_tenaga_co_ass).addClass(jumlah_tenaga_co_ass == null ? 'is-invalid': 'is-valid');
        $('#sudah_periksa_co_ass').val(data.sudah_periksa_co_ass).addClass(sudah_periksa_co_ass == null ? 'is-invalid': 'is-valid');
        $('#hasil_pcr_co_ass').val(data.hasil_pcr_co_ass).addClass(hasil_pcr_co_ass == null ? 'is-invalid': 'is-valid');
        $('#jumlah_tenaga_internship').val(data.jumlah_tenaga_internship).addClass(jumlah_tenaga_internship == null ? 'is-invalid': 'is-valid');
        $('#sudah_periksa_internship').val(data.sudah_periksa_internship).addClass(sudah_periksa_internship == null ? 'is-invalid': 'is-valid');
        $('#hasil_pcr_internship').val(data.hasil_pcr_internship).addClass(hasil_pcr_internship == null ? 'is-invalid': 'is-valid');
        $('#jumlah_tenaga_nakes_lainnya').val(data.jumlah_tenaga_nakes_lainnya).addClass(jumlah_tenaga_nakes_lainnya == null ? 'is-invalid': 'is-valid');
        $('#sudah_periksa_nakes_lainnya').val(data.sudah_periksa_nakes_lainnya).addClass(sudah_periksa_nakes_lainnya == null ? 'is-invalid': 'is-valid');
        $('#hasil_pcr_nakes_lainnya').val(data.hasil_pcr_nakes_lainnya).addClass(hasil_pcr_nakes_lainnya == null ? 'is-invalid': 'is-valid');
        $('#rekap_jumlah_tenaga').val(data.rekap_jumlah_tenaga).addClass(rekap_jumlah_tenaga == null ? 'is-invalid': 'is-valid');
        $('#rekap_jumlah_sudah_diperiksa').val(data.rekap_jumlah_sudah_diperiksa).addClass(rekap_jumlah_sudah_diperiksa == null ? 'is-invalid': 'is-valid');
        $('#rekap_jumlah_hasil_pcr').val(data.rekap_jumlah_hasil_pcr).addClass(rekap_jumlah_hasil_pcr == null ? 'is-invalid': 'is-valid');
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
                  url: "{{ route('pcr-nakes.sinkronisasi') }}", //url simpan data
                  type: "POST", //karena simpan kita pakai method POST
                  dataType: 'json', //data tipe kita kirim berupa JSON
                  success: function (data) { //jika berhasil
                      $('#form-tambah-edit').trigger("reset"); //form reset
                      $('#addUtamaModal').modal('hide'); //modal hide
                      $('#tombol-simpan').html('Simpan'); //tombol simpan
                      var oTable = $('#dt-rekap-pcr-nakes').dataTable(); //inialisasi datatable
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

      var url = "{{ route('pcr-nakes.destroy', ":dataId") }}";
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
                var oTable = $('#dt-rekap-pcr-nakes').dataTable();
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
        url: "{{ route('pcr-nakes.range') }}",
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
            var oTable = $('#dt-rekap-pcr-nakes').dataTable(); //inialisasi datatable
            oTable.fnDraw(false); //reset datatable
          } else {
            $('.sinkron-range').prop('disabled', false);
            iziToast.error({
                title: 'Successfully',
                message: data.message,
                position: 'bottomRight'
            });
            var oTable = $('#dt-rekap-pcr-nakes').dataTable(); //inialisasi datatable
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