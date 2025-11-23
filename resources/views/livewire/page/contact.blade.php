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
                        <label class="form-label">Nombre</label>
                        <input type="text" class="form-control" wire:model="form.name">
                        @error('form.name') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Correo Electrónico</label>
                        <input type="email" class="form-control" wire:model="form.email">
                        @error('form.email') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <div class="col-12">
                        <label class="form-label">Asunto</label>
                        <input type="text" class="form-control" wire:model="form.subject">
                        @error('form.subject') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <div class="col-12">
                        <label class="form-label">Mensaje</label>
                        <textarea class="form-control" rows="5" wire:model="form.message"></textarea>
                        @error('form.message') <small class="text-danger">{{ $message }}</small> @enderror
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
</div>
