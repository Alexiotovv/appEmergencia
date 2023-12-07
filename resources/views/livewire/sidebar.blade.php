
<div class="sidebar-wrapper" data-simplebar="true">
    <div class="sidebar-header">
        <div>
            <img src="{{ asset('assets//images/pnp.png')}}" class="logo-icon" alt="logo icon">
        </div>
        <div>
            <h4 class="logo-text">Seguridad</h4>
        </div>
        <div class="toggle-icon ms-auto"><i class='bx bx-arrow-to-left'></i>
        </div>
    </div>
    {{--navigation--}}
    <ul class="metismenu" id="menu">
        <li>
            <a href="javascript:void(0)" class="has-arrow">
                <div class="parent-icon"><i class="bx bx-category"></i>
                </div>
                <div class="menu-title">Control</div>
            </a>
            <ul>
                <li> <a href="#" wire:click.prevent="loadPage('dashboard')"><i class="bx bx-right-arrow-alt"></i>Dashboard</a>
                </li>
                <li> <a href="#" wire:click.prevent="loadPage('sos')"><i class="bx bx-right-arrow-alt"></i>SOS</a>
                </li>
            </ul>
        </li>

        <li class="menu-label">Admin</li>
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="lni lni-users"></i>
                </div>
                <div class="menu-title">Usuarios</div>
            </a>
            <ul>
                <li> <a href="#" wire:click.prevent="loadPage('listar')"><i class="bx bx-right-arrow-alt"></i>Listar</a>
                </li>
                <li> <a href="#" wire:click.prevent="loadPage('registrar')"><i class="bx bx-right-arrow-alt"></i>Registrar</a>
                </li>
            </ul>
        </li>
    </ul>
    {{--end navigation--}}
</div>
{{--end sidebar wrapper --}}