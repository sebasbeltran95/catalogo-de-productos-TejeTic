<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="description" content="">
        <meta name="author" content="Sebastian Beltran Zapata">
        <link rel="icon" href="{{ asset('img/logo.webp') }}" type="" />
        <title>@yield('title') - HomeElements</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        @livewireStyles
        @livewireScripts
        @stack('js')
    </head>
<body>
    <nav class="navbar navbar-expand-lg bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ url('/') }}"><img src="{{ asset('img/logo.webp') }}" width="15%" alt="User Icon" /></a>
            <button class="navbar-toggler bg-white" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{ url('/') }}" style="color: white;">Inicio</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="color: white;">
                        Categorias
                        </a>
                        @livewire('blog-categorias')
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('contactanos') }}" style="color: white;">Contactanos</a>
                    </li>
                    @if (Auth()->user())
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('posts') }}" style="color: white;">Dashboard</a>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}" style="color: white;">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}" style="color: white;">Register</a>
                        </li>
                    @endif
                </ul>
                {{--  <form class="d-flex" role="search">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>  --}}
            </div>
        </div>
    </nav>
    @yield('content') 
    {{--  <footer class="bg-dark text-white text-center py-4">
        <div class="container">
            <section class="mb-4">
                <a class="btn btn-outline-light btn-floating m-1" style="background-color: #3b5998;" href="#!" role="button">
                    <i class="fab fa-facebook-square"></i>
                </a>
                <a class="btn btn-outline-light btn-floating m-1" style="background-color: #55acee;" href="#!" role="button">
                    <i class="fab fa-twitter"></i>
                </a>
                <a class="btn btn-outline-light btn-floating m-1" style="background-color: #dd4b39;" href="#!" role="button">
                    <i class="fab fa-google"></i>
                </a>
                <a class="btn btn-outline-light btn-floating m-1" style="background-color: #ac2bac;" href="#!" role="button">
                    <i class="fab fa-instagram"></i>
                </a>
                <a class="btn btn-outline-light btn-floating m-1" style="background-color: #0082ca;" href="#!" role="button">
                    <i class="fab fa-linkedin-in"></i>
                </a>
                <a class="btn btn-outline-light btn-floating m-1" style="background-color: #333333;" href="#!" role="button">
                    <i class="fab fa-github"></i>
                </a>
            </section>
            <div class="text-center">
                <p>©{{date('Y')}} HomeElements. Todos los derechos reservados.</p>
            </div>
        </div>
    </footer>  --}}




    <footer class="text-center text-lg-start bg-body-tertiary text-muted">
        <section class="d-flex justify-content-center justify-content-lg-between p-4 border-bottom">
            <div class="me-5 d-none d-lg-block">
                <span>Conéctate con nosotros:</span>
            </div>
            
            <div>
                <a href="" class="me-4 text-reset">
                    <i class="fab fa-facebook-f"></i>
                </a>
                <a href="" class="me-4 text-reset">
                    <i class="fab fa-twitter"></i>
                </a>
                <a href="" class="me-4 text-reset">
                    <i class="fab fa-google"></i>
                </a>
                <a href="" class="me-4 text-reset">
                    <i class="fab fa-instagram"></i>
                </a>
                <a href="" class="me-4 text-reset">
                    <i class="fab fa-linkedin"></i>
                </a>
                <a href="" class="me-4 text-reset">
                    <i class="fab fa-github"></i>
                </a>
            </div>
        </section>
    
        <section class="">
            <div class="container text-center text-md-start mt-5">
                <div class="row mt-3">
                    <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
                        <h6 class="text-uppercase fw-bold mb-4">
                                <img src="{{ asset('img/logo.webp') }}" width="50%" alt="User Icon" />
                        </h6>
                    </div>
                    <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4">
                        <h6 class="text-uppercase fw-bold mb-4">
                            Nosotros
                        </h6>
                        <p>
                            <a href="{{ route('contactanos') }}" class="text-reset" style="text-decoration: none;">Contactanos</a>
                        </p>
                    </div>
        
                    <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">
                        <h6 class="text-uppercase fw-bold mb-4">
                            Servicios
                        </h6>
                        <p>
                            <a href="#!" class="text-reset">Pricing</a>
                        </p>
                        <p>
                            <a href="#!" class="text-reset">Settings</a>
                        </p>
                        <p>
                            <a href="#!" class="text-reset">Orders</a>
                        </p>
                        <p>
                            <a href="#!" class="text-reset">Help</a>
                        </p>
                    </div>
        
                    <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
                        <h6 class="text-uppercase fw-bold mb-4">Contactanos</h6>
                        <p><i class="fas fa-home me-3"></i> New York, NY 10012, US</p>
                        <p>
                            <i class="fas fa-envelope me-3"></i>
                            info@example.com
                        </p>
                        <p><i class="fas fa-phone me-3"></i> + 01 234 567 88</p>
                        <p><i class="fas fa-print me-3"></i> + 01 234 567 89</p>
                    </div>
                </div>
            </div>
        </section>
    
        <div class="text-center p-4" style="background-color: rgba(0, 0, 0, 0.05);">
            ©{{date('Y')}} HomeElements. Todos los derechos reservados.
        </div>
    </footer>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    @stack('js')
</body>
</html>