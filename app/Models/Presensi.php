<?php

namespace App\Models;

use Database\Factories\PresensiFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable(['id_jadwal', 'jam_masuk', 'jam_keluar', 'status', 'total_jam', 'menit_terlambat', 'terkunci'])]
class Presensi extends Model
{
    /** @use HasFactory<PresensiFactory> */
    use HasFactory;

    protected $table = 'presensi';

    protected $primaryKey = 'id_presensi';

    public const CREATED_AT = 'dibuat_pada';

    public const UPDATED_AT = 'diperbarui_pada';

    protected function casts(): array
    {
        return [
            'jam_masuk' => 'datetime',
            'jam_keluar' => 'datetime',
            'total_jam' => 'decimal:2',
            'menit_terlambat' => 'integer',
            'terkunci' => 'boolean',
        ];
    }

    public function jadwal(): BelongsTo
    {
        return $this->belongsTo(Jadwal::class, 'id_jadwal', 'id_jadwal');
    }
}
