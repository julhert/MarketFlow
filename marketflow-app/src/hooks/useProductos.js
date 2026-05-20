import { useState, useEffect } from 'react';
import { getProductos } from '../api/productos';

export const useProductos = () => {
  const [productos, setProductos] = useState([]);
  const [filtrados, setFiltrados] = useState([]);
  const [busqueda, setBusqueda] = useState('');
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState(null);

  useEffect(() => {
    getProductos()
      .then(data => {
        setProductos(data);
        setFiltrados(data);
      })
      .catch(err => setError(err.message))
      .finally(() => setLoading(false));
  }, []);

  useEffect(() => {
    if (busqueda.trim() === '') {
      setFiltrados(productos);
    } else {
      const texto = busqueda.toLowerCase();
      setFiltrados(productos.filter(p => p.nombre.toLowerCase().includes(texto)));
    }
  }, [busqueda, productos]);

  return { productos: filtrados, loading, error, busqueda, setBusqueda };
};