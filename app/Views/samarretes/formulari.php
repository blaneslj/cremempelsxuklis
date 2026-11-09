<?= $this->extend('layouts/web') ?>

<?= $this->section('content') ?>
<?php
$errors       = session('errors') ?? [];
$oldTalla     = (array) old('talla');
$oldQuantitat = (array) old('quantitat');
$euros        = static fn (float $v): string => number_format($v, 2, ',', '.') . ' €';
$invalid      = static fn (string $camp): string => isset($errors[$camp]) ? ' is-invalid' : '';
?>

<section class="xk-contenidor xk-afanoc-heroi xk-form-heroi">
    <p class="xk-etiqueta">Samarreta solidària</p>
    <h1>Compra la<br><span class="xk-accent">samarreta</span></h1>
    <p class="xk-heroi-entradeta"><?= $euros($config->preuUnitari) ?> per samarreta. Tot el que recaptem va a La Casa dels Xuklis.</p>
</section>

<section class="xk-contenidor xk-form-cos">
    <div class="xk-form-lateral">
        <div class="xk-form-passos">
            <h2 class="xk-etiqueta">El funcionament és el següent</h2>
            <ol>
                <li>Feu la comanda posant les vostres dades.</li>
                <li>Ens posarem en contacte amb vosaltres per confirmar la comanda i informant-vos del procediment de pagament.</li>
                <li>Un cop rebut el pagament us informarem per a que pugueu recollir la comanda.</li>
            </ol>
        </div>
        <figure class="xk-form-foto">
            <img src="<?= base_url('assets/img/samarreta-davant.jpg') ?>" width="912" height="1146" loading="lazy"
                 alt="Noi amb la samarreta negra: al davant, tres diables dibuixats amb tabal, forca i espurnes">
        </figure>
    </div>

    <div class="xk-form">
        <?php if (session('missatge')): ?>
            <div class="xk-avis xk-avis-ok" role="status">
                <svg aria-hidden="true" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="9"/><path d="M8 12.5l2.5 2.5L16 9.5"/></svg>
                <p><?= esc(session('missatge')) ?></p>
            </div>
        <?php endif ?>

        <?php if ($errors !== []): ?>
            <div class="xk-avis xk-avis-error" role="alert">
                <svg aria-hidden="true" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="9"/><path d="M12 7.5v5.5M12 16.5v.01"/></svg>
                <p><?= isset($errors['talles']) && count($errors) === 1 ? esc($errors['talles']) : 'Revisa els camps marcats en vermell.' ?></p>
            </div>
        <?php endif ?>

        <?= form_open('samarretes', ['novalidate' => true]) ?>

            <fieldset class="xk-form-bloc">
                <legend>Les vostres dades</legend>

                <div class="mb-3">
                    <label for="nom" class="form-label">Nom entitat/persona</label>
                    <input type="text" class="form-control<?= $invalid('nom') ?>"
                           id="nom" name="nom" maxlength="150" required autocomplete="name"
                           value="<?= esc(old('nom')) ?>">
                    <?php if (isset($errors['nom'])): ?>
                        <div class="invalid-feedback"><?= esc($errors['nom']) ?></div>
                    <?php endif ?>
                </div>

                <div class="row g-3">
                    <div class="col-sm-7">
                        <label for="email" class="form-label">Correu electrònic</label>
                        <input type="email" class="form-control<?= $invalid('email') ?>"
                               id="email" name="email" maxlength="254" required autocomplete="email"
                               value="<?= esc(old('email')) ?>">
                        <?php if (isset($errors['email'])): ?>
                            <div class="invalid-feedback"><?= esc($errors['email']) ?></div>
                        <?php endif ?>
                    </div>
                    <div class="col-sm-5">
                        <label for="telefon" class="form-label">Telèfon</label>
                        <input type="tel" class="form-control<?= $invalid('telefon') ?>"
                               id="telefon" name="telefon" maxlength="20" required autocomplete="tel"
                               inputmode="tel" value="<?= esc(old('telefon')) ?>">
                        <?php if (isset($errors['telefon'])): ?>
                            <div class="invalid-feedback"><?= esc($errors['telefon']) ?></div>
                        <?php endif ?>
                    </div>
                </div>
            </fieldset>

            <div id="comanda" data-preu="<?= esc((string) $config->preuUnitari, 'attr') ?>">
                <?php if (isset($errors['talles']) && count($errors) > 1): ?>
                    <p class="xk-error-talles"><?= esc($errors['talles']) ?></p>
                <?php endif ?>

                <?php foreach ($config->grups as $titol => $talles): ?>
                    <fieldset class="xk-form-bloc">
                        <legend><?= esc($titol) ?></legend>
                        <div class="xk-talla xk-talla-cap" aria-hidden="true">
                            <span>Talla</span><span>Quantitat</span><span>Import</span>
                        </div>

                        <?php foreach ($talles as $clau => $etiqueta):
                            $id       = 'talla-' . preg_replace('/[^A-Za-z0-9]/', '', $clau);
                            $marcada  = isset($oldTalla[$clau]);
                            $q        = $oldQuantitat[$clau] ?? '';
                            $error    = $errors['quantitat.' . $clau] ?? null;
                            $importIn = ($marcada && ctype_digit((string) $q)) ? (int) $q * $config->preuUnitari : 0;
                        ?>
                        <div class="xk-talla linia-talla">
                            <div class="form-check mb-0">
                                <input class="form-check-input js-talla" type="checkbox"
                                       id="<?= $id ?>" name="talla[<?= esc($clau, 'attr') ?>]" value="1"
                                       <?= $marcada ? 'checked' : '' ?>>
                                <label class="form-check-label" for="<?= $id ?>"><?= esc($etiqueta) ?></label>
                            </div>
                            <input type="number" class="form-control js-quantitat<?= $error ? ' is-invalid' : '' ?>"
                                   id="<?= $id ?>-q" name="quantitat[<?= esc($clau, 'attr') ?>]"
                                   min="1" max="<?= $config->quantitatMaxima ?>" step="1" inputmode="numeric"
                                   aria-label="Quantitat <?= esc($etiqueta, 'attr') ?>"
                                   value="<?= esc((string) $q, 'attr') ?>" <?= $marcada ? '' : 'disabled' ?>>
                            <output class="js-import" for="<?= $id ?>-q"
                                    aria-label="Import <?= esc($etiqueta, 'attr') ?>"><?= $euros($importIn) ?></output>
                            <?php if ($error): ?>
                                <p class="xk-talla-error"><?= esc($error) ?></p>
                            <?php endif ?>
                        </div>
                        <?php endforeach ?>
                    </fieldset>
                <?php endforeach ?>

                <div class="xk-total">
                    <span>Total <small>(<span id="total-unitats">0</span> samarretes)</small></span>
                    <output id="total"><?= $euros(0) ?></output>
                </div>
            </div>

            <button type="submit" class="xk-boto xk-boto-ple xk-boto-ample">Envia la comanda</button>

        <?= form_close() ?>
    </div>
</section>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script src="<?= base_url('assets/js/samarretes.js') ?>"></script>
<?= $this->endSection() ?>
