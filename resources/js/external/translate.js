// resources/js/external/translate.js

export async function traducirTexto(texto, destino = 'en') {
  if (!texto) return texto;
  try {
    // Forzamos el idioma de origen "es" (español)
    const res = await fetch(
      `https://api.mymemory.translated.net/get?q=${encodeURIComponent(texto)}&langpair=es|${destino}`
    );

    const data = await res.json();

    if (!data || !data.responseData) {
      throw new Error('Respuesta inválida de MyMemory');
    }

    return data.responseData.translatedText ?? texto;
  } catch (error) {
    console.error('❌ Error traduciendo:', error);
    return texto; // fallback
  }
}
