@extends('dashboard.base')

@section('content')
<div class="container-fluid">
  <div class="fade-in">
    @if (session('error'))
      <div class="alert alert-danger">{{ session('error') }}</div>
    @endif
    <form action="{{ route('oksigenasi.store') }}" method="post" enctype="multipart/form-data">
      @csrf
      <div class="card">
        <div class="card-header">Upload File</div>
        <div class="card-body">
          <div class="form-group row">
            <div class="col-md-12">
              <table class="table table-sm table-bordered">
                <tr>
                  <th>Satuan P Cair</th>
                  <th>
                    <select class="form-control form-control-sm" name="satuan_p_cair" id="satuan_p_cair">
                      <option value="m3">M3</option>
                      <option value="liter">Liter</option>
                      <option value="kg">Kg</option>
                      <option value="ton">Ton</option>
                      <option value="galon">Galon</option>
                    </select>
                  </th>
                  <th>Satuan K Isi Cair</th>
                  <th>
                    <select class="form-control form-control-sm" name="satuan_k_isi_cair" id="satuan_k_isi_cair">
                      <option value="m3">M3</option>
                      <option value="liter">Liter</option>
                      <option value="kg">Kg</option>
                      <option value="ton">Ton</option>
                      <option value="galon">Galon</option>
                    </select>
                  </th>
                </tr>
              </table>
            </div>
          </div>
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
      </div>
    </form>
  </div>
</div>
@endsection

@section('css')
    
@endsection

@section('javascript')
    
@endsection