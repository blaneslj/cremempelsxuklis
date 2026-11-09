<?= $this->extend('layouts/web') ?>

<?= $this->section('content') ?>
<?php $preu = number_format(config(\Config\Samarretes::class)->preuUnitari, 0, ',', '.') . ' €'; ?>

<section id="inici" class="xk-heroi">
    <div class="xk-contenidor xk-heroi-cos">
        <div class="xk-heroi-text">
            <div class="xk-heroi-etiquetes">
                <span class="xk-pastilla-accent">Correfoc infantil</span>
                <span class="xk-etiqueta">Solidari · Montbau, Barcelona</span>
            </div>
            <h1>Cremem<br>pels <span class="xk-accent">Xuklis</span></h1>
            <p class="xk-heroi-entradeta">Un correfoc infantil on els petits diables de Barcelona encenen el foc per acompanyar els infants i joves amb càncer i les seves famílies.</p>
            <div class="xk-botons">
                <a class="xk-boto xk-boto-ple" href="#samarreta">Compra la samarreta</a>
                <a class="xk-boto xk-boto-contorn" href="#programa">Veure el programa</a>
            </div>
        </div>
        <div class="xk-heroi-dades">
            <div class="xk-targeta">
                <span class="xk-targeta-etiqueta">Data</span>
                <span class="xk-targeta-valor">Dissabte 12 de desembre</span>
            </div>
            <div class="xk-targeta">
                <span class="xk-targeta-etiqueta">Lloc</span>
                <span class="xk-targeta-valor">Plaça de Montbau</span>
                <a href="#com-arribar">Com arribar →</a>
            </div>
        </div>
    </div>
</section>

<section id="que-es" class="xk-clara">
    <div class="xk-contenidor xk-seccio xk-dues-columnes">
        <div class="xk-col-titol">
            <p class="xk-etiqueta">Què és</p>
            <h2 class="xk-titol">Foc, tabals i molta germanor</h2>
        </div>
        <div class="xk-col-text">
            <p>Cremem pels Xuklis és un correfoc infantil i solidari organitzat per l’Associació AFANOC, els Diables de Montbau i la Federació Diables de la Ciutat de Barcelona. Diables i tabalers de tota la ciutat surten junts al carrer amb un sol objectiu: fer pinya amb els xuklis, els infants i joves amb càncer que acompanya AFANOC.</p>
            <p>Tot el que recaptem durant la festa es destina a La Casa dels Xuklis. Vine a cremar, a ballar sota les espurnes o a mirar-ho des de la vorera: cada persona hi suma.</p>
            <a class="xk-boto xk-boto-fosc" href="<?= site_url('afanoc') ?>">Coneix l’AFANOC →</a>
        </div>
    </div>
</section>

<section id="programa" class="xk-contenidor xk-seccio">
    <div class="xk-capcalera">
        <p class="xk-etiqueta">Programa</p>
        <h2 class="xk-titol">Com anirà la festa</h2>
    </div>
    <ol class="xk-programa">
        <?php foreach ([
            ['11–14 h', 'Matí d’entremesos', 'A càrrec de l’AEEF.'],
            ['14–16 h', 'Pintxo solidari', 'Tot el que recaptem va a La Casa dels Xuklis.'],
            ['16–17 h', 'Tallers', 'Tallers organitzats per l’organització de la festa.'],
            ['17–19 h', 'Concert de Furtius', 'Versions de grups catalans.'],
            ['19–20 h', 'Correfoc infantil', 'Les colles de diables encenen la plaça de Montbau.'],
            ['20–21 h', 'DJ', 'Si la temperatura ho permet.'],
        ] as [$hora, $activitat, $detall]): ?>
            <li>
                <span class="xk-programa-hora"><?= esc($hora) ?></span>
                <div class="xk-programa-act">
                    <h3><?= esc($activitat) ?></h3>
                    <p><?= esc($detall) ?></p>
                </div>
            </li>
        <?php endforeach ?>
    </ol>
