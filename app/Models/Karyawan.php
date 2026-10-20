<?php

namespace App\Models;

use Database\Factories\KaryawanFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

#[Fillable(['id_cabang', 'nama', 'jabatan', 'no_identitas', 'telepon', 'email', 'status_kerja', 'tanggal_bergabung', 'tanggal_keluar'])]
class Karyawan extends Model
{
    /** @use HasFactory<KaryawanFactory> */
    use HasFactory;

    protected $table = 'karyawan';

    protected $primaryKey = 'id_karyawan';

    public const CREATED_AT = 'dibuat_pada';

    public const UPDATED_AT = 'diperbarui_pada';

    protected function casts(): array
    {
        return [
            'tanggal_bergabung' => 'date',
            'tanggal_keluar' => 'date',
        ];
    }

    public function cabang(): BelongsTo
    {
        return $this->belongsTo(Cabang::class, 'id_cabang', 'id_cabang');
    }

    public function pengguna(): HasOne
    {
        return $this->hasOne(Pengguna::class, 'id_karyawan', 'id_karyawan');
    }

    public function jadwal(): HasMany
    {
        return $this->hasMany(Jadwal::class, 'id_karyawan', 'id_karyawan');
    }
}
