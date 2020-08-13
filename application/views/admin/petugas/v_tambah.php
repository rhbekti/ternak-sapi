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
                    <form action="<?=site_url('/Petugas/save');?>" method="post">
                        <div class="form-group">
                            <label for="nama">Nama</label>
                            <input type="text" name="nama" id="nama" class="form-control" value="<?=set_value('nama'); ?>">
                            <?= form_error('nama','<small class="text-danger">','</small>'); ?>
                        </div>
                        <div class="form-group">
                            <label for="nip">NIP</label>
                            <input type="number" name="nip" id="nip" class="form-control" value="<?=set_value("nip"); ?>">
                            <?= form_error("nip",'<small class="text-danger">','</small>'); ?>
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
                        <div class="form-group">
                            <label for="pass1">Password</label>
                            <input type="password" name="pass1" id="pass1" class="form-control" value="<?=set_value('pass1'); ?>">
                            <?= form_error('pass1','<small class="text-danger">','</small>'); ?>
                        </div>
                        <div class="form-group">
                            <label for="pass2">Retype Password</label>
                            <input type="password" name="pass2" id="pass2" class="form-control">
                            <?= form_error('pass2','<small class="text-danger">','</small>'); ?>
                        </div>
                        
                        <button type="submit" class="btn btn-success">Simpan</button>
                        <a href="<?=site_url('/Petugas'); ?>" class="btn btn-danger">Batal</a>
                    </form>
                    </div>
                </div>
            </div>
        </div>
      </div>
    </div>
  </div>
  

  


