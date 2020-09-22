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
            <li class="breadcrumb-item"><a href="<?= base_url(); ?>">Home</a></li>
            <li class="breadcrumb-item active"><?= $judul; ?></li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">

    <!-- Default box -->
    <div class="card">
      <div class="flashdata" data-flashdata="<?= $this->session->flashdata('info'); ?>"></div>
      <div class="pesanerror" data-pesanerror="<?= $this->session->flashdata('error'); ?>"></div>
      <div class="card-header">
        <button type="button" class="btn btn-sm btn-primary float-right" data-toggle="modal" data-target="#aturpengeringan"><i class="fas fa-clock"></i> Atur</button>
        <ul class="nav nav-tabs mb-3">
          <li class="nav-item">
            <a class="nav-link active" data-toggle="tab" href="#home">Terjadwal</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#menu1">Detail Pengeringan</a>
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
                  <th>Status</th>
                  <th>&nbsp;</th>
                </tr>
              </thead>
              <tbody id="tbl-pkb">
              </tbody>
            </table>
          </div>
        </div>
        <div class="tab-pane container" id="menu1">
          <div class="card-body table-responsive">
            <table class="table table-hover w-100" id="tblpengeringan">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Tag Sapi</th>
                  <th>Tanggal Mulai</th>
                  <th>Tanggal Akhir</th>
                </tr>
              </thead>
            </table>
          </div>
        </div>
      </div>
    </div>
    <!-- /.card -->

  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->


<!-- Modal -->
<div class="modal fade" id="aturpengeringan" tabindex="-1" role="dialog" aria-labelledby="aturpengeringanLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="aturpengeringanLabel">Atur Pengeringan</h5>
      </div>
      <div class="modal-body">
        <?= form_open('/Pengeringan/aturpengeringan') ?>
        <div class="form-group">
          <label for="tglhari">Awal Pengeringan</label>
          <input type="number" name="tglawal" placeholder="jumlah hari" id="tglawal" class="form-control">
        </div>
        <div class="form-group">
          <label for="tglhari">Awal Akhir</label>
          <input type="number" name="tglakhir" placeholder="jumlah hari" id="tglakhir" class="form-control">
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