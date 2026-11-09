<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

/**
 * Talles i preu de la comanda de samarretes.
 * És l'única font: la fan servir el formulari i el càlcul del servidor.
 */
class Samarretes extends BaseConfig
{
    /** Preu unitari en euros */
    public float $preuUnitari = 15.00;

    /** Adreça on arriba l'avís de cada comanda nova */
    public string $correuAvis = 'blaneslj@gmail.com';

    /** Correu de contacte que surt al peu de la web (buit = no es mostra) */
    public string $correuContacte = 'blaneslj@gmail.com';

    /** Quantitat màxima per talla */
    public int $quantitatMaxima = 999;

    /** Grups de talles: títol => [clau => etiqueta] */
    public array $grups = [
        'Talles infantils' => [
            '3-4'  => '3-4 anys',
            '5-6'  => '5-6 anys',
            '7-8'  => '7-8 anys',
            '9-11' => '9-11 anys',
            'XS'   => 'XS',
        ],
        'Talles adults' => [
            'S'   => 'S',
            'M'   => 'M',
            'L'   => 'L',
            'XL'  => 'XL',
            '2XL' => '2XL',
            '3XL' => '3XL',
            '4XL' => '4XL',
        ],
    ];

    /** Columna de la taula tsamarretes on es desa la quantitat d'una talla */
    public function columna(string $clau): string
    {
        return 'q_' . strtolower(str_replace('-', '_', $clau));
    }

    /** Totes les talles, en pla: clau => etiqueta */
    public function talles(): array
    {
        return array_merge(...array_values($this->grups));
    }
}
