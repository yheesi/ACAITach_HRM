<?php

namespace App\Models;

use Database\Factories\JadwalFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

#[Fillable(['id_karyawan', 'id_cabang', 'id_shift', 'tanggal', 'status', 'dibuat_oleh'])]
class Jadwal extends Model
{
    /** @use HasFactory<JadwalFactory> */
    use HasFactory;

    protected $table = 'jadwal';

    protected $primaryKey = 'id_jadwal';

    public const CREATED_AT = 'dibuat_pada';

    public const UPDATED_AT = 'diperbarui_pada';

    protected function casts(): array
    {
        return ['tanggal' => 'date'];
    }

    public function karyawan(): BelongsTo
    {
        return $this->belongsTo(Karyawan::class, 'id_karyawan', 'id_karyawan');
    }

    public function cabang(): BelongsTo
    {
        return $this->belongsTo(Cabang::class, 'id_cabang', 'id_cabang');
    }

    public function shift(): BelongsTo
    {
        return $this->belongsTo(Shift::class, 'id_shift', 'id_shift');
    }

    public function pembuat(): BelongsTo
    {
        return $this->belongsTo(Pengguna::class, 'dibuat_oleh', 'id_pengguna');
    }

    public function presensi(): HasOne
    {
        return $this->hasOne(Presensi::class, 'id_jadwal', 'id_jadwal');
    }

    public function lembur(): HasMany
    {
        return $this->hasMany(Lembur::class, 'id_jadwal', 'id_jadwal');
    }
}
