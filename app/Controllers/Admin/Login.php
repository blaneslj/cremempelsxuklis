<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\RedirectResponse;
use Config\Admin as AdminConfig;

class Login extends BaseController
{
    public function index(): RedirectResponse|string
    {
        if (session('admin') === true) {
            return redirect()->to(site_url('admin/comandes'));
        }

        return view('admin/login', ['title' => 'Accés · Cremem pels Xuklis']);
    }

    public function entra(): RedirectResponse
    {
        $config = config(AdminConfig::class);

        // Limita els intents per IP per evitar atacs de força bruta
        $clau = 'login-' . md5($this->request->getIPAddress());
        if (service('throttler')->check($clau, $config->intentsPerMinut, MINUTE) === false) {
            return redirect()->back()->with('error', "Massa intents. Espera un minut i torna-ho a provar.");
        }

        $usuari = trim((string) $this->request->getPost('usuari'));
        $pass   = (string) $this->request->getPost('contrasenya');

        $ok = $config->usuari !== '' && $config->hash !== ''
            && hash_equals($config->usuari, $usuari)
            && password_verify($pass, $config->hash);

        if (! $ok) {
            log_message('warning', 'Inici de sessió admin fallit des de {ip}', ['ip' => $this->request->getIPAddress()]);

            return redirect()->back()->withInput()->with('error', 'Usuari o contrasenya incorrectes.');
        }

        session()->regenerate(true);
        session()->set('admin', true);

        return redirect()->to(site_url('admin/comandes'));
    }

    public function surt(): RedirectResponse
    {
        session()->destroy();

        return redirect()->to(site_url('admin/login'));
    }
}
