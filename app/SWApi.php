<?php
namespace App;

use Illuminate\Support\Facades\Http;

class SWApi
{
    public const API_URL = "https://swapi.dev/api/";

    public function get(string $url, $params = array()) : ?array
    {
        $response = Http::withOptions(['verify' => false])
            ->get(self::API_URL . $url, $params);

        return $response->json();
    }
}