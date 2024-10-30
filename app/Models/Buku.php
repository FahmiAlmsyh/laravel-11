<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Buku extends Model
{
    use HasFactory;

    protected $table = 'buku';

    protected $primaryKey = 'id';

    protected $fillable = [
        'judul',
        'penulis_id',
        'tahun_terbit',
        'penerbit',
        'jenis',
        'sinopsis',
        'foto'
    ];

    protected function casts(): array
    {
        return [
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ];
    }
    public function author(): BelongsTo
    {
        return $this->belongsTo(penulis::class, 'penulis_id', 'id');
    }
}
