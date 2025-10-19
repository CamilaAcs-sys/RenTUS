<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PropertyController extends Controller
{
    private function baseUrl()
    {
        return env('URL_SERVER_API');
    }

    private function fetchData($endpoint)
    {
        $response = Http::get($this->baseUrl() . $endpoint);

        if (!$response->successful()) {
            abort(500, 'Error al consumir la API');
        }

        return $response->json();
    }

    public function index()
    {
        return view('home.index');
    }

    public function show($id)
    {
        $property = $this->fetchData('/properties/' . $id);
        return view('properties.show', compact('property'));
    }

    public function create()
    {
        $users = $this->fetchData('/users');
        return view('properties.create', compact('users'));
    }

public function store(Request $request)
{
    try {
        $data = $request->only([
            'title',
            'city',
            'address',
            'monthly_price',
            'num_bedrooms',
            'num_bathrooms',
            'area_m2',
            'status',
            'included_services',
            'description',
            'image_url',
            'publication_date',
            'user_id',
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
        $response = Http::put($this->baseUrl() . "/properties/$id", $request->all());

        if (!$response->successful()) {
            return back()->withErrors(['message' => 'Error al actualizar propiedad']);
        }

        return redirect()->route('properties.index')->with('success', 'Propiedad actualizada correctamente');
    }

    public function destroy($id)
    {
        $response = Http::delete($this->baseUrl() . "/properties/$id");

        if (!$response->successful()) {
            return back()->withErrors(['message' => 'Error al eliminar propiedad']);
        }

        return redirect()->route('properties.index')->with('success', 'Propiedad eliminada correctamente');
    }
}