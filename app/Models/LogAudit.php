<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogAudit extends Model
{
    use HasFactory;

    // @dbml-sync:table-property
    protected $table = 'log_audit';
    // @enddbml-sync:table-property

    // @dbml-sync:fillable
    protected $fillable = [
        'id_pengguna',
		'aksi',
		'nama_tabel',
		'id_objek',
		'data_lama',
		'data_baru',
		'waktu_catat'
    ];
    // @enddbml-sync:fillable

    // @dbml-sync:casts
    protected $casts = [
        'data_lama' => 'array',
		'data_baru' => 'array',
		'waktu_catat' => 'datetime'
    ];
    // @enddbml-sync:casts

    // @dbml-sync:relations
    public function pengguna()
    {
        return $this->belongsTo(Pengguna::class, 'id_pengguna', 'id_pengguna');
    }

    // @enddbml-sync:relations
}