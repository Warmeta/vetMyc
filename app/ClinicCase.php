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
        'owner_email',
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
        'comment'
    ];



    public function antibiotics() {
        return $this->belongsToMany(Antibiotic::class, 'clinic_cases_antibiotics', 'clinic_case_id', 'antibiotic_id');
    }

    public function scopeStatus($query, $status){
        $query->where('clinic_case_status', $status);
    }

    public function scopeIsolate($query, $isolate){
        $query->whereNotNull($isolate);
    }

    public function scopeLocalization($query, $loc){
        $query->where('localization', $loc);
    }

    public function scopeNclinic($query, $nclinic){
        $query->where('number_clinic_history', $nclinic)->orWhere('number_clinic_history', 'like', '%' . $nclinic . '%');
    }

}
