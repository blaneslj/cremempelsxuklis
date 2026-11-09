<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

/**
 * Accés a la zona d'administració.
 * Els valors reals són al .env (admin.usuari i admin.hash); el hash es
 * genera amb password_hash() i mai no es guarda la contrasenya en clar.
 */
class Admin extends BaseConfig
{
    public string $usuari = '';
    public string $hash   = '';

    /** Intents d'inici de sessió permesos per IP i minut */
    public int $intentsPerMinut = 5;
}
