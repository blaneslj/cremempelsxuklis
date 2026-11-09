<?= $this->extend('layouts/web') ?>

<?= $this->section('content') ?>

<section class="xk-contenidor xk-afanoc-heroi">
    <p class="xk-etiqueta">Qui organitza</p>
    <h1>Què és<br>l’<span class="xk-taronja">AFANOC</span></h1>
    <p class="xk-heroi-entradeta">L’Associació de Familiars i Amics de Nens Oncològics de Catalunya treballa des del 1987 per millorar la qualitat de vida dels nens, nenes, adolescents i joves amb càncer i les seves famílies.</p>
    <div class="xk-graella xk-graella-220 xk-xifres">
        <?php foreach ([
            ['1987', 'Any de fundació'],
            ['2000', 'Entitat declarada d’utilitat pública'],
            ['25', 'Habitacions a la Casa dels Xuklis'],
            ['4', 'Seus: Barcelona, Girona, Lleida i Tarragona'],
        ] as [$xifra, $text]): ?>
            <div class="xk-targeta">
                <span class="xk-xifra"><?= esc($xifra) ?></span>
                <span class="xk-xifra-text"><?= esc($text) ?></span>
            </div>
        <?php endforeach ?>
    </div>
</section>

<section class="xk-clara">
    <div class="xk-contenidor xk-seccio xk-dues-columnes">
        <div class="xk-col-titol">
            <p class="xk-etiqueta">Qui som</p>
            <h2 class="xk-titol">Un complement vital per a la sanitat</h2>
        </div>
        <div class="xk-col-text">
            <p>Som una entitat professionalitzada, sense ànim de lucre i declarada d’utilitat pública des de l’any 2000. Duem a terme una tasca essencial que l’administració no pot oferir, i per això som un complement vital per a l’atenció sanitària i social oncològica, a Catalunya i a la resta de l’Estat.</p>
            <p>Som presents als dos hospitals oncològics de Barcelona, <strong>Vall d’Hebron</strong> i <strong>Sant Joan de Déu</strong>, amb un equip propi de professionals:</p>
            <ul class="xk-xips">
                <?php foreach (['Treballadores socials', 'Neuropsicòloga', 'Psicooncòloga', 'Educadores socials', 'Psicopedagoga', 'Infermera terapeuta'] as $professio): ?>
                    <li class="xk-xip"><?= esc($professio) ?></li>
                <?php endforeach ?>
            </ul>
        </div>
    </div>
</section>

<section class="xk-contenidor xk-seccio">
    <div class="xk-caixa">
        <div class="xk-col-titol">
            <p class="xk-etiqueta">On va el que recaptem</p>
            <h2 class="xk-titol-gran">La Casa dels <span class="xk-accent">Xuklis</span></h2>
        </div>
        <div class="xk-col-text">
            <p>Una llar temporal amb 25 habitacions per a les famílies que han de fer tractament als hospitals de Barcelona. Hi arriben famílies de tot l’Estat, i és un recurs únic a Europa.</p>
            <p>Són tractaments de llarga durada: sis mesos no te’ls treu ningú. Per això és tan important tenir una casa a prop de l’hospital.</p>
        </div>
    </div>
</section>

<section class="xk-contenidor xk-seccio" style="padding-top: 0">
    <div class="xk-capcalera" style="margin-bottom: 40px">
        <p class="xk-etiqueta">Què fem</p>
        <h2 class="xk-titol">Un acompanyament integral</h2>
        <p class="xk-entradeta">Des del diagnòstic, durant l’estada a l’hospital i fins a la tornada a casa.</p>
    </div>
    <div class="xk-graella xk-graella-260">
        <?php foreach ([
            ['01', false, 'El debut', 'Acompanyem la família des del primer moment del diagnòstic.'],
            ['02', false, 'L’estada', 'Professionals als hospitals i la Casa dels Xuklis durant el tractament.'],
            ['03', false, 'La tornada a casa', 'Seguim al costat de les famílies des de les seus de Tarragona, Lleida, Girona i Barcelona.'],
            ['+', true, 'Escola', 'Gestionem amb el Departament d’Educació l’atenció educativa durant el tractament, activant els mestres domiciliaris.'],
            ['+', true, 'Voluntariat', 'Hospitalari, domiciliari, a la Casa dels Xuklis i en actes i campanyes: són les persones que trobaràs a les parades de marxandatge, les barres i les taquilles.'],
        ] as [$num, $blau, $titol, $text]): ?>
            <div class="xk-pas">
                <span class="xk-pas-num<?= $blau ? ' xk-blau' : '' ?>" aria-hidden="true"><?= esc($num) ?></span>
                <h3><?= esc($titol) ?></h3>
                <p><?= esc($text) ?></p>
            </div>
        <?php endforeach ?>
    </div>
</section>

<section class="xk-clara">
    <div class="xk-contenidor xk-seccio xk-pila">
        <div class="xk-dues-columnes xk-alineat-baix">
            <div class="xk-col-titol">
                <p class="xk-etiqueta">Per què us necessitem</p>
                <h2 class="xk-titol">Ens busquem la vida</h2>
            </div>
            <p class="xk-col-text" style="flex-basis: 420px">Cada any l’AFANOC necessita 2.000.000 €. L’administració n’aporta el 30%; la resta l’aconseguim nosaltres, i per això impulsem dues campanyes de sensibilització i normalització sobre el càncer en infants, adolescents i joves.</p>
        </div>
        <div class="xk-graella xk-graella-240">
            <div class="xk-xifra-clara"><span>2.000.000 €</span><span>Pressupost anual necessari</span></div>
            <div class="xk-xifra-clara"><span>30%</span><span>Aportació de l’administració</span></div>
            <div class="xk-xifra-clara"><span class="xk-vermell">70%</span><span>Campanyes, actes i persones com tu</span></div>
        </div>
        <div class="xk-graella xk-graella-300">
            <div class="xk-campanya">
                <h3>Posa’t la Gorra</h3>
                <p>Una campanya familiar on la gorra és el nostre símbol: quan et poses una gorra, no saps quin infant té càncer. Una manera de sensibilitzar i normalitzar.</p>
            </div>
            <div class="xk-campanya">
                <h3>Rockpelsxuklis</h3>
                <p>«Música per als joves amb càncer»: una campanya musical adreçada als joves i joves adults, que travessa diferents estils musicals.</p>
            </div>
        </div>
    </div>
</section>

<section class="xk-contenidor xk-seccio xk-tancament">
    <h2 class="xk-titol-gran">El 12 de desembre,<br>cremem pels <span class="xk-accent">Xuklis</span></h2>
    <div class="xk-botons">
        <a class="xk-boto xk-boto-ple" href="<?= site_url('/') ?>">Tornar a la festa</a>
        <a class="xk-boto xk-boto-contorn" href="https://afanoc.org/">Web de l’AFANOC</a>
    </div>
</section>
<?= $this->endSection() ?>
