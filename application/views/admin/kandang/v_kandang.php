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
                <div class="card">
                  <div class="card-header">
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-success float-right" data-toggle="modal" data-target="#tambahdata">
                    Tambah Data
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="tambahdata" tabindex="-1" role="dialog" aria-labelledby="tambahdataLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="tambahdataLabel">Modal title</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="<?=site_url('/Kandang/save');?>" method="post">
                                <div class="form-group">
                                    <label for="namakandang">Nama Kandang</label>
                                    <input type="text" name="namakandang" id="namakandang" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="alamat">Alamat Kandang</label>
                                    <input type="text" name="alamat" id="alamat" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="kapasitas">Kapasitas</label>
                                    <input type="text" name="kapasitas" id="kapasitas" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="peternakan">Peternakan</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#view_peternakan">Pilih</button>
                                        </div>
                                        <input type="text" class="form-control" name="namapeternakan" readonly>
                                        <input type="hidden" name="peternakan">
                                    </div>
                                </div>
                                <p class="small">
                                <b><i>Catatan : Data Harus Diisi Lengkap</i></b>
                                </p>
                            </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-success">Simpan</button>
                        </form>
                        </div>
                        </div>
                    </div>
                    </div>
                  </div>
                    <div class="card-body table-responsive">
                      <div class="container p-3">
                        <table class="table table-hover" id="tblkandang">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Alamat</th>
                                    <th>Kapasitas</th>
                                    <th>Peternakan</th>
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
  </div>
  
  <aside class="control-sidebar control-sidebar-dark">
    <div class="p-3">
      <h5>Title</h5>
      <p>Sidebar content</p>
    </div>
  </aside>

<!-- Modal -->
<div class="modal fade" id="ModalEdit" tabindex="-1" role="dialog" aria-labelledby="ModalEditLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="ModalEditLabel">Edit Data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="<?=site_url('Kandang/update');?>" method="post">
        <input type="hidden" name="idkandang" id="idkandang" class="form-control" required>
        <div class="form-group">
            <label for="namakandang">Nama Kandang</label>
            <input type="text" name="namakandang" id="namakandang" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="namakandang">Lokasi Kandang</label>
            <input type="text" name="lokasikandang" id="lokasikandang" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="kapasitas">Kapasitas</label>
            <input type="text" name="kapasitas" id="kapasitaskandang" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="peternakan">Peternakan</label>
            <div class="input-group mb-3">
                <input type="text" class="form-control" name="namapeternakan" readonly>
                <input type="hidden" name="peternakan">
                <div class="input-group-prepend">
                    <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#view_peternakan">Ubah</button>
                </div>
            </div>
        </div>
        <p class="small">
           <b><i>Catatan : Data Harus Diisi Lengkap</i></b>
        </p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-success">Perbarui</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="Modalhapus" tabindex="-1" role="dialog" aria-labelledby="judulmodal" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="judulmodal">Hapus Data</h5>
      </div>
      <div class="modal-body">
        <form action="<?=site_url('/kandang/delete'); ?>" method="post">
          <input type="hidden" name="idkandang" id="id" required>
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
<div class="modal fade" id="view_peternakan" tabindex="-1" role="dialog" aria-labelledby="view_peternakanLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="view_peternakanLabel">Data Peternakan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="card">
            <div class="card-body table-responsive">
                <table class="table" id="tblpeternakan">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Alamat</th>
                            <th>&nbsp;</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>
  


