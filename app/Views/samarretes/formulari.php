<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<?php $errors = session('errors') ?? []; ?>
<div class="row justify-content-center">
    <div class="col-xl-6 col-lg-7 col-md-9">
        <h1 class="h2 mb-3"><i class="bi bi-person-vcard"></i> Samarretes</h1>

        <div class="bg-body-tertiary border rounded-3 p-3 mb-4">
            <p class="mb-2">El funcionament és el següent:</p>
            <ol class="mb-0">
                <li>Feu la comanda posant les vostres dades.</li>
                <li>Ens posarem en contacte amb vosaltres per confirmar la comanda i informant-vos del procediment de pagament.</li>
                <li>Un cop rebut el pagament us informarem per a que pugueu recollir la comanda.</li>
            </ol>
        </div>

        <?php if (session('missatge')): ?>
            <div class="alert alert-success d-flex align-items-center" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i>
                <div><?= esc(session('missatge')) ?></div>
            </div>
        <?php endif ?>

        <?php if ($errors !== []): ?>
            <div class="alert alert-danger" role="alert">
                Revisa els camps marcats en vermell.
            </div>
        <?php endif ?>

        <div class="card shadow-sm">
            <div class="card-body p-4">
                <?= form_open('samarretes', ['novalidate' => true]) ?>

                    <div class="mb-3">
                        <label for="nom" class="form-label">Nom entitat/persona</label>
                        <input type="text" class="form-control<?= isset($errors['nom']) ? ' is-invalid' : '' ?>"
                               id="nom" name="nom" maxlength="150" required autocomplete="name"
                               value="<?= esc(old('nom')) ?>">
                        <?php if (isset($errors['nom'])): ?>
                            <div class="invalid-feedback"><?= esc($errors['nom']) ?></div>
                        <?php endif ?>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Correu electrònic</label>
                        <div class="input-group has-validation">
                            <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                            <input type="email" class="form-control<?= isset($errors['email']) ? ' is-invalid' : '' ?>"
                                   id="email" name="email" maxlength="254" required autocomplete="email"
                                   value="<?= esc(old('email')) ?>">
                            <?php if (isset($errors['email'])): ?>
                                <div class="invalid-feedback"><?= esc($errors['email']) ?></div>
                            <?php endif ?>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label for="telefon" class="form-label">Telèfon</label>
                        <div class="input-group has-validation">
                            <span class="input-group-text"><i class="bi bi-telephone"></i></span>
                            <input type="tel" class="form-control<?= isset($errors['telefon']) ? ' is-invalid' : '' ?>"
                                   id="telefon" name="telefon" maxlength="20" required autocomplete="tel"
                                   inputmode="tel" value="<?= esc(old('telefon')) ?>">
                            <?php if (isset($errors['telefon'])): ?>
                                <div class="invalid-feedback"><?= esc($errors['telefon']) ?></div>
                            <?php endif ?>
                        </div>
                    </div>

                    <?php
                        $oldTalla     = (array) old('talla');
                        $oldQuantitat = (array) old('quantitat');
                        $euros        = static fn (float $v): string => number_format($v, 2, ',', '.') . ' €';
                    ?>
                    <h2 class="h5 mb-1">Comanda</h2>
                    <p class="text-body-secondary small mb-3">
                        Preu unitari: <strong><?= $euros($config->preuUnitari) ?></strong>
                    </p>

                    <?php if (isset($errors['talles'])): ?>
                        <div class="alert alert-danger py-2 small"><?= esc($errors['talles']) ?></div>
                    <?php endif ?>

                    <div id="comanda" data-preu="<?= esc((string) $config->preuUnitari, 'attr') ?>">
                    <?php foreach ($config->grups as $titol => $talles): ?>
                        <fieldset class="mb-3">
                            <legend class="fs-6 fw-semibold border-bottom pb-1 mb-2"><?= esc($titol) ?></legend>
                            <div class="row g-2 small text-body-secondary mb-1 d-none d-sm-flex">
                                <div class="col">Talla</div>
                                <div class="col-4 col-sm-3">Quantitat</div>
                                <div class="col-3 text-end">Import</div>
                            </div>

                            <?php foreach ($talles as $clau => $etiqueta):
                                $id       = 'talla-' . preg_replace('/[^A-Za-z0-9]/', '', $clau);
                                $marcada  = isset($oldTalla[$clau]);
                                $q        = $oldQuantitat[$clau] ?? '';
                                $error    = $errors['quantitat.' . $clau] ?? null;
                                $importIn = ($marcada && ctype_digit((string) $q)) ? (int) $q * $config->preuUnitari : 0;
                            ?>
                            <div class="row g-2 align-items-center mb-2 linia-talla">
                                <div class="col">
                                    <div class="form-check mb-0">
                                        <input class="form-check-input js-talla" type="checkbox"
                                               id="<?= $id ?>" name="talla[<?= esc($clau, 'attr') ?>]" value="1"
                                               <?= $marcada ? 'checked' : '' ?>>
                                        <label class="form-check-label" for="<?= $id ?>"><?= esc($etiqueta) ?></label>
                                    </div>
                                </div>
                                <div class="col-4 col-sm-3">
                                    <input type="number" class="form-control form-control-sm js-quantitat<?= $error ? ' is-invalid' : '' ?>"
                                           id="<?= $id ?>-q" name="quantitat[<?= esc($clau, 'attr') ?>]"
                                           min="1" max="<?= $config->quantitatMaxima ?>" step="1" inputmode="numeric"
                                           aria-label="Quantitat <?= esc($etiqueta, 'attr') ?>"
                                           value="<?= esc((string) $q, 'attr') ?>" <?= $marcada ? '' : 'disabled' ?>>
                                </div>
                                <div class="col-3 text-end">
                                    <output class="js-import fw-semibold font-monospace" for="<?= $id ?>-q"
                                            aria-label="Import <?= esc($etiqueta, 'attr') ?>"><?= $euros($importIn) ?></output>
                                </div>
                                <?php if ($error): ?>
                                    <div class="col-12 text-danger small mt-0"><?= esc($error) ?></div>
                                <?php endif ?>
                            </div>
                            <?php endforeach ?>
                        </fieldset>
                    <?php endforeach ?>

                        <div class="d-flex justify-content-between align-items-center border-top pt-3 mb-4">
                            <span class="fw-semibold">Total <span class="text-body-secondary fw-normal small">(<span id="total-unitats">0</span> samarretes)</span></span>
                            <output id="total" class="fs-5 fw-bold font-monospace"><?= $euros(0) ?></output>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-danger w-100">
                        <i class="bi bi-send"></i> Envia
                    </button>

                <?= form_close() ?>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script src="<?= base_url('assets/js/samarretes.js') ?>"></script>
<?= $this->endSection() ?>
