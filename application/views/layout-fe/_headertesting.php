<header id="header" class="d-flex align-items-center">
    <div class="container d-flex align-items-center">
      <nav id="navbar" class="navbar" style="padding-top: 1%; padding-left: 7%;">
        <ul>
          
          <li><a class="nav-link scrollto" href="<?=site_url('c_transaksi/detail_material/').$detail->report_no?>">Product Information</a></li>
          <li><a class="nav-link scrollto" href="<?=site_url('c_transaksi/index_method/').$detail->report_no?>">Test Method</a></li>
          <li><a class="nav-link scrollto" href="<?=site_url('c_transaksi/tambah_shrinkage/').$detail->report_no?>">Actual Shrinkage</a></li>
          <li hidden><a class="nav-link scrollto" href="<?=site_url('c_transaksi/index_fgft/').$detail->report_no?>">FGFT</a></li>
          <li class="dropdown"><a href="#"><span>After Wash Appearance Check List</span> <i class="bi bi-chevron-down"></i></a>
            <ul>
              <li><a href="<?= site_url('c_transaksi/tambah_appearance_trim/').$detail->report_no ?>">Trim Durability</a></li>
              <li><a href="<?= site_url('c_transaksi/tambah_appearance_fabric/').$detail->report_no ?>">Fabric Properties</a></li>
            </ul>
          </li>
          <li class="dropdown"><a href="#"><span>Others</span> <i class="bi bi-chevron-down"></i></a>
            <ul>
              <li><a class="nav-link scrollto" href="<?=site_url('c_transaksi/tambah_instruction/').$detail->report_no?>">Care Instruction</a></li>
              <li><a class="nav-link scrollto" href="<?= site_url('c_transaksi/tambah_signcomment/').$detail->report_no ?>">Sign & Comment</a></li>
            </ul>
          </li>

          <li class="dropdown"><a href="#"><span>Option</span> <i class="bi bi-chevron-down"></i></a>
            <ul>
              <li><a href="<?=site_url('c_transaksi/index_material') ?>">Back To Material</a></li>
            </ul>
          </li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->
    </div>
  </header>