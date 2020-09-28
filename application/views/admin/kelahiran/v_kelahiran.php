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
          <div class="flashdata" data-flashdata="<?= $this->session->flashdata('info'); ?>"></div>
          <div class="card">
            <div class="card-header">
              <!-- tambah data  -->
              <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#tambahData">
                Tambah Data
              </button>

              <!-- Modal tambah data-->
              <div class="modal fade" id="tambahData" tabindex="-1" role="dialog" aria-labelledby="tambahDataLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="tambahDataLabel">Tambah Data</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <form action="<?= site_url('/Kelahiran/tambah'); ?>" method="post">
                        <div class="form-group">
                          <label for="pilihternak">Pilih Ternak</label>
                          <div class="input-group mb-3">
                            <div class="input-group-prepend">
                              <button class="btn btn-success" type="button" id="pilihternak">Pilih</button>
                            </div>
                            <input type="hidden" name="idsapi">
                            <input type="text" class="form-control" name="namasapi" placeholder="Pilih Sapi" readonly>
                          </div>
                        </div>
                        <div class="form-group">
                          <label for="tanggal">Tanggal</label>
                          <div class="input-group date" id="datetimepicker1" data-target-input="nearest">
                            <input type="text" name="tanggal" class="form-control datetimepicker-input" data-target="#datetimepicker1" />
                            <div class="input-group-append" data-target="#datetimepicker1" data-toggle="datetimepicker">
                              <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                          </div>
                        </div>
                        <div class="form-group">
                          <label for="xlaktasi">Xlaktasi</label>
                          <input type="text" name="xlaktasi" id="xlaktasi" class="form-control">
                        </div>
                        <div class="form-group">
                          <label for="statuslahir">Status Lahir</label>
                          <select name="statuslahir" id="statuslahir" class="form-control">
                            <option value="single">Sigle</option>
                            <option value="kembar">Kembar</option>
                            <option value="abortus">Abortus</option>
                          </select>
                        </div>

                        <div class="form-group">
                          <label for="petugas">Nama Petugas</label>
                          <input type="hidden" name="idpetugas" id="idpetugas">
                          <input type="text" name="namapetugas" id="petugas" class="form-control" autocomplete="off">
                          <select id="list-petugas" class="form-control" multiple>

                          </select>
                          <input type="hidden" name="tglinput" value="<?= date('Y-m-d'); ?>">
                          <input type="hidden" name="idib" id="idib">
                          <input type="hidden" name="idfarm" id="idfarm">
                          <input type="hidden" name="idpkb" id="idpkb">
                        </div>
                        <div class="form-group">
                          <label for="keterangan">Keterangan</label>
                          <textarea name="keterangan" id="keterangan" cols="10" rows="5" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                      <button type="submit" class="btn btn-primary" id="SimpanData">Simpan</button>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="card-body table-responsive">
              <div class="container p-3">
                <table class="table table-hover" id="tblkelahiran">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Tanggal</th>
                      <th>Nama</th>
                      <th>Xlaktasi</th>
                      <th>Peternakan</th>
                      <th>Status</th>
                      <th>Keterangan</th>
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
<div class="modal fade" id="Modalhapus" tabindex="-1" role="dialog" aria-labelledby="judulmodal" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="judulmodal">Hapus Data</h5>
      </div>
      <div class="modal-body">
        <form action="<?= site_url('/kelahiran/delete'); ?>" method="post">
          <input type="hidden" name="idkelahiran" id="id" required>
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
<!-- Modal sapi-->
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
              <th>Tag Sapi</th>
              <th>Peternakan</th>
              <th>IB</th>
              <th>&nbsp;</th>
            </tr>
          </thead>
          <tbody id="tabel-sapi">
          </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal" id="btl">Batal</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal" id="btl1">Batal</button>
        </form>
      </div>
    </div>
  </div>
</div>