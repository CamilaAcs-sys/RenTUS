<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class PropertyController extends Controller
{
    private function baseUrl(): string
{
    $url = rtrim(config('api.base_url') ?? env('URL_SERVER_API'), '/');

    if (empty($url)) {
        throw new \Exception('La variable URL_SERVER_API no está configurada.');
    }

    // Si la URL no termina con /api, la agregamos
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
            return []; // <-- Devolvemos array vacío en lugar de abortar
        }

        $json = $response->json();

        // Si el body es nulo o vacío, devolvemos un array vacío
        return $json ?: [];
    } catch (\Throwable $e) {
        Log::error("Excepción al conectar con API: {$url}", ['error' => $e->getMessage()]);
        return []; // <-- Evita abort(500) para no romper vistas que usan foreach
    }
}


    public function index()
    {
        $apiUrl = $this->baseUrl();
        return view('home.index', compact('apiUrl'));
    }

    public function show($id)
    {
        $property = $this->fetchData("/properties/{$id}");
        return view('properties.show', compact('property'));
    }

    public function create()
{
    // Obtenemos usuarios desde el backend
    $users = $this->fetchData('/users');

    // Normalizamos respuesta (por si viene paginada o no)
    if (isset($users['data'])) {
        $users = $users['data'];
    } elseif (!is_array($users)) {
        $users = [];
    }

    // Retornamos la vista con los usuarios disponibles
    return view('properties.create', compact('users'));
}


    public function store(Request $request)
    {
        try {
            $data = $request->only([
                'title', 'city', 'address', 'monthly_price', 'num_bedrooms',
                'num_bathrooms', 'area_m2', 'status', 'included_services',
                'description', 'image_url', 'publication_date', 'user_id',
            ]);

            $response = Http::withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json'
            ])->post($this->baseUrl() . '/properties', $data);

            if (!$response->successful()) {
                return back()->withErrors([
                    'message' => 'Error en la API al crear propiedad',
                    'detalle' => $response->json() ?? $response->body()
                ])->withInput();
            }

            return redirect()->route('properties.index')->with('success', 'Propiedad creada correctamente');
        } catch (\Exception $e) {
            return back()->withErrors([
                'message' => 'Excepción al conectar con la API',
                'detalle' => $e->getMessage()
            ])->withInput();
        }
    }

    public function edit($id)
    {
        $propertyResponse = Http::get($this->baseUrl() . "/properties/{$id}");
        $usersResponse = Http::get($this->baseUrl() . "/users");

        if (!$propertyResponse->successful() || !$usersResponse->successful()) {
            abort(500, 'Error al obtener datos de la API');
        }

        $property = $propertyResponse->json();
        $users = $usersResponse->json();

        return view('properties.edit', compact('property', 'users'));
    }

    public function update(Request $request, $id)
    {
        $response = Http::put($this->baseUrl() . "/properties/{$id}", $request->all());

        if (!$response->successful()) {
            return back()->withErrors(['message' => 'Error al actualizar propiedad']);
        }

        return redirect()->route('properties.index')->with('success', 'Propiedad actualizada correctamente');
    }

    public function destroy($id)
    {
        $response = Http::delete($this->baseUrl() . "/properties/{$id}");

        if (!$response->successful()) {
            return back()->withErrors(['message' => 'Error al eliminar propiedad']);
        }

        return redirect()->route('properties.index')->with('success', 'Propiedad eliminada correctamente');
    }
}
