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
                    <div class="card">
                        <div class="card-body">
                            <div class="flashdata" data-flashdata="<?= $this->session->flashdata('info'); ?>" data-pesan="<?= $this->session->flashdata('pesan'); ?>"></div>
                            <form action="<?= site_url('/Pkb/save'); ?>" method="post">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="hidden" name="idib">
                                            <label for="tgl">Tanggal Pemeriksaan</label>
                                            <div class="input-group date" id="tglform" data-target-input="nearest">
                                                <div class="input-group-append" data-target="#tglform" data-toggle="datetimepicker">
                                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                </div>
                                                <input type="text" name="tanggal" min="2020-9-14" class="form-control datetimepicker-input" data-target="#tglform" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="petugas">Petugas</label>
                                            <input type="hidden" name="idpetugas">
                                            <input type="text" name="petugas" id="petugas" class="form-control">
                                            <input type="hidden" name="idpetugas">
                                        </div>
                                        <div class="form-group">
                                            <label for="namasapi">Nama Sapi Betina</label>
                                            <div class="input-group">
                                                <input type="hidden" name="idsapi">
                                                <input type="text" class="form-control" id="namasapi" name="namasapi" autocomplete="off">
                                                <div class="input-group-append">
                                                    <span type="button" data-toggle="modal" data-target="#view_ternak" class="input-group-text bg-primary" id="cari-sapi"><i class="fas fa-search"></i></span>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="hasil">Hasil</label>
                                            <select name="hasil" id="hasil" class="form-control">
                                                <option value="P">Positif</option>
                                                <option value="N">Negatif</option>
                                                <option value="Dubius">Dubius</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="keterangan">Keterangan</label>
                                            <textarea name="keterangan" id="keterangan" cols="3" rows="5" class="form-control"></textarea>
                                            <button type="submit" class="btn btn-success float-right my-3">Simpan</button>
                                            <a href="<?= site_url('/Pkb'); ?>" class="btn btn-danger float-right my-3 mx-3">Batal</a>
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
</div>

<aside class="control-sidebar control-sidebar-dark">
    <div class="p-3">
        <h5>Title</h5>
        <p>Sidebar content</p>
    </div>
</aside>
<!-- Modal Peterakan-->
<div class="modal fade" id="view_ternak" tabindex="-1" role="dialog" aria-labelledby="view_peternakanLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="view_peternakanLabel">Data Peternakan</h5>
            </div>
            <div class="modal-body">
                <div class="card">
                    <div class="card-body table-responsive">
                        <table class="table table-hover" id="tblrepib">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Nama Semen</th>
                                    <th>IB</th>
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