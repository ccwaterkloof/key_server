<?php

namespace App;

use Dotenv\Dotenv;

class Controller
{
    public function __construct($get, $post)
    {
        $dotenv = Dotenv::createImmutable(__DIR__, '../.env');
        $dotenv->load();

        if (! $this->isLegit($get)) {
            $this->respond('Unauthorized', 401);
        }

        $this->sendCredentials();
    }

    public function respond($data, $code = 200)
    {
        header('Content-Type: application/json', false, $code);
        die(json_encode($data));
    }

    protected function isLegit($get)
    {
        if (! isset($get['password'])) {
            return false;
        }

        // var_dump($get);
        $expected = getenv('PASSWORD');
        $actual = $get['password'];

        return $expected == $actual;
    }

    protected function sendCredentials()
    {
        $data = [
            'key' => getenv('API_KEY'),
            'token' => getenv('API_TOKEN'),
            ];

        $this->respond($data);
    }
}
