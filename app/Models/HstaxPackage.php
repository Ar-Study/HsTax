<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HstaxPackage extends Model
{
    protected $fillable = [
        'icon', 'name', 'desc', 'price', 'period',
        'features', 'sort_order', 'is_popular',
    ];

    protected $casts = [
        'features' => 'array',
        'is_popular' => 'boolean',
    ];

    protected $table = 'hstax_packages';
}
