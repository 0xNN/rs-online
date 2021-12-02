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
        <div class="row">
          <div class="col-sm-12">
            <table class="table table-sm table-bordered">
              <tr>
                <th>Tanggal</th>
                <th colspan="3"><input class="form-control form-control-sm" id="tanggal" name="tanggal" readonly></th>
              </tr>
              <tr>
                <th>P Cair</th>
                <th><input type="number" class="form-control form-control-sm" id="p_cair" name="p_cair"></th>
                <th>P Tabung Kecil</th>
                <th><input type="number" class="form-control form-control-sm" id="p_tabung_kecil" name="p_tabung_kecil"></th>
              </tr>
              <tr>
                <th>P Tabung Sedang</th>
                <th><input type="number" class="form-control form-control-sm" id="p_tabung_sedang" name="p_tabung_sedang"></th>
                <th>P Tabung Besar</th>
                <th><input type="number" class="form-control form-control-sm" id="p_tabung_besar" name="p_tabung_besar"></th>
              </tr>
              <tr>
                <th>K Isi Cair</th>
                <th><input type="number" class="form-control form-control-sm" id="k_isi_cair" name="k_isi_cair"></th>
                <th>K Isi Tabung Kecil</th>
                <th><input type="number" class="form-control form-control-sm" id="k_isi_tabung_kecil" name="k_isi_tabung_kecil"></th>
              </tr>
              <tr>
                <th>K Isi Tabung Sedang</th>
                <th><input type="number" class="form-control form-control-sm" id="k_isi_tabung_sedang" name="k_isi_tabung_sedang"></th>
                <th>K Isi Tabung Besar</th>
                <th><input type="number" class="form-control form-control-sm" id="k_isi_tabung_besar" name="k_isi_tabung_besar"></th>
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