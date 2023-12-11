<div>
    <h5>Bienvenido</h5>
    <div class="row">
        <div class="col-sm-6">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-4">
                            <p>Año</p>
                            <select wire:model="anoSeleccionado" wire:change="cargarDatosEstadisticos"   class="form-select form-select-sm">
                                @foreach ($years as $y)
                                    <option value="{{ $y->year }}">{{ $y->year }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div id="meses" >
                        <div id="loading" class="spinner-border text-primary"  style="display:none" role="status"> <span class="visually-hidden">Loading...</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="card radius-10">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <p class="mb-0">Total Usuarios Registrados</p>
                            <h5 class="mb-0">{{ $total_users }}</h5>
                        </div>
                        <div class="dropdown ms-auto">
                            <a class="dropdown-toggle dropdown-toggle-nocaret" href="#" data-bs-toggle="dropdown">
                                <i class='bx bx-dots-horizontal-rounded font-22 text-dark'></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card radius-10">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <p class="mb-0">Total Usuarios Activos</p>
                            <h5 class="mb-0">{{ $activos_users }}</h5>
                        </div>
                        <div class="dropdown ms-auto">
                            <a class="dropdown-toggle dropdown-toggle-nocaret" href="#" data-bs-toggle="dropdown">
                                <i class='bx bx-dots-horizontal-rounded font-22 text-dark'></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card radius-10">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <p class="mb-0">Total SOS a la fecha</p>
                            <h5 class="mb-0">{{ $total_sos }}</h5>
                        </div>
                        <div class="dropdown ms-auto">
                            <a class="dropdown-toggle dropdown-toggle-nocaret" href="#" data-bs-toggle="dropdown">
                                <i class='bx bx-dots-horizontal-rounded font-22 text-dark'></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

@push('scripts')
    <script>
        Livewire.on('datosEstadisticosActualizados',(data) => {
            initChart(data.datos);
        });

        function initChart(datosEstadisticos){
            if (window.chart) {
                window.chart.destroy();
            }
            var cat = [];
            var poli = [];
            var bom = [];
            var amb = [];
            datosEstadisticos.forEach(element => {
                cat.push(element.nombre);
                poli.push(element.cant_policia);
                bom.push(element.cant_bombero);
                amb.push(element.cant_ambulancia);
            });

            var options = {
                series: [{
                    name: 'Policia',
                    data: poli
                }, {
                    name: 'Bombero',
                    data: bom
                }, {
                    name: 'Ambulancia',
                    data: amb
                }],
                chart: {
                    type: 'bar',
                    height: 350
                },
                plotOptions: {
                    bar: {
                        horizontal: false,
                        columnWidth: '55%',
                        endingShape: 'rounded'
                    },
                },
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    show: true,
                    width: 2,
                    colors: ['transparent']
                },
                xaxis: {
                    categories: cat,
                },
                yaxis: {
                    title: {
                        text: 'Incidencias'
                    }
                },
                fill: {
                    opacity: 1
                },
                tooltip: {
                    y: {
                        formatter: function(val) {
                            if (val > 1) {
                                palabra = " Incidencias"
                            } else {
                                palabra = " Incidencia"
                            }
                            return val + palabra
                        }
                    }
                }
            };
            window.chart = new ApexCharts(document.querySelector("#meses"), options);
            window.chart.render();
        }
    </script>
@endpush