<?php

namespace App\Http\Controllers;

use App\ClinicCase;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class LaboratoryController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function __construct()
    {
        //$this->middleware('auth');
    }

    public function index()
    {
        return view('laboratory.index');
    }


    public function create()
    {
        $sex = LaboratoryController::getSexOptions();
        $loc = LaboratoryController::getLocOptions();
        $sta = LaboratoryController::getStatusOptions();
        $bac = LaboratoryController::getBacterialOptions();
        $fun = LaboratoryController::getFungiOptions();
        $sen = LaboratoryController::getSenOptions();
        $int = LaboratoryController::getIntOptions();
        $res = LaboratoryController::getResOptions();
        $data = collect([
            'sex'  => $sex,
            'localization' => $loc,
            'status' => $sta,
            'bac' => $bac,
            'fun' => $fun,
            'sensitive' => $sen,
            'intermediate' => $int,
            'resistant' => $res
        ]);
        return view('laboratory.create')->with('data', $data);
    }

    public function store(Request $request)
    {
            $cliniccase = new ClinicCase();
            $cliniccase->fill(['author_id' => Auth::user()->id]);
            $cliniccase->create($request->all());

            /*$cliniccase = new ClinicCase();
            $cliniccase->number_clinic_history = $request->get('number_clinic_history');
            $cliniccase->author_id = Auth::user()->id;
            $cliniccase->ref_animal = $request->get('ref_animal');
            $cliniccase->specie = $request->get('specie');
            $cliniccase->clinic_history = $request->get('clinic_history');
            $cliniccase->owner = $request->get('owner');
            $cliniccase->breed = $request->get('breed');
            $cliniccase->sex = $request->get('sex');
            $cliniccase->age = $request->get('age');
            $cliniccase->localization = $request->get('localization');
            $cliniccase->clinic_case_status = $request->get('clinic_case_status');
            $cliniccase->sample = $request->get('sample');
            $cliniccase->bacterioscopy = $request->get('bacterioscopy');
            $cliniccase->trichogram = $request->get('trichogram');
            $cliniccase->culture = $request->get('culture');
            $cliniccase->bacterial = $request->get('bacterial');
            $cliniccase->fungus = $request->get('fungus');
            $cliniccase->antibiogram_sensitive = $request->get('antibiogram_sensitive');
            $cliniccase->antibiogram_intermediate = $request->get('antibiogram_intermediate');
            $cliniccase->antibiogram_resistant = $request->get('antibiogram_resistant');
            $cliniccase->comment = $request->get('comment');
            $cliniccase->save();*/
            return Redirect::to('/lab')->with('message', 'Clinic case created successfully.');

    }

    public function getSexOptions()
    {
        return ['male' => 'Male', 'female' => 'Female'];
    }

    public function getLocOptions()
    {
        return ['loc1' => 'loc1example','loc2' => 'loc2example'];
    }

    public function getStatusOptions()
    {
        return ['inprogress' => 'In progress','finished' => 'Finished'];
    }

    public function getBacterialOptions()
    {
        return ['bac1' => 'bacterial1','bac2' => 'bacterial2'];
    }

    public function getFungiOptions()
    {
        return ['fung1' => 'fungi1','fung2' => 'fungi2'];
    }

    public function getSenOptions()
    {
        return ['m1' => 'med1','m2' => 'med2'];
    }

    public function getIntOptions()
    {
        return ['m1' => 'med1','m2' =>  'med2'];
    }

    public function getResOptions()
    {
        return ['m1' => 'med1','m2' =>  'med2'];
    }
}
