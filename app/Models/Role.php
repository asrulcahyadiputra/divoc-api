<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'divoc_roles';
    protected $primaryKey = 'id';
    protected $keyType = 'string';

    protected $fillable = ['id','kode_lokasi','name'];
}
