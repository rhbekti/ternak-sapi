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
            <div class="flashdata" data-flashdata="<?=$this->session->flashdata('info'); ?>"></div>
            <div class="pesanerror" data-pesanerror="<?=$this->session->flashdata('error'); ?>"></div>
                <div class="card">
                  <div class="card-header">
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#tambahsemen">
                    Tambah Data 
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="tambahsemen" tabindex="-1" role="dialog" aria-labelledby="tambahsemenLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="tambahsemenLabel">TAMBAH DATA</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="<?=site_url('/Semen/tambah');?>" method="post">
                            <div class="form-group">
                                <label for="kodesemen">Kode Semen</label>
                                <input type="text" class="form-control" name="kodesemen" value="<?=set_value("kodesemen"); ?>">
                                <?= form_error("kodesemen",'<small class="text-danger">','</small>'); ?>
                            </div>
                            <div class="form-group">
                                <label for="namasemen">Nama Semen</label>
                                <input type="text" class="form-control" name="namasemen" value="<?=set_value("namasemen"); ?>">
                                <?= form_error("namasemen",'<small class="text-danger">','</small>'); ?>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <a href="<?=site_url('/semen')?>" class="btn btn-danger">Batal</a>
                            <button type="submit" class="btn btn-success">Simpan</button>
                        </form>
                        </div>
                        </div>
                    </div>
                    </div>
                  </div>
                    <div class="card-body table-responsive">
                        <table class="table table-hover" id="tblsemen">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kode Semen</th>
                                    <th>Nama Semen</th>
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
    </div>
  </div>
  
  <aside class="control-sidebar control-sidebar-dark">
    <div class="p-3">
      <h5>Title</h5>
      <p>Sidebar content</p>
    </div>
  </aside>

 <!-- Modal -->
 <div class="modal fade" id="editsemen" tabindex="-1" role="dialog" aria-labelledby="editsemenLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="editsemenLabel">EDIT DATA</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form action="<?=site_url('/Semen/update');?>" method="post">
            <div class="form-group">
                <input type="hidden" name="kode">
                <label for="kodesemen">Kode Semen</label>
                <input type="text" class="form-control" id="editkode" name="kodesemen" value="<?=set_value("kodesemen"); ?>">
                <?= form_error("kodesemen",'<small class="text-danger">','</small>'); ?>
            </div>
            <div class="form-group">
                <label for="namasemen">Nama Semen</label>
                <input type="text" class="form-control" id="editnama" name="namasemen" value="<?=set_value("namasemen"); ?>">
                <?= form_error("namasemen",'<small class="text-danger">','</small>'); ?>
            </div>
        </div>
        <div class="modal-footer">
            <a href="<?=site_url('/semen')?>" class="btn btn-danger">Batal</a>
            <button type="submit" class="btn btn-success">Perbarui</button>
        </form>
        </div>
        </div>
    </div>
</div>
 <!-- Modal -->
 <div class="modal fade" id="hapussemen" tabindex="-1" role="dialog" aria-labelledby="hapussemenLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="hapussemenLabel">HAPUS DATA</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body text-center">
        <p class="text-danger"><i class="fas fa-exclamation-circle fa-4x"></i></p>
        <p>Apakah Yakin Menghapus Data ini?</p>
            <form action="<?=site_url('/Semen/delete');?>" method="post">
                <input type="hidden" name="kodesemen">
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" class="close" data-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-danger">Hapus</button>
        </form>
        </div>
        </div>
    </div>
</div>