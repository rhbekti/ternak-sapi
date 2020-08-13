<div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark"><?=$judul;?></h1>
          </div>
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
            <div class="col-12 col-md-6">
                <div class="card">
                    <div class="card-header">
                        DATA PETERNAKAN
                    </div>
                    <div class="card-body">
                        <button class="btn btn-primary float-right" type="button" data-toggle="modal" data-target="#view_ternak">Pilih Ternak</button>
                        <br>
                        <form action="<?=site_url('/susu/save');?>" method="post">
                        <div class="form-group">
                            <label for="sapi">Nama Sapi</label>
                            <input type="text" name="nmsapi" id="nmsapi" class="form-control" readonly>
                            <input type="hidden" name="idsapi" id="idsapi">
                        </div>  
                        <div class="form-group">
                            <label for="kandang">Nama Kandang</label>
                            <input type="text" name="nmkandang" id="nmkandang" class="form-control" readonly>
                            <input type="hidden" name="idkandang" id="idkandang">
                        </div>  
                        <div class="form-group">
                            <label for="peternakan">Nama Peternakan</label>
                            <input type="text" name="namapeternakan" id="nmpeternakan" class="form-control" readonly>
                            <input type="hidden" name="idpeternakan" id="idpeternakan">
                        </div>  
                        <p class="small">
                            <b><i>Data Akan Terisi otomatis sesuai peternakan</i></b>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="card">
                <div class="card-header">DATA PRODUKSI</div>
                <div class="card-body">
                        <div class="form-group">
                            <label for="pagi">Produksi Pagi</label>
                            <input type="number" name="pagi" id="pagi" class="form-control" placeholder="Liter">
                        </div>
                        <div class="form-group">
                            <label for="pagi">Produksi Sore</label>
                            <input type="number" name="sore" id="sore" class="form-control" placeholder="Liter">
                        </div>
                        <div class="form-group">
                            <label for="xlatasi">Xlatasi</label>
                            <input type="number" name="xlatasi" class="form-control">
                        </div>
                        <p class="small">
                            <b><i>Catatan : Data Harus Diisi Lengkap</i></b>
                        </p>
                        <button type="submit" class="btn btn-success">Simpan</button>
                        <a href="<?=site_url('/susu'); ?>" class="btn btn-danger">Batal</a>
                    </form>
                </div>
                </div>
            </div>
        </div>
      </div>
    </div>
  </div>
  
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
                            <th>Kandang</th>
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
  


