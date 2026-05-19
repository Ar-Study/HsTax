<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssistanceHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'jamaah_id', 'application_id', 'assistance_type',
        'amount', 'date', 'status',
    ];

    protected $casts = [
        'date' => 'date',
        'amount' => 'decimal:2',
    ];

    public function jamaah()
    {
        return $this->belongsTo(User::class, 'jamaah_id');
    }

    public function application()
    {
        return $this->belongsTo(AssistanceApplication::class, 'application_id');
    }
}
