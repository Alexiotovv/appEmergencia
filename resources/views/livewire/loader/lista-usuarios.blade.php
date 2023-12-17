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
    <div class="row">
        <div class="col-sm-4">
            Buscar usuario por nombre
            <div class="input-group">
                <input type="text" class="form-control form-control-sm" wire:model="userNameFind">
                <button class="btn btn-primary btn-sm" wire:click="buscarPorNombre"><i class="bx bx-search"></i>Buscar</button>
            </div>
        </div>
    </div>
    @if($sectionList)
        <h5>Lista Usuarios</h5>
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover" id="DTUsuarios">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Acción</th>
                                <th>nombre_usuario</th>
                                <th>correo</th>
                                <th>tipo</th>
                                <th>status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($listUsers as $usu)
                                <tr>
                                    <td>{{ $usu->id }}</td>
                                    <td><a href="#" wire:click.prevent="sectionEditUserById({{ $usu->id }})" class="btn btn-warning btn-sm">Editar</a>
                                    <a class="btn btn-danger btn-sm btnCambiarClave" href="#" wire:click.prevent="sectionEditPassUserById({{ $usu->id }})">Cambiar Contraseña</a>
                                    </td>
                                    <td>{{ $usu->name }}</td>
                                    <td>{{ $usu->email }}</td>
                                    <td>{{ $usu->tipo }}</td>
                                    <td>
                                        @if ($usu->status=='1')
                                            <p style="color: green;">ACTIVO</p>
                                        @else
                                            <p style="color: rgb(201, 21, 21)">INACTIVO</p>
                                        @endif
                                        
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $listUsers->links() }}
                </div>

            </div>
        </div>
    @endif

    @if ($sectionEditPass)
        <div class="d-flex justify-content-left align-items-center">
            <h5>Editar Contraseña</h5>
            <div class="mr-3 p-2 cursor-pointer rounded">
                <a href="#" wire:click.prevent="backList" class="btn btn-warning btn-sm"><i class="lni lni-arrow-left-circle"></i> Volver</a>
            </div>
        </div>
        <form wire:submit.prevent="updatePassByUser">
            <div class="row">
                <div class="col-md-4">
                    <label for="name">Nombre de usuario</label>
                    <input type="text" class="form-control" maxlength="200" wire:model="name" readonly>
                </div>
                <div class="col-md-4">
                    <label for="email">Contraseña</label>
                    <input type="text" class="form-control" maxlength="200" wire:model="password" required>

                </div>
                <div class="col-md-4">
                    <label for="tipo">Nueva Contraseña</label>
                    <input type="text" class="form-control" maxlength="200" wire:model="newPassword" required>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <br>
                    <button type="submit" class="btn btn-danger">Guardar</button>
                </div>
            </div>
            <input type="text" class="form-control" name="id" wire:model="idUser" readonly hidden>

        </form>    
    @endif

    @if ($sectionEditUser)
        <div class="d-flex justify-content-left align-items-center">
            <h5>Editar Trabajador</h5>
            <div class="mr-3 p-2 cursor-pointer rounded">
                <a href="#" wire:click.prevent="backList" class="btn btn-warning btn-sm"><i class="lni lni-arrow-left-circle"></i> Volver</a>
            </div>
        </div>
    
        <form wire:submit.prevent="updateDataByUser">
            <div class="row">
                <input type="text" class="form-control" name="id" wire:model="idUser" readonly hidden>
        
                <div class="col-md-4">
                    <label for="email">Correo</label>
                    <input type="text" class="form-control" wire:model.lazy="email" maxlength="100" required>
                    @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
        
                <div class="col-md-4">
                    <label for="name">Nombre de usuario</label>
                    <input type="text" class="form-control" wire:model.lazy="name"  maxlength="200" required>
                    @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
        
                <div class="col-md-4">
                    <label for="tipo">Tipo</label>
                    <select wire:model.lazy="tipo" class="form-select">
                        <option value="admin">ADMIN</option>
                        <option value="public">PUBLICO</option>
                    </select>
                    @error('tipo') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
        
                <div class="col-md-4">
                    <label for="status">Estado</label>
                    <select wire:model.lazy="status" class="form-select">
                        <option value="1">ACTIVO</option>
                        <option value="0">INACTIVO</option>
                    </select>
                    @error('status') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
            </div>
        
            <div class="row">
                <div class="col-md-4">
                    <br>
                    <button type="submit" class="btn btn-danger">Guardar</button>
                </div>
            </div>
        </form>    
    @endif
</div>
@script
    <script>
        Livewire.on('NotFindUser', (data) => {
            Swal.fire({
                position: "top-end",
                icon: "error",
                title: "No se ha encontrado ningun usuario.",
                showConfirmButton: false,
                timer: 1500,
            });
        });

        Livewire.on('PassNotSame', (data) => {
            Swal.fire({
                position: "top-end",
                icon: "error",
                title: "Las contraseñas no son iguales.",
                showConfirmButton: false,
                timer: 1500,
            }); 
        });

        Livewire.on( 'ValidationError', (data) => {
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
@endscript