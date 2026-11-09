<?php

namespace App\Libraries;

use Config\Samarretes as SamarretesConfig;

/**
 * Envia els dos correus d'una comanda de samarretes:
 * la confirmació a qui l'ha feta i l'avís intern a l'organització.
 */
class CorreuSamarretes
{
    public function __construct(private readonly SamarretesConfig $config)
    {
    }

    /**
     * @param array<string, mixed> $comanda Fila de tsamarretes
     *
     * @return array{client: bool, avis: bool}
     */
    public function envia(array $comanda): array
    {
        return [
            'client' => $this->envia1(
                $comanda['email'],
                'Confirmació de la teva comanda de samarretes',
                $comanda,
                false,
                null,
            ),
            'avis' => $this->envia1(
                $this->config->correuAvis,
                sprintf('Nova comanda de samarretes núm. %d — %s', $comanda['id'], $comanda['nom']),
                $comanda,
                true,
                $comanda['email'],
            ),
        ];
    }

    private function envia1(string $a, string $assumpte, array $comanda, bool $perAvis, ?string $respondreA): bool
    {
        $email = service('email', null, false); // instància nova per a cada correu
        $email->setTo($a);
        $email->setSubject($assumpte);
        $email->setMailType('html');
        $email->setMessage(view('emails/samarretes_resum', [
            'comanda' => $comanda,
            'config'  => $this->config,
            'perAvis' => $perAvis,
        ]));

        if ($respondreA !== null) {
            $email->setReplyTo($respondreA, $comanda['nom']);
        }

        if ($email->send(false)) {
            return true;
        }

        log_message('error', "Comanda {id}: no s'ha pogut enviar el correu a {a}.\n{debug}", [
            'id'    => $comanda['id'],
            'a'     => $a,
            'debug' => $email->printDebugger(['headers']),
        ]);

        return false;
    }
}
