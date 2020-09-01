<div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark"><?=$judul;?></h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active"><?=$judul; ?></li>
            </ol>
          </div>
        </div>
      </div>
    </div>
    <div class="content">
      <div class="container-fluid">
        <div class="row">
            <div class="col-12">
            <div class="flashdata" data-flashdata="<?=$this->session->flashdata('info'); ?>" data-pesan="<?=$this->session->flashdata('pesan'); ?>"></div>
                <div class="card">
                    <div class="card-header">
                      <a href="<?=site_url('/Pkb/tambah');?>" class="btn btn-success float-right">Tambah Data</a>
                    </div>
                    <div class="card-body table-responsive">
                        <table class="table table-hover" id="tblpkb">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Tanggal</th>
                                    <th>Sapi</th>
                                    <th>Hasil</th>
                                    <th>Status</th>
                                    <th>Keterangan</th>
                                    <th>Petugas</th>
                                    <th>&nbsp;</th>
                                    <th>&nbsp;</th>
                                </tr>
                            </thead>
                            <tbody id="tbltampil"> 
                           
                            </tbody>
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
        <form action="<?=site_url('/Pkb/hapus')?>" method="post">
        <input type="hidden" name="idpkb">
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