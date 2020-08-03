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
                    <form action="<?=site_url('/koperasi/save');?>" method="post">
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                                <label for="nama">Nama</label>
                                <input type="text" name="nama" id="nama" class="form-control" value="<?=set_value('nama'); ?>">
                                <?= form_error('nama','<small class="text-danger">','</small>'); ?>
                            </div>
                            <div class="form-group">
                                <label for="alamat">Alamat</label>
                                <input type="text" name="alamat" id="alamat" class="form-control" value="<?=set_value('alamat'); ?>">
                                <?= form_error('alamat','<small class="text-danger">','</small>'); ?>
                            </div>
                            <div class="form-group">
                                <label for="notelpkoperasi">No Telp</label>
                                <input type="number" name="notelpkoperasi" id="notelpkoperasi" class="form-control" value="<?=set_value('notelpkoperasi'); ?>">
                                <?= form_error('notelpkoperasi','<small class="text-danger">','</small>'); ?>
                            </div>
                          </div>
                          <div class="col-md-6">
                              <div class="form-group">
                                <label for="propinsi">Provinsi</label>
                                <select name="propinsi" id="propinsi" class="form-control" required>
                                  <option value="0">--Pilih--</option>
                                  <?php foreach($propinsi as $row) { ?>
                                    <option value="<?=$row->kodepropinsi; ?>"><?=$row->namapropinsi; ?></option>
                                  <?php } ?>
                                </select>
                              </div>
                              <div class="form-group">
                                <label for="kabupaten">Kabupaten</label>
                                <select name="kabupaten" id="kabupaten" class="kabupaten form-control">
                                  <option value="0">--Pilih--</option>
                                </select>
                              </div>
                              <div class="form-group">
                                <label for="kecamatan">Kecamatan</label>
                                <select name="kecamatan" id="kecamatan" class="form-control">
                                  <option value="0">--Pilih--</option>
                                </select>
                              </div>
                          </div>
                        </div>
                        <button type="submit" class="btn btn-success">Simpan</button>
                        <a href="<?=site_url('/koperasi'); ?>" class="btn btn-danger">Batal</a>
                    </form>
                    </div>
                </div>
            </div>
        </div>
      </div>
    </div>
  </div>
  

  


