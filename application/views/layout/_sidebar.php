
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
            <?php if ($this->session->userdata('bg_idlvl')=='1') { ?>
              <li class="nav-item" hidden>
              <a href="<?=site_url('c_transaksi/index_barcode')?>" class="nav-link">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                  Barcode
                </p>
              </a>
              </li>
              <li class="nav-item">
              <a href="<?=site_url('c_transaksi/index')?>" class="nav-link">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                  Dashboard
                </p>
              </a>
              </li>
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
                    <a href="<?=site_url('c_transaksi/index_supplier')?>" class="nav-link">
                      <i class="far fa-dot-circle nav-icon"></i>
                      <p>Supplier</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="<?=site_url('c_transaksi/index_department')?>" class="nav-link">
                      <i class="far fa-dot-circle nav-icon"></i>
                      <p>Department</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="<?=site_url('c_transaksi/index_email')?>" class="nav-link">
                      <i class="far fa-dot-circle nav-icon"></i>
                      <p>Applicant Information</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="<?=site_url('c_transaksi/index_material')?>" class="nav-link">
                      <i class="far fa-dot-circle nav-icon"></i>
                      <p>Material</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="<?=site_url('c_transaksi/index_buyer')?>" class="nav-link">
                      <i class="far fa-dot-circle nav-icon"></i>
                      <p>Buyer</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="<?=site_url('c_transaksi/index_oekotex')?>" class="nav-link">
                      <i class="far fa-dot-circle nav-icon"></i>
                      <p>OEKO-TEX</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="<?=site_url('c_transaksi/index_sizecategory')?>" class="nav-link">
                      <i class="far fa-dot-circle nav-icon"></i>
                      <p>Size Category</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="<?=site_url('c_transaksi/index_stages')?>" class="nav-link">
                      <i class="far fa-dot-circle nav-icon"></i>
                      <p>Stages</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="<?=site_url('c_transaksi/index_careInstruction')?>" class="nav-link">
                      <i class="far fa-dot-circle nav-icon"></i>
                      <p>Care Instruction</p>
                    </a>
                  </li>
                  </ul>
                </li> 
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
                  <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-circle"></i>
                    <p>
                      Report
                      <i class="right fas fa-angle-left"></i>
                    </p>
                  </a>
                  <ul class="nav nav-treeview">
                    <li class="nav-item">
                      <a href="<?=site_url('c_transaksi/index_report')?>" class="nav-link">
                        <i class="nav-icon fa fa-users"></i>
                        <p>
                          Report Test Required
                        </p>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a href="<?=site_url('c_transaksi/index_reportAll')?>" class="nav-link">
                        <i class="nav-icon fa fa-users"></i>
                        <p>
                          Report All
                        </p>
                      </a>
                    </li>
                  </ul>
            </li>
           
            <li class="nav-item">
              <a href="<?=site_url('c_transaksi/index_user')?>" class="nav-link">
                <i class="nav-icon fa fa-users"></i>
                <p>
                  User Management
                </p>
              </a>
            </li>
            <?php } if ($this->session->userdata('bg_idlvl')=='2') { ?>
              <li class="nav-item">
              <a href="<?=site_url('c_transaksi/index')?>" class="nav-link">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                  Dashboard
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?=site_url('c_transaksi/index_penerimaan')?>" class="nav-link">
                <i class="nav-icon fa fa-users"></i>
                <p>
                  Penerimaan Sample
                </p>
              </a>
            </li>
            <?php } if($this->session->userdata('bg_idlvl') == '3') { ?>
              <li class="nav-item">
              <a href="<?=site_url('c_transaksi/index')?>" class="nav-link">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                  Dashboard
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
            <?php } if($this->session->userdata('bd_idlvl') == '4') { ?>
              <li class="nav-item">
              <a href="<?=site_url('c_transaksi/index')?>" class="nav-link">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                  Dashboard
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
            <?php } ?>
          </ul>
        </nav>
        <!-- /.sidebar-menu -->
  </div>
</aside>
