<div>
    @if ($currentPage == 'dashboard')
        @livewire('dashboard')
    @elseif ($currentPage == 'sos')
        @livewire('sos')
    @elseif ($currentPage == 'listar')
        @livewire('listar')
    @elseif ($currentPage == 'registrar')
        @livewire('listar')
    @endif
</div>