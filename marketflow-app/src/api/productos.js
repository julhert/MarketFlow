const API_URL = 'https://marketflowpelonesdev-production.up.railway.app/api';

export const getProductos = async () => {
  const res = await fetch(`${API_URL}/productos`);
  const json = await res.json();
  if (!json.success) throw new Error('Error al obtener productos');
  return json.data;
};

export const getDetalle = async (id) => {
  const res = await fetch(`${API_URL}/productos/${id}`);
  const json = await res.json();
  if (!json.success) throw new Error('Error al obtener el producto');
  return json.data;
};