<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark"><?= $judul; ?></h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active"><?= $judul; ?></li>
          </ol>
        </div>
      </div>
    </div>
  </div>
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="flashdata" data-flashdata="<?= $this->session->flashdata('info'); ?>" data-pesan="<?= $this->session->flashdata('pesan'); ?>"></div>
          <div class="card">
            <div class="card-header">
              <button type="button" class="btn btn-sm btn-primary float-right" data-toggle="modal" data-target="#aturpkb"><i class="fas fa-clock"></i> Atur</button>
              <ul class="nav nav-tabs mb-3">
                <li class="nav-item">
                  <a class="nav-link active" data-toggle="tab" href="#home">Pemeriksaan</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" data-toggle="tab" href="#menu1">Detail Pemeriksaan</a>
                </li>
              </ul>
            </div>
            <div class="tab-content">
              <div class="tab-pane container active" id="home">
                <div class="card-body table-responsive">
                  <table class="table table-hover" id="tblpkb">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Tag Sapi</th>
                        <th>Nama Sapi</th>
                        <th>IBKe</th>
                        <th>Status</th>
                        <th>&nbsp;</th>
                      </tr>
                    </thead>
                    <tbody id="tbl-pkb-body">
                    </tbody>
                  </table>
                </div>
              </div>
              <div class="tab-pane container" id="menu1">
                <div class="card-body table-responsive">
                  <table class="table table-hover w-100" id="tblperiksapkb">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Tag Sapi</th>
                        <th>Hasil</th>
                        <th>Petugas</th>
                      </tr>
                    </thead>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<aside class="control-sidebar control-sidebar-dark">
  <div class="p-3">
    <h5>Title</h5>
    <p>Sidebar content</p>
  </div>
</aside>

<!-- Modal hapus -->
<div class="modal fade" id="PeriksaData" tabindex="-1" role="dialog" aria-labelledby="hapusDataLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="hapusDataLabel">Pemeriksaan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <?= form_open('/Pkb/Tambah') ?>
        <input type="hidden" name="idib">
        <div class="form-group">
          <label for="tgl">Tanggal Pemeriksaan</label>

          <div class="input-group date" id="tglform" data-target-input="nearest">
            <div class="input-group-append" data-target="#tglform" data-toggle="datetimepicker">
              <div class="input-group-text"><i class="fa fa-calendar"></i></div>
            </div>
            <input type="text" name="tanggal" class="form-control datetimepicker-input" data-target="#tglform" required />
          </div>
          <?= form_error("tanggal", '<small class="text-danger">', '</small>'); ?>
        </div>
        <div class="form-group">
          <label for="sapi">Sapi</label>
          <input type="hidden" name="idsapi">
          <input type="text" name="namasapi" id="sapi" class="form-control" readonly>
        </div>
        <div class="form-group">
          <label for="hasil">Hasil</label>
          <select name="hasil" id="hasil" class="form-control">
            <option value="P">Positif</option>
            <option value="N">Negatif</option>
            <option value="Dubius">Dubius</option>
          </select>
        </div>
        <div class="form-group">
          <label for="petugas">Petugas</label>
          <input type="hidden" name="idpetugas" id="idpetugas">
          <input type="text" name="petugas" id="petugas" class="form-control" autocomplete="off" required>
          <?= form_error("petugas", '<small class="text-danger">', '</small>'); ?>
          <select class="form-control" name="listpetugas" id="list-petugas" multiple>

          </select>
        </div>
        <div class="form-group">
          <input type="hidden" name="tglinput" value="<?= date('Y-m-d'); ?>">
          <label for="keterangan">Keterangan</label>
          <textarea name="keterangan" id="keterangan" class="form-control" cols="10" rows="5"></textarea>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-danger">Simpan</button>
        <?= form_close(); ?>
      </div>
    </div>
  </div>
</div>


<!-- Modal -->
<div class="modal fade" id="aturpkb" tabindex="-1" role="dialog" aria-labelledby="aturpkbLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="aturpkbLabel">Atur Pemeriksaan</h5>
      </div>
      <div class="modal-body">
        <?= form_open('/Pkb/aturpkb') ?>
        <div class="form-group">
          <label for="tglhari">Hari</label>
          <input type="number" name="tglhari" placeholder="jumlah hari" id="tglhari" class="form-control">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
        <button type="submit" class="btn btn-primary">Simpan</button>
        <?= form_close(); ?>
      </div>
    </div>
  </div>
</div>