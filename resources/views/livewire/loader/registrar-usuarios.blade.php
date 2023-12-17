<div>
    @if ($statusSave)
        <div class="alert alert-success border-0 bg-success alert-dismissible fade show py-2">
            <div class="d-flex align-items-center">
                <div class="font-35 text-white"><i class='bx bxs-check-circle'></i>
                </div>
                <div class="ms-3">
                    <h6 class="mb-0 text-white">Registro</h6>
                    <div class="text-white">Guardado correctamente!</div>
                </div>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" wire:click="setSaveStatus(false)"></button>
        </div>
    @endif
    <h5>Registrar Trabajador</h5>
    <form wire:submit.prevent="saveNewUser">
        <div class="row">
            <div class="col-md-3">
                <label for="email">correo</label>
                <input type="email" class="form-control" name="email" id="email" maxlength="255" wire:model.lazy ="email" required> 
            </div>
            <div class="col-md-4">
                <label for="name">nombre usuario</label>
                <input type="text" class="form-control" name="name" id="name" maxlength="255"  wire:model.lazy ="name" required>
            </div>
            <div class="col-md-4">
                <label for="tipo">tipo</label>
                <select name="tipo"  class="form-select"  wire:model.lazy= "tipo" :init>
                    <option value="admin" selected>ADMIN</option>
                    <option value="public">PUBLICO</option>
                </select>
            </div>
            <div class="col-md-4">
                <label for="status">estado</label>
                <select name="status" class="form-select"  wire:model.lazy ="status" :init>
                    <option value="1" selected>ACTIVO</option>
                    <option value="0">INACTIVO</option>
                </select>
            </div>
            <div class="col-md-3">
                <label for="password">contraseña</label>
                <input type="password" class="form-control" name="password"  wire:model.lazy = "password" required>
            </div>
            
            <div class="row">
                <div class="col-md-4 mt-3">
                    <button type="submit" class="btn btn-danger">Guardar</button>
                </div>  
            </div>
        </div>
    </form>
</div>

@push('scripts')
<script>
    Livewire.on( 'ValidationErrorUser', (data) => {
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        })

        Toast.fire({
            icon: 'error',
            title: data.error
        })
    });
</script>
@endpush