<form action="{{ route('auxiliar.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <!-- Campos para nombre, identificación, programa académico, etc. -->
    <div class="form-group">
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" class="form-control" required>
    </div>

    <div class="form-group">
        <label for="programa_academico_id">Programa Académico:</label>
        <select name="programa_academico_id" class="form-control" required>
            @foreach($programas as $programa)
                <option value="{{ $programa->id }}">{{ $programa->nombre }}</option>
            @endforeach
        </select>
    </div>

    <!-- Otros campos... -->

    <div class="form-group">
        <label for="acuerdo_vinculacion">Acuerdo de Vinculación (PDF):</label>
        <input type="file" name="acuerdo_vinculacion" class="form-control" required>
    </div>

    <button type="submit" class="btn btn-primary">Registrar Auxiliar</button>
</form>
