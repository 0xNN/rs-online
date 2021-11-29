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
                <th>J.Tenaga D.Umum</th>
                <th><input class="form-control form-control-sm" id="jumlah_tenaga_dokter_umum" name="jumlah_tenaga_dokter_umum"></th>
              </tr>
              <tr>
                <th>Sdh.Periksa D.Umum</th>
                <th><input class="form-control form-control-sm" id="sudah_periksa_dokter_umum" name="sudah_periksa_dokter_umum"></th>
                <th>Hsl.Pcr D.Umum</th>
                <th><input class="form-control form-control-sm" id="hasil_pcr_dokter_umum" name="hasil_pcr_dokter_umum"></th>
              </tr>
              <tr>
                <th>J.Tenaga D.Spesialis</th>
                <th><input class="form-control form-control-sm" id="jumlah_tenaga_dokter_spesialis" name="jumlah_tenaga_dokter_spesialis"></th>
                <th>Sdh.Periksa D.Spesialis</th>
                <th><input class="form-control form-control-sm" id="sudah_periksa_dokter_spesialis" name="sudah_periksa_dokter_spesialis"></th>
              </tr>
              <tr>
                <th>Hsl.Pcr D.Spesialis</th>
                <th><input class="form-control form-control-sm" id="hasil_pcr_dokter_spesialis" name="hasil_pcr_dokter_spesialis"></th>
                <th>J.Tenaga D.Gigi</th>
                <th><input class="form-control form-control-sm" id="jumlah_tenaga_dokter_gigi" name="jumlah_tenaga_dokter_gigi"></th>
              </tr>
              <tr>
                <th>Sdh.Periksa D.Gigi</th>
                <th><input class="form-control form-control-sm" id="sudah_periksa_dokter_gigi" name="sudah_periksa_dokter_gigi"></th>
                <th>Hsl.Pcr D.Gigi</th>
                <th><input class="form-control form-control-sm" id="hasil_pcr_dokter_gigi" name="hasil_pcr_dokter_gigi"></th>
              </tr>
              <tr>
                <th>J.Tenaga Residen</th>
                <th><input class="form-control form-control-sm" id="jumlah_tenaga_residen" name="jumlah_tenaga_residen"></th>
                <th>Sdh.Periksa Residen</th>
                <th><input class="form-control form-control-sm" id="sudah_periksa_residen" name="sudah_periksa_residen"></th>
              </tr>
              <tr>
                <th>Hsl. Pcr Residen</th>
                <th><input class="form-control form-control-sm" id="hasil_pcr_residen" name="hasil_pcr_residen"></th>
                <th>J.Tenaga Perawat</th>
                <th><input class="form-control form-control-sm" id="jumlah_tenaga_perawat" name="jumlah_tenaga_perawat"></th>
              </tr>
              <tr>
                <th>Sdh.Periksa Perawat</th>
                <th><input class="form-control form-control-sm" id="sudah_periksa_perawat" name="sudah_periksa_perawat"></th>
                <th>Hsl.Pcr Perawat</th>
                <th><input class="form-control form-control-sm" id="hasil_pcr_perawat" name="hasil_pcr_perawat"></th>
              </tr>
              <tr>
                <th>Jml.Tenaga Bidan</th>
                <th><input class="form-control form-control-sm" id="jumlah_tenaga_bidan" name="jumlah_tenaga_bidan"></th>
                <th>Sdh.Periksa Bidan</th>
                <th><input class="form-control form-control-sm" id="sudah_periksa_bidan" name="sudah_periksa_bidan"></th>
              </tr>
              <tr>
                <th>Hsl.Pcr Bidan</th>
                <th><input class="form-control form-control-sm" id="hasil_pcr_bidan" name="hasil_pcr_bidan"></th>
                <th>Jml.Tenaga Apoteker</th>
                <th><input class="form-control form-control-sm" id="jumlah_tenaga_apoteker" name="jumlah_tenaga_apoteker"></th>
              </tr>
              <tr>
                <th>Sdh.Periksa Apoteker</th>
                <th><input class="form-control form-control-sm" id="sudah_periksa_apoteker" name="sudah_periksa_apoteker"></th>
                <th>Hsl.Pcr Apoteker</th>
                <th><input class="form-control form-control-sm" id="hasil_pcr_apoteker" name="hasil_pcr_apoteker"></th>
              </tr>
              <tr>
                <th>Jml.Tenaga Radiografer</th>
                <th><input class="form-control form-control-sm" id="jumlah_tenaga_radiografer" name="jumlah_tenaga_radiografer"></th>
                <th>Sdh.Periksa Radiografer</th>
                <th><input class="form-control form-control-sm" id="sudah_periksa_radiografer" name="sudah_periksa_radiografer"></th>
              </tr>
              <tr>
                <th>Hsl.Pcr Radiografer</th>
                <th><input class="form-control form-control-sm" id="hasil_pcr_radiografer" name="hasil_pcr_radiografer"></th>
                <th>Jml.Tenaga Analis Lab</th>
                <th><input class="form-control form-control-sm" id="jumlah_tenaga_analis_lab" name="jumlah_tenaga_analis_lab"></th>
              </tr>
              <tr>
                <th>Sdh.Periksa Analis Lab</th>
                <th><input class="form-control form-control-sm" id="sudah_periksa_analis_lab" name="sudah_periksa_analis_lab"></th>
                <th>Hsl.Pcr Analis Lab</th>
                <th><input class="form-control form-control-sm" id="hasil_pcr_analis_lab" name="hasil_pcr_analis_lab"></th>
              </tr>
              <tr>
                <th>Jml.Tenaga Co Ass</th>
                <th><input class="form-control form-control-sm" id="jumlah_tenaga_co_ass" name="jumlah_tenaga_co_ass"></th>
                <th>Sdh.Periksa Co Ass</th>
                <th><input class="form-control form-control-sm" id="sudah_periksa_co_ass" name="sudah_periksa_co_ass"></th>
              </tr>
              <tr>
                <th>Hsl.Pcr Co Ass</th>
                <th><input class="form-control form-control-sm" id="hasil_pcr_co_ass" name="hasil_pcr_co_ass"></th>
                <th>Jml.Tenaga Internship</th>
                <th><input class="form-control form-control-sm" id="jumlah_tenaga_internship" name="jumlah_tenaga_internship"></th>
              </tr>
              <tr>
                <th>Sdh.Periksa Internship</th>
                <th><input class="form-control form-control-sm" id="sudah_periksa_internship" name="sudah_periksa_internship"></th>
                <th>Hsl.Pcr Internship</th>
                <th><input class="form-control form-control-sm" id="hasil_pcr_internship" name="hasil_pcr_internship"></th>
              </tr>
              <tr>
                <th>Jml.Tenaga Nakes Lainnya</th>
                <th><input class="form-control form-control-sm" id="jumlah_tenaga_nakes_lainnya" name="jumlah_tenaga_nakes_lainnya"></th>
                <th>Sdh.Periksa Nakes Lainnya</th>
                <th><input class="form-control form-control-sm" id="sudah_periksa_nakes_lainnya" name="sudah_periksa_nakes_lainnya"></th>
              </tr>
              <tr>
                <th>Hsl.Pcr Nakes Lainnya</th>
                <th><input class="form-control form-control-sm" id="hasil_pcr_nakes_lainnya" name="hasil_pcr_nakes_lainnya"></th>
                <th>Rekap Jml.Tenaga</th>
                <th><input class="form-control form-control-sm" id="rekap_jumlah_tenaga" name="rekap_jumlah_tenaga"></th>
              </tr>
              <tr>
                <th>Rekap Jml.Sdh.Diperiksa</th>
                <th><input class="form-control form-control-sm" id="rekap_jumlah_sudah_diperiksa" name="rekap_jumlah_sudah_diperiksa"></th>
                <th>Rekap Jml.Hsl.Pcr</th>
                <th><input class="form-control form-control-sm" id="rekap_jumlah_hasil_pcr" name="rekap_jumlah_hasil_pcr"></th>
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