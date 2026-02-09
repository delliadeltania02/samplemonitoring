<?php if (empty($tests)): ?>
    <div class="alert alert-warning">
        Tidak ada test required yang tersedia.
    </div>
<?php else: ?>

<?php foreach ($tests as $t): ?>
    <div class="form-check mb-1">
        <input class="form-check-input"
               type="checkbox"
               name="id_kualitas[]"
               value="<?= $t->id_kualitas ?>"
               <?= $t->status !== 'belum' ? 'disabled checked' : '' ?>>

        <label class="form-check-label">
            <?= $t->test_required ?>
            <?php if ($t->status === 'kembali'): ?>
                <span class="badge badge-warning">revisi</span>
            <?php elseif ($t->status !== 'belum'): ?>
                <span class="badge badge-success">selesai</span>
            <?php endif; ?>
        </label>
    </div>
<?php endforeach; ?>

<?php endif; ?>