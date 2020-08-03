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
                    <form action="<?=site_url('/koperasi/perbarui');?>" method="post">
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                            <input type="hidden" name="kodekoperasi" value="<?=$rs->kodekoperasi; ?>">
                            <label for="nama">Nama</label>
                            <input type="text" name="nama" id="nama" class="form-control" value="<?=$rs->namakoperasi; ?>">
                            <?= form_error('nama','<small class="text-danger">','</small>'); ?>
                        </div>
                        <div class="form-group">
                            <label for="alamat">Alamat</label>
                            <input type="text" name="alamat" id="alamat" class="form-control" value="<?=$rs->alamatkoperasi; ?>">
                            <?= form_error('alamat','<small class="text-danger">','</small>'); ?>
                        </div>
                        <div class="form-group">
                            <label for="notelpkoperasi">No telp koperasi</label>
                            <input type="number" name="notelpkoperasi" id="notelpkoperasi" class="form-control" value="<?=$rs->notelpkoperasi; ?>">
                            <?= form_error('notelpkoperasi','<small class="text-danger">','</small>'); ?>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                            <label for="propinsi">Provinsi</label>
                            <select name="propinsi" id="propinsi" class="form-control">
                                <?php foreach($propinsi as $row) { 
                                  echo "<option value='$row->kodepropinsi'".(($rs->kodepropinsi == $row->kodepropinsi)?"SELECTED":"").">$row->namapropinsi</option>";
                                 } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="kabupaten">Kabupaten</label>
                            <select name="kabupaten" id="kabupaten" class="form-control">
                                <?php foreach($kabupaten as $row) { 
                                  echo "<option value='$row->kodekabupaten'".(($rs->kodekabupaten == $row->kodekabupaten)?"SELECTED":"").">$row->namakabupaten</option>";
                                 } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="kecamatan">Kecamatan</label>
                            <select name="kecamatan" id="kecamatan" class="form-control">
                                <?php foreach($kecamatan as $row) { 
                                  echo "<option value='$row->kodekecamatan'".(($rs->kodekecamatan == $row->kodekecamatan)?"SELECTED":"").">$row->namakecamatan</option>";
                                 } ?>
                            </select>
                        </div>
                      </div>
                    </div>
                        <!-- tombol kirim -->
                        <button type="submit" class="btn btn-success">Perbarui</button>
                        <a href="<?=site_url('/koperasi'); ?>" class="btn btn-danger">Batal</a>
                    </form>
                    </div>
                </div>
            </div>
        </div>
      </div>
    </div>
  </div>
  

  


