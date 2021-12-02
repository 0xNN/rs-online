@extends('dashboard.base')

@section('content')
<div class="container-fluid">
  <div class="fade-in">
    @if (session('error'))
      <div class="alert alert-danger">{{ session('error') }}</div>
    @endif
    <form action="{{ route('pasien-masuk.store') }}" method="post" enctype="multipart/form-data">
      <div class="card">
        <div class="card-header">Upload File</div>
        <div class="card-body">
            @csrf
            <div class="form-group row">
              <label class="col-md-3 col-form-label" for="file">File input <strong class="text-danger">Excel (xls, xlsx)</strong></label>
              <div class="col-md-9">
              <input id="file" type="file" name="file" accept=".xls, .xlsx">
            </div>
          </div>
        </div>
        <div class="card-footer">
          <button type="submit" class="btn btn-success" name="proses">Proses</button>
          <button type="submit" class="btn btn-info" name="contoh_format">Contoh Format Excel</button>
        </div>
    </form>
  </div>
</div>
@endsection

@section('css')
    
@endsection

@section('javascript')
    
@endsection