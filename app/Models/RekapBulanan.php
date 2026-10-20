<?php

namespace App\Models;

use Database\Factories\RekapBulananFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable(['id_cabang', 'tanggal_mulai', 'tanggal_selesai', 'total_karyawan', 'total_jam_kerja', 'total_jam_terlambat', 'total_jam_lembur', 'dibuat_oleh', 'terkunci', 'dikunci_pada'])]
class RekapBulanan extends Model
{
    /** @use HasFactory<RekapBulananFactory> */
    use HasFactory;

    protected $table = 'rekap_bulanan';

    protected $primaryKey = 'id_rekap';

    public const CREATED_AT = 'dibuat_pada';

    public const UPDATED_AT = null;

    protected function casts(): array
    {
        return [
            'tanggal_mulai' => 'date',
            'tanggal_selesai' => 'date',
            'total_jam_kerja' => 'decimal:2',
            'total_jam_terlambat' => 'decimal:2',
            'total_jam_lembur' => 'decimal:2',
            'terkunci' => 'boolean',
            'dikunci_pada' => 'datetime',
        ];
    }

    public function cabang(): BelongsTo
    {
        return $this->belongsTo(Cabang::class, 'id_cabang', 'id_cabang');
    }

    public function pembuat(): BelongsTo
    {
        return $this->belongsTo(Pengguna::class, 'dibuat_oleh', 'id_pengguna');
    }
}
