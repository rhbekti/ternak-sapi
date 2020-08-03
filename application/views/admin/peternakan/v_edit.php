<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1><?=$judul;?></h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active"><?=$judul;?></li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-6">
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Data Peternakan</h3>
            </div>
            <div class="card-body">
            <form action="<?=site_url('/peternakan/update'); ?>" method="POST">
            <input type="hidden" name="id_peternakan" value="<?=$ra->id_peternakan; ?>">
              <div class="form-group">
                <label for="pemilik">Nama Pemilik</label>
                <input type="text" name="pemilik" id="pemilik" class="form-control" value="<?=$ra->namapeternak;?>">
              </div>
              <div class="form-group">
                <label for="nmpeternakan">Nama Peternakan</label>
                <input type="text" name="nmpeternakan" id="nmpeternakan" class="form-control" value="<?=$ra->namapeternakan;?>">
              </div>
              <div class="form-group">
                <label for="alpeternakan">Alamat Peternakan</label>
                <input type="text" name="alpeternakan" id="alpeternakan" class="form-control" value="<?=$ra->alamat;?>">
              </div>
              <div class="form-group">
                <label for="notelp">No Telp</label>
                <input type="number" name="notelp" id="notelp" class="form-control" value="<?=$ra->notelp;?>">
              </div>
              <div class="row">
                  <div class="col-md-6">
                      <div class="form-group">
                        <label for="kelompok">Kelompok</label>
                        <input type="text" name="kelompok" class="form-control" id="kelompok" placeholder="Masukkan Nama Kelompok" value="<?=$ra->namakelompok;?>">
                        <input type="hidden" name="kodekelompok" class="form-control" id="kodekelompok" value="<?=$ra->kodekelompok;?>" placeholder="Kode Kelompok" readonly>
                      </div>
                  </div>
                     

                  <div class="col-md-6">
                      <div class="form-group">
                        <label for="koperasi">Koperasi</label>
                        <input type="text" name="koperasi" class="form-control" id="koperasi" placeholder="Masukkan Nama Koperasi" value="<?=$ra->namakoperasi;?>">
                        <input type="hidden" name="kodekoperasi" class="form-control" value="<?=$ra->kodekoperasi;?>" id="kodekoperasi" placeholder="Kode Koperasi" readonly>
                      </div>
                  </div>
              </div>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <div class="col-md-6">
          <div class="card card-secondary">
            <div class="card-header">
              <h3 class="card-title">Data peternakan</h3>
            </div>
            <div class="card-body">
              <div class="form-group">
                <label for="nosiup">No SIUP</label>
                <input type="number" name="nosiup" id="nosiup" class="form-control" value="<?=$ra->nosiup;?>">
              </div>
              <div class="form-group">
                <label for="tglberdiri">Tanggal peternakan</label>
                <input type="date" name="tglberdiri" id="tglberdiri" class="form-control" value="<?=$ra->tglberdiri;?>">
              </div>
              <div class="form-group">
                <label for="propinsi">Provinsi</label>
                <select name="propinsi" id="propinsi" class="form-control">
                    <?php foreach($propinsi as $row) { 
                        echo "<option value='$row->kodepropinsi'".(($ra->kodepropinsi == $row->kodepropinsi)?"SELECTED":"").">$row->namapropinsi</option>";
                        } ?>
                </select>
            </div>
            <div class="form-group">
                <label for="kabupaten">Kabupaten</label>
                <select name="kabupaten" id="kabupaten" class="form-control">
                    <?php foreach($kabupaten as $row) { 
                        echo "<option value='$row->kodekabupaten'".(($ra->kodekabupaten == $row->kodekabupaten)?"SELECTED":"").">$row->namakabupaten</option>";
                        } ?>
                </select>
            </div>
            <div class="form-group">
                <label for="kecamatan">Kecamatan</label>
                <select name="kecamatan" id="kecamatan" class="form-control">
                    <?php foreach($kecamatan as $row) { 
                        echo "<option value='$row->kodekecamatan'".(($ra->kodekecamatan == $row->kodekecamatan)?"SELECTED":"").">$row->namakecamatan</option>";
                        } ?>
                </select>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-12">
          <input type="hidden" name="user_id" value="<?=$id_user->id; ?>">
          <a href="<?=site_url('/Peternakan'); ?>" class="btn btn-secondary float-right">Cancel</a>
          <button type="submit" class="btn btn-success float-right mx-3">Simpan</button>
        </form>
        </div>
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->