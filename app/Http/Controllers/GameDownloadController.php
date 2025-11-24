<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GameDownloadController extends Controller
{
    public function downloadLatest()
    {
        $file = \App\Models\GameFile::where('is_active', true)->first();

        if (!$file) {
            return redirect()->back()->with('error', 'No hay ninguna versión disponible para descargar en este momento.');
        }

        $file->increment('download_count');

        return response()->download(storage_path('app/public/' . $file->file_path));
    }
}
