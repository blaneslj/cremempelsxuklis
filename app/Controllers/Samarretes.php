<?php

namespace App\Controllers;

use App\Libraries\CorreuSamarretes;
use App\Models\SamarretaModel;
use CodeIgniter\HTTP\RedirectResponse;
use Config\Samarretes as SamarretesConfig;

class Samarretes extends BaseController
{
    public function index(): string
    {
        return view('samarretes/formulari', [
            'title'      => 'Compra la samarreta · Cremem pels Xuklis',
            'descripcio' => 'Reserva la samarreta solidària de Cremem pels Xuklis. Tot el que recaptem va a La Casa dels Xuklis.',
            'pagina'     => 'samarretes',
            'config'     => config(SamarretesConfig::class),
        ]);
    }

    public function desa(): RedirectResponse
    {
        $config = config(SamarretesConfig::class);
        $model  = new SamarretaModel();

        $dades = $this->request->getPost(['nom', 'email', 'telefon']);
        $dades = array_map(static fn ($v) => trim((string) $v), $dades);

        [$linies, $errors] = $this->linies($config);

        // Valida les dades personals amb les regles del model
        if (! $model->validate($dades)) {
            $errors = $model->errors() + $errors;
        }

        if ($errors !== []) {
            return redirect()->back()->withInput()->with('errors', $errors);
        }

        $unitats = 0;
        foreach ($config->talles() as $clau => $etiqueta) {
            $q = $linies[$clau] ?? 0;
            $dades[$config->columna($clau)] = $q;
            $unitats += $q;
        }
        $dades['total'] = round($unitats * $config->preuUnitari, 2);

        $id      = $model->insert($dades, true);
        $enviats = (new CorreuSamarretes($config))->envia($model->find($id));

        $missatge = sprintf(
            'Gràcies! Hem rebut la teva comanda de %d samarretes per un total de %s €.',
            $unitats,
            number_format($dades['total'], 2, ',', '.')
        );
        $missatge .= $enviats['client']
            ? " T'hem enviat un correu amb el resum. Properament ens posarem en contacte amb tu per informar-te de les condicions de pagament."
            : " Properament ens posarem en contacte amb tu per informar-te de les condicions de pagament.";

        return redirect()->to(site_url('samarretes'))->with('missatge', $missatge);
    }

    /**
     * Llegeix les talles marcades i en valida les quantitats.
     *
     * @return array{0: array<string, int>, 1: array<string, string>} [talla => quantitat, errors]
     */
    private function linies(SamarretesConfig $config): array
    {
        $marcades    = (array) $this->request->getPost('talla');
        $quantitats  = (array) $this->request->getPost('quantitat');
        $linies      = [];
        $errors      = [];

        foreach ($config->talles() as $clau => $etiqueta) {
            if (! isset($marcades[$clau])) {
                continue;
            }

            $q = trim((string) ($quantitats[$clau] ?? ''));

            if (! ctype_digit($q) || (int) $q < 1 || (int) $q > $config->quantitatMaxima) {
                $errors['quantitat.' . $clau] = sprintf('Indica una quantitat entre 1 i %d.', $config->quantitatMaxima);

                continue;
            }

            $linies[$clau] = (int) $q;
        }

        if ($linies === [] && $errors === []) {
            $errors['talles'] = 'Marca com a mínim una talla i indica-hi la quantitat.';
        }

        return [$linies, $errors];
    }
}
