<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class mutasi extends Model
{
    protected $table='mutasi';
    protected $fillable=["kode", "order_id", "nomer_mutasi", "tanggal", "keterangan", "asal_mutasi", "tujuan_mutasi", "jumlah", "status"];
}
