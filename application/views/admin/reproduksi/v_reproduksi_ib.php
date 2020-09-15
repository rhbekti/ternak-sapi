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
          <div class="pesanerror" data-pesanerror="<?= $this->session->flashdata('error'); ?>"></div>
          <div class="flashdata" data-flashdata="<?= $this->session->flashdata('info'); ?>" data-pesan="<?= $this->session->flashdata('pesan'); ?>"></div>
          <div class="card">
            <div class="card-header">
              <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#ModalTambah">
                Tambah Data
              </button>

            </div>
            <div class="card-body table-responsive">
              <table class="table table-hover" id="tblrepib">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>Nama</th>
                    <th>Nama Semen</th>
                    <th>IB</th>
                    <th>Intensitas</th>
                    <th>Keterangan</th>
                    <th>Petugas</th>
                    <th>&nbsp;</th>
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

<aside class="control-sidebar control-sidebar-dark">
  <div class="p-3">
    <h5>Title</h5>
    <p>Sidebar content</p>
  </div>
</aside>

<!-- Modal hapus -->
<div class="modal fade" id="hapusData" tabindex="-1" role="dialog" aria-labelledby="hapusDataLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="hapusDataLabel">Hapus Data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="<?= site_url('/Reproduksi/hapus'); ?>" method="post">
          <input type="hidden" name="idib" required>
          <input type="hidden" name="jenis" value="IB">
          Apakah Yakin dihapus?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-danger">Hapus</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Modal Tambah -->
<div class="modal fade" id="ModalTambah" tabindex="-1" role="dialog" aria-labelledby="ModalTambahLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="ModalTambahLabel">Tambah Data</h5>
      </div>
      <div class="modal-body">
        <form action="<?= site_url('/Reproduksi_IB/tambah'); ?>" method="post">
          <div class="row">
            <div class="col-12 col-md-6">
              <div class="form-group">
                <label for="tgl">Tanggal Pengajuan</label>
                <div class="input-group date" id="tglform" data-target-input="nearest">
                  <div class="input-group-append" data-target="#tglform" data-toggle="datetimepicker">
                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                  </div>
                  <input type="text" name="tanggal" class="form-control datetimepicker-input" data-target="#tglform" />
                </div>
                <?= form_error("tanggal", '<small class="text-danger">', '</small>'); ?>
              </div>
              <div class="form-group">
                <label for="petugas">Petugas</label>
                <input type="hidden" name="idpetugas" id="idpetugas">
                <input type="text" name="petugas" id="petugas" class="form-control" autocomplete="off">
                <?= form_error("petugas", '<small class="text-danger">', '</small>'); ?>
                <select class="form-control" name="listpetugas" id="list-petugas" multiple>

                </select>
              </div>
              <div class="form-group">
                <label for="keterangan">Keterangan</label>
                <textarea name="keterangan" id="keterangan" class="form-control" cols="10" rows="4"></textarea>
              </div>
            </div>
            <div class="col-12 col-md-6">
              <div class="form-group mb-3">
                <label for="kodesemen">Kode Semen</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <button type="button" class="btn btn-success" id="pilihsemen"><i class="fas fa-search"></i></button>
                  </div>
                  <input type="hidden" class="form-control" name="kodesemen">
                  <input type="text" class="form-control" placeholder="kodesemen" name="namasemen">
                </div>
                <?= form_error("kodesemen", '<small class="text-danger">', '</small>'); ?>
              </div>
              <div class="form-group">
                <label for="sapibetina">Sapi</label>
                  <input type="text" name="sapibetina" id="sapibetina" placeholder="ketik tag Sapi" class="form-control" autocomplete="off">
                  <small class="text-danger" id="validasi_tag"></small>
              </div>
              <div class="form-group">
                <label for="intensitas">Intensitas Birahi</label>
                <input type="number" name="intensitas" id="intensitas" class="form-control">
              </div>
              <div class="form-group">
                <input type="hidden" name="status" value="0">
              </div>
              <div class="form-group">
                <label for="ibke">IB ke</label>
                <input type="number" name="ibke" id="ibke" class="form-control">
                <?= form_error("ibke", '<small class="text-danger">', '</small>'); ?>
              </div>
            </div>
          </div>
      </div>
      <div class="modal-footer">
        <a href="<?= site_url('/Reproduksi_IB'); ?>" class="btn btn-secondary">Batal</a>
        <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- modal ternak betina -->
<div class="modal fade" id="Modalternak" tabindex="-1" role="dialog" aria-labelledby="judulmodal" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="judulmodal">Data Ternak</h5>
      </div>
      <div class="modal-body table-responsive">
        <table class="table table-hover" id="tblrepib">
          <thead>
            <tr>
              <th>No</th>
              <th>Nama Sapi</th>
              <th>Kelamin</th>
              <th>Peternakan</th>
              <th>&nbsp;</th>
            </tr>
          </thead>
          <tbody id="tabel-sapi">
          </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal" id="btl">Batal</button>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- modal semen -->
<div class="modal fade" id="ModalSemen" tabindex="-1" role="dialog" aria-labelledby="judulmodal" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="judulmodal">Data Ternak</h5>
      </div>
      <div class="modal-body table-responsive">
        <table class="table table-hover" id="tblsemen">
          <thead>
            <tr>
              <th>No</th>
              <th>Kode Semen</th>
              <th>Nama Semen</th>
              <th>&nbsp;</th>
            </tr>
          </thead>
          <tbody id="tabel-sapi">
          </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal" id="btl">Batal</button>
        </form>
      </div>
    </div>
  </div>
</div>