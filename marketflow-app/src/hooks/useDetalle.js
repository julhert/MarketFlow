import { useState, useEffect } from 'react';
import { getDetalle } from '../api/productos';

export const useDetalle = (id) => {
  const [producto, setProducto] = useState(null);
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState(null);

  useEffect(() => {
    getDetalle(id)
      .then(setProducto)
      .catch(err => setError(err.message))
      .finally(() => setLoading(false));
  }, [id]);

  return { producto, loading, error };
};