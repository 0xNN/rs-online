<div class="modal fade" id="addUtamaModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
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
                <th>Kebutuhan</th>
                <th><input class="form-control form-control-sm" id="kebutuhan" name="kebutuhan" readonly></th>
                <th>Jumlah Eksisting</th>
                <th><input type="number" class="form-control form-control-sm" id="jumlah_eksisting" name="jumlah_eksisting"></th>
                <input type="hidden" name="id_kebutuhan" id="id_kebutuhan">
              </tr>
              <tr>
                <th>Jumlah</th>
                <th><input type="number" class="form-control form-control-sm" id="jumlah" name="jumlah"></th>
                <th>Jumlah Diterima</th>
                <th><input type="number" class="form-control form-control-sm" id="jumlah_diterima" name="jumlah_diterima"></th>
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