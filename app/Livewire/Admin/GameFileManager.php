<?php

namespace App\Livewire\Admin;

use Livewire\Component;

class GameFileManager extends Component
{
    use \Livewire\WithFileUploads;

    public $file;
    public $version;
    public $platform = 'PC';

    protected $rules = [
        'file' => 'required|file|max:512000', // 500MB max
        'version' => 'required|string|max:20',
        'platform' => 'required|in:PC,Mac,Linux',
    ];

    public $editingFileId = null;

    public function edit($id)
    {
        $file = \App\Models\GameFile::find($id);
        if ($file) {
            $this->editingFileId = $file->id;
            $this->version = $file->version;
            $this->platform = $file->platform;
            // We don't load the file input as it's read-only/upload-only
        }
    }

    public function cancelEdit()
    {
        $this->reset(['file', 'version', 'platform', 'editingFileId']);
    }

    public function delete($id)
    {
        $file = \App\Models\GameFile::find($id);
        if ($file) {
            // Optional: Delete file from storage
            // \Illuminate\Support\Facades\Storage::disk('public')->delete($file->file_path);
            $file->delete();
            session()->flash('message', 'Archivo eliminado correctamente.');
        }
    }

    public function toggleActive($id)
    {
        $file = \App\Models\GameFile::find($id);
        if ($file) {
            if ($file->is_active) {
                $file->update(['is_active' => false]);
                session()->flash('message', 'Versión desactivada.');
            } else {
                // Deactivate all other files first
                \App\Models\GameFile::where('is_active', true)->update(['is_active' => false]);
                
                $file->update(['is_active' => true]);
                session()->flash('message', 'Versión activada correctamente.');
            }
            
            return redirect()->route('admin.dashboard');
        }
    }

    public function save()
    {
        if ($this->editingFileId) {
            $this->validate([
                'version' => 'required|string|max:20',
                'platform' => 'required|in:PC,Mac,Linux',
                'file' => 'nullable|file|max:512000', // File is optional on update
            ]);

            $file = \App\Models\GameFile::find($this->editingFileId);
            
            $data = [
                'version' => $this->version,
                'platform' => $this->platform,
            ];

            if ($this->file) {
                $data['file_path'] = $this->file->store('games', 'public');
            }

            $file->update($data);
            session()->flash('message', 'Versión actualizada correctamente.');
        } else {
            $this->validate(); // Uses default rules including required file

            $path = $this->file->store('games', 'public');

            // Deactivate previous files if this is a new active upload
            \App\Models\GameFile::where('is_active', true)->update(['is_active' => false]);

            \App\Models\GameFile::create([
                'file_path' => $path,
                'version' => $this->version,
                'platform' => $this->platform,
                'is_active' => true,
            ]);
            session()->flash('message', '¡Archivo subido y activado correctamente!');
        }

        $this->cancelEdit();
        
        // Refresh the page to update the dashboard stats
        return redirect()->route('admin.dashboard');
    }

    public function render()
    {
        return view('livewire.admin.game-file-manager', [
            'files' => \App\Models\GameFile::orderBy('created_at', 'desc')->get()
        ]);
    }
}
