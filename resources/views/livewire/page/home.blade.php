<div>
    <section class="hero-section position-relative">
        <div class="floating-shapes"></div>
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <h1 class="display-4 fw-bold mb-4">
                        ¡Mejora tus habilidades cognitivas con<span class="text-warning"> Qxal Academy!</span>
                    </h1>
                    <p class="lead mb-4">
                        Diversion y juegos interactivos diseñados por expertos en educación para mejorar las habilidades
                        cognitivas
                        de los niños de 6 a 12 años. ¡El aprendizaje nunca ha sido tan emocionante!
                    </p>
                    <div class="d-flex gap-3 flex-wrap">
                        <a href="#download" class="btn btn-primary btn-lg">
                            <i class="fas fa-play me-2"></i>Juega ahora!
                        </a>
                        <a href="#features" class="btn btn-outline-light btn-lg">
                            <i class="fas fa-info-circle me-2"></i>Ver mas
                        </a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="text-center">
                        <div class="position-relative">
                            <img src="" alt="Q-XAL Game Screenshot" class="img-fluid rounded-3 shadow-lg">
                            <div
                                class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-center">
                                <button class="btn btn-light btn-lg rounded-circle" style="width: 80px; height: 80px;">
                                    <i class="fas fa-play text-primary" style="font-size: 2rem;"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="stats-section py-5">
        <div class="container">
            <div class="row text-center">
                <div class="col-md-4 mb-3">
                    <div class="h2 fw-bold">{{ $estadisticas->jugadores }}</div>
                    <p class="mb-0">Jugadores felices</p>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="h2 fw-bold">{{ $estadisticas->escuelas }}</div>
                    <p class="mb-0">Escuelas usan Qxal</p>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="h2 fw-bold">{{ $estadisticas->paises }}</div>
                    <p class="mb-0">Paises alrededor del mundo</p>
                </div>

            </div>
        </div>
    </section>

    <section id="features" class="py-5">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="display-5 fw-bold">¿Por que aman nuestro proyecto?</h2>
                <p class="lead text-muted">Juegos diseñados científicamente que hacen que el aprendizaje sea divertido y
                    efectivo</p>
            </div>
            <div class="row g-4">
                @forelse ($caracteristicas as $caracteristica)
                    <div class="col-lg-3 col-md-6">
                        <div class="card feature-card h-100 text-center p-4">
                            <div class="card-body">
                                <div class="mb-3">
                                    <i class="fas fa-{{ $caracteristica->icon }} text-primary"
                                        style="font-size: 3rem;"></i>
                                </div>
                                <h5 class="card-title fw-bold">{{ $caracteristica->title }}</h5>
                                <p class="card-text">{{ $caracteristica->description }}</p>
                                <span class="badge bg-light text-dark">{{ $caracteristica->age_group }}</span>
                            </div>
                        </div>
                    </div>

                @empty
                    <p class="text-center">No hay características disponibles en este momento.</p>
                @endforelse
            </div>
        </div>
    </section>

    <section class="py-5 bg-light">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="display-5 fw-bold">¿Como funciona?</h2>
                <p class="lead text-muted">Tres simples pasos para la mejora cognitiva</p>
            </div>
            <div class="row g-4">
                <div class="col-md-4 text-center">
                    <div class="mb-3">
                        <div class="bg-primary text-white rounded-circle d-inline-flex align-items-center justify-content-center"
                            style="width: 80px; height: 80px; font-size: 2rem; font-weight: bold;">1</div>
                    </div>
                    <h4>Elige tu aventura</h4>
                    <p>Selecciona entre juegos de memoria, rompecabezas, atención o velocidad según los intereses de tu
                        hijo.</p>
                </div>
                <div class="col-md-4 text-center">
                    <div class="mb-3">
                        <div class="bg-success text-white rounded-circle d-inline-flex align-items-center justify-content-center"
                            style="width: 80px; height: 80px; font-size: 2rem; font-weight: bold;">2</div>
                    </div>
                    <h4>Jugar y Aprender</h4>
                    <p>Interactúa con minijuegos coloridos y atractivos diseñados por expertos en desarrollo infantil.
                    </p>
                </div>
                <div class="col-md-4 text-center">
                    <div class="mb-3">
                        <div class="bg-warning text-white rounded-circle d-inline-flex align-items-center justify-content-center"
                            style="width: 80px; height: 80px; font-size: 2rem; font-weight: bold;">3</div>
                    </div>
                    <h4>Seguimiento del Progreso</h4>
                    <p>Observa cómo mejoran las habilidades cognitivas de tu hijo con informes de progreso detallados
                        para padres.</p>
                </div>
            </div>
        </div>
    </section>
    <section class="py-5">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="display-5 fw-bold">Lo que dicen padres y maestros</h2>
            </div>

            <div class="row g-4">
                @forelse ($testimonios as $testimonio)
                    <div class="col-md-6">
                        <div class="testimonial-card">
                            <div class="mb-3">
                                {{-- Estrellas según rating --}}
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
                    <p class="text-center">No hay testimonios disponibles en este momento.</p>
                @endforelse
            </div>
        </div>
    </section>
    <section class="py-5 bg-primary text-white">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <h3 class="fw-bold mb-3">¡Mantente Actualizado!</h3>
                    <p class="mb-0">Recibe las últimas novedades sobre nuevos juegos y características.</p>
                </div>
                <div class="col-lg-6">
                    <form id="newsletterForm" class="d-flex gap-2">
                        <input type="email" class="form-control" placeholder="Ingresa tu correo electrónico"
                            required>
                        <button type="submit" class="btn btn-light">Suscribirse</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
