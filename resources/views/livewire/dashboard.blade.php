<div>
    @section('title', 'Dashbaord')
    <div class="container-fluid">
        <div class="row mt-5 mb-5">
            <div class="col-md-12">
                <h1 class="display-4 text-center">
                    Dashbaord
                </h1>
            </div>
        </div>
        <div class="row mb-5">
            {{--  <!-- Tarjeta 1 -->  --}}
            <div class="col-lg-3 col-6 mb-2">
                <div class="card bg-info">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <h3 class="text-white">{{ $this->prodcutos_año }}</h3>
                            <p class="text-white">Total productos por año {{date('Y')}}</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-address-card fa-3x"></i>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('productos') }}" class="btn btn-info w-100 text-white">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>
            {{--  <!-- Tarjeta 1 -->  --}}

            {{--  <!-- Tarjeta 2 -->  --}}
            <div class="col-lg-3 col-6 mb-2">
                <div class="card bg-success">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <h3 class="text-white">{{ $this->productos_mes }}</h3>
                            <p class="text-white">Total productos por mes {{date('m')}}</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-address-card fa-3x"></i>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('productos') }}" class="btn btn-success w-100 text-white">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>
            {{--  <!-- Tarjeta 2 -->  --}}

            {{--  <!-- Tarjeta 3 -->  --}}
            <div class="col-lg-3 col-6 mb-2">
                <div class="card bg-warning">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <h3 class="text-white">{{ $this->usuarios_registrados }}</h3>
                            <p class="text-white">Usuarios Registrados</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-users fa-3x"></i>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('usuarios') }}" class="btn btn-warning w-100 text-white">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>
            {{--  <!-- Tarjeta 3 -->  --}}

            {{--  <!-- Tarjeta 4 -->  --}}
            <div class="col-lg-3 col-6 mb-2">
                <div class="card bg-danger">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <h3 class="text-white">{{ $this->categorias }}</h3>
                            <p class="text-white">No Categorias</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-clipboard-list fa-3x"></i>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('categoria') }}" class="btn btn-danger w-100 text-white">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>
            {{--  <!-- Tarjeta 4 -->  --}}
        </div>



        <div class="row">
            <div class="col-md-12 d-flex justify-content-center" style="width: 100%; height: 400px;" wire:ignore>
                <canvas id="myChart"></canvas>
            </div>
            <div class="col-md-12 d-flex justify-content-center" style="width: 100%; height: 400px;" wire:ignore>
                <canvas id="myChart1"></canvas>
            </div>
            <div class="col-md-12 d-flex justify-content-center" style="width: 100%; height: 400px;" wire:ignore>
                <canvas id="myChart2"></canvas>
            </div>
            <div class="col-md-12 d-flex justify-content-center" style="width: 100%; height: 400px;" wire:ignore>
                <canvas id="myChart3"></canvas>
            </div>
        </div>
    </div>
    <style>
        /* El canvas ocupará el 100% del contenedor sin limitar el tamaño */
        #myChart, #myChart1, #myChart2  {
            width: 100% !important;  /* El canvas ocupará el 100% del contenedor */
            height: 70% !important; /* Ajusta la altura al 100% del contenedor */
        }
        #myChart3 {
            width: 70% !important;  /* El canvas ocupará el 100% del contenedor */
            height: 70% !important; /* Ajusta la altura al 100% del contenedor */
        }
    </style>
    <script>
        document.addEventListener('livewire:load', function () {
            const ctx = document.getElementById('myChart');
        
            // Pasar los datos de Livewire a JavaScript
            const postData = @json($produc); // Esto convierte la propiedad $post a un objeto JavaScript
        
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: postData.map(item => item.Meses),  // Los meses (por nombre)
                    datasets: [{
                        label: '# de Posts',
                        data: postData.map(item => item.Value),  // La cantidad de posts
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        });
        document.addEventListener('livewire:load', function () {
            const ctx = document.getElementById('myChart1');
        
            // Pasar los datos de Livewire a JavaScript
            const postData = @json($produc); // Esto convierte la propiedad $post a un objeto JavaScript
        
            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: postData.map(item => item.Meses),  // Los meses (por nombre)
                    datasets: [{
                        label: '# de Posts',
                        data: postData.map(item => item.Value),  // La cantidad de posts
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    interaction: {
                        // Overrides the global setting
                        mode: 'index'
                    }
                }
            });
        });
        document.addEventListener('livewire:load', function () {
            const ctx = document.getElementById('myChart2');
        
            // Pasar los datos de Livewire a JavaScript
            const postData = @json($produc); // Esto convierte la propiedad $post a un objeto JavaScript
        
            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: postData.map(item => item.Meses),  // Los meses (por nombre)
                    datasets: [{
                        label: '# de Posts',
                        data: postData.map(item => item.Value),  // La cantidad de posts
                        fill: false,
                        borderColor: 'rgb(75, 192, 192)',
                    }]
                },
                options: {
                    animations: {
                        tension: {
                          duration: 1000,
                          easing: 'linear',
                          from: 1,
                          to: 0,
                          loop: true
                        }
                    },
                    scales: {
                        y: { // defining min and max so hiding the dataset does not change scale range
                          min: 0,
                          max: 100
                        }
                     }
                }
            });
        });
        document.addEventListener('livewire:load', function () {
            const ctx = document.getElementById('myChart3');
        
            // Pasar los datos de Livewire a JavaScript
            const postData = @json($produc); // Esto convierte la propiedad $post a un objeto JavaScript
        
            new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: postData.map(item => item.Meses),  // Los meses (por nombre)
                    datasets: [{
                        label: '# de Posts',
                        data: postData.map(item => item.Value),  // La cantidad de posts
                        backgroundColor: [
                        'rgb(255, 99, 132)',
                        'rgb(54, 162, 235)',
                        'rgb(255, 205, 86)'
                        ],
                        hoverOffset: 4
                    }]
                }
            });
        });
    </script>
</div>
