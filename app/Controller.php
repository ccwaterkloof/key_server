<?php

namespace App;

use Dotenv\Dotenv;

class Controller
{
    public function __construct()
    {
        $dotenv = Dotenv::createImmutable(__DIR__, '../.env');
        $dotenv->load();
    }

    public function handleKeyRequest($get)
    {
        if (! $this->isValidKeyRequest($get)) {
            $this->respond('Unauthorized', 401);
        }

        $data = [
            'key' => getenv('API_KEY'),
            'token' => getenv('API_TOKEN'),
            ];

        $this->respond($data);
    }

    protected function isValidKeyRequest($get)
    {
        if (! isset($get['password'])) {
            return false;
        }

        // var_dump($get);
        $expected = getenv('PASSWORD');
        $actual = $get['password'];

        return $expected == $actual;
    }

    protected function respond($data, $code = 200)
    {
        header('Content-Type: application/json', false, $code);
        die(json_encode($data));
    }
}
