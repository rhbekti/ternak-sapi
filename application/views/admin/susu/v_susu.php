<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1><?= $judul; ?></h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active"><?= $judul; ?></li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    .<div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#ModalTambah">
                Tambah Data
              </button>
            </div>
            <div class="flashdata" data-flashdata="<?= $this->session->flashdata('info'); ?>"></div>
            <div class="card-body table-responsive">
              <table class="table table-hover" id="tblsusu">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>Tag Sapi</th>
                    <th>Kandang</th>
                    <th>Pagi (L)</th>
                    <th>Sore (L)</th>
                    <th>&nbsp;</th>
                    <th>&nbsp;</th>
                  </tr>
                </thead>

              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<!-- Modal -->
<div class="modal fade" id="Modalhapus" tabindex="-1" role="dialog" aria-labelledby="judulmodal" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="judulmodal">Hapus Data</h5>
      </div>
      <div class="modal-body">
        <form action="<?= site_url('/susu/hapus'); ?>" method="post">
          <input type="hidden" name="idpengukuran" id="id" required>
          Apakah yakin dihapus?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-danger">Hapus</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="ModalTambah" tabindex="-1" role="dialog" aria-labelledby="ModalTambahLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="ModalTambahLabel">Tambah Data Produksi</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <?= form_open('/Susu/tambah') ?>
        <div class="form-group">
          <label for="tagsapi">Tag Sapi</label>
          <input type="text" name="tagsapi" id="tagsapi" class="form-control" autocomplete="off" required>
          <input type="hidden" name="kandang" id="kandang">
          <input type="hidden" name="idsapi" id="idsapi" required>
          <span class="text-danger" id="validasi_tag"></span>
        </div>
        <div class="form-group">
          <label for="tgl">Tanggal</label>
          <div class="input-group date" id="tglsusu" data-target-input="nearest">
            <input type="text" name="tanggal" class="form-control datetimepicker-input" data-target="#tglsusu" required />
            <div class="input-group-append" data-target="#tglsusu" data-toggle="datetimepicker">
              <div class="input-group-text"><i class="fa fa-calendar"></i></div>
            </div>
          </div>
        </div>
        <div class="form-group">
          <label for="xlaktasi">Xlaktasi</label>
          <input type="text" name="xlaktasi" id="xlaktasi" class="form-control" required>
        </div>
        <div class="form-group">
          <label for="pagi">Produksi Pagi</label>
          <input type="text" name="pagi" id="pagi" class="form-control" required>
        </div>
        <div class="form-group">
          <label for="sore">Produksi Sore</label>
          <input type="text" name="sore" id="sore" class="form-control" required>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary btn-tutup" data-dismiss="modal">Tutup</button>
        <button type="submit" class="btn btn-primary">Simpan</button>
        <?= form_close(); ?>
      </div>
    </div>
  </div>
</div>



<!-- Modal -->
<div class="modal fade" id="ModalEdit" tabindex="-1" role="dialog" aria-labelledby="ModalEditLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="ModalEditLabel">Edit Data Produksi</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <?= form_open('/Susu/edit') ?>
        <div class="form-group">
          <input type="hidden" name="idpengukuran">
          <label for="tagsapiedit">Tag Sapi</label>
          <input type="text" name="tagsapi_edit" id="tagsapiedit" class="form-control" autocomplete="off" required>
          <input type="hidden" name="kandang_edit" id="kandang_edit">
          <input type="hidden" name="idsapi_edit" id="idsapi_edit" required>
          <span class="text-danger" id="validasi_tag"></span>
        </div>
        <div class="form-group">
          <label for="tgl">Tanggal</label>
          <div class="input-group date" id="tglsusu" data-target-input="nearest">
            <input type="text" name="tanggal_edit" class="form-control datetimepicker-input" data-target="#tglsusu" required />
            <div class="input-group-append" data-target="#tglsusu" data-toggle="datetimepicker">
              <div class="input-group-text"><i class="fa fa-calendar"></i></div>
            </div>
          </div>
        </div>
        <div class="form-group">
          <label for="xlaktasi_edit">Xlaktasi</label>
          <input type="text" name="xlaktasi_edit" id="xlaktasi_edit" class="form-control" required>
        </div>
        <div class="form-group">
          <label for="pagi_edit">Produksi Pagi</label>
          <input type="text" name="pagi_edit" id="pagi_edit" class="form-control" required>
        </div>
        <div class="form-group">
          <label for="sore_edit">Produksi Sore</label>
          <input type="text" name="sore_edit" id="sore_edit" class="form-control" required>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary btn-tutup" data-dismiss="modal">Tutup</button>
        <button type="submit" class="btn btn-success">Perbarui</button>
        <?= form_close(); ?>
      </div>
    </div>
  </div>
</div>