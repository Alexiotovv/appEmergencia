<div>
        <h5>Editar Trabajador</h5>
        <div class="row">    
            <input type="text" class="form-control" name="id" value="{{$userData->id}}" readonly hidden>
        <div class="col-md-4">
            <label for="">correo</label>
            <input type="text" class="form-control" name="email" value="{{$userData->email}}" maxlength="50" required>
        </div>
        <div class="col-md-4">
            <label for="">nombre usuario</label>
            <input type="text" class="form-control" name="name" value="{{$userData->name}}" maxlength="100" required>
        </div>
        <div class="col-md-4">
            <label for="">tipo</label>
            <select name="tipo" class="form-select">
                @if ($userData->tipo=='ADMIN')
                    <option value="ADMIN" selected>ADMIN</option>
                    <option value="PUBLICO">PUBLICO</option>
                @else
                    <option value="PUBLICO" selected>PUBLICO</option>
                    <option value="ADMIN">ADMIN</option>
                @endif
            </select>
        </div>
        <div class="col-md-4">
            <label for="">estado</label>
            <select name="status" class="form-select">
                @if ($userData->status=='1')
                    <option value="1" selected>ACTIVO</option>
                    <option value="0">INACTIVO</option>
                @else
                    <option value="0" selected>INACTIVO</option>
                    <option value="1">ACTIVO</option>
                @endif
            </select>
        </div>
        
        <div class="row">
            <div class="col-md-4">
                <br>
                <button type="submit" class="btn btn-danger">Guardar</button>
            </div>  
        </div>
    </div>

</div>
