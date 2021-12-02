@extends('dashboard.base')

@section('content')

@include('sinkron.oksigenasi.modal')
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
        <div class="card-header">Data Oksigenasi
          <a href="{{ route('oksigenasi.create') }}" class="d-sm-inline-block btn btn-sm btn-success shadow-sm" id="tombol-utama">
            Tambah/Ubah
            {{-- <i class="cil-plus"></i> --}}
          </a>
        </div>
        <div class="card-body">
          {{-- <div class="table-responsive"> --}}
            <table id="dt-rekap-oksigenasi" class="table table-sm table-bordered dt-responsive nowrap" style="width:100%">
              <thead class="thead-info">
                <tr>
                  <th>#</th>
                  {{-- <th>ID</th> --}}
                  <th>Aksi</th>
                  <th>Tanggal</th>
                  {{-- <th>Status</th> --}}
                  <th>P Cair</th>
                  <th>P Tabung Kecil</th>
                  <th>P Tabung Sedang</th>
                  <th>P Tabung Besar</th>
                  <th>K Isi Cair</th>
                  <th>K Isi Tabung Kecil</th>
                  <th>K Isi Tabung Sedang</th>
                  <th>K Isi Tabung Besar</th>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
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
    var table = $('#dt-rekap-oksigenasi').DataTable({
      language: {
        url: '{{ asset('id.json') }}'
      },
      responsive: true,
      processing: true,
      serverSide: true,
      ajax: "{{ route('oksigenasi.index') }}",
      columns: [
        {data: 'DT_RowIndex', name: 'DT_RowIndex', searchable: false, orderable: false},
        // {data: 'id', name: 'id'},
        {data: 'action', name: 'action', searchable: false, orderable: false},
        {data: 'tanggal', name: 'tanggal'},
        // {data: 'status_sinkron', name: 'status_sinkron', orderable: false},
        {data: 'p_cair', name: 'p_cair', orderable: false},
        {data: 'p_tabung_kecil', name: 'p_tabung_kecil', orderable: false},
        {data: 'p_tabung_sedang', name: 'p_tabung_sedang', orderable: false},
        {data: 'p_tabung_besar', name: 'p_tabung_besar', orderable: false},
        {data: 'k_isi_cair', name: 'k_isi_cair', orderable: false},
        {data: 'k_isi_tabung_kecil', name: 'k_isi_tabung_kecil', orderable: false},
        {data: 'k_isi_tabung_sedang', name: 'k_isi_tabung_sedang', orderable: false},
        {data: 'k_isi_tabung_besar', name: 'k_isi_tabung_besar', orderable: false},
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
      $.get('oksigenasi/'+id, function(data) {
        $('#modal-judul').html("Edit Post");
        $('#tombol-simpan').val("edit-post");
        $('#addUtamaModal').modal('show');
        $('#form-tambah-edit').trigger('reset');
        //set value masing-masing id berdasarkan data yg diperoleh dari ajax get request diatas
        $('#id').val(data.id);
        $('#tanggal').val(data.tanggal).addClass(data.tanggal == null ? 'is-invalid': 'is-valid');
        $('#p_cair').val(data.p_cair).addClass(data.p_cair == null ? 'is-invalid': 'is-valid');
        $('#p_tabung_kecil').val(data.p_tabung_kecil).addClass(data.p_tabung_kecil == null ? 'is-invalid': 'is-valid');
        $('#p_tabung_sedang').val(data.p_tabung_sedang).addClass(data.p_tabung_sedang == null ? 'is-invalid': 'is-valid');
        $('#p_tabung_besar').val(data.p_tabung_besar).addClass(data.p_tabung_besar == null ? 'is-invalid': 'is-valid');
        $('#k_isi_cair').val(data.k_isi_cair).addClass(data.k_isi_cair == null ? 'is-invalid': 'is-valid');
        $('#k_isi_tabung_kecil').val(data.k_isi_tabung_kecil).addClass(data.k_isi_tabung_kecil == null ? 'is-invalid': 'is-valid');
        $('#k_isi_tabung_sedang').val(data.k_isi_tabung_sedang).addClass(data.k_isi_tabung_sedang == null ? 'is-invalid': 'is-valid');
        $('#k_isi_tabung_besar').val(data.k_isi_tabung_besar).addClass(data.k_isi_tabung_besar == null ? 'is-invalid': 'is-valid');
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
                  url: "{{ route('oksigenasi.sinkronisasi') }}", //url simpan data
                  type: "POST", //karena simpan kita pakai method POST
                  dataType: 'json', //data tipe kita kirim berupa JSON
                  success: function (data) { //jika berhasil
                      $('#form-tambah-edit').trigger("reset"); //form reset
                      $('#addUtamaModal').modal('hide'); //modal hide
                      $('#tombol-simpan').html('Simpan'); //tombol simpan
                      var oTable = $('#dt-rekap-oksigenasi').dataTable(); //inialisasi datatable
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

      var url = "{{ route('oksigenasi.destroy', ":dataId") }}";
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
                var oTable = $('#dt-rekap-oksigenasi').dataTable();
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
        url: "{{ route('oksigenasi.range') }}",
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
            var oTable = $('#dt-rekap-oksigenasi').dataTable(); //inialisasi datatable
            oTable.fnDraw(false); //reset datatable
          } else {
            $('.sinkron-range').prop('disabled', false);
            iziToast.error({
                title: 'Successfully',
                message: data.message,
                position: 'bottomRight'
            });
            var oTable = $('#dt-rekap-oksigenasi').dataTable(); //inialisasi datatable
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