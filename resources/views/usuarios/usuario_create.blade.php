@extends('bases.base')

@section('content')

    <h5>Registrar Trabajador</h5>
    <form action="{{route('usuarios.store')}}" method="POST">@csrf
        <div class="row">
            <div class="col-md-2">
                <label for="">Id</label>
                <input type="text" class="form-control" name="id" readonly style="background-color: rgb(223, 217, 217)">
            </div>
            <div class="col-md-3">
                <label for="">correo</label>
                <input type="email" class="form-control" name="email" id="email" maxlength="50" required>
                <p id="estadoemail" style="color: red;display:none">No Disponible</p> 
            </div>
            <div class="col-md-4">
                <label for="">nombre usuario</label>
                <input type="text" class="form-control" name="name" id="name" maxlength="100" required>
                <p id="estadousuario" style="color: red;display:none" >No disponible</p>
            </div>
            <div class="col-md-4">
                <label for="">tipo</label>
                <select name="tipo" id="" class="form-select">
                    <option value="ADMIN">ADMIN</option>
                    <option value="PUBLICO">PUBLICO</option>
                </select>
            </div>
            <div class="col-md-4">
                <label for="">estado</label>
                <select name="status" id="" class="form-select">
                    <option value="1" selected>ACTIVO</option>
                    <option value="0">INACTIVO</option>
                </select>
            </div>
            
            <div class="col-md-3">
                <label for="">contraseña</label>
                <input type="password" class="form-control" name="password" id="password" required>
            </div>
            
            <div class="row">
                <div class="col-md-4">
                    <br>
                    <button type="submit" class="btn btn-danger">Guardar</button>
                </div>  
            </div>
        </div>

    </form>
    
@endsection
@section('extra_js')
    <script src="../../../app_js/usuarios.js"></script>
@endsection
