<?php

namespace App\Models;

use Database\Factories\PenggunaFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['id_karyawan', 'username', 'password', 'peran', 'aktif', 'terakhir_login'])]
class Pengguna extends Model
{
    /** @use HasFactory<PenggunaFactory> */
    use HasFactory;

    protected $table = 'pengguna';

    protected $primaryKey = 'id_pengguna';

    public const CREATED_AT = 'dibuat_pada';

    public const UPDATED_AT = 'diperbarui_pada';

    protected function casts(): array
    {
        return [
            'password' => 'hashed',
            'aktif' => 'boolean',
            'terakhir_login' => 'datetime',
        ];
    }

    public function karyawan(): BelongsTo
    {
        return $this->belongsTo(Karyawan::class, 'id_karyawan', 'id_karyawan');
    }

    public function jadwalDibuat(): HasMany
    {
        return $this->hasMany(Jadwal::class, 'dibuat_oleh', 'id_pengguna');
    }

    public function lemburDisetujui(): HasMany
    {
        return $this->hasMany(Lembur::class, 'disetujui_oleh', 'id_pengguna');
    }

    public function rekapBulananDibuat(): HasMany
    {
        return $this->hasMany(RekapBulanan::class, 'dibuat_oleh', 'id_pengguna');
    }

    public function logAudit(): HasMany
    {
        return $this->hasMany(LogAudit::class, 'id_pengguna', 'id_pengguna');
    }
}
