<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="row justify-content-center">
    <div class="col-sm-8 col-md-5 col-lg-4">
        <h1 class="h3 mb-4 text-center"><i class="bi bi-lock"></i> Accés restringit</h1>

        <?php if (session('error')): ?>
            <div class="alert alert-danger py-2" role="alert"><?= esc(session('error')) ?></div>
        <?php endif ?>

        <div class="card shadow-sm">
            <div class="card-body p-4">
                <?= form_open('admin/login') ?>
                    <div class="mb-3">
                        <label for="usuari" class="form-label">Usuari</label>
                        <input type="text" class="form-control" id="usuari" name="usuari" required
                               autocomplete="username" autofocus value="<?= esc(old('usuari')) ?>">
                    </div>
                    <div class="mb-4">
                        <label for="contrasenya" class="form-label">Contrasenya</label>
                        <input type="password" class="form-control" id="contrasenya" name="contrasenya" required
                               autocomplete="current-password">
                    </div>
                    <button type="submit" class="btn btn-danger w-100">
                        <i class="bi bi-box-arrow-in-right"></i> Entra
                    </button>
                <?= form_close() ?>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
