<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HstaxTestimonial extends Model
{
    protected $fillable = [
        'stars', 'text', 'initial', 'name', 'role',
        'sort_order', 'is_approved',
    ];

    protected $casts = [
        'is_approved' => 'boolean',
    ];

    protected $table = 'hstax_testimonials';
}
