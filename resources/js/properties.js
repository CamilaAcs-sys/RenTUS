import { apiFetch } from './api.js';

export async function getProperties() {
  return await apiFetch('properties');
}

export async function getProperty(id) {
  return await apiFetch(`properties/${id}`);
}

export async function createProperty(data) {
  return await apiFetch('properties', {
    method: 'POST',
    body: JSON.stringify(data),
  });
}
