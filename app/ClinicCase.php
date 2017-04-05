<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ClinicCase extends Model
{
    protected $fillable = [
        'number_clinic_history',
        'author_id',
        'ref_animal',
        'specie',
        'clinic_history',
        'owner',
        'breed',
        'sex',
        'age',
        'localization',
        'clinic_case_status',
        'sample',
        'bacterioscopy',
        'trichogram',
        'culture',
        'bacterial_isolate',
        'fungi_isolate',
        'antibiogram_sensitive',
        'antibiogram_intermediate',
        'antibiogram_resistant',
        'comment'
    ];

    public function antibiotics() {
        return $this->belongsToMany(Antibiotic::class, 'clinic_cases_antibiotics', 'clinic_case_id', 'antibiotic_id');
    }

}
