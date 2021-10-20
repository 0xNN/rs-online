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
                <th><input class="form-control form-control-sm" id="tanggal" name="tanggal" readonly></th>
                <th>Dirujuk</th>
                <th><input class="form-control form-control-sm" id="dirujuk" name="dirujuk" readonly></th>
              </tr>
              <tr>
                <th>Isman</th>
                <th><input class="form-control form-control-sm" id="isman" name="isman" readonly></th>
                <th>APS</th>
                <th><input class="form-control form-control-sm" id="aps" name="aps" readonly></th>
              </tr>
              <tr>
                <th>Sembuh</th>
                <th><input class="form-control form-control-sm is-valid" id="sembuh" name="sembuh" readonly></th>
                <th>Discarded</th>
                <th><input class="form-control form-control-sm" id="discarded" name="discarded" readonly></th>
              </tr>
              <tr>
                <th>Meninggal Komorbid</th>
                <th><input class="form-control form-control-sm" id="meninggal_komorbid" name="meninggal_komorbid" readonly></th>
                <th>Meninggal -Komorbid</th>
                <th><input class="form-control form-control-sm" id="meninggal_tanpa_komorbid" name="meninggal_tanpa_komorbid" readonly></th>
              </tr>
              <tr>
                <th>Meninggal Prob Pre Komorbid</th>
                <th><input class="form-control form-control-sm" id="meninggal_prob_pre_komorbid" name="meninggal_prob_pre_komorbid" readonly></th>
                <th>Meninggal Prob Pre -Komorbid</th>
                <th><input class="form-control form-control-sm" id="meninggal_prob_pre_tanpa_komorbid" name="meninggal_prob_pre_tanpa_komorbid" readonly></th>
              </tr>
              <tr>
                <th>Meninggal Prob Neo Komorbid</th>
                <th><input class="form-control form-control-sm" id="meninggal_prob_neo_komorbid" name="meninggal_prob_neo_komorbid" readonly></th>
                <th>Meninggal Prob Neo -Komorbid</th>
                <th><input class="form-control form-control-sm" id="meninggal_prob_neo_tanpa_komorbid" name="meninggal_prob_neo_tanpa_komorbid" readonly></th>
              </tr>
              <tr>
                <th>Meninggal Prob Bayi Komorbid</th>
                <th><input class="form-control form-control-sm" id="meninggal_prob_bayi_komorbid" name="meninggal_prob_bayi_komorbid" readonly></th>
                <th>Meninggal Prob Bayi -Komorbid</th>
                <th><input class="form-control form-control-sm" id="meninggal_prob_bayi_tanpa_komorbid" name="meninggal_prob_bayi_tanpa_komorbid" readonly></th>
              </tr>
              <tr>
                <th>Meninggal Prob Balita Komorbid</th>
                <th><input class="form-control form-control-sm" id="meninggal_prob_balita_komorbid" name="meninggal_prob_balita_komorbid" readonly></th>
                <th>Meninggal Prob Balita -Komorbid</th>
                <th><input class="form-control form-control-sm" id="meninggal_prob_balita_tanpa_komorbid" name="meninggal_prob_balita_tanpa_komorbid" readonly></th>
              </tr>
              <tr>
                <th>Meninggal Prob Anak Komorbid</th>
                <th><input class="form-control form-control-sm" id="meninggal_prob_anak_komorbid" name="meninggal_prob_anak_komorbid" readonly></th>
                <th>Meninggal Prob Anak -Komorbid</th>
                <th><input class="form-control form-control-sm" id="meninggal_prob_anak_tanpa_komorbid" name="meninggal_prob_anak_tanpa_komorbid" readonly></th>
              </tr>
              <tr>
                <th>Meninggal Prob Remaja Komorbid</th>
                <th><input class="form-control form-control-sm" id="meninggal_prob_remaja_komorbid" name="meninggal_prob_remaja_komorbid" readonly></th>
                <th>Meninggal Prob Remaja -Komorbid</th>
                <th><input class="form-control form-control-sm" id="meninggal_prob_remaja_tanpa_komorbid" name="meninggal_prob_remaja_tanpa_komorbid" readonly></th>
              </tr>
              <tr>
                <th>Meninggal Prob Dewasa Komorbid</th>
                <th><input class="form-control form-control-sm" id="meninggal_prob_dws_komorbid" name="meninggal_prob_dws_komorbid" readonly></th>
                <th>Meninggal Prob Dewasa -Komorbid</th>
                <th><input class="form-control form-control-sm" id="meninggal_prob_dws_tanpa_komorbid" name="meninggal_prob_dws_tanpa_komorbid" readonly></th>
              </tr>
              <tr>
                <th>Meninggal Prob Lansia Komorbid</th>
                <th><input class="form-control form-control-sm" id="meninggal_prob_lansia_komorbid" name="meninggal_prob_lansia_komorbid" readonly></th>
                <th>Meninggal Prob Lansia -Komorbid</th>
                <th><input class="form-control form-control-sm" id="meninggal_prob_lansia_tanpa_komorbid" name="meninggal_prob_lansia_tanpa_komorbid" readonly></th>
              </tr>
              <tr>
                <th>Meninggal Discarded Komorbid</th>
                <th><input class="form-control form-control-sm" id="meninggal_discarded_komorbid" name="meninggal_discarded_komorbid" readonly></th>
                <th>Meninggal Discarded -Komorbid</th>
                <th><input class="form-control form-control-sm" id="meninggal_discarded_tanpa_komorbid" name="meninggal_discarded_tanpa_komorbid" readonly></th>
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