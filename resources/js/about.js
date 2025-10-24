// resources/js/about.js
import { traducirTexto } from './external/translate.js';

async function traducirAbout(destino = 'en') {
  // Mostrar loader
  const loader = document.getElementById('loader');
  if (loader) loader.style.display = 'block';

  // Guardamos originales la primera vez para poder revertir
  if (!window._about_originals) {
    window._about_originals = {};

    window._about_originals.title = document.querySelector('h1')?.innerText ?? '';
    window._about_originals.lead = document.querySelector('.lead')?.innerText ?? '';
    window._about_originals.paragraphs = Array.from(document.querySelectorAll('.col-md-6 p.text-secondary'))
      .map(p => p.innerText);
    window._about_originals.listItems = Array.from(document.querySelectorAll('.list-group-item'))
      .map(li => li.innerText);
    window._about_originals.h3s = Array.from(document.querySelectorAll('.col-md-6 h3'))
      .map(h3 => h3.innerText);
    window._about_originals.mission = document.querySelectorAll('.col-md-6 h3')[0]?.nextElementSibling?.innerText ?? '';
    window._about_originals.vision = document.querySelectorAll('.col-md-6 h3')[1]?.nextElementSibling?.innerText ?? '';
  }

  // Traducimos elementos
  const h1 = document.querySelector('h1');
  if (h1) h1.innerText = await traducirTexto(window._about_originals.title, destino);

  const lead = document.querySelector('.lead');
  if (lead) lead.innerText = await traducirTexto(window._about_originals.lead, destino);

  const paras = document.querySelectorAll('.col-md-6 p.text-secondary');
  for (let i = 0; i < paras.length; i++) {
    const p = paras[i];
    const original = window._about_originals.paragraphs[i] ?? p.innerText;
    p.innerText = await traducirTexto(original, destino);
  }

  // 🔹 Traducir ítems de la lista
  const listItems = document.querySelectorAll('.list-group-item');
  for (let i = 0; i < listItems.length; i++) {
    const li = listItems[i];
    const original = window._about_originals.listItems[i] ?? li.innerText;
    li.innerText = await traducirTexto(original, destino);
  }

  // 🔹 Traducir títulos (Misión / Visión)
  const h3s = document.querySelectorAll('.col-md-6 h3');
  for (let i = 0; i < h3s.length; i++) {
    const h3 = h3s[i];
    const original = window._about_originals.h3s[i] ?? h3.innerText;
    h3.innerText = await traducirTexto(original, destino);
  }

  if (h3s[0]) {
    const node = h3s[0].nextElementSibling;
    if (node) node.innerText = await traducirTexto(window._about_originals.mission, destino);
  }
  if (h3s[1]) {
    const node = h3s[1].nextElementSibling;
    if (node) node.innerText = await traducirTexto(window._about_originals.vision, destino);
  }

  if (loader) loader.style.display = 'none';
}

function revertirAbout() {
  if (!window._about_originals) return;

  const h1 = document.querySelector('h1');
  if (h1) h1.innerText = window._about_originals.title;

  const lead = document.querySelector('.lead');
  if (lead) lead.innerText = window._about_originals.lead;

  const paras = document.querySelectorAll('.col-md-6 p.text-secondary');
  paras.forEach((p, i) => p.innerText = window._about_originals.paragraphs[i] ?? p.innerText);

  const listItems = document.querySelectorAll('.list-group-item');
  listItems.forEach((li, i) => li.innerText = window._about_originals.listItems[i] ?? li.innerText);

  const h3s = document.querySelectorAll('.col-md-6 h3');
  h3s.forEach((h3, i) => h3.innerText = window._about_originals.h3s[i] ?? h3.innerText);

  if (h3s[0]) {
    const node = h3s[0].nextElementSibling;
    if (node) node.innerText = window._about_originals.mission;
  }
  if (h3s[1]) {
    const node = h3s[1].nextElementSibling;
    if (node) node.innerText = window._about_originals.vision;
  }
}

// Exponer globalmente
window.traducirAbout = traducirAbout;
window.revertirAbout = revertirAbout;
