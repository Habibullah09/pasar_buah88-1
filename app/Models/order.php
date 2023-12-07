<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class order extends Model
{
    protected $table='orders';
    protected $fillable=["kode","no_order","jumlah", "status_order","tgl_order"];
}
