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
                <th>Icu Ventilator Suspect L</th>
                <th><input class="form-control form-control-sm" id="icu_dengan_ventilator_suspect_l" name="icu_dengan_ventilator_suspect_l" readonly></th>
                <th>Icu -Ventilator Suspect L</th>
                <th><input class="form-control form-control-sm" id="icu_tanpa_ventilator_suspect_l" name="icu_tanpa_ventilator_suspect_l" readonly></th>
              </tr>
              <tr>
                <th>Icu Ventilator Suspect P</th>
                <th><input class="form-control form-control-sm" id="icu_dengan_ventilator_suspect_p" name="icu_dengan_ventilator_suspect_p" readonly></th>
                <th>Icu -Ventilator Suspect P</th>
                <th><input class="form-control form-control-sm" id="icu_tanpa_ventilator_suspect_p" name="icu_tanpa_ventilator_suspect_p" readonly></th>
              </tr>
              <tr>
                <th>Icu Ventilator Confirm L</th>
                <th><input class="form-control form-control-sm" id="icu_dengan_ventilator_confirm_l" name="icu_dengan_ventilator_confirm_l" readonly></th>
                <th>Icu -Ventilator Confirm L</th>
                <th><input class="form-control form-control-sm" id="icu_tanpa_ventilator_confirm_l" name="icu_tanpa_ventilator_confirm_l" readonly></th>
              </tr>
              <tr>
                <th>Icu Ventilator Confirm P</th>
                <th><input class="form-control form-control-sm" id="icu_dengan_ventilator_confirm_p" name="icu_dengan_ventilator_confirm_p" readonly></th>
                <th>Icu -Ventilator Confirm P</th>
                <th><input class="form-control form-control-sm" id="icu_tanpa_ventilator_confirm_p" name="icu_tanpa_ventilator_confirm_p" readonly></th>
              </tr>

              <tr>
                <th>Icu T.N Ventilator Suspect L</th>
                <th><input class="form-control form-control-sm" id="icu_tekanan_negatif_dengan_ventilator_suspect_l" name="icu_tekanan_negatif_dengan_ventilator_suspect_l" readonly></th>
                <th>Icu T.N -Ventilator Suspect L</th>
                <th><input class="form-control form-control-sm" id="icu_tekanan_negatif_tanpa_ventilator_suspect_l" name="icu_tekanan_negatif_tanpa_ventilator_suspect_l" readonly></th>
              </tr>
              <tr>
                <th>Icu T.N Ventilator Suspect P</th>
                <th><input class="form-control form-control-sm" id="icu_tekanan_negatif_dengan_ventilator_suspect_p" name="icu_tekanan_negatif_dengan_ventilator_suspect_p" readonly></th>
                <th>Icu T.N -Ventilator Suspect P</th>
                <th><input class="form-control form-control-sm" id="icu_tekanan_negatif_tanpa_ventilator_suspect_p" name="icu_tekanan_negatif_tanpa_ventilator_suspect_p" readonly></th>
              </tr>
              <tr>
                <th>Icu T.N Ventilator Confirm L</th>
                <th><input class="form-control form-control-sm" id="icu_tekanan_negatif_dengan_ventilator_confirm_l" name="icu_tekanan_negatif_dengan_ventilator_confirm_l" readonly></th>
                <th>Icu T.N -Ventilator Confirm L</th>
                <th><input class="form-control form-control-sm" id="icu_tekanan_negatif_tanpa_ventilator_confirm_l" name="icu_tekanan_negatif_tanpa_ventilator_confirm_l" readonly></th>
              </tr>
              <tr>
                <th>Icu T.N Ventilator Confirm P</th>
                <th><input class="form-control form-control-sm" id="icu_tekanan_negatif_dengan_ventilator_confirm_p" name="icu_tekanan_negatif_dengan_ventilator_confirm_p" readonly></th>
                <th>Icu T.N -Ventilator Confirm P</th>
                <th><input class="form-control form-control-sm" id="icu_tekanan_negatif_tanpa_ventilator_confirm_p" name="icu_tekanan_negatif_tanpa_ventilator_confirm_p" readonly></th>
              </tr>

              <tr>
                <th>Isolasi T.N Suspect L</th>
                <th><input class="form-control form-control-sm" id="isolasi_tekanan_negatif_suspect_l" name="isolasi_tekanan_negatif_suspect_l" readonly></th>
                <th>Isolasi -T.N Suspect L</th>
                <th><input class="form-control form-control-sm" id="isolasi_tanpa_tekanan_negatif_suspect_l" name="isolasi_tanpa_tekanan_negatif_suspect_l" readonly></th>
              </tr>
              <tr>
                <th>Isolasi T.N Suspect P</th>
                <th><input class="form-control form-control-sm" id="isolasi_tekanan_negatif_suspect_p" name="isolasi_tekanan_negatif_suspect_p" readonly></th>
                <th>Isolasi -T.N Suspect P</th>
                <th><input class="form-control form-control-sm" id="isolasi_tanpa_tekanan_negatif_suspect_p" name="isolasi_tanpa_tekanan_negatif_suspect_p" readonly></th>
              </tr>
              <tr>
                <th>Isolasi T.N Confirm L</th>
                <th><input class="form-control form-control-sm" id="isolasi_tekanan_negatif_confirm_l" name="isolasi_tekanan_negatif_confirm_l" readonly></th>
                <th>Isolasi -T.N Confirm L</th>
                <th><input class="form-control form-control-sm" id="isolasi_tanpa_tekanan_negatif_confirm_l" name="isolasi_tanpa_tekanan_negatif_confirm_l" readonly></th>
              </tr>
              <tr>
                <th>Isolasi T.N Confirm P</th>
                <th><input class="form-control form-control-sm" id="isolasi_tekanan_negatif_confirm_p" name="isolasi_tekanan_negatif_confirm_p" readonly></th>
                <th>Isolasi -T.N Confirm P</th>
                <th><input class="form-control form-control-sm" id="isolasi_tanpa_tekanan_negatif_confirm_p" name="isolasi_tanpa_tekanan_negatif_confirm_p" readonly></th>
              </tr>

              <tr>
                <th>Nicu Khusus Covid Suspect L</th>
                <th><input class="form-control form-control-sm" id="nicu_khusus_covid_suspect_l" name="nicu_khusus_covid_suspect_l" readonly></th>
                <th>Picu Khusus Covid Suspect L</th>
                <th><input class="form-control form-control-sm" id="picu_khusus_covid_suspect_l" name="picu_khusus_covid_suspect_l" readonly></th>
              </tr>
              <tr>
                <th>Nicu Khusus Covid Suspect P</th>
                <th><input class="form-control form-control-sm" id="nicu_khusus_covid_suspect_p" name="nicu_khusus_covid_suspect_p" readonly></th>
                <th>Picu Khusus Covid Suspect P</th>
                <th><input class="form-control form-control-sm" id="picu_khusus_covid_suspect_p" name="picu_khusus_covid_suspect_p" readonly></th>
              </tr>
              <tr>
                <th>Nicu Khusus Covid Confirm L</th>
                <th><input class="form-control form-control-sm" id="nicu_khusus_covid_confirm_l" name="nicu_khusus_covid_confirm_l" readonly></th>
                <th>Picu Khusus Covid Confirm L</th>
                <th><input class="form-control form-control-sm" id="picu_khusus_covid_confirm_l" name="picu_khusus_covid_confirm_l" readonly></th>
              </tr>
              <tr>
                <th>Nicu Khusus Covid Confirm P</th>
                <th><input class="form-control form-control-sm" id="nicu_khusus_covid_confirm_p" name="nicu_khusus_covid_confirm_p" readonly></th>
                <th>Picu Khusus Covid Confirm P</th>
                <th><input class="form-control form-control-sm" id="picu_khusus_covid_confirm_p" name="picu_khusus_covid_confirm_p" readonly></th>
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