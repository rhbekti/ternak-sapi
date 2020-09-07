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
                        <div class="card-body table-responsive">
                            <div class="container p-3">
                                <form action="<?= site_url('/Kelahiran/update'); ?>" method="post">
                                    <div class="form-group">
                                        <label for="tgl">Tanggal</label>
                                        <div class="input-group date" id="tglform" data-target-input="nearest">
                                            <div class="input-group-append" data-target="#tglform" data-toggle="datetimepicker">
                                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                            </div>
                                            <input type="text" name="tanggal" value="<?=$rs->tanggal;?>" class="form-control datetimepicker-input" data-target="#tglform" />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <button class="btn btn-success" type="button" id="editpilihan">Pilih</button>
                                            </div>
                                            <input type="hidden" name="idsapi">
                                            <input type="text" class="form-control" name="namasapi" placeholder="Pilih Sapi" value="<?=$rs->namasapi;?>" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="xlaktasi">Xlaktasi</label>
                                        <input type="text" name="xlaktasi" id="xlaktasi" class="form-control" value="<?=$rs->xlaktasi;?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="statuslahir">Status Lahir</label>
                                        <select name="statuslahir" id="statuslahir" class="form-control">
                                            <option value="single" <?=($rs->statuslahir == 'single')?('selected'):('')?>>Sigle</option>
                                            <option value="double" <?=($rs->statuslahir == 'double')?('selected'):('')?>>Double</option>
                                            <option value="abortus" <?=($rs->statuslahir == 'abortus')?('selected'):('')?>>Abortus</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="keterangan">Keterangan</label>
                                        <textarea name="keterangan" id="keterangan" cols="10" rows="5" class="form-control"><?=$rs->keterangan;?></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="petugas">Nama Petugas</label>
                                        <input type="hidden" name="idpetugas" id="idpetugas" value="<?=$rs->idpetugas;?>">
                                        <input type="text" name="namapetugas" id="petugas" class="form-control" autocomplete="off" value="<?=$rs->namapetugas;?>">
                                        <select id="list-petugas" class="form-control" multiple>

                                        </select>
                                        <input type="hidden" name="tglinput" value="<?= date('Y-m-d'); ?>">
                                        <input type="hidden" name="idib" id="idib">
                                    </div>
                            </div>
                            <div class="modal-footer">
                                <a href="<?=site_url('/Kelahiran');?>" class="btn btn-danger">Batal</a>
                                <button type="submit" class="btn btn-success">Perbarui</button>
                                </form>
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
                            <th>Nama Sapi</th>
                            <th>Kelamin</th>
                            <th>Peternakan</th>
                            <th>IBke</th>
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