
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
            <img src="<?php echo base_url('assets');?>/dist/img/kaha.png" class="img-circle elevation-2" alt="User Image">
          </div>
          <div class="info">
            <a href="#" class="d-block">PT KAHATEX</a>
          </div>
        </div>
    <!-- SidebarSearch Form -->
        <div class="form-inline">
          <div class="input-group" data-widget="sidebar-search">
            <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
        
          </div>
        </div>
        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item">
              <a href="<?=site_url('c_transaksi/index_other')?>" class="nav-link">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                  Dashboard
                </p>
              </a>
            </li>
            <?php if ($this->session->userdata('bg_idlvl')=='1') { ?>
              <li class="nav-item">
                  <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-circle"></i>
                    <p>
                      Master Data
                      <i class="right fas fa-angle-left"></i>
                    </p>
                  </a>
                  <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="<?=site_url('c_transaksi/index_departmentOther')?>" class="nav-link">
                      <i class="far fa-dot-circle nav-icon"></i>
                      <p>Department</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="<?=site_url('c_transaksi/index_emailOther')?>" class="nav-link">
                      <i class="far fa-dot-circle nav-icon"></i>
                      <p>Applicant Information</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="<?=site_url('c_transaksi/index_materialOther')?>" class="nav-link">
                      <i class="far fa-dot-circle nav-icon"></i>
                      <p>Material</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="<?=site_url('c_transaksi/index_buyerOther')?>" class="nav-link">
                      <i class="far fa-dot-circle nav-icon"></i>
                      <p>Buyer</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="<?=site_url('c_transaksi/index_oekotexOther')?>" class="nav-link">
                      <i class="far fa-dot-circle nav-icon"></i>
                      <p>OEKO-TEX</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="<?=site_url('c_transaksi/index_sizecategoryOther')?>" class="nav-link">
                      <i class="far fa-dot-circle nav-icon"></i>
                      <p>Size Category</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="<?=site_url('c_transaksi/index_stagesOther')?>" class="nav-link">
                      <i class="far fa-dot-circle nav-icon"></i>
                      <p>Stages</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="<?=site_url('c_transaksi/index_careInstructionOther')?>" class="nav-link">
                      <i class="far fa-dot-circle nav-icon"></i>
                      <p>Care Instruction</p>
                    </a>
                  </li>
                  </ul>
                </li> 
            <li class="nav-item">
              <a href="<?=site_url('c_transaksi/index_penerimaan_other')?>" class="nav-link">
                <i class="nav-icon fa fa-users"></i>
                <p>
                  Penerimaan Sample
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?=site_url('c_transaksi/index_kualitas_other')?>" class="nav-link">
                <i class="nav-icon fa fa-users"></i>
                <p>
                  Kualitas Sample
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?=site_url('c_transaksi/index_report_other')?>" class="nav-link">
                <i class="nav-icon fa fa-users"></i>
                <p>
                  Report Sample
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?=site_url('c_user/indexOther')?>" class="nav-link">
                <i class="nav-icon fa fa-users"></i>
                <p>
                  User Management
                </p>
              </a>
            </li>
            <?php } if ($this->session->userdata('bg_idlvl')=='2') { ?>
            <li class="nav-item">
              <a href="<?=site_url('c_transaksi/index_penerimaan')?>" class="nav-link">
                <i class="nav-icon fa fa-users"></i>
                <p>
                  Penerimaan Sample
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?=site_url('c_transaksi/index_kualitas')?>" class="nav-link">
                <i class="nav-icon fa fa-users"></i>
                <p>
                  Kualitas Sample
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?=site_url('c_transaksi/index_report')?>" class="nav-link">
                <i class="nav-icon fa fa-users"></i>
                <p>
                  Report Sample
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?=site_url('c_user/index')?>" class="nav-link">
                <i class="nav-icon fa fa-users"></i>
                <p>
                  User Management
                </p>
              </a>
            </li>
            <?php } ?>
          </ul>
        </nav>
        <!-- /.sidebar-menu -->
  </div>
</aside>
