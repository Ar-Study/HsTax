<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HstaxFaq extends Model
{
    protected $fillable = ['question', 'answer', 'sort_order'];

    protected $table = 'hstax_faqs';
}
