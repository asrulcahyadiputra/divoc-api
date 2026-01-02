<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $table = 'divoc_menus';

    protected $fillable = ['prefix', 'name', 'sort', 'description', 'category', 'category_name', 'sub_category', 'sub_category_name', 'sub_sort', 'permission_type', 'disabled_permission', 'icon', 'link', 'is_beta', 'is_active', 'is_premium'];

    protected static function booted(): void
    {
        static::saved(function ($menu) {
            cache()->forget("menu:prefix:{$menu->prefix}");
        });

        static::deleted(function ($menu) {
            cache()->forget("menu:prefix:{$menu->prefix}");
        });
    }
}
