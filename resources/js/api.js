// resources/js/api/api.js

const API_URL = 'http://api.backrentus/api';

/**
 * Función genérica para todas las peticiones a la API
 */
export async function apiFetch(endpoint, options = {}) {
  try {
    const res = await fetch(`${API_URL}/${endpoint}`, {
      headers: {
        'Content-Type': 'application/json',
        Accept: 'application/json',
      },
      ...options,
    });

    if (!res.ok) {
      const errText = await res.text();
      throw new Error(`Error ${res.status}: ${errText}`);
    }

    return await res.json();
  } catch (error) {
    console.error(`❌ Error en ${endpoint}:`, error.message);
    return null;
  }
}
