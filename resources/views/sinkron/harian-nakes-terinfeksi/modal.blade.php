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
                <th colspan="3">Tanggal</th>
                <th colspan="5"><input class="form-control form-control-sm" id="tanggal" name="tanggal" readonly></th>
              </tr>
              <tr>
                <th>Co Ass</th>
                <th><input class="form-control form-control-sm" id="co_ass" name="co_ass"></th>
                <th>Residen</th>
                <th><input class="form-control form-control-sm" id="residen" name="residen"></th>
                <th>Internship</th>
                <th><input class="form-control form-control-sm" id="intership" name="intership"></th>
                <th>D.Spesialis</th>
                <th><input class="form-control form-control-sm" id="dokter_spesialis" name="dokter_spesialis"></th>
              </tr>
              <tr>
                <th>D.Umum</th>
                <th><input class="form-control form-control-sm" id="dokter_umum" name="dokter_umum"></th>
                <th>D.Gigi</th>
                <th><input class="form-control form-control-sm" id="dokter_gigi" name="dokter_gigi"></th>
                <th>Perawat</th>
                <th><input class="form-control form-control-sm" id="perawat" name="perawat"></th>
                <th>Bidan</th>
                <th><input class="form-control form-control-sm" id="bidan" name="bidan"></th>
              </tr>
              <tr>
                <th>Apoteker</th>
                <th><input class="form-control form-control-sm" id="apoteker" name="apoteker"></th>
                <th>Radiografer</th>
                <th><input class="form-control form-control-sm" id="radiografer" name="radiografer"></th>
                <th>Analis Lab</th>
                <th><input class="form-control form-control-sm" id="analis_lab" name="analis_lab"></th>
                <th>Nakes.L</th>
                <th><input class="form-control form-control-sm" id="nakes_lainnya" name="nakes_lainnya"></th>
              </tr>
              <tr>
                <th>Co Ass. Mniggl</th>
                <th><input class="form-control form-control-sm" id="co_ass_meninggal" name="co_ass_meninggal"></th>
                <th>Residen Mniggl</th>
                <th><input class="form-control form-control-sm" id="residen_meninggal" name="residen_meninggal"></th>
                <th>Internship Mniggl</th>
                <th><input class="form-control form-control-sm" id="intership_meninggal" name="intership_meninggal"></th>
                <th>D.Spesialis Mniggl</th>
                <th><input class="form-control form-control-sm" id="dokter_spesialis_meninggal" name="dokter_spesialis_meninggal"></th>
              </tr>
              <tr>
                <th>D.Umum Mniggl</th>
                <th><input class="form-control form-control-sm" id="dokter_umum_meninggal" name="dokter_umum_meninggal"></th>
                <th>D.Gigi Mniggl</th>
                <th><input class="form-control form-control-sm" id="dokter_gigi_meninggal" name="dokter_gigi_meninggal"></th>
                <th>Perawat Minggl</th>
                <th><input class="form-control form-control-sm" id="perawat_meninggal" name="perawat_meninggal"></th>
                <th>Bidan Mniggl</th>
                <th><input class="form-control form-control-sm" id="bidan_meninggal" name="bidan_meninggal"></th>
              </tr>
              <tr>
                <th>Apoteker Mniggl</th>
                <th><input class="form-control form-control-sm" id="apoteker_meninggal" name="apoteker_meninggal"></th>
                <th>Radiografer Mniggl</th>
                <th><input class="form-control form-control-sm" id="radiografer_meninggal" name="radiografer_meninggal"></th>
                <th>Analis Lab Mniggl</th>
                <th><input class="form-control form-control-sm" id="analis_lab_meninggal" name="analis_lab_meninggal"></th>
                <th>Nakes.L Mniggl</th>
                <th><input class="form-control form-control-sm" id="nakes_lainnya_meninggal" name="nakes_lainnya_meninggal"></th>
              </tr>
              <tr>
                <th>Co Ass Dirawat</th>
                <th><input class="form-control form-control-sm" id="co_ass_dirawat" name="co_ass_dirawat"></th>
                <th>Co Ass Isoman</th>
                <th><input class="form-control form-control-sm" id="co_ass_isoman" name="co_ass_isoman"></th>
                <th>Co Ass Sembuh</th>
                <th><input class="form-control form-control-sm" id="co_ass_sembuh" name="co_ass_sembuh"></th>
                <th>Residen Dirawat</th>
                <th><input class="form-control form-control-sm" id="residen_dirawat" name="residen_dirawat"></th>
              </tr>
              <tr>
                <th>Residen Isoman</th>
                <th><input class="form-control form-control-sm" id="residen_isoman" name="residen_isoman"></th>
                <th>Residen Sembuh</th>
                <th><input class="form-control form-control-sm" id="residen_sembuh" name="residen_sembuh"></th>
                <th>Internship Dirawat</th>
                <th><input class="form-control form-control-sm" id="intership_dirawat" name="intership_dirawat"></th>
                <th>Internship Isoman</th>
                <th><input class="form-control form-control-sm" id="intership_isoman" name="intership_isoman"></th>
              </tr>
              <tr>
                <th>Intership Sembuh</th>
                <th><input class="form-control form-control-sm" id="intership_sembuh" name="intership_sembuh"></th>
                <th>D.Spesialis Dirawat</th>
                <th><input class="form-control form-control-sm" id="dokter_spesialis_dirawat" name="dokter_spesialis_dirawat"></th>
                <th>D.Spesialis Isoman</th>
                <th><input class="form-control form-control-sm" id="dokter_spesialis_isoman" name="dokter_spesialis_isoman"></th>
                <th>D.Spesialis Sembuh</th>
                <th><input class="form-control form-control-sm" id="dokter_spesialis_sembuh" name="dokter_spesialis_sembuh"></th>
              </tr>
              <tr>
                <th>D.Umum Dirawat</th>
                <th><input class="form-control form-control-sm" id="dokter_umum_dirawat" name="dokter_umum_dirawat"></th>
                <th>D.Umum Isoman</th>
                <th><input class="form-control form-control-sm" id="dokter_umum_isoman" name="dokter_umum_isoman"></th>
                <th>D.Umum Sembuh</th>
                <th><input class="form-control form-control-sm" id="dokter_umum_sembuh" name="dokter_umum_sembuh"></th>
                <th>D.Gigi Dirawat</th>
                <th><input class="form-control form-control-sm" id="dokter_gigi_dirawat" name="dokter_gigi_dirawat"></th>
              </tr>
              <tr>
                <th>D.Gigi Isoman</th>
                <th><input class="form-control form-control-sm" id="dokter_gigi_isoman" name="dokter_gigi_isoman"></th>
                <th>D.Gigi Sembuh</th>
                <th><input class="form-control form-control-sm" id="dokter_gigi_sembuh" name="dokter_gigi_sembuh"></th>
                <th>Bidan Dirawat</th>
                <th><input class="form-control form-control-sm" id="bidan_dirawat" name="bidan_dirawat"></th>
                <th>Bidan Isoman</th>
                <th><input class="form-control form-control-sm" id="bidan_isoman" name="bidan_isoman"></th>
              </tr>
              <tr>
                <th>Bidan Sembuh</th>
                <th><input class="form-control form-control-sm" id="bidan_sembuh" name="bidan_sembuh"></th>
                <th>Apoteker Dirawat</th>
                <th><input class="form-control form-control-sm" id="apoteker_dirawat" name="apoteker_dirawat"></th>
                <th>Apoteker Isoman</th>
                <th><input class="form-control form-control-sm" id="apoteker_isoman" name="apoteker_isoman"></th>
                <th>Apoteker Sembuh</th>
                <th><input class="form-control form-control-sm" id="apoteker_sembuh" name="apoteker_sembuh"></th>
              </tr>
              <tr>
                <th>Radiografer Dirawat</th>
                <th><input class="form-control form-control-sm" id="radiografer_dirawat" name="radiografer_dirawat"></th>
                <th>Radiografer Isoman</th>
                <th><input class="form-control form-control-sm" id="radiografer_isoman" name="radiografer_isoman"></th>
                <th>Radiografer Sembuh</th>
                <th><input class="form-control form-control-sm" id="radiografer_sembuh" name="radiografer_sembuh"></th>
                <th>Analis Lab Dirawat</th>
                <th><input class="form-control form-control-sm" id="analis_lab_dirawat" name="analis_lab_dirawat"></th>
              </tr>
              <tr>
                <th>Analis Lab Isoman</th>
                <th><input class="form-control form-control-sm" id="analis_lab_isoman" name="analis_lab_isoman"></th>
                <th>Analis Lab Sembuh</th>
                <th><input class="form-control form-control-sm" id="analis_lab_sembuh" name="analis_lab_sembuh"></th>
                <th>Nakes.L Dirawat</th>
                <th><input class="form-control form-control-sm" id="nakes_lainnya_dirawat" name="nakes_lainnya_dirawat"></th>
                <th>Nakes.L Isoman</th>
                <th><input class="form-control form-control-sm" id="nakes_lainnya_isoman" name="nakes_lainnya_isoman"></th>
              </tr>
              <tr>
                <th>Nakes.L Sembuh</th>
                <th><input class="form-control form-control-sm" id="nakes_lainnya_sembuh" name="nakes_lainnya_sembuh"></th>
                <th>Perawat Dirawat</th>
                <th><input class="form-control form-control-sm" id="perawat_dirawat" name="perawat_dirawat"></th>
                <th>Perawat Isoman</th>
                <th><input class="form-control form-control-sm" id="perawat_isoman" name="perawat_isoman"></th>
                <th>Perawat Sembuh</th>
                <th><input class="form-control form-control-sm" id="perawat_sembuh" name="perawat_sembuh"></th>
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