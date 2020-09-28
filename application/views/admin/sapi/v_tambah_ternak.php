<?php
date_default_timezone_set('Asia/Jakarta');
?>
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
        <div class="col-12 col-md-6 col-sm-12">
          <div class="card">
            <div class="card-body">
              <form action="<?= site_url('/Sapi/save') ?>" method="post">
                <div class="form-group">
                  <label for="tagsapi">Tag Sapi</label>
                  <input type="text" name="tagsapi" class="form-control">
                </div>
                <div class="form-group">
                  <label for="namasapi">Nama Sapi</label>
                  <input type="text" name="namasapi" class="form-control">
                </div>
                <div class="form-group">
                  <label for="kelamin">Jenis Kelamin</label>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="kelamin" id="jantan" value="Jantan">
                    <label class="form-check-label" for="exampleRadios1">
                      Jantan
                    </label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="kelamin" id="betina" value="Betina">
                    <label class="form-check-label" for="exampleRadios2">
                      Betina
                    </label>
                  </div>
                  <div class="form-group">
                    <label for="bangsa">Bangsa Ternak</label>
                    <select name="bangsa" id="bangsa" class="form-control">
                      <?php foreach ($bangsa as $row) { ?>
                        <option value="<?= $row->id_bangsa; ?>"><?= $row->nama_bangsa; ?></option>
                      <?php } ?>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="status">Status</label>
                    <select name="status" id="status" class="form-control">
                      <option value="hidup">Hidup</option>
                      <option value="mati">Mati</option>
                      <option value="dijual">Dijual</option>
                      <option value="afkir">Afkir</option>
                      <option value="mutasi">Mutasi</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="statuspc">Status PC</label>
                    <select name="statuspc" id="statuspc" class="form-control">
                      <option value="PC">PC</option>
                      <option value="DC">DC</option>
                      <option value="ANAK DC">ANAK DC</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="kandang">Kandang</label>
                    <input type="text" name="kandang" class="form-control" id="kandang" placeholder="Masukkan Nama Kandang">
                    <input type="hidden" name="idkandang" class="form-control" id="idkandang" placeholder="idkandang" readonly>
                  </div>
                  <div class="form-group">
                    <label for="peternakan">peternakan</label>
                    <input type="text" name="peternakan" class="form-control" id="peternakan" placeholder="Masukkan Nama peternakan">
                    <input type="hidden" name="idpeternakan" class="form-control" id="idpeternakan" placeholder="idpeternakan" readonly>
                  </div>
                </div>
            </div>
          </div>
        </div>
        <!-- card samping -->
        <div class="col-12 col-md-6 col-sm-12">
          <div class="card">
            <div class="card-body">
              <div class="form-group">
                <label for="tipeternak">Tipe Ternak</label>
                <select name="tipeternak" id="tipeternak" class="form-control">
                  <option value="IB">IB</option>
                  <option value="ET">ET</option>
                  <option value="Alam">Alam</option>
                </select>
              </div>
              <div class="row">
                <div class="col-12 col-md-6 col-sm-12">
                  <div class="form-group">
                    <label for="tgllahir">Tanggal Kelahiran</label>
                    <div class="input-group date" id="tgllahirform" data-target-input="nearest">
                      <input type="text" name="tgllahir" class="form-control datetimepicker-input" data-target="#tgllahirform" />
                      <div class="input-group-append" data-target="#tgllahirform" data-toggle="datetimepicker">
                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-12 col-md-6 col-sm-12">
                  <div class="form-group">
                    <label for="waktulahir">Waktu Melahirkan</label>
                    <div class="input-group date" id="waktulahir" data-target-input="nearest">
                      <input type="text" name="waktulahir" class="form-control datetimepicker-input" data-target="#waktulahir" />
                      <div class="input-group-append" data-target="#waktulahir" data-toggle="datetimepicker">
                        <div class="input-group-text"><i class="fa fa-clock"></i></div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label for="bobotlahir">Bobot Lahir (kg)</label>
                <input type="number" name="bobotlahir" id="bobot" class="form-control">
              </div>
              <div class="form-group">
                <label for="uzur">Uzur</label>
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="uzur" id="ck_uzur" value="1">
                  <label class="form-check-label" for="exampleRadios1">
                    Iya
                  </label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="uzur" id="ci_uzur" value="0">
                  <label class="form-check-label" for="exampleRadios2">
                    Tidak
                  </label>
                </div>
                <div class="form-group">
                  <label for="uzur">KSO</label>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="kso" id="ck_kso" value="1">
                    <label class="form-check-label" for="exampleRadios1">
                      Iya
                    </label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="kso" id="ci_kso" value="0">
                    <label class="form-check-label" for="exampleRadios2">
                      Tidak
                    </label>
                  </div>
                  <div class="form-group">
                    <label for="uzur">Balai</label>
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="balai" id="ck_balai" value="1">
                      <label class="form-check-label" for="exampleRadios1">
                        Iya
                      </label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="balai" id="ci_balai" value="0">
                      <label class="form-check-label" for="exampleRadios2">
                        Tidak
                      </label>
                    </div>
                    <div class="form-group mb-4">
                      <label for="vbc">VBC</label>
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="vbc" id="ck_vbc" value="1">
                        <label class="form-check-label" for="exampleRadios1">
                          Iya
                        </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="vbc" id="ci_vbc" value="0">
                        <label class="form-check-label" for="exampleRadios2">
                          Tidak
                        </label>
                      </div>
                      <br><br>
                      <!-- hidden input -->
                      <input type="hidden" name="idsapi" required>
                      <input type="hidden" name="tglinput" value="<?= date('Y-m-d H:i:s'); ?>">
                      <button type="submit" name="update" class="btn btn-success float-right mx-3">Tambah</button>
                      <a href="<?= site_url('/Sapi'); ?>" class="btn btn-danger float-right" id="btn_kembali">Batal</a>
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