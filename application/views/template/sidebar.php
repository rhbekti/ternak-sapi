<?php
$menu = $this->session->userdata('menu');
$submenu = $this->session->userdata('submenu');

?>
  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="<?=base_url();?>/assets/AdminLte/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="<?=base_url();?>/assets/AdminLte/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block"><?=$id_user->username; ?></a>
          <a href="#" class="d-block text-success"><?=$id_user->nama_level; ?></a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item has-treeview <?=($menu == 'data_ternak')?('menu-open'):(''); ?>">
            <a href="<?=base_url();?>" class="nav-link <?=($menu == 'data_ternak')?('active'):(''); ?>">
              <i class="nav-icon fas fa-horse"></i>
              <p>
                Ternak
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?=site_url('/Sapi');?>" class="nav-link <?=($submenu == 'sapi')?('active'):('');?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Sapi</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview <?=($menu == 'peternakan')?('menu-open'):(''); ?>">
            <a href="#" class="nav-link <?=($menu == 'peternakan')?('active'):(''); ?>">
              <i class="nav-icon fas fa-hat-cowboy"></i>
              <p>
                Peternakan
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?=site_url('/Pengajuan'); ?>" class="nav-link <?=($submenu == 'pengajuan')?('active'):('');?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Pengajuan Peternakan</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?=site_url('/Peternakan');?>" class="nav-link <?=($submenu == 'peternakan')?('active'):('');?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Data Peternakan</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?=site_url('/Kandang');?>" class="nav-link <?=($submenu == 'kandang')?('active'):('');?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Data Kandang</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?=site_url('/Kelompok');?>" class="nav-link <?=($submenu == 'kelompok')?('active'):('');?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Data Kelompok</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?=site_url('/Koperasi'); ?>" class="nav-link <?=($submenu == 'koperasi')?('active'):('')?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Data Koperasi</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview <?=($menu == 'ref_produksi')?('menu-open'):(''); ?>">
            <a href="javascript:void(0);" class="nav-link <?=($menu == 'ref_produksi')?('active'):(''); ?>">
              <i class="nav-icon fas fa-flask"></i>
              <p>
                Produksi Susu
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?=site_url('/Susu');?>" class="nav-link <?=($submenu == 'susu')?('active'):('');?>">
                  <i class="fas fa-store-alt nav-icon"></i>
                  <p>Data Produksi</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="fas fa-eye-dropper nav-icon"></i>
                  <p>KUALITAS SUSU</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview <?=($menu == 'ref_reproduksi')?('menu-open'):(''); ?>">
            <a href="javascript:void(0);" class="nav-link <?=($menu == 'ref_reproduksi')?('active'):(''); ?>">
              <i class="nav-icon fas fa-chart-line"></i>
              <p>
                Reproduksi
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?=site_url('/Reproduksi_IB');?>" class="nav-link <?=($submenu == 'reproduksi_ib')?('active'):('');?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Data IB</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?=site_url('/Reproduksi_ET');?>" class="nav-link <?=($submenu == 'data_et')?('active'):('');?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Data ET</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?=site_url('/Pkb');?>" class="nav-link <?=($submenu == 'data_pkb')?('active'):('');?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Data PKB</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?=site_url('/Kelahiran');?>" class="nav-link <?=($submenu == 'data_kelahiran')?('active'):('');?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Data Kelahiran</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?=site_url('/Semen');?>" class="nav-link <?=($submenu == 'data_semen')?('active'):('')?>">
                  <i class="fas fa-vial nav-icon"></i>
                  <p>SEMEN</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="<?=site_url('/Pengguna'); ?>" class="nav-link <?=($menu == 'pengguna')?('active'):(''); ?>">
              <i class="nav-icon fas fa-user"></i>
              <p>
                Pengguna
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?=site_url('/Petugas'); ?>" class="nav-link <?=($menu == 'petugas')?('active'):(''); ?>">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Petugas
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>