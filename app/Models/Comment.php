<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'name', 'email', 'content', 'rating',
        'is_approved', 'news_id',
    ];

    protected $casts = [
        'is_approved' => 'boolean',
    ];

    public function news()
    {
        return $this->belongsTo(News::class);
    }

    public function scopeApproved($query)
    {
        return $query->where('is_approved', true);
    }
}
