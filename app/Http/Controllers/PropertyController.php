<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PropertyController extends Controller
{
    private function fetchDataFromApi($url)
    {
        $response = Http::get($url);
        return $response->json();
    }

    private function postDataToApi($url, $data)
    {
        $response = Http::post($url, $data);
        return $response->json();
    }

    private function putDataToApi($url, $data)
    {
        $response = Http::put($url, $data);
        return $response->json();
    }

    private function deleteFromApi($url)
    {
        $response = Http::delete($url);
        return $response->json();
    }

    public function index()
    {
        $url = env('URL_SERVER_API');
        $properties = $this->fetchDataFromApi($url . '/properties');
        return view('properties.index', compact('properties'));
    }

    public function create()
    {
        return view('properties.create');
    }

    public function store(Request $request)
    {
        $url = env('URL_SERVER_API') . '/properties';

        $data = $request->all(); // valídalo después

        $response = $this->postDataToApi($url, $data);

        return redirect()->route('properties')->with('success', 'Propiedad creada correctamente');
    }

    public function edit($id)
    {
        $url = env('URL_SERVER_API');
        $property = $this->fetchDataFromApi($url . "/properties/$id");

        return view('properties.edit', compact('property'));
    }

    public function update(Request $request, $id)
    {
        $url = env('URL_SERVER_API') . "/properties/$id";
        $data = $request->all();

        $response = $this->putDataToApi($url, $data);

        return redirect()->route('properties')->with('success', 'Propiedad actualizada correctamente');
    }


    public function destroy($id)
    {
        $url = env('URL_SERVER_API') . "/properties/$id";
        $this->deleteFromApi($url);

        return redirect()->route('properties')->with('success', 'Propiedad eliminada');
    }
}
