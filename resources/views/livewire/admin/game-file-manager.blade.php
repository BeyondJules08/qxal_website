<div>
    @if (session()->has('message'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('message') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    {{-- Upload/Edit Form --}}
    <div class="mb-4">
        <h6 class="fw-bold mb-3">{{ $editingFileId ? 'Editar Versión' : 'Subir Nueva Versión' }}</h6>
        <form wire:submit.prevent="save" class="row g-3">
            <div class="col-md-4">
                <label class="form-label">Versión (Ej: v1.0.2)</label>
                <input type="text" class="form-control" wire:model="version" placeholder="v1.0.0">
                @error('version') <span class="text-danger small">{{ $message }}</span> @enderror
            </div>
            <div class="col-md-4">
                <label class="form-label">Plataforma</label>
                <select class="form-select" wire:model="platform">
                    <option value="PC">PC (Windows)</option>
                    <option value="Mac">Mac</option>
                    <option value="Linux">Linux</option>
                </select>
                @error('platform') <span class="text-danger small">{{ $message }}</span> @enderror
            </div>
            <div class="col-md-4">
                <label class="form-label">Archivo {{ $editingFileId ? '(Opcional)' : '(.zip, .exe)' }}</label>
                <input type="file" class="form-control" wire:model="file">
                <div wire:loading wire:target="file" class="text-muted small">Subiendo...</div>
                @error('file') <span class="text-danger small">{{ $message }}</span> @enderror
            </div>
            <div class="col-12 d-flex gap-2">
                <button type="submit" class="btn {{ $editingFileId ? 'btn-warning' : 'btn-success' }}"
                    wire:loading.attr="disabled">
                    <span wire:loading.remove>
                        <i class="fas {{ $editingFileId ? 'fa-save' : 'fa-cloud-upload-alt' }} me-2"></i>
                        {{ $editingFileId ? 'Actualizar' : 'Subir y Activar' }}
                    </span>
                    <span wire:loading><i class="fas fa-spinner fa-spin me-2"></i> Procesando...</span>
                </button>
                @if($editingFileId)
                    <button type="button" class="btn btn-secondary" wire:click="cancelEdit">
                        Cancelar
                    </button>
                @endif
            </div>
        </form>
    </div>

    <hr>

    {{-- History Table --}}
    <h6 class="fw-bold mb-3">Historial de Versiones</h6>
    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th>Versión</th>
                    <th>Plataforma</th>
                    <th>Estado</th>
                    <th>Descargas</th>
                    <th>Fecha</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($files as $file)
                    <tr>
                        <td class="fw-bold">{{ $file->version }}</td>
                        <td>{{ $file->platform }}</td>
                        <td>
                            @if($file->is_active)
                                <span class="badge bg-success">Activo</span>
                            @else
                                <span class="badge bg-secondary">Inactivo</span>
                            @endif
                        </td>
                        <td>{{ $file->download_count }}</td>
                        <td>{{ $file->created_at->format('d/m/Y') }}</td>
                        <td>
                            @if($file->is_active)
                                <button class="btn btn-sm btn-outline-warning me-1" wire:click="toggleActive({{ $file->id }})"
                                    title="Desactivar">
                                    <i class="fas fa-ban"></i>
                                </button>
                            @else
                                <button class="btn btn-sm btn-outline-success me-1" wire:click="toggleActive({{ $file->id }})"
                                    title="Activar">
                                    <i class="fas fa-check"></i>
                                </button>
                            @endif
                            <button class="btn btn-sm btn-outline-primary me-1" wire:click="edit({{ $file->id }})"
                                title="Editar">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button class="btn btn-sm btn-outline-danger" wire:click="delete({{ $file->id }})"
                                onclick="confirm('¿Estás seguro de eliminar esta versión?') || event.stopImmediatePropagation()"
                                title="Eliminar">
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted py-4">
                            No hay archivos subidos.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>