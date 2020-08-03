
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 3 | Registration Page</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url();?>/assets/AdminLTE/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="<?php echo base_url();?>/assets/AdminLTE/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url();?>/assets/AdminLTE/dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition register-page">
<div class="register-box">
  <div class="register-logo">
    <a href="<?php echo base_url();?>/assets/AdminLTE/index2.html"><b>Si</b>Ternak</a>
  </div>

  <div class="card">
    <div class="card-body register-card-body">
      <p class="login-box-msg">Daftar Sebagai Member baru</p>

      <form action="<?php echo site_url('/Login/tambah');?>" method="post">
        <div class="form-group mb-3">
            <div class="input-group">
              <input type="text" class="form-control" placeholder="Full name" name="nama" value="<?= set_value('nama'); ?>">
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-user"></span>
                </div>
              </div>
            </div>
            <?= form_error('nama','<small class="text-danger">','</small>'); ?>
        </div>
        <div class="form-group mb-3">
            <div class="input-group">
              <input type="text" class="form-control" placeholder="Username" name="username" value="<?= set_value('username'); ?>">
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-user"></span>
                </div>
              </div>
            </div>
            <?= form_error('username','<small class="text-danger">','</small>'); ?>
        </div>
        <div class="form-group mb-3">
            <div class="input-group">
              <input type="password" class="form-control" placeholder="Password" name="pass1">
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-lock"></span>
                </div>
              </div>
            </div>
        <?= form_error('pass1','<small class="text-danger">','</small>'); ?>
        </div>
        <div class="form-group mb-3">
            <div class="input-group">
              <input type="password" class="form-control" placeholder="Retype password" name="pass2">
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-lock"></span>
                </div>
              </div>
            </div>
        <?= form_error('pass2','<small class="text-danger">','</small>'); ?>
        </div>
        <div class="row">
          <div class="col-12">
           
              <button type="submit" class="btn btn-primary btn-block">Daftar</button>
              
          </div>
        </form>
    </div>
    <!-- /.form-box -->
  </div><!-- /.card -->
</div>
<!-- /.register-box -->

<!-- jQuery -->
<script src="<?php echo base_url();?>/assets/AdminLTE/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?php echo base_url();?>/assets/AdminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url();?>/assets/AdminLTE/dist/js/adminlte.min.js"></script>
</body>
</html>
