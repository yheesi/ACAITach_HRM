<?php

namespace App\Models;

use Database\Factories\LogAuditFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable(['id_pengguna', 'aksi', 'nama_tabel', 'id_objek', 'data_lama', 'data_baru', 'waktu_catat'])]
class LogAudit extends Model
{
    /** @use HasFactory<LogAuditFactory> */
    use HasFactory;

    protected $table = 'log_audit';

    protected $primaryKey = 'id_audit';

    public $timestamps = false;

    protected function casts(): array
    {
        return [
            'id_objek' => 'integer',
            'data_lama' => 'array',
            'data_baru' => 'array',
            'waktu_catat' => 'datetime',
        ];
    }

    public function pengguna(): BelongsTo
    {
        return $this->belongsTo(Pengguna::class, 'id_pengguna', 'id_pengguna');
    }
}
