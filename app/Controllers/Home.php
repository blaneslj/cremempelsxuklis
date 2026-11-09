<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
        return view('web/inici', [
            'title'  => 'Cremem pels Xuklis · Correfoc infantil i solidari',
            'pagina' => 'inici',
        ]);
    }

    public function afanoc(): string
    {
        return view('web/afanoc', [
            'title'      => 'Què és l’AFANOC · Cremem pels Xuklis',
            'descripcio' => 'L’AFANOC acompanya des del 1987 els infants, adolescents i joves amb càncer i les seves famílies. Tot el que recaptem va a La Casa dels Xuklis.',
            'pagina'     => 'afanoc',
        ]);
    }
}
