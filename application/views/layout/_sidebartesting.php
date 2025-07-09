<nav class="mt-2" style="font-size:12px;">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="<?=site_url('c_transaksi/detail_material/').$detail->report_no?>" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Product Information
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?=site_url('c_transaksi/index_method/').$detail->report_no?>" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Test Method
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?=site_url('c_transaksi/tambah_shrinkage/').$detail->report_no?>" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Actual Shrinkage
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                After Wash Appearance Check List
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                  <a href="<?= site_url('c_transaksi/tambah_appearance_trim/').$detail->report_no ?>" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Trim Durability</p>
                  </a>
              </li>
              <li class="nav-item">
                  <a href="<?= site_url('c_transaksi/tambah_appearance_fabric/').$detail->report_no ?>" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Fabric Properties</p>
                  </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Trim Durability
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                  <a href="<?= site_url('c_transaksi/index_heat/').$detail->report_no ?>" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Print / Heat Transfer</p>
                  </a>
              </li>
              <li class="nav-item">
                  <a href="<?= site_url('c_transaksi/index_embroidery/').$detail->report_no ?>" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Embroidery</p>
                  </a>
              </li>
              <li class="nav-item">
                  <a href="<?= site_url('c_transaksi/index_label/').$detail->report_no ?>" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Label</p>
                  </a>
              </li>
              <li class="nav-item">
                  <a href="<?= site_url('c_transaksi/index_zipper/').$detail->report_no ?>" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Zipper / Snap button / button / tie cord / etc.</p>
                  </a>
              </li>  
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Fabric Properties
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?= site_url('c_transaksi/index_change/').$detail->report_no ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Discoloration (colour change)</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= site_url('c_transaksi/index_staining/').$detail->report_no ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Colour Staining</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= site_url('c_transaksi/index_pilling/').$detail->report_no ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Pilling</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= site_url('c_transaksi/index_spirality/').$detail->report_no ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Shrinkage & Spirality</p>
                </a>
              </li>
            </ul>
          </li>
        </ul>
      </nav>