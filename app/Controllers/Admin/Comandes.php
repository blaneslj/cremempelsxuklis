<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\SamarretaModel;
use CodeIgniter\HTTP\ResponseInterface;
use Config\Samarretes as SamarretesConfig;

class Comandes extends BaseController
{
    public function index(): string
    {
        $config   = config(SamarretesConfig::class);
        $comandes = (new SamarretaModel())->orderBy('id', 'DESC')->findAll();

        // Totals per talla: el que caldrà encarregar
        $perTalla = [];
        foreach ($config->talles() as $clau => $etiqueta) {
            $perTalla[$clau] = array_sum(array_column($comandes, $config->columna($clau)));
        }

        return view('admin/comandes', [
            'title'    => 'Comandes · Cremem pels Xuklis',
            'config'   => $config,
            'comandes' => $comandes,
            'perTalla' => $perTalla,
            'total'    => array_sum(array_map('floatval', array_column($comandes, 'total'))),
        ]);
    }

    /** Exportació CSV (separador «;» i UTF-8 amb BOM perquè l'Excel l'obri bé) */
    public function csv(): ResponseInterface
    {
        $config   = config(SamarretesConfig::class);
        $comandes = (new SamarretaModel())->orderBy('id', 'ASC')->findAll();

        $f = fopen('php://temp', 'r+b');
        fwrite($f, "\xEF\xBB\xBF");
        fputcsv($f, array_merge(
            ['Núm.', 'Data', 'Nom entitat/persona', 'Correu electrònic', 'Telèfon'],
            array_values($config->talles()),
            ['Unitats', 'Total (€)']
        ), ';', '"', '');

        foreach ($comandes as $c) {
            $quantitats = [];
            foreach (array_keys($config->talles()) as $clau) {
                $quantitats[] = (int) $c[$config->columna($clau)];
            }
            fputcsv($f, array_merge(
                [$c['id'], $c['created_at'], $this->segur($c['nom']), $this->segur($c['email']), $c['telefon']],
                $quantitats,
                [array_sum($quantitats), number_format((float) $c['total'], 2, ',', '')]
            ), ';', '"', '');
        }

        rewind($f);
        $csv = stream_get_contents($f);
        fclose($f);

        return $this->response
            ->setContentType('text/csv; charset=UTF-8')
            ->setHeader('Content-Disposition', 'attachment; filename="comandes-samarretes-' . date('Y-m-d') . '.csv"')
            ->setBody($csv);
    }

    /** Evita que l'Excel interpreti com a fórmula un text que comenci per =, +, - o @ */
    private function segur(string $valor): string
    {
        return preg_match('/^[=+\-@\t\r]/', $valor) ? "'" . $valor : $valor;
    }
}
