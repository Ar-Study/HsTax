<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HstaxSetting extends Model
{
    protected $fillable = ['key', 'value', 'group'];

    protected $table = 'hstax_settings';
}
