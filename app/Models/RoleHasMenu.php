<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RoleHasMenu extends Model
{
    protected $table = 'divoc_roles_has_menus';

    protected $casts = [
        'can_read'   => 'boolean',
        'can_create' => 'boolean',
        'can_update' => 'boolean',
        'can_delete' => 'boolean',
    ];

    protected static function booted(): void
    {
        static::saved(function ($perm) {
            foreach (['read', 'create', 'update', 'delete'] as $action) {
                cache()->forget(
                    "perm:{$perm->kode_lokasi}:{$perm->role_id}:{$perm->menu->prefix}:{$action}"
                );
            }
        });
    }

    public function menu(): BelongsTo
    {
        return $this->belongsTo(Menu::class, 'menu_id');
    }
}
