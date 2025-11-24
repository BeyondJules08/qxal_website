<nav class="navbar navbar-expand-lg navbar-light bg-white fixed-top shadow-sm">
    <div class="container">

        <a class="navbar-brand" href="{{ url('/') }}">
            <i class="fas fa-graduation-cap me-2"></i>Qxal Academy
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home') }}" wire:navigate>Inicio</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('features') }}" wire:navigate>Características</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('about') }}" wire:navigate>Acerca de</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('contact') }}" wire:navigate>Contacto</a>
                </li>

                <li class="nav-item">
                    <a class="btn btn-primary ms-2" href="#download">¡Juega Ahora!</a>
                </li>

            </ul>
        </div>
    </div>
</nav>