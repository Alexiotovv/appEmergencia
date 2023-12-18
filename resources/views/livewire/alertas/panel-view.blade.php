<div>
    <div class="w3-sidebar w3-bar-block w3-collapse w3-card w3-animate-right p-0" style="width:30%;right:0;top:0px" id="PanelInfoSoS">
        <div class="row">
            <div class="col-md-8 bg-light">
                <div class="logo-text" style="color:rgb(17, 65, 225);">DETALLES DE SOS</div>
            </div>
            <div class="col-md-4 bg-light">
                <a href="#" wire:click.prevent="$dispatch('close')" class="btn btn-dark w-100">Atender</a>
            </div>
        </div>
    </div>    
</div>
@push('scripts')
<script>
    Livewire.on('close', (data) => {
        w3_close();
    });
    Livewire.on('open', (data) => {
        w3_open();
    });

    function w3_open() {
        document.getElementById("PanelInfoSoS").style.display = "block";
    }

    function w3_close() {
        document.getElementById("PanelInfoSoS").style.display = "none";
    }
</script>
@endpush
