@extends('dashboard.base')

@section('content')
<div class="container-fluid">
  <div class="fade-in">
    @if (session('error'))
      <div class="alert alert-danger">{{ session('error') }}</div>
    @endif
    <form action="{{ route('data-ruangan-tempat-tidur.store') }}" method="post" enctype="multipart/form-data">
      <div class="card">
        <div class="card-header">Upload File</div>
        <div class="card-body">
            @csrf
            <div class="form-group row">
              <label class="col-md-3 col-form-label" for="file">Pilih Master T.Tidur</strong></label>
              <div class="col-md-9">
                <select class="form-control form-control-sm" name="kode_master_tt" id="kode_master_tt">
                  <option value="-1">-- Master T.Tidur --</option>
                  @foreach ($obj as $item)
                    <option value="{{ $item->kode_tt }}">{{ $item->nama_tt }}</option>
                  @endforeach
                </select>
                <input type="hidden" name="nama_master_tt" id="nama_master_tt">
              </div>
            </div>
            <div class="form-group row">
              <label class="col-md-3 col-form-label" for="file">File input <strong class="text-danger">Excel (xls, xlsx)</strong></label>
              <div class="col-md-9">
                <input id="file" type="file" name="file" accept=".xls, .xlsx">
              </div>
            </div>
          </div>
        </div>
        <div class="card-footer">
          <button type="submit" class="btn btn-success">Proses</button>
        </div>
    </form>
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
  $(document).ready(function() {
    $('#kode_master_tt').change(function() {
      $('#nama_master_tt').val($('#kode_master_tt option:selected').text());
      // console.log($('#kode_master_tt option:selected').text());
    })
  });
</script>
@endsection