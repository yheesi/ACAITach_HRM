<?php

namespace App\Models;

use Database\Factories\ShiftFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['nama_shift', 'jam_mulai', 'jam_selesai', 'lintas_tengah_malam', 'durasi_jam', 'toleransi_telat_menit', 'status'])]
class Shift extends Model
{
    /** @use HasFactory<ShiftFactory> */
    use HasFactory;

    protected $table = 'shift';

    protected $primaryKey = 'id_shift';

    public const CREATED_AT = 'dibuat_pada';

    public const UPDATED_AT = 'diperbarui_pada';

    protected function casts(): array
    {
        return [
            'lintas_tengah_malam' => 'boolean',
            'durasi_jam' => 'decimal:2',
        ];
    }

    public function jadwal(): HasMany
    {
        return $this->hasMany(Jadwal::class, 'id_shift', 'id_shift');
    }
}
