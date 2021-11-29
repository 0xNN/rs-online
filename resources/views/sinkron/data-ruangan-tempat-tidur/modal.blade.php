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
                <th>Kelas T.Tidur</th>
                <th colspan="3"><input class="form-control form-control-sm" id="tt" name="tt" readonly></th>
                <input type="hidden" name="id_tt" id="id_tt">
              </tr>
              <tr>
                <th>Ruang</th>
                <th><input class="form-control form-control-sm" id="ruang" name="ruang" readonly></th>
                <th>Jumlah Ruang</th>
                <th><input class="form-control form-control-sm" id="jumlah_ruang" name="jumlah_ruang"></th>
              </tr>
              <tr>
                <th>Jumlah</th>
                <th><input class="form-control form-control-sm" id="jumlah" name="jumlah"></th>
                <th>Terpakai</th>
                <th><input class="form-control form-control-sm" id="terpakai" name="terpakai"></th>
              </tr>
              <tr>
                <th>Antrian</th>
                <th><input class="form-control form-control-sm" id="antrian" name="antrian"></th>
                <th>Prepare</th>
                <th><input class="form-control form-control-sm" id="prepare" name="prepare"></th>
              </tr>
              <tr>
                <th>Prepare Plan</th>
                <th><input class="form-control form-control-sm" id="prepare_plan" name="prepare_plan"></th>
                <th>Covid</th>
                <th><input class="form-control form-control-sm" id="covid" name="covid"></th>
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