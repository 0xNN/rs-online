<div class="modal fade" id="addUtamaModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
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
                <th>IGD Suspect L</th>
                <th><input class="form-control form-control-sm is-valid" id="igd_suspect_l" name="igd_suspect_l" readonly></th>
                <th>IGD Suspect P</th>
                <th><input class="form-control form-control-sm" id="igd_suspect_p" name="igd_suspect_p" readonly></th>
              </tr>
              <tr>
                <th>IGD Confirm L</th>
                <th><input class="form-control form-control-sm" id="igd_confirm_l" name="igd_confirm_l" readonly></th>
                <th>IGD Confirm P</th>
                <th><input class="form-control form-control-sm" id="igd_confirm_p" name="igd_confirm_p" readonly></th>
              </tr>
              <tr>
                <th>RJ Suspect L</th>
                <th><input class="form-control form-control-sm" id="rj_suspect_l" name="rj_suspect_l" readonly></th>
                <th>RJ Suspect P</th>
                <th><input class="form-control form-control-sm" id="rj_suspect_p" name="rj_suspect_p" readonly></th>
              </tr>
              <tr>
                <th>RJ Confirm L</th>
                <th><input class="form-control form-control-sm" id="rj_confirm_l" name="rj_confirm_l" readonly></th>
                <th>RJ Confirm P</th>
                <th><input class="form-control form-control-sm" id="rj_confirm_p" name="rj_confirm_p" readonly></th>
              </tr>
              <tr>
                <th>RI Suspect L</th>
                <th><input class="form-control form-control-sm" id="ri_suspect_l" name="ri_suspect_l" readonly></th>
                <th>RI Suspect P</th>
                <th><input class="form-control form-control-sm" id="ri_suspect_p" name="ri_suspect_p" readonly></th>
              </tr>
              <tr>
                <th>RI Confirm L</th>
                <th><input class="form-control form-control-sm" id="ri_confirm_l" name="ri_confirm_l" readonly></th>
                <th>RI Confirm P</th>
                <th><input class="form-control form-control-sm" id="ri_confirm_p" name="ri_confirm_p" readonly></th>
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