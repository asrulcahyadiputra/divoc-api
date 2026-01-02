<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $table = 'locations';
    protected $primaryKey = 'kode_lokasi';
    protected $keyType = 'string';
    protected $fillable = ['kode_lokasi', 'packet_id', 'nama', 'alamat', 'no_telp', 'email', 'no_telp_pic'];
}
