@extends('bases.base')

@section('content')
@if (session()->has('guardo')=='si')
{{-- comprueba si existe el valor en sesión --}}

    <div class="alert alert-success border-0 bg-success alert-dismissible fade show py-2">
        <div class="d-flex align-items-center">
            <div class="font-35 text-white"><i class='bx bxs-check-circle'></i>
            </div>
            <div class="ms-3">
                <h6 class="mb-0 text-white">Registro</h6>
                <div class="text-white">Actualizado correctamente!</div>
            </div>
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>

@endif
    <h5>Editar Trabajador</h5>
    <form action="{{route('usuarios.update')}}" method="POST">@csrf
        <div class="row">    
                <input type="text" class="form-control" name="id" value="{{$obj->id}}" readonly hidden>
            <div class="col-md-4">
                <label for="">correo</label>
                <input type="text" class="form-control" name="email" value="{{$obj->email}}" maxlength="50" required>
            </div>
            <div class="col-md-4">
                <label for="">nombre usuario</label>
                <input type="text" class="form-control" name="name" value="{{$obj->name}}" maxlength="100" required>
            </div>
            <div class="col-md-4">
                <label for="">tipo</label>
                <select name="tipo" class="form-select">
                    @if ($obj->tipo=='ADMIN')
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
                    @if ($obj->status=='1')
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

    </form>
@endsection
