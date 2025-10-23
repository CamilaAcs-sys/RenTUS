<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    private function baseUrl(): string
    {
        $url = rtrim(env('URL_SERVER_API', 'http://api.backrentus'), '/');
        if (!str_ends_with($url, '/api')) {
            $url .= '/api';
        }
        return $url;
    }

    private function fetchData(string $endpoint)
    {
        $url = $this->baseUrl() . $endpoint;

        try {
            $response = Http::timeout(10)->get($url);

            if ($response->failed()) {
                Log::error("Error al consumir API: {$url}", [
                    'status' => $response->status(),
                    'body' => $response->body()
                ]);
                return [];
            }

            $json = $response->json();

            return $json ?: [];
        } catch (\Throwable $e) {
            Log::error("Excepción al conectar con API: {$url}", [
                'error' => $e->getMessage()
            ]);
            return [];
        }
    }

    public function create()
    {
        $response = $this->fetchData('/users');

        // Normalizamos la respuesta
        if (isset($response['data'])) {
            $users = $response['data']; // paginada
        } elseif (is_array($response)) {
            $users = $response; // directa
        } else {
            $users = [];
        }

        return view('properties.create', compact('users'));
    }
}
