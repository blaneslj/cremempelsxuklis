<?php
/**
 * Plantilla de la web pública (disseny «Cremem pels Xuklis»).
 *
 * @var string      $title
 * @var string|null $descripcio
 * @var string      $pagina      'inici' | 'afanoc' | 'samarretes'
 */
$pagina ??= 'inici';
$inici  = $pagina === 'inici';
// A la portada els enllaços del menú són àncores; des d'altres pàgines tornen a la portada
$a = static fn (string $ancora): string => ($inici ? '' : site_url('/')) . '#' . $ancora;
?>
<!doctype html>
<html lang="ca">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= esc($title ?? 'Cremem pels Xuklis') ?></title>
    <meta name="description" content="<?= esc($descripcio ?? 'Correfoc infantil i solidari a la plaça de Montbau (Barcelona) per acompanyar els infants i joves amb càncer i les seves famílies.', 'attr') ?>">
    <meta name="theme-color" content="#140E0C">
    <meta property="og:title" content="<?= esc($title ?? 'Cremem pels Xuklis', 'attr') ?>">
    <meta property="og:type" content="website">
    <meta property="og:image" content="<?= base_url('assets/img/portada.jpg') ?>">
    <link rel="icon" href="<?= base_url('favicon.ico') ?>">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Anton&amp;family=Poppins:wght@400;500;600;700&amp;display=swap">
    <link rel="stylesheet" href="<?= base_url('assets/bootstrap/css/bootstrap.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/web.css') ?>">
</head>
<body class="xk">
<a class="xk-salta" href="#contingut">Salta al contingut</a>

<header<?= $inici ? ' class="xk-cap-sobre"' : '' ?>>
    <nav class="navbar navbar-expand-lg xk-cap xk-contenidor" aria-label="Navegació principal">
        <a class="navbar-brand" href="<?= $inici ? '#inici' : site_url('/') ?>">Cremem pels <span class="xk-accent">Xuklis</span></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menu"
                aria-controls="menu" aria-expanded="false" aria-label="Mostra el menú">
            <svg aria-hidden="true" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M4 7h16M4 12h16M4 17h16"/></svg>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="menu">
            <ul class="navbar-nav">
                <?php if ($inici): ?>
                    <li class="nav-item"><a class="nav-link" href="#que-es">Què és</a></li>
                    <li class="nav-item"><a class="nav-link" href="#programa">Programa</a></li>
                    <li class="nav-item"><a class="nav-link" href="#samarreta">Samarreta</a></li>
                    <li class="nav-item"><a class="nav-link" href="#collabora">Col·labora</a></li>
                    <li class="nav-item"><a class="nav-link" href="#seguretat">Seguretat</a></li>
                    <li class="nav-item"><a class="nav-link" href="#com-arribar">Com arribar</a></li>
                <?php else: ?>
                    <li class="nav-item"><a class="nav-link" href="<?= site_url('/') ?>">← Tornar a la festa</a></li>
                <?php endif ?>
                <?php if ($pagina !== 'samarretes'): ?>
                    <li class="nav-item"><a class="xk-boto xk-boto-ple" href="<?= site_url('samarretes') ?>">Compra la samarreta</a></li>
                <?php endif ?>
            </ul>
        </div>
    </nav>
</header>

<main id="contingut">
<?= $this->renderSection('content') ?>
</main>

<footer class="xk-peu<?= $inici ? '' : ' xk-peu-vora' ?>">
    <div class="xk-contenidor">
        <span>© <?= date('Y') ?> Cremem pels Xuklis · AFANOC, Diables de Montbau i Federació Diables de la Ciutat de Barcelona</span>
        <?php if (($correu = config(\Config\Samarretes::class)->correuContacte) !== ''): ?>
            <span>Contacte: <a href="mailto:<?= esc($correu, 'attr') ?>"><?= esc($correu) ?></a></span>
        <?php else: ?>
            <a href="https://afanoc.org/">afanoc.org</a>
        <?php endif ?>
    </div>
</footer>

<script src="<?= base_url('assets/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
<script src="<?= base_url('assets/js/web.js') ?>"></script>
<?= $this->renderSection('scripts') ?>
</body>
</html>
