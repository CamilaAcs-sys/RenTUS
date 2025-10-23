import { apiFetch } from './api.js';

export async function getUsers() {
  return await apiFetch('users');
}

export async function getUser(id) {
  return await apiFetch(`users/${id}`);
}

export async function createUser(data) {
  return await apiFetch('users', {
    method: 'POST',
    body: JSON.stringify(data),
  });
}
