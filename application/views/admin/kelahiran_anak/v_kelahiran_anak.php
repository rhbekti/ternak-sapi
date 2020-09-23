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
            <div class="card">
                <div class="card-header">
                    <button class="btn btn-success btn-sm float-right" id="btn-tambah">Tambah</button>
                </div>
                <div class="card-body table-responsive">
                    <table class="table table-hover" id="tblanak">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tag Sapi Induk</th>
                                <th>Bobot Lahir</th>
                                <th>Jenis Kelamin</th>
                                <th>&nbsp;</th>
                                <th>&nbsp;</th>
                            </tr>
                        </thead>
                    </table>
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

<!-- Modal Tambah-->
<div class="modal fade" id="tambahModal" tabindex="-1" role="dialog" aria-labelledby="tambahModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahModalLabel">Tambah Data</h5>
            </div>
            <div class="modal-body">
                <div class="form-group table-responsive overflow-hidden">
                    <table class="table table-hover w-100" id="tblkelahiran">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal</th>
                                <th>Tag Sapi</th>
                                <th>Peternakan</th>
                                <th>Status</th>
                                <th>Keterangan</th>
                                <th>&nbsp;</th>
                            </tr>
                        </thead>
                        <tbody id="tblkelahiranbody"></tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-primary">Simpan</button>
            </div>
        </div>
    </div>
    <div class="flashdata" data-flashdata="<?= $this->session->flashdata('info'); ?>"></div>
</div>
<!-- Modal Tambah-->
<div class="modal fade" id="inputModal" tabindex="-1" role="dialog" aria-labelledby="inputModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="inputModalLabel">Tambah Data</h5>
            </div>
            <div class="modal-body">
                <?= form_open('/Kelahiran_anak/add') ?>
                <div class="form-group">
                    <input type="hidden" name="idsapi" required>
                    <input type="hidden" name="idib" required>
                    <input type="hidden" name="status" required>
                </div>
                <div class="form-group">
                    <label for="bobot">Bobot Lahir</label>
                    <input type="number" class="form-control" name="bobot" id="bobot" required>
                </div>
                <div class="form-group">
                    <label for="kelamin">Jenis Kelamin</label>
                    <select name="kelamin" id="kelamin" class="form-control" required>
                        <option value="Jantan">Jantan</option>
                        <option value="Betina">Betina</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
                <?= form_close(); ?>
            </div>
        </div>
    </div>
</div>