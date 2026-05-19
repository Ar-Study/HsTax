<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{
    use HasFactory;

    protected $fillable = [
        'jamaah_id', 'type', 'amount', 'donation_date',
        'payment_method', 'description', 'proof_image', 'notes',
    ];

    protected $casts = [
        'donation_date' => 'date',
        'amount' => 'decimal:2',
    ];

    public function jamaah()
    {
        return $this->belongsTo(User::class, 'jamaah_id');
    }
}
