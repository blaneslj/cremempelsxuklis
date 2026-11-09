<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<?php
$euros   = static fn (float $v): string => number_format($v, 2, ',', '.') . ' €';
$unitats = array_sum($perTalla);
?>
<div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-4">
    <h1 class="h2 mb-0"><i class="bi bi-list-check"></i> Comandes de samarretes</h1>
    <?php if ($comandes !== []): ?>
        <a href="<?= site_url('admin/comandes.csv') ?>" class="btn btn-outline-success">
            <i class="bi bi-file-earmark-spreadsheet"></i> Descarrega CSV
        </a>
    <?php endif ?>
</div>

<div class="row g-3 mb-4">
    <div class="col-sm-4">
        <div class="card text-center h-100"><div class="card-body">
            <div class="text-body-secondary small">Comandes</div>
            <div class="fs-3 fw-bold"><?= count($comandes) ?></div>
        </div></div>
    </div>
    <div class="col-sm-4">
        <div class="card text-center h-100"><div class="card-body">
            <div class="text-body-secondary small">Samarretes</div>
            <div class="fs-3 fw-bold"><?= $unitats ?></div>
        </div></div>
    </div>
    <div class="col-sm-4">
        <div class="card text-center h-100"><div class="card-body">
            <div class="text-body-secondary small">Import total</div>
            <div class="fs-3 fw-bold"><?= $euros($total) ?></div>
        </div></div>
    </div>
</div>

<?php if ($comandes === []): ?>
    <div class="alert alert-info"><i class="bi bi-info-circle"></i> Encara no hi ha cap comanda.</div>
<?php else: ?>

<h2 class="h5">Samarretes per talla</h2>
<div class="table-responsive mb-4">
    <table class="table table-sm table-bordered text-center align-middle mb-0">
        <thead class="table-light">
            <tr>
                <?php foreach ($config->grups as $titol => $talles): ?>
                    <th colspan="<?= count($talles) ?>"><?= esc($titol) ?></th>
                <?php endforeach ?>
                <th rowspan="2" class="align-middle">Total</th>
            </tr>
            <tr>
                <?php foreach ($config->talles() as $etiqueta): ?>
                    <th class="text-nowrap fw-normal"><?= esc($etiqueta) ?></th>
                <?php endforeach ?>
            </tr>
        </thead>
        <tbody>
            <tr>
                <?php foreach ($perTalla as $q): ?>
                    <td class="<?= $q ? 'fw-semibold' : 'text-body-tertiary' ?>"><?= $q ?></td>
                <?php endforeach ?>
                <td class="fw-bold"><?= $unitats ?></td>
            </tr>
        </tbody>
    </table>
</div>

<h2 class="h5">Detall de les comandes</h2>
<div class="table-responsive">
    <table class="table table-hover align-middle">
        <thead class="table-light">
            <tr>
                <th>Núm.</th>
                <th>Data</th>
                <th>Nom entitat/persona</th>
                <th>Contacte</th>
                <th>Talles</th>
                <th class="text-end">Total</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($comandes as $c): ?>
            <tr>
                <td class="fw-semibold"><?= (int) $c['id'] ?></td>
                <td class="text-nowrap small"><?= esc(date('d/m/Y H:i', strtotime($c['created_at']))) ?></td>
                <td><?= esc($c['nom']) ?></td>
                <td class="small">
                    <a href="mailto:<?= esc($c['email'], 'attr') ?>"><?= esc($c['email']) ?></a><br>
                    <a href="tel:<?= esc($c['telefon'], 'attr') ?>" class="text-nowrap"><?= esc($c['telefon']) ?></a>
                </td>
                <td>
                    <?php foreach ($config->talles() as $clau => $etiqueta):
                        $q = (int) $c[$config->columna($clau)];
                        if ($q === 0) {
                            continue;
                        } ?>
                        <span class="badge text-bg-light border text-nowrap"><?= esc($etiqueta) ?> × <?= $q ?></span>
                    <?php endforeach ?>
                </td>
                <td class="text-end text-nowrap fw-semibold"><?= $euros((float) $c['total']) ?></td>
            </tr>
        <?php endforeach ?>
        </tbody>
    </table>
</div>
<?php endif ?>
<?= $this->endSection() ?>
