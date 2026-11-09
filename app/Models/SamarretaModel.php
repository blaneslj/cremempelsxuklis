<?php

namespace App\Models;

use CodeIgniter\Model;

class SamarretaModel extends Model
{
    protected $table          = 'tsamarretes';
    protected $primaryKey     = 'id';
    protected $returnType     = 'array';
    protected $allowedFields  = [
        'nom', 'email', 'telefon',
        'q_3_4', 'q_5_6', 'q_7_8', 'q_9_11', 'q_xs',
        'q_s', 'q_m', 'q_l', 'q_xl', 'q_2xl', 'q_3xl', 'q_4xl',
        'total',
    ];
    protected $useTimestamps  = true;

    protected $validationRules = [
        'nom'     => 'required|max_length[150]',
        'email'   => 'required|max_length[254]|valid_email',
        'telefon' => 'required|max_length[20]|regex_match[/^\+?[0-9 ]{9,19}$/]',
    ];

    protected $validationMessages = [
        'nom' => [
            'required'   => "Cal indicar el nom de l'entitat o de la persona.",
            'max_length' => 'El nom no pot tenir més de 150 caràcters.',
        ],
        'email' => [
            'required'    => 'Cal indicar un correu electrònic.',
            'max_length'  => 'El correu electrònic és massa llarg.',
            'valid_email' => 'El correu electrònic no és vàlid.',
        ],
        'telefon' => [
            'required'    => 'Cal indicar un telèfon.',
            'max_length'  => 'El telèfon és massa llarg.',
            'regex_match' => 'El telèfon ha de tenir com a mínim 9 xifres (pot començar amb + i contenir espais).',
        ],
    ];

    protected $beforeInsert = ['normalitza'];

    protected function normalitza(array $data): array
    {
        $data['data']['nom']     = trim($data['data']['nom']);
        $data['data']['email']   = mb_strtolower(trim($data['data']['email']));
        $data['data']['telefon'] = preg_replace('/\s+/', '', $data['data']['telefon']);

        return $data;
    }
}
