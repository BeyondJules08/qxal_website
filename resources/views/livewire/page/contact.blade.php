<div>
    <div class="container py-5">
        <div class="row">
            <div class="col-lg-8 mx-auto">

                <div class="text-center mb-5">
                    <h1 class="display-4 fw-bold">Contáctanos</h1>
                    <p class="lead">¡Nos encantaría saber de ti!</p>
                </div>

                @if (session()->has('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <form class="row g-3" wire:submit.prevent="send">

                    <div class="col-md-6">
                        <label class="form-label">Nombre <span class="text-danger">*</span></label>
                        <input
                            type="text"
                            class="form-control @error('form.name') is-invalid @enderror"
                            wire:model="form.name"
                            placeholder="Tu nombre completo"
                            minlength="3"
                            maxlength="50"
                            @input="updateCharCount('name', 50)">
                        <small class="form-text text-muted char-count" id="count-name">0/50</small>
                        @error('form.name')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Correo Electrónico <span class="text-danger">*</span></label>
                        <input
                            type="email"
                            class="form-control @error('form.email') is-invalid @enderror"
                            wire:model="form.email"
                            placeholder="tu@email.com"
                            maxlength="50"
                            @input="updateCharCount('email', 50)">
                        <small class="form-text text-muted char-count" id="count-email">0/50</small>
                        @error('form.email')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-12">
                        <label class="form-label">Asunto <span class="text-danger">*</span></label>
                        <input
                            type="text"
                            class="form-control @error('form.subject') is-invalid @enderror"
                            wire:model="form.subject"
                            placeholder="Asunto de tu mensaje"
                            minlength="5"
                            maxlength="20"
                            @input="updateCharCount('subject', 20)">
                        <small class="form-text text-muted char-count" id="count-subject">0/20</small>
                        @error('form.subject')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-12">
                        <label class="form-label">Mensaje <span class="text-danger">*</span></label>
                        <textarea
                            class="form-control @error('form.message') is-invalid @enderror"
                            rows="5"
                            wire:model="form.message"
                            placeholder="Cuéntanos tu mensaje (mínimo 10, máximo 90 caracteres)"
                            minlength="10"
                            maxlength="90"
                            @input="updateCharCount('message', 90)"></textarea>
                        <small class="form-text text-muted char-count" id="count-message">0/90</small>
                        @error('form.message')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-12 text-center">
                        <button class="btn btn-primary btn-lg" type="submit">
                            Enviar mensaje
                        </button>
                    </div>

                </form>

            </div>
        </div>
    </div>

    <script>
        function updateCharCount(fieldName, maxChars) {
            const element = document.querySelector(`[wire\\:model="form.${fieldName}"]`);
            const countDisplay = document.getElementById(`count-${fieldName}`);

            if (element && countDisplay) {
                const currentLength = element.value.length;
                countDisplay.textContent = `${currentLength}/${maxChars}`;

                // Cambiar color si se aproxima al límite
                if (currentLength > maxChars * 0.8) {
                    countDisplay.classList.add('text-warning');
                    countDisplay.classList.remove('text-muted');
                } else if (currentLength > maxChars * 0.9) {
                    countDisplay.classList.add('text-danger');
                    countDisplay.classList.remove('text-warning', 'text-muted');
                } else {
                    countDisplay.classList.remove('text-warning', 'text-danger');
                    countDisplay.classList.add('text-muted');
                }
            }
        }

        // Inicializar contadores al cargar la página
        document.addEventListener('DOMContentLoaded', function() {
            const fields = ['name', 'email', 'subject', 'message'];
            const maxChars = {
                name: 50,
                email: 50,
                subject: 20,
                message: 90
            };

            fields.forEach(field => {
                const element = document.querySelector(`[wire\\:model="form.${field}"]`);
                if (element) {
                    updateCharCount(field, maxChars[field]);
                }
            });
        });

        // Actualizar contadores cuando Livewire actualiza los datos
        document.addEventListener('livewire:updated', function() {
            const fields = ['name', 'email', 'subject', 'message'];
            const maxChars = {
                name: 50,
                email: 50,
                subject: 20,
                message: 90
            };

            fields.forEach(field => {
                const element = document.querySelector(`[wire\\:model="form.${field}"]`);
                if (element) {
                    updateCharCount(field, maxChars[field]);
                }
            });
        });
    </script>
</div>
