<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgramBudget extends Model
{
    use HasFactory;

    protected $fillable = [
        'program_id', 'item_name', 'estimated_cost',
        'actual_cost', 'description', 'status',
    ];

    protected $casts = [
        'estimated_cost' => 'decimal:2',
        'actual_cost' => 'decimal:2',
    ];

    public function program()
    {
        return $this->belongsTo(Program::class);
    }
}