</section>

<section id="samarreta" class="xk-clara">
    <div class="xk-contenidor xk-seccio xk-samarreta">
        <div class="xk-samarreta-text">
            <p class="xk-etiqueta">Samarreta solidària</p>
            <h2 class="xk-titol">Porta el foc posat</h2>
            <p>La samarreta oficial de Cremem pels Xuklis: diables i tabalers al davant, el lema encès a l’esquena i els logos d’AFANOC i de la Federació a les mànigues. Tot el que recaptem va a La Casa dels Xuklis.</p>
            <div class="xk-xips"><span class="xk-xip">Preu: <?= $preu ?></span></div>
            <p class="xk-nota">Es compra online: omple el formulari i reserva la teva.</p>
            <a class="xk-boto xk-boto-ple" href="<?= site_url('samarretes') ?>">Compra la samarreta</a>
        </div>
        <div class="xk-samarreta-fotos">
            <figure>
                <picture>
                    <source type="image/webp" srcset="<?= base_url('assets/img/samarreta-davant.webp') ?>">
                    <img src="<?= base_url('assets/img/samarreta-davant.jpg') ?>" width="800" height="1005" loading="lazy" style="object-position: center 30%"
                         alt="Noi amb la samarreta negra: al davant, tres diables dibuixats amb tabal, forca i espurnes">
                </picture>
                <figcaption>Davant</figcaption>
            </figure>
            <figure>
                <picture>
                    <source type="image/webp" srcset="<?= base_url('assets/img/samarreta-esquena.webp') ?>">
                    <img src="<?= base_url('assets/img/samarreta-esquena.jpg') ?>" width="800" height="1305" loading="lazy" style="object-position: center 40%"
                         alt="Noi d’esquena amb la samarreta negra amb el lema Cremem pels Xuklis en lletres enceses">
                </picture>
                <figcaption>Esquena</figcaption>
            </figure>
        </div>
    </div>
</section>

<section id="collabora" class="xk-franja xk-franja-tancada">
    <div class="xk-contenidor xk-seccio">
        <div class="xk-capcalera">
            <p class="xk-etiqueta">Col·labora</p>
            <h2 class="xk-titol">Encén la teva espurna</h2>
            <p class="xk-entradeta">Tres maneres de cremar pels xuklis.</p>
        </div>
        <div class="xk-graella xk-graella-260">
            <div class="xk-collabora">
                <svg aria-hidden="true" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="#F07A3A" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M8 3l-5 3 2 4 2-1v12h10V9l2 1 2-4-5-3a4 4 0 0 1-8 0z"/></svg>
                <h3>Compra la samarreta</h3>
                <p><?= $preu ?> que van íntegrament a La Casa dels Xuklis. Es compra online amb el formulari.</p>
                <a class="xk-boto xk-boto-ple xk-boto-sm" href="<?= site_url('samarretes') ?>">Vull la samarreta</a>
            </div>
            <div class="xk-collabora">
                <svg aria-hidden="true" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="#3CC3DB" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="9" cy="8" r="3.5"/><path d="M2.5 20a6.5 6.5 0 0 1 13 0"/><path d="M16 4.5a3.5 3.5 0 0 1 0 7"/><path d="M18 14.5a6.5 6.5 0 0 1 3.5 5.5"/></svg>
                <h3>Participa en les activitats</h3>
                <p>Entremesos, pintxo solidari, tallers, concert i cremada: vine a la plaça de Montbau i omple-la de gent.</p>
                <a class="xk-boto xk-boto-contorn xk-boto-sm" href="#programa">Veure el programa</a>
            </div>
            <div class="xk-collabora">
                <svg aria-hidden="true" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="#FFD27A" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="18" cy="5" r="3"/><circle cx="6" cy="12" r="3"/><circle cx="18" cy="19" r="3"/><path d="M8.6 13.5l6.8 4M15.4 6.5l-6.8 4"/></svg>
                <h3>Fes-ne difusió</h3>
                <p>Comparteix la festa amb l’etiqueta #CrememPelsXuklis i porta-hi la teva colla.</p>
                <button type="button" class="xk-boto xk-boto-contorn xk-boto-sm js-comparteix"
                        data-titol="Cremem pels Xuklis" data-text="Correfoc infantil i solidari el 12 de desembre a la plaça de Montbau #CrememPelsXuklis"
                        data-url="<?= esc(site_url('/'), 'attr') ?>">Comparteix</button>
                <p class="xk-comparteix-avis" role="status" aria-live="polite"></p>
            </div>
        </div>
    </div>
