<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class PropertyController extends Controller
{
    /** =====================================
     *  BASE URL API
     *  ===================================== */
    private function baseUrl(): string
    {
        $url = rtrim(env('URL_SERVER_API', ''), '/');
        if (empty($url)) {
            throw new \Exception('La variable URL_SERVER_API no está configurada en el archivo .env');
        }

        // Asegura que termine en /api
        return str_ends_with($url, '/api') ? $url : "{$url}/api";
    }

    /** =====================================
     *  FETCH GENÉRICO CON MANEJO DE ERRORES
     *  ===================================== */
    private function fetchData(string $endpoint, int $timeout = 10): array
    {
        $url = $this->baseUrl() . $endpoint;

        try {
            $response = Http::timeout($timeout)->get($url);

            if ($response->failed()) {
                Log::error("❌ Error al consumir API [GET {$url}]", [
                    'status' => $response->status(),
                    'body'   => $response->body(),
                ]);
                return [];
            }

            return $response->json() ?? [];
        } catch (\Throwable $e) {
            Log::error("💥 Excepción al conectar con la API [{$url}]", [
                'error' => $e->getMessage(),
            ]);
            return [];
        }
    }

    /** =====================================
     *  HOME
     *  ===================================== */
    public function home()
    {
        $apiUrl = rtrim(env('URL_SERVER_API', 'http://api.backrentus'), '/');
        $properties = $this->fetchData('/properties');
        $limited = array_slice($properties, 0, 9);

        return view('home.index', [
            'properties' => $limited,
            'apiUrl'     => $apiUrl,
        ]);
    }

    /** =====================================
     *  INDEX - Listado completo
     *  ===================================== */
    public function index()
    {
        $properties = $this->fetchData('/properties');
        return view('properties.index', compact('properties'));
    }

    /** =====================================
     *  SHOW - Ver detalle
     *  ===================================== */
    public function show($id)
    {
        $property = $this->fetchData("/properties/{$id}");
        if (empty($property)) {
            abort(404, 'Propiedad no encontrada.');
        }

        return view('properties.show', compact('property'));
    }

    /** =====================================
     *  CREATE - Formulario
     *  ===================================== */
    public function create()
    {
        $users  = $this->fetchData('/users');
        $apiUrl = rtrim(env('URL_SERVER_API', 'http://api.backrentus'), '/');

        return view('properties.create', compact('users', 'apiUrl'));
    }

    /** =====================================
     *  STORE - Guardar nueva
     *  ===================================== */
    public function store(Request $request)
    {
        $response = Http::post($this->baseUrl() . '/properties', $request->all());

        if (! $response->successful()) {
            Log::warning('⚠️ Error al crear propiedad', ['body' => $response->body()]);
            return back()->withErrors(['message' => 'Error al crear la propiedad.']);
        }

        return redirect()->route('properties.index')
            ->with('success', 'Propiedad creada correctamente.');
    }

    /** =====================================
     *  EDITAR - Formulario
     *  ===================================== */
    public function edit($id)
    {
        $property = $this->fetchData("/properties/{$id}");
        $users    = $this->fetchData('/users');

        if (empty($property)) {
            abort(404, 'Propiedad no encontrada.');
        }

        return view('properties.edit', compact('property', 'users'));
    }

    /** =====================================
     *  UPDATE - Actualizar
     *  ===================================== */
    public function update(Request $request, $id)
    {
        $response = Http::put($this->baseUrl() . "/properties/{$id}", $request->all());

        if (! $response->successful()) {
            Log::warning('⚠️ Error al actualizar propiedad', [
                'id'   => $id,
                'body' => $response->body(),
            ]);
            return back()->withErrors(['message' => 'Error al actualizar la propiedad.']);
        }

        return redirect()->route('properties.index')
            ->with('success', 'Propiedad actualizada correctamente.');
    }

    /** =====================================
     *  DELETE - Eliminar
     *  ===================================== */
    public function destroy($id)
    {
        $response = Http::delete($this->baseUrl() . "/properties/{$id}");

        if (! $response->successful()) {
            Log::warning('⚠️ Error al eliminar propiedad', [
                'id'   => $id,
                'body' => $response->body(),
            ]);
            return back()->withErrors(['message' => 'Error al eliminar la propiedad.']);
        }

        return redirect()->route('properties.index')
            ->with('success', 'Propiedad eliminada correctamente.');
    }
}
