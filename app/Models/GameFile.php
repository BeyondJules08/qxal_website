<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GameFile extends Model
{
    protected $fillable = [
        'file_path',
        'version',
        'platform',
        'is_active',
        'download_count',
    ];
}
