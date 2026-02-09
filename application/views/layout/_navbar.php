<?php
$ci =& get_instance();
$ci->load->model('m_transaksi');

// Notifikasi kualitas
$notif = $ci->m_transaksi->joinKualitas()->result();
$count = count($notif);

// Notifikasi report yang belum final
$report = $ci->m_transaksi->getReportSample()->result();
$report_belum = array_filter($report, function($r) {
  return empty($r->date_final);
});
$count_report = count($report_belum);

// Total notif
$total_notif = $count + $count_report;
?>

<nav class="main-header navbar navbar-expand navbar-light" style="background-color: #f5f5f5; border-bottom: 1px solid #ddd;">
  <div class="container-fluid d-flex align-items-center justify-content-between">

    <!-- Tombol Sidebar -->
    <ul class="navbar-nav d-flex align-items-center mr-3 mb-0">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button" style="font-size: 18px;">
          <i class="fas fa-bars"></i>
        </a>
      </li>
    </ul>

    <!-- Brand -->
    <span class="mb-0 h6 text-muted" style="font-weight: 700; font-size: 14px;">Sample Monitoring System</span>

    <!-- Kanan: Notifikasi, Jam, User -->
    <ul class="navbar-nav ml-auto align-items-center">

      <!-- Notifikasi -->
      <li class="nav-item dropdown mr-3 d-flex align-items-center">
        <a class="nav-link d-flex align-items-center" data-toggle="dropdown" href="#" title="Notifikasi">
          <i class="far fa-bell" style="font-size: 20px;"></i>
          <?php if ($total_notif > 0): ?>
            <span class="badge badge-danger navbar-badge"><?= $total_notif ?></span>
          <?php endif; ?>
        </a>

        <?php if ($total_notif > 0): ?>
        <div class="dropdown-menu dropdown-menu-right" style="min-width: 280px;">
          <span class="dropdown-item dropdown-header"><?= $total_notif ?> Notifikasi</span>
          <div class="dropdown-divider"></div>

          <?php if ($count > 0): ?>
            <a href="<?= site_url('c_transaksi/index_kualitas') ?>" >
              <span class="dropdown-item">
                <i class="fas fa-vial text-warning mr-2"></i>
                <?= $count ?> Kualitas Belum
              </span>
            </a>
          <?php endif; ?>

          <?php if ($count_report > 0): ?>
            <a href="<?= site_url('c_transaksi/index_report') ?>" ></a>
              <span class="dropdown-item">
                <i class="fas fa-file-alt text-info mr-2"></i>
                <?= $count_report ?> Report Belum Final
              </span>
            </a>
          <?php endif; ?>

          <div class="dropdown-divider"></div>
          <a href="<?= site_url('c_kualitas') ?>" class="dropdown-item dropdown-footer" hidden>Lihat Detail</a>
        </div>
        <?php endif; ?>
      </li>

      <!-- Jam -->
      <li class="nav-item dropdown mr-3 d-flex align-items-center">
        <a class="nav-link d-flex align-items-center" data-toggle="dropdown" href="#" title="Jam Sekarang">
          <i class="far fa-clock" style="font-size: 20px;"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-right">
          <span class="dropdown-item text-muted" id="dropdown-clock"></span>
        </div>
      </li>

      <!-- User -->
      <li class="nav-item dropdown d-flex align-items-center">
        <a class="nav-link d-flex align-items-center" data-toggle="dropdown" href="#" title="User">
          <i class="fas fa-user-circle" style="font-size: 20px;"></i>
          <span class="ml-2" style="font-size: 14px; font-weight: 500;">
            <?= $this->session->userdata('bg_nama'); ?>
          </span>
          <i class="fas fa-caret-down ml-1" style="font-size: 12px;"></i> <!-- Icon panah -->
        </a>
        <div class="dropdown-menu dropdown-menu-right">
          <a class="dropdown-item" href="<?= site_url('welcome/index') ?>">
            <i class="fas fa-sign-out-alt text-danger"></i> Logout
          </a>
        </div>
      </li>

    </ul>
  </div>
</nav>

<script>
function updateClock() {
  const now = new Date();
  const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
  const dateStr = now.toLocaleDateString('id-ID', options);
  const timeStr = now.toLocaleTimeString('id-ID', { hour12: false });
  document.getElementById('dropdown-clock').textContent = `${dateStr} - ${timeStr}`;
}
setInterval(updateClock, 1000);
updateClock();
</script>
