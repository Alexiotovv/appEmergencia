<div>
    <div class="page-wrapper">
        <div class="page-content">
            @switch($pageCurrent)
                @case('home')
                    @livewire('loader.dashboard')
                    @break
                @case('listar')
                    @livewire('loader.lista-usuarios')
                    @break
                @default
                    @livewire('loader.dashboard')
            @endswitch
        </div>
    </div>
</div>
