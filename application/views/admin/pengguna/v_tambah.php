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
                    <form action="<?=site_url('/Pengguna/save');?>" method="post">
                        <div class="form-group">
                            <label for="nama">Nama</label>
                            <input type="text" name="nama" id="nama" class="form-control" value="<?=set_value('nama'); ?>">
                            <?= form_error('nama','<small class="text-danger">','</small>'); ?>
                        </div>
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" name="username" id="username" class="form-control" value="<?=set_value('username'); ?>">
                            <?= form_error('username','<small class="text-danger">','</small>'); ?>
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
                        <div class="form-group">
                            <label for="level">Level</label>
                            <select name="level" id="level" class="form-control">
                                <?php foreach($level as $row) { ?>
                                    <option value="<?=$row->id_level; ?>"><?=$row->nama_level; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-success">Simpan</button>
                        <a href="<?=site_url('/Pengguna'); ?>" class="btn btn-danger">Batal</a>
                    </form>
                    </div>
                </div>
            </div>
        </div>
      </div>
    </div>
  </div>
  

  


