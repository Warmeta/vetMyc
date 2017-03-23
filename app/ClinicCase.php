<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClinicCase extends Model
{
    protected $fillable = [
        'number_clinic_history',
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
        'bacterial',
        'fungus',
        'antibiogram_sensitive',
        'antibiogram_intermediate',
        'antibiogram_resistant',
        'comment'];

}
