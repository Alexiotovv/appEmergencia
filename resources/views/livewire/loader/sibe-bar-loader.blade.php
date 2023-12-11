<div>
    <div class="page-wrapper">
        <div class="page-content">
            @switch($pageCurrent)
                @case('dashboard')
                    @livewire('loader.dashboard')
                    @break
                @case('lista-usuarios')
                    @livewire('loader.lista-usuarios')
                    @break
                @case('registrar-usuarios')
                    @livewire('loader.registrar-usuarios')
                @break
                @default
                    @livewire('loader.dashboard')
            @endswitch
        </div>
    </div>
</div>
