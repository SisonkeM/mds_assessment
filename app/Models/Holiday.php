<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Holiday extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $fillable = ['date',
        'day_of_week',
        'name',
        'holiday_type'];
}
