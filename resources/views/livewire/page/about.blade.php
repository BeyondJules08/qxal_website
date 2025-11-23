<div>
    <div class="container py-5">
        <div class="row align-items-center mb-5">
            <div class="col-lg-6">
                <h1 class="display-4 fw-bold mb-4">Acerca de</h1>
                <p class="lead">Qxal es un equipo de desarrollo de software y diseñadores de juegos que creen que el
                    aprendizaje debe ser divertido y atractivo.</p>
                <p>Nuestra misión es proporcionar a los niños las herramientas que necesitan para desarrollar
                    habilidades cognitivas cruciales a través de un juego interactivo que se siente más como un juego
                    que como un trabajo.</p>
            </div>
            <div class="col-lg-6">
                <img src="https://via.placeholder.com/500x400/4ECDC4/FFFFFF?text=Our+Team" alt="Q-XAL Team"
                    class="img-fluid rounded-3">
            </div>
        </div>
        <br><br><br>
        <div class="row g-4">
            <div class="col-md-4 text-center">
                <i class="fas fa-brain text-primary mb-3" style="font-size: 3rem;"></i>
                <h4>Basado en Ciencia</h4>
                <p>Cada juego está diseñado en base a investigaciones sobre el desarrollo cognitivo y principios de la
                    ciencia del aprendizaje.</p>
            </div>
            <div class="col-md-4 text-center">
                <i class="fas fa-shield-alt text-success mb-3" style="font-size: 3rem;"></i>
                <h4>Seguro y Protegido</h4>
                <p>Sin anuncios, sin compras dentro de la aplicación y completa protección de la privacidad para los
                    niños .</p>
            </div>
            <div class="col-md-4 text-center">
                <i class="fas fa-users text-warning mb-3" style="font-size: 3rem;"></i>
                <h4>Expertos aprueban</h4>
                <p>Recomendado por psicólogos infantiles, maestros y especialistas en aprendizaje en todo el mundo.</p>
            </div>
        </div>
    </div>
    <div class="container py-5">

        {{-- Mensaje de éxito --}}
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        {{-- FORMULARIO --}}
        <form wire:submit.prevent="save" class="border p-4 mb-5 rounded shadow-sm">

            <h4 class="mb-3">Escribe un Testimonio</h4>

            <div class="mb-3">
                <label class="form-label">Nombre</label>
                <input type="text" wire:model="form.name" class="form-control">
                @error('form.name')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Rol</label>
                <input type="text" wire:model="form.role" class="form-control">
                @error('form.role')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Comentario</label>
                <textarea wire:model="form.text" class="form-control" rows="3"></textarea>
                @error('form.text')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Estrellas</label>
                <select wire:model="form.rating" class="form-select">
                    <option value="">Selecciona</option>
                    <option value="1">1 ⭐</option>
                    <option value="2">2 ⭐⭐</option>
                    <option value="3">3 ⭐⭐⭐</option>
                    <option value="4">4 ⭐⭐⭐⭐</option>
                    <option value="5">5 ⭐⭐⭐⭐⭐</option>
                </select>
                @error('form.rating')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <button class="btn btn-primary w-100">Enviar</button>
        </form>


        {{-- LISTA DE TESTIMONIOS (TU DISEÑO EXACTO) --}}
        <section id="testimonios">
            <h2 class="display-5 fw-bold text-center mb-5">Lo que dicen padres y maestros</h2>

            <div class="row g-4">
                @forelse ($testimonios as $testimonio)
                    <div class="col-md-6">
                        <div class="testimonial-card">
                            <div class="mb-3">
                                @for ($i = 0; $i < $testimonio->rating; $i++)
                                    <i class="fas fa-star text-warning"></i>
                                @endfor
                            </div>

                            <p class="mb-3">"{{ $testimonio->text }}"</p>

                            <div class="d-flex align-items-center">
                                <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-3"
                                    style="width: 50px; height: 50px;">
                                    {{ strtoupper(substr($testimonio->name, 0, 1)) }}
                                </div>

                                <div>
                                    <div class="fw-bold">{{ $testimonio->name }}</div>
                                    <small class="text-muted">{{ $testimonio->role }}</small>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="text-center">No hay testimonios aún.</p>
                @endforelse
            </div>
            <div wire:navigate>
                {{ $testimonios->links() }}
            </div>

        </section>

    </div>
    <script>
        window.addEventListener('scrollToTestimonios', () => {
            document.getElementById('testimonios').scrollIntoView({
                behavior: 'smooth'
            });
        });
    </script>

</div>
