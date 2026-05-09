<hr class="my-8">

<h1>Editar Producto: {{ $producto->nombre }}</h1>

<form action="{{ route('productos.update', $producto->id_producto) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div>
        <label>Nombre:</label><br>
        <input type="text" name="nombre" value="{{ $producto->nombre }}" required>
    </div><br>

    <div>
        <label>Categoría:</label><br>
        <select name="id_categoria" required>
            @foreach($categorias as $cat)
                <option value="{{ $cat->id_categoria }}" {{ $cat->id_categoria == $producto->id_categoria ? 'selected' : '' }}>
                    {{ $cat->nombre }}
                </option>
            @endforeach
        </select>
    </div><br>

    <div>
        <label>Descripción:</label><br>
        <textarea name="descripcion" rows="3">{{ $producto->descripcion }}</textarea>
    </div><br>

    <div>
        <label>Stock:</label><br>
        <input type="number" name="stock" value="{{ $producto->stock }}" required>
    </div><br>

    <div>
        <label>Precio:</label><br>
        <input type="number" step="0.01" name="precio" value="{{ $producto->precio }}" required>
    </div><br>

    <div class="mt-4 bg-gray-800 p-4 rounded">
        <label class="text-white">Añadir nuevas imágenes:</label>
        <input type="file" name="imagenes[]" multiple class="form-control text-white">
    </div><br>

    <button type="submit">Actualizar Producto</button>
    <a href="{{ route('productos.index') }}">Cancelar</a>
</form>

<hr>

{{-- 2. SECCIÓN PARA VER Y BORRAR FOTOS EXISTENTES (FUERA DEL FORM DE ARRIBA) --}}
<h3 class="text-white">Imágenes actuales:</h3>
<div class="grid grid-cols-3 gap-4">
    @foreach ($producto->imagenes as $img)
        <div class="relative">
            <img src="{{ asset('storage/' . $img->rutaImagen) }}" class="w-full h-32 object-cover rounded">

            {{-- FORMULARIO INDEPENDIENTE PARA BORRAR CADA FOTO --}}
            <form action="{{ route('productos.imagen.destroy', $img->id_imagen) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="absolute top-0 right-0 bg-red-600 text-white rounded-full p-1">
                    X
                </button>
            </form>
        </div>
    @endforeach
</div>
