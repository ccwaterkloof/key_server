<?php

namespace App;

use Dotenv\Dotenv;
use Skateboard\Wheels\WebController;

class Controller extends WebController
{
    public function __construct()
    {
        $dotenv = Dotenv::createImmutable(__DIR__, '../.env');
        $dotenv->load();
    }

    public function index()
    {
        if (! $this->isValidKeyRequest()) {
            $this->abort(401);
        }

        $data = [
            'key' => getenv('API_KEY'),
            'token' => getenv('API_TOKEN'),
            ];

        $this->json($data);
    }

    protected function isValidKeyRequest()
    {
        if (! $this->input('password')) {
            return false;
        }

        $expected = getenv('PASSWORD');
        $actual = $this->input('password');

        return $expected == $actual;
    }
}
