<?php

namespace App\Models;

use Database\Factories\LemburFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable(['id_jadwal', 'tanggal_lembur', 'jam_lembur', 'alasan', 'status', 'disetujui_oleh', 'disetujui_pada', 'terkunci'])]
class Lembur extends Model
{
    /** @use HasFactory<LemburFactory> */
    use HasFactory;

    protected $table = 'lembur';

    protected $primaryKey = 'id_lembur';

    public const CREATED_AT = 'dibuat_pada';

    public const UPDATED_AT = 'diperbarui_pada';

    protected function casts(): array
    {
        return [
            'tanggal_lembur' => 'date',
            'jam_lembur' => 'decimal:1',
            'disetujui_pada' => 'datetime',
            'terkunci' => 'boolean',
        ];
    }

    public function jadwal(): BelongsTo
    {
        return $this->belongsTo(Jadwal::class, 'id_jadwal', 'id_jadwal');
    }

    public function penyetuju(): BelongsTo
    {
        return $this->belongsTo(Pengguna::class, 'disetujui_oleh', 'id_pengguna');
    }
}
