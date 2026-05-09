<form action="{{ route('productos.store') }}" method="POST" enctype="multipart/form-data" style="margin-top: 20px;">
    @csrf

    <div>
        <label>Nombre del producto:</label><br>
        <input type="text" name="nombre" required>
    </div><br>

    <!-- Campos de nombre, precio, etc. -->

    <div class="form-group">
        <label>Imágenes del Producto</label>
        <input type="file" name="imagenes[]" multiple class="form-control" accept="image/*">
        <small>Puedes seleccionar varias fotos a la vez.</small>
    </div>

    <div>
        <label>Categoría:</label><br>
        <select name="id_categoria" required>
            <option value="">Selecciona una categoría</option>
            @foreach($categorias as $cat)
                <option value="{{ $cat->id_categoria }}">{{ $cat->nombre }}</option>
            @endforeach
        </select>
    </div><br>

    <div>
        <label>Descripción:</label><br>
        <textarea name="descripcion" rows="3"></textarea>
    </div><br>

    <div>
        <label>Stock:</label><br>
        <input type="number" name="stock" value="0" required>
    </div><br>

    <div>
        <label>Precio:</label><br>
        <input type="number" step="0.01" name="precio" required>
    </div><br>

    <button type="submit">Guardar Producto</button>
</form>
