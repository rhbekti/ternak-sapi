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
        <div class="pesanerror" data-pesanerror="<?=$this->session->flashdata('error'); ?>"></div>
          <div class="flashdata" data-flashdata="<?= $this->session->flashdata('info'); ?>" data-pesan="<?= $this->session->flashdata('pesan'); ?>"></div>
          <div class="card">
            <div class="card-header">
              <!-- Button trigger modal -->
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
                    <th>Sapi Betina</th>
                    <th>Sapi Jantan</th>
                    <th>Keterangan</th>
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
        <form action="<?= site_url('/Reproduksi/hapus') ?>" method="post">
          <input type="hidden" name="idet">
          <input type="hidden" name="jenis" value="ET">
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

<!-- Modal tambah -->
<div class="modal fade" id="ModalTambah" tabindex="-1" aria-labelledby="ModalTambahLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="ModalTambahLabel">Tambah Data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="<?= site_url('/Reproduksi_ET/tambah'); ?>" method="post">
          <div class="form-group">
            <label for="tgl">Tanggal</label>
            <div class="input-group date" id="tglform" data-target-input="nearest">
              <div class="input-group-append" data-target="#tglform" data-toggle="datetimepicker">
                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
              </div>
              <input type="text" name="tanggal" class="form-control datetimepicker-input" data-target="#tglform" value="<?=set_value('tanggal');?>" />
            </div>
            <?= form_error("tanggal",'<small class="text-danger">','</small>'); ?>
          </div>
          <div class="form-group mb-3">
            <label for="sapijantan">Sapi Jantan</label>
            <div class="input-group">
              <div class="input-group-prepend">
                <button class="btn btn-success" type="button" id="ternak-jantan"><i class="fas fa-search"></i></button>
              </div>
              <input type="hidden" name="idsapijantan">
              <input type="text" class="form-control" name="sapijantan" placeholder="Pilih Sapi Jantan" readonly>
            </div>
            <?= form_error("sapijantan",'<small class="text-danger">','</small>'); ?>
          </div>
          <div class="form-group mb-3">
            <label for="sapibetina">Sapi Betina</label>
            <div class="input-group">
              <div class="input-group-prepend">
                <button class="btn btn-success" type="button" id="ternak-betina"><i class="fas fa-search"></i></button>
              </div>
              <input type="hidden" name="idsapibetina">
              <input type="text" class="form-control" name="sapibetina" placeholder="Pilih Sapi Betina" readonly>
            </div>
            <?= form_error("sapibetina",'<small class="text-danger">','</small>'); ?>
          </div>
          <div class="form-group">
            <label for="keterangan">Keterangan</label>
            <textarea name="keterangan" id="keterangan" class="form-control" cols="10" rows="4"></textarea>
          </div>
          <input type="hidden" name="idpetugas" value="<?=$id_user->id;?>">
      </div>
      <div class="modal-footer">
        <a href="<?=site_url('/Reproduksi_ET');?>" class="btn btn-danger">Batal</a>
        <button type="submit" class="btn btn-success">Simpan</button>
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
<!-- modal data ternak sapi jantan -->
<div class="modal fade" id="Modalternakjantan" tabindex="-1" role="dialog" aria-labelledby="judulmodal" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="judulmodal">Data Ternak</h5>
            </div>
            <div class="modal-body table-responsive">
                <table class="table table-hover" id="tbljantan">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Sapi</th>
                            <th>Kelamin</th>
                            <th>Peternakan</th>
                            <th>&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody id="tabel-sapi-jantan">
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
<!-- modal hapus data -->
<!-- Modal -->
<div class="modal fade" id="ModalHapus" tabindex="-1" role="dialog" aria-labelledby="ModalHapusTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="ModalHapusTitle">Hapus Data</h5>
      </div>
      <div class="modal-body">
        <form action="<?=site_url('/Reproduksi_ET/hapus');?>" method="post">
          <input type="hidden" name="idtransfer">
          Apakah yakin?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-danger">Hapus</button>
        </form>
      </div>
    </div>
  </div>
</div>