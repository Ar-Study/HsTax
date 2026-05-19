<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssistanceApplication extends Model
{
    use HasFactory;

    protected $fillable = [
        'jamaah_id', 'assistance_type', 'amount_requested',
        'amount_approved', 'description', 'status', 'admin_note',
        'application_date', 'verification_date', 'verified_by',
    ];

    protected $casts = [
        'application_date' => 'date',
        'verification_date' => 'date',
        'amount_requested' => 'decimal:2',
        'amount_approved' => 'decimal:2',
    ];

    public function jamaah()
    {
        return $this->belongsTo(User::class, 'jamaah_id');
    }

    public function verifier()
    {
        return $this->belongsTo(User::class, 'verified_by');
    }

    public function distributions()
    {
        return $this->hasMany(AssistanceDistribution::class, 'application_id');
    }

    public function history()
    {
        return $this->hasOne(AssistanceHistory::class, 'application_id');
    }
}
