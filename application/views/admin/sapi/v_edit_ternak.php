<?php
date_default_timezone_set('Asia/Jakarta');
echo date('Y-m-d H:i:s');
?>
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
            <div class="col-12 col-md-6 col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <form action="<?=site_url('/Sapi/update')?>" method="post">
                        <div class="form-group">
                          <label for="tagsapi">Tag Sapi</label>
                          <input type="text" name="tagsapi" class="form-control" value="<?=$rs->tagsapi;?>">
                        </div>
                        <div class="form-group">
                          <label for="namasapi">Nama Sapi</label>
                          <input type="text" name="namasapi" class="form-control" value="<?=$rs->namasapi;?>">
                        </div>
                        <div class="form-group">
                          <label for="kelamin">Jenis Kelamin</label>
                          <div class="form-check">
                              <input class="form-check-input" type="radio" name="kelamin" id="jantan" value="Jantan" <?=($rs->kelamin == 'Jantan')?('checked'):('');?>>
                              <label class="form-check-label" for="exampleRadios1">
                                Jantan
                              </label>
                            </div>
                            <div class="form-check">
                              <input class="form-check-input" type="radio" name="kelamin" id="betina" value="Betina" <?=($rs->kelamin == 'Betina')?('checked'):('');?>>
                              <label class="form-check-label" for="exampleRadios2">
                                Betina
                              </label>
                          </div>
                          <div class="form-group">
                            <label for="bangsa">Bangsa Ternak</label>
                            <select name="bangsa" id="bangsa" class="form-control">
                              <?php foreach($bangsa as $row) { ?>
                                <option value="<?=$row->id_bangsa;?>" <?=($rs->idbangsa == $row->id_bangsa)?"SELECTED":""?>><?=$row->nama_bangsa;?></option>
                              <?php } ?>
                            </select>
                          </div>
                          <div class="form-group">
                            <label for="status">Status</label>
                            <select name="status" id="status" class="form-control">
                              <option value="hidup" <?=($rs->status == 'hidup')?"SELECTED":""?>>Hidup</option>
                              <option value="mati" <?=($rs->status == 'mati')?"SELECTED":""?>>Mati</option>
                              <option value="dijual" <?=($rs->status == 'dijual')?"SELECTED":""?>>Dijual</option>
                              <option value="afkir" <?=($rs->status == 'afkir')?"SELECTED":""?>>Afkir</option>
                              <option value="mutasi" <?=($rs->status == 'mutasi')?"SELECTED":""?>>Mutasi</option>
                            </select>
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
                                <option value="IB" <?=($rs->tipesapi == "IB")?"SELECTED":""?>>IB</option>
                                <option value="ET" <?=($rs->tipesapi == "ET")?"SELECTED":""?>>ET</option>
                                <option value="Alam" <?=($rs->tipesapi == "Alam")?"SELECTED":""?>>Alam</option>
                            </select>
                          </div>
                          <div class="form-group">
                            <label for="tgllahir">Tanggal Lahir</label>
                            <input type="datetime" name="tgllahir" id="tgllahir" value="<?=$rs->tgllahir;?>" class="form-control">
                          </div>
                          <div class="form-group">
                            <label for="bobot">Bobot Lahir (kg)</label>
                            <input type="number" name="bobot" id="bobot" class="form-control" value="<?=$rs->bobotlahir;?>">
                          </div>
                          <div class="form-group">
                          <label for="uzur">Uzur</label>
                          <div class="form-check">
                              <input class="form-check-input" type="radio" name="uzur" id="ck_uzur" value="1" <?=($rs->is_uzur == '1')?('checked'):('');?>>
                              <label class="form-check-label" for="exampleRadios1">
                                Iya
                              </label>
                            </div>
                            <div class="form-check">
                              <input class="form-check-input" type="radio" name="uzur" id="ci_uzur" value="0" <?=($rs->is_uzur == '0')?('checked'):('');?>>
                              <label class="form-check-label" for="exampleRadios2">
                                Tidak
                              </label>
                          </div>
                          <div class="form-group">
                          <label for="uzur">Balai</label>
                          <div class="form-check">
                              <input class="form-check-input" type="radio" name="balai" id="ck_uzur" value="1" <?=($rs->is_balai == '1')?('checked'):('');?>>
                              <label class="form-check-label" for="exampleRadios1">
                                Iya
                              </label>
                            </div>
                            <div class="form-check">
                              <input class="form-check-input" type="radio" name="balai" id="ci_uzur" value="0" <?=($rs->is_balai == '0')?('checked'):('');?>>
                              <label class="form-check-label" for="exampleRadios2">
                                Tidak
                              </label>
                          </div>
                          <!-- hidden input -->
                          <input type="hidden" name="idsapi" value="<?=$rs->idsapi;?>">
                          <input type="hidden" name="tglinput" value="<?=date('Y-m-d H:i:s');?>">
                        </div>
                      </div>
                    </div>
                  </div>
                  <button type="submit" name="update" class="btn btn-success float-right mx-3">Perbarui</button>
                  <a href="<?=site_url('/Sapi');?>" class="btn btn-danger float-right" id="btn_kembali">Batal</a>
                </form>
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