</section>

<section id="seguretat" class="xk-contenidor xk-seccio xk-dues-columnes">
    <div class="xk-col-titol" style="flex-basis: 320px">
        <p class="xk-etiqueta">Seguretat</p>
        <h2 class="xk-titol">Si vols ballar sota el foc</h2>
        <p class="xk-entradeta">El correfoc és festa si el vivim amb cap. Segueix sempre les indicacions de les colles i de l’organització.</p>
    </div>
    <ul class="xk-consells">
        <li><strong>Roba de cotó</strong>Màniga llarga, pantaló llarg i res de teixits sintètics.</li>
        <li><strong>Cap i coll tapats</strong>Barret o mocador de cotó i, si pots, ulleres protectores.</li>
        <li><strong>Calçat tancat</strong>Sabates esportives, mai sandàlies ni xancletes.</li>
        <li><strong>Infants protegits</strong>Lluny del foc i amb protectors auditius.</li>
        <li><strong>Respecta els diables</strong>No els toquis, no els llancis aigua i deixa’ls pas.</li>
        <li><strong>Veïnat</strong>Tanqueu balcons i finestres i retireu la roba estesa.</li>
    </ul>
</section>

<section id="com-arribar" class="xk-franja">
    <div class="xk-contenidor xk-seccio xk-arribar">
        <div class="xk-arribar-text">
            <p class="xk-etiqueta">Com arribar</p>
            <h2 class="xk-titol">Plaça de Montbau</h2>
            <p class="xk-entradeta">Barri de Montbau, districte d’Horta-Guinardó, Barcelona.</p>
            <div class="xk-xips"><span class="xk-xip-fosc">Metro L3 · Montbau</span></div>
            <a class="xk-boto xk-boto-ple" href="https://www.google.com/maps/search/?api=1&amp;query=Pla%C3%A7a+de+Montbau%2C+Barcelona">Obre a Google Maps</a>
        </div>
        <div class="xk-mapa">
            <iframe src="https://www.google.com/maps?q=Pla%C3%A7a+de+Montbau%2C+Barcelona&amp;z=16&amp;hl=ca&amp;output=embed"
                    title="Mapa de la plaça de Montbau, Barcelona" loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade" allowfullscreen></iframe>
        </div>
    </div>
</section>

<section aria-labelledby="organitzen" class="xk-blanca">
    <div class="xk-contenidor xk-organitzen">
        <h2 id="organitzen">Organitzen</h2>
        <div class="xk-logos">
            <a href="<?= site_url('afanoc') ?>">
                <img class="xk-logo-afanoc" src="<?= base_url('assets/img/logo-afanoc.png') ?>" width="349" height="100" loading="lazy"
                     alt="Associació AFANOC – Càncer en infants i joves (què és l’AFANOC)">
            </a>
            <img class="xk-logo-montbau" src="<?= base_url('assets/img/logo-diables-montbau.svg') ?>" width="170" height="120" loading="lazy"
                 alt="Diables de Montbau">
            <img class="xk-logo-federacio" src="<?= base_url('assets/img/logo-federacio-diables.png') ?>" width="327" height="84" loading="lazy"
                 alt="Federació Diables de la Ciutat de Barcelona">
        </div>
    </div>
</section>
<?= $this->endSection() ?>
