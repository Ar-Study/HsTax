<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssistanceDistribution extends Model
{
    use HasFactory;

    protected $fillable = [
        'application_id', 'amount', 'distribution_date',
        'method', 'notes', 'proof_image', 'distributed_by',
    ];

    protected $casts = [
        'distribution_date' => 'date',
        'amount' => 'decimal:2',
    ];

    public function application()
    {
        return $this->belongsTo(AssistanceApplication::class, 'application_id');
    }

    public function distributedBy()
    {
        return $this->belongsTo(User::class, 'distributed_by');
    }
}
