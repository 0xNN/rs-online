<div class="modal fade" id="addUtamaModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <form id="form-tambah-edit" name="form-tambah-edit">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Data Sinkron</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <input type="hidden" name="id" id="id">
        <div class="row">
          <div class="col-sm-12">
            <table class="table table-sm table-bordered">
              <tr>
                <th>Tanggal</th>
                <th colspan="3"><input class="form-control form-control-sm" id="tanggal" name="tanggal" readonly></th>
              </tr>
              <tr>
                <th>IGD Suspek</th>
                <th><input class="form-control form-control-sm" id="igd_suspek" name="igd_suspek"></th>
                <th>IGD Konfirmasi</th>
                <th><input class="form-control form-control-sm" id="igd_konfirmasi" name="igd_konfirmasi"></th>
              </tr>
              <tr>
                <th>G Ringan Murni Covid</th>
                <th><input class="form-control form-control-sm is-valid" id="g_ringan_murni_covid" name="g_ringan_murni_covid"></th>
                <th>G Ringan Komorbid</th>
                <th><input class="form-control form-control-sm" id="g_ringan_komorbid" name="g_ringan_komorbid"></th>
              </tr>
              <tr>
                <th>G Ringan Koinsiden</th>
                <th><input class="form-control form-control-sm" id="g_ringan_koinsiden" name="g_ringan_koinsiden"></th>
                <th>G Sedang</th>
                <th><input class="form-control form-control-sm" id="g_sedang" name="g_sedang"></th>
              </tr>
              <tr>
                <th>G Berat</th>
                <th><input class="form-control form-control-sm" id="g_berat" name="g_berat"></th>
                <th>IGD Dirujuk</th>
                <th><input class="form-control form-control-sm" id="igd_dirujuk" name="igd_dirujuk"></th>
              </tr>
            </table>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-sm btn-success" id="tombol-simpan" value="create">Sinkronisasi</button>
      </div>
      </form>
    </div>
  </div>
</div>

<div class="modal fade" id="deleteUtamaModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Delete</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Apakah Anda Yakin Akan di Hapus?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" name="tombol-utama-hapus" id="tombol-utama-hapus" class="btn btn-danger">Hapus</button>
      </div>
    </div>
  </div>
</div>