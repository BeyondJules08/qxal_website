<div>
    <h2 class="mb-4 fw-bold text-dark">Dashboard</h2>

    {{-- Stats Cards --}}
    <div class="row g-4 mb-5">
        <div class="col-md-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body d-flex align-items-center">
                    <div class="bg-primary bg-opacity-10 text-primary rounded-circle p-3 me-3">
                        <i class="fas fa-users fa-2x"></i>
                    </div>
                    <div>
                        <h6 class="text-muted mb-1">Personas beneficiadas</h6>
                        <h3 class="fw-bold mb-0">{{ number_format($stats->jugadores) }}</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body d-flex align-items-center">
                    <div class="bg-success bg-opacity-10 text-success rounded-circle p-3 me-3">
                        <i class="fas fa-school fa-2x"></i>
                    </div>
                    <div>
                        <h6 class="text-muted mb-1">Escuelas</h6>
                        <h3 class="fw-bold mb-0">{{ number_format($stats->escuelas) }}</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body d-flex align-items-center">
                    <div class="bg-warning bg-opacity-10 text-warning rounded-circle p-3 me-3">
                        <i class="fas fa-globe-americas fa-2x"></i>
                    </div>
                    <div>
                        <h6 class="text-muted mb-1">Países</h6>
                        <h3 class="fw-bold mb-0">{{ number_format($stats->paises) }}</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body d-flex align-items-center">
                    <div class="bg-info bg-opacity-10 text-info rounded-circle p-3 me-3">
                        <i class="fas fa-comment-alt fa-2x"></i>
                    </div>
                    <div>
                        <h6 class="text-muted mb-1">Reseñas</h6>
                        <h3 class="fw-bold mb-0">{{ number_format($reviews_count) }}</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Game File Management Section --}}
    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                    <h5 class="mb-0 fw-bold">Gestión del Videojuego</h5>

                </div>
                <div class="card-body">
                    @if($game_file)
                        <div class="alert alert-success d-flex align-items-center" role="alert">
                            <i class="fas fa-check-circle fa-2x me-3"></i>
                            <div>
                                <h5 class="alert-heading mb-1">Versión Activa: {{ $game_file->version }}</h5>
                                <p class="mb-0">
                                    Plataforma: <strong>{{ $game_file->platform }}</strong> |
                                    Descargas: <strong>{{ $game_file->download_count }}</strong> |
                                    Subido el: {{ $game_file->created_at->format('d/m/Y H:i') }}
                                </p>
                            </div>
                        </div>
                    @else
                        <div class="text-center py-5 text-muted">
                            <i class="fas fa-gamepad fa-4x mb-3 opacity-50"></i>
                            <h5>No hay ninguna versión del juego activa.</h5>
                            <p>Sube un archivo para que los usuarios puedan descargarlo.</p>
                        </div>
                    @endif

                    <livewire:admin.game-file-manager />
                </div>
            </div>
        </div>
    </div>
</div>