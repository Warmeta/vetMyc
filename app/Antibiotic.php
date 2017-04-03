<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Antibiotic extends Model
{
    protected $fillable = [
        'antibiotic_name',
        'description',
    ];
}
