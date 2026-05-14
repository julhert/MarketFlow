<?php

namespace App\Services;

use App\Models\Producto;
use App\Models\ImagenProducto;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProductoService
{
    public function guardarProducto(array $datos, $archivoPortada, array $galeria = [])
    {
        try {
            return \DB::transaction(function () use ($datos, $archivoPortada, $galeria) {
                // 1. Crear el producto primero
                $producto = Producto::create($datos);

                // 2. Si hay una imagen, la guardamos en la tabla de IMAGENES
                if ($archivoPortada) {
                    $rutaPortada = $archivoPortada->store('productos', 'public');
                    ImagenProducto::create([
                        'id_producto' => $producto->id_producto,
                        'rutaImagen'        => $rutaPortada,
                        'portada'     => 1, // marcamos esta imagen como portada
                    ]);
                }

                // 3. Guardar la Galería (portada = 0)
                foreach ($galeria as $foto) {
                    $rutaFoto = $foto->store('productos', 'public');
                    ImagenProducto::create([
                        'id_producto' => $producto->id_producto,
                        'rutaImagen'        => $rutaFoto,
                        'portada'     => 0
                    ]);
                }

                return $producto;
            });
        } catch (\Exception $e) {
            \Log::error("Error al crear producto con portada: " . $e->getMessage());
            throw $e;
        }
    }

    public function actualizarProducto($id_producto, array $datos, $archivoPortada = null, array $galeria = [])
    {
        try {
            return \DB::transaction(function () use ($id_producto, $datos, $archivoPortada, $galeria) {
                
                // 1. Buscamos el producto y actualizamos sus datos (nombre, precio, etc.)
                $producto = Producto::findOrFail($id_producto);
                $producto->update($datos);

                // 2. Si el usuario subió una NUEVA portada
                if ($archivoPortada) {
                    // Buscamos si tenía una portada vieja en la BD
                    $portadaAnterior = ImagenProducto::where('id_producto', $producto->id_producto)
                                                    ->where('portada', 1)
                                                    ->first();
                    
                    if ($portadaAnterior) {
                        // Borramos el archivo físico de Fedora/Storage y el registro de la BD
                        Storage::disk('public')->delete($portadaAnterior->rutaImagen);
                        $portadaAnterior->delete();
                    }

                    // Guardamos la nueva
                    $rutaPortada = $archivoPortada->store('productos', 'public');
                    ImagenProducto::create([
                        'id_producto' => $producto->id_producto,
                        'rutaImagen'  => $rutaPortada,
                        'portada'     => 1,
                    ]);
                }

                // 3. Si el usuario subió NUEVAS fotos a la galería
                // (Ojo: esto no borra las anteriores, solo agrega nuevas. 
                // La eliminación individual ya la tienes en tu método deleteImage)
                if (!empty($galeria)) {
                    foreach ($galeria as $foto) {
                        $rutaFoto = $foto->store('productos', 'public');
                        ImagenProducto::create([
                            'id_producto' => $producto->id_producto,
                            'rutaImagen'  => $rutaFoto,
                            'portada'     => 0
                        ]);
                    }
                }

                return $producto;
            });
        } catch (\Exception $e) {
            \Log::error("Error al actualizar producto: " . $e->getMessage());
            throw $e;
        }
    }


    public function eliminarProducto(Producto $producto)
    {
        // Borramos las imágenes del storage antes de eliminar el producto
        foreach ($producto->imagenes as $imagen) {
            Storage::disk('public')->delete($imagen->rutaImagen);
        }
        return $producto->delete();
    }

    // Para la ruta de borrar foto (aun pendiente)
    public function deleteImage(ImagenProducto $imagen)
    {
        // 1. Borramos el archivo físico del storage
        Storage::disk('public')->delete($imagen->rutaImagen);

        // 2. Borramos el registro de la DB
        return $imagen->delete();
    }

    // Para la ruta de guardar foto individual (aun pendiente)
    public function addImage(Producto $producto, $foto)
    {
        $path = $foto->store('productos', 'public');

        return $producto->imagenes()->create([
            'rutaImagen' => $path,
            'portada' => !$producto->imagenes()->where('portada', true)->exists()
        ]);
    }
}
