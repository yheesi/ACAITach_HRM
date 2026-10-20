<?php

namespace App\Models;

use Database\Factories\CabangFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['nama_cabang', 'alamat', 'kota', 'telepon', 'status'])]
class Cabang extends Model
{
    /** @use HasFactory<CabangFactory> */
    use HasFactory;

    protected $table = 'cabang';

    protected $primaryKey = 'id_cabang';

    public const CREATED_AT = 'dibuat_pada';

    public const UPDATED_AT = 'diperbarui_pada';

    public function karyawan(): HasMany
    {
        return $this->hasMany(Karyawan::class, 'id_cabang', 'id_cabang');
    }

    public function jadwal(): HasMany
    {
        return $this->hasMany(Jadwal::class, 'id_cabang', 'id_cabang');
    }

    public function rekapBulanan(): HasMany
    {
        return $this->hasMany(RekapBulanan::class, 'id_cabang', 'id_cabang');
    }
}
