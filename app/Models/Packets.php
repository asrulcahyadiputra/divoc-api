<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Packets extends Model
{
    protected $table = 'divoc_packets';
    protected $primaryKey = 'id';
    protected $fillable = ['name', 'description'];

    public function divocLocationPackages() :HasMany {
        return $this->hasMany(DivocLocationPackage::class, 'package_id', 'id')->orderBy('kode_lokasi', 'ASC');
    }
}
