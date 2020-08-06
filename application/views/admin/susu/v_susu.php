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
      .<div class="container-fluid">
          <div class="row">
            <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal">
                      Tambah Data
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            <div class="form-group">
                            <label for="peternakan">Nama Peternakan</label>
                              <input type="text" name="namapeternakan" class="form-control" id="peternakan" placeholder="Masukkan Nama Peternakan">
                              <input type="hidden" name="kodesapi" class="form-control" id="kodesapi" readonly>
                            </div>
                            <div class="form-group">            
                            <label for="kelompok">Nama Sapi</label>
                              <input type="text" name="namasapi" class="form-control" id="namasapi" placeholder="Masukkan Nama Sapi">
                              <input type="hidden" name="kodesapi" class="form-control" id="kodesapi" readonly>
                              <input type="hidden" name="tanggal" value="<?=date('y-m-d');?>">
                            </div>
                            <div class="form-group">
                              <label for="pagi">Produksi Pagi</label>
                              <input type="number" name="pagi" id="pagi" class="form-control" placeholder="Liter">
                            </div>
                            <div class="form-group">
                              <label for="pagi">Produksi Sore</label>
                              <input type="number" name="sore" id="sore" class="form-control" placeholder="Liter">
                            </div>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary">Save changes</button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                <div class="flashdata" data-flashdata="<?=$this->session->flashdata('info'); ?>"></div>
                    <div class="card-body table-responsive">
                        <table class="table table-hover" id="tblsusu">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>barcode</th>
                                    <th>Tanggal Produksi</th>
                                    <th>Peternakan</th>
                                    <th>Nama Sapi</th>
                                    <th>Kandang</th>
                                    <th>Pagi (L)</th>
                                    <th>Sore (L)</th>
                                    <th>&nbsp;</th>
                                    <th>&nbsp;</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $generator = new Picqer\Barcode\BarcodeGeneratorHTML();
                                $no = 0;
                                foreach($rs as $row) :
                                $no++;
                                ?>
                                <tr>
                                  <td><?=$no; ?></td>
                                  <td><?=$generator->getBarcode($row->barcode, $generator::TYPE_CODE_128);?></td>
                                  <td><?=$row->tgl_produksi;?></td>
                                  <td><?=$row->namapeternakan;?></td>
                                  <td><?=$row->id_sapi; ?></td>
                                  <td><?=$row->kandang; ?></td>
                                  <td><?=$row->pagi;?></td>
                                  <td><?=$row->sore;?></td>
                                  <td><button id="edit" class="btn btn-warning"><i class="fas fa-pen"></i></button></td>
                                  <td><button id="hapus" class="btn btn-danger"><i class="fas fa-trash"></i></button></td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
          </div> 
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <!-- Modal -->
<div class="modal fade" id="Modalhapus" tabindex="-1" role="dialog" aria-labelledby="judulmodal" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="judulmodal">Hapus Data</h5>
      </div>
      <div class="modal-body">
        <form action="<?=site_url('/peternakan/hapus'); ?>" method="post">
          <input type="hidden" name="idpeternakan" id="id" required>
          Apakah yakin dihapus?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-danger">Hapus</button>
        </form>
      </div>
    </div>
  </div>
</div>