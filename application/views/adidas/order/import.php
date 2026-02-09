<div class="card p-4 shadow-sm">
  <h5 class="mb-3 text-secondary fw-bold"><i class="fas fa-file-import me-2"></i>Import Data Order</h5>

  <form action="<?= site_url('c_transaksi/import_order') ?>" method="post" enctype="multipart/form-data">
    <div class="mb-3">
      <label for="file" class="form-label">Pilih File Excel (.xlsx / .xls)</label>
      <input type="file" class="form-control" id="file" name="file" accept=".xls,.xlsx" required>
    </div>
    <button type="submit" class="btn btn-success">
      <i class="fas fa-upload me-1"></i>Upload & Import
    </button>
    <a href="<?= site_url('c_transaksi/index_order') ?>" class="btn btn-outline-secondary ms-2">
      <i class="fas fa-arrow-left me-1"></i>Kembali
    </a>
  </form>
</div>
