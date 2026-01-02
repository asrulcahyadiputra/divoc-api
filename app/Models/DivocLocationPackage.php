<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DivocLocationPackage extends Model
{
    protected $table = 'divoc_location_packages';
    protected $primaryKey = 'id';
    protected $fillable = ['package_id', 'kode_lokasi', 'start_date', 'end_date', 'is_active'];

    public function packet() :BelongsTo {
        return $this->belongsTo(Packets::class, 'package_id', 'id');
    }
}
