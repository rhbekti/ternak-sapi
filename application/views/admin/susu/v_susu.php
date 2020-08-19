<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1><?=$judul;?></h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active"><?=$judul;?></li>
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
                  <a href="<?=site_url('/Susu/tambah');?>" class="btn btn-success float-right">Tambah Data </a>
                  </div>
                <div class="flashdata" data-flashdata="<?=$this->session->flashdata('info'); ?>"></div>
                    <div class="card-body table-responsive">
                        <table class="table table-hover" id="tblsusu">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Tanggal Produksi</th>
                                    <th>Nama Sapi</th>
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
        <form action="<?=site_url('/susu/hapus'); ?>" method="post">
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

