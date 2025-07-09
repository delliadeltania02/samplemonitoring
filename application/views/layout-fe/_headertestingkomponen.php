<header id="header" class="d-flex align-items-center">
    <div class="container d-flex align-items-center">
      <nav id="navbar" class="navbar" style="padding-top: 1%; padding-left: 12%;">
        <ul>
          
          <li><a class="nav-link scrollto" href="<?=site_url('c_transaksi/detail_komponen/').$detail->report_no?>">Product Information</a></li>
          <li><a class="nav-link scrollto" href="<?=site_url('c_transaksi/index_methodkomponen/').$detail->report_no?>">Test Method</a></li>
          <li><a class="nav-link scrollto" href="<?=site_url('c_transaksi/tambah_shrinkagekomponen/').$detail->report_no?>">Actual Shrinkage</a></li>
          <li class="dropdown"><a href="#"><span>After Wash Appearance Check List</span> <i class="bi bi-chevron-down"></i></a>
            <ul>
              <li><a href="<?= site_url('c_transaksi/tambah_appearance_trimkomponen/').$detail->report_no ?>">Trim Durability</a></li>
              <li><a href="<?= site_url('c_transaksi/tambah_appearance_fabrickomponen/').$detail->report_no ?>">Fabric Properties</a></li>
            </ul>
          </li>
          <li class="dropdown"><a href="#"><span>Option</span> <i class="bi bi-chevron-down"></i></a>
            <ul>
              <li><a href="<?=site_url('c_transaksi/index_komponen') ?>">Back To Material</a></li>
            </ul>
          </li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->
    </div>
  </header>