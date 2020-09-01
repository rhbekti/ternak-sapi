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
            <div class="card">
              <div class="card-body">
              <div class="flashdata" data-flashdata="<?=$this->session->flashdata('info'); ?>" data-pesan="<?=$this->session->flashdata('pesan'); ?>"></div>
                <form action="<?=site_url('/reproduksi/save');?>" method="post">
                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="tgl">Tanggal Pengajuan</label>
                      <div class="input-group date" id="tglform" data-target-input="nearest">
                        <div class="input-group-append" data-target="#tglform" data-toggle="datetimepicker">
                          <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                        <input type="text" name="tanggal" class="form-control datetimepicker-input" data-target="#tglform" />
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="petugas">Petugas</label>
                      <input type="hidden" name="idpetugas">
                      <input type="text" name="petugas" id="petugas" class="form-control">
                      <input type="hidden" name="idpetugas">
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                        <label for="kodesemen">Nama Sapi Jantan</label>
                            <div class="input-group">
                                <input type="hidden" name="idsapijantan">
                                <input type="text" class="form-control" id="namasapijantan" name="namasapijantan" autocomplete="off">
                                <div class="input-group-append">
                                <span type="button" data-toggle="modal" data-target="#view_ternak_jantan" class="input-group-text bg-primary" id="cari-semen"><i class="fas fa-search"></i></span>
                            </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        </div>
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-body">
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="namasapi">Nama Sapi Betina</label>
                        <div class="input-group">
                          <input type="hidden" name="idsapi">
                          <input type="text" class="form-control" id="namasapi" name="namasapi" autocomplete="off">
                          <div class="input-group-append">
                            <span type="button" data-toggle="modal" data-target="#view_ternak" class="input-group-text bg-primary" id="cari-sapi"><i class="fas fa-search"></i></span>
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <input type="hidden" name="jenisreproduksi" id="jenisreproduksi" class="form-control" value="ET">
                      </div>
                    </div>
                    <div class="col-md-6">
                        <label for="keterangan">Keterangan</label>
                        <textarea name="keterangan" id="keterangan" cols="3" rows="5" class="form-control">
                        </textarea>
                        <button type="submit" class="btn btn-success float-right my-3">Simpan</button>
                        <a href="<?=site_url('/Reproduksi_ET');?>" class="btn btn-danger float-right my-3 mx-3">Batal</a>
                        </form>
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
  <!-- Modal Peterakan-->
<div class="modal fade" id="view_ternak" tabindex="-1" role="dialog" aria-labelledby="view_peternakanLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
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
                <table class="table" id="tblsapi">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Sapi</th>
                            <th>Peternakan</th>
                            <th>Kelamin</th>
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
  <!-- Modal Peterakan Jantan-->
<div class="modal fade" id="view_ternak_jantan" tabindex="-1" role="dialog" aria-labelledby="view_peternakanLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
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
                <table class="table" id="tblsapijantan">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Sapi</th>
                            <th>Peternakan</th>
                            <th>Kelamin</th>
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
  
 