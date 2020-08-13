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
                    <a href="<?=site_url('/Petugas/add');?>" class="btn btn-primary">Tambah</a>
                  </div>
                    <div class="card-body table-responsive">
                        <table class="table table-hover" id="tblpetugas">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Jabatan</th>
                                    <th>Nip</th>
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


<!-- Modal Hapus-->
<div class="modal fade" id="Modalhapus" tabindex="-1" role="dialog" aria-labelledby="judulmodal" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="judulmodal">Hapus Data</h5>
      </div>
      <div class="modal-body">
        <form action="<?=site_url('/Petugas/hapus'); ?>" method="post">
          <input type="hidden" name="id" id="id" required>
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
<!-- Modal Edit-->
<div class="modal fade" id="ModalEdit" tabindex="-1" role="dialog" aria-labelledby="judulmodal" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="judulmodal">Edit Data</h5>
      </div>
      <div class="modal-body">
        <form action="<?=site_url('/Petugas/update'); ?>" method="post">
          <input type="hidden" name="id" id="id" required>
          <div class="form-group">
            <label for="nip">NIP</label>
            <input type="text" name="nip" id="nip" class="form-control">
          </div>
          <div class="form-group">
            <label for="nama">Nama</label>
            <input type="text" name="nama" id="nama" class="form-control">
          </div>
       
        <div class="form-group">
            <label for="jabatan">Jabatan</label>
            <select name="jabatan" id="jabatan" class="form-control">
              <option value="0">-- PILIH --</option>
              <option value="Administrator">Administrator</option>
              <option value="PETUGAS PKB">PETUGAS PKB</option>
              <option value="PETUGAS IB">PETUGAS IB</option>
              <option value="MEDIK VETERINER">MEDIK VETERINER</option>
              <option value="MEDIK VETERINER MUDA">MEDIK VETERINER MUDA</option>
            </select>
        </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-success">Perbarui</button>
        </form>
      </div>
    </div>
  </div>
</div>
  

