<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-4">
            <div class="card shadow-lg border-0 rounded-3">
                <div class="card-body p-4">
                    <div class="text-center mb-4">
                        <h3 class="fw-bold text-primary">Q-xal Admin</h3>
                        <p class="text-muted">Inicia sesión para continuar</p>
                    </div>

                    <form wire:submit.prevent="authenticate">
                        <div class="mb-3">
                            <label for="email" class="form-label">Correo Electrónico</label>
                            <input wire:model="email" type="email"
                                class="form-control @error('email') is-invalid @enderror" id="email"
                                placeholder="admin@qxal.com" autofocus>
                            @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Contraseña</label>
                            <input wire:model="password" type="password"
                                class="form-control @error('password') is-invalid @enderror" id="password"
                                placeholder="••••••••">
                            @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary btn-lg">
                                <span wire:loading.remove>Ingresar</span>
                                <span wire:loading><i class="fas fa-spinner fa-spin"></i> Cargando...</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="text-center mt-3">
                <a href="{{ route('home') }}" class="text-decoration-none text-muted">
                    <i class="fas fa-arrow-left me-1"></i> Volver al inicio
                </a>
            </div>
        </div>
    </div>
</div>