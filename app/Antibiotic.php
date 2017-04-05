<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Antibiotic extends Model
{
    protected $fillable = [
        'antibiotic_name',
        'description',
    ];

    public function clinic_cases() {
        return $this->belongsToMany(ClinicCase::class, 'clinic_cases_antibiotics', 'antibiotic_id', 'clinic_case_id');
    }
}
