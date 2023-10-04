@extends('bases.base')
@section('content')
<h5>Bienvenido</h5>
<div class="row">
    <div class="card">
        <div class="card-body">
            <a href="{{route('sos.index')}}" class="btn btn-danger" style="width: 250px; height:250px; font-size:30px; margin:50px">
                SOS
            </a>
            
            <a class="btn btn-warning" style="width: 250px; height:250px; font-size:30px; margin:50px">
                ESTADISTICAS
            </a>

        </div>
    </div>
    
</div>    

    
@endsection
