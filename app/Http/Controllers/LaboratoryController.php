<?php

namespace App\Http\Controllers;

use App\ClinicCase;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
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
        $sen = LaboratoryController::getSenOptions();
        $int = LaboratoryController::getIntOptions();
        $res = LaboratoryController::getResOptions();
        $data = array(
            'sex'  => $sex,
            'localization' => $loc,
            'status' => $sta,
            'sensitive' => $sen,
            'intermediate' => $int,
            'resistant' => $res
        );
        return view('laboratory.create')->with('data', $data);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'number_clinic_history' => 'required|numeric|digits_between:1,30',
            'ref_animal' => 'required|numeric|digits_between:1,30',
            'specie' => 'required|max:255',
            'clinic_history' => 'required|max:500',
            'owner' => 'required|max:255',
            'breed' => 'required|max:255',
            'sex' => 'required|max:255',
            'age' => 'required|numeric|digits_between:1,3',
            'localization' => 'required|max:255',
            'clinic_case_status' => 'required|max:255',
            'sample' => 'required|max:255',
            'bacterioscopy' => 'max:255',
            'trichogram' => 'max:255',
            'culture' => 'max:255',
            'bacterial_isolate' => 'max:255',
            'fungi_isolate' => 'max:255',
            'antibiogram_sensitive' => 'max:255',
            'antibiogram_intermediate' => 'max:255',
            'antibiogram_resistant' => 'max:255',
            'comment' => 'max:500',
        ]);

        $cliniccase = new ClinicCase($request->all());

        $cliniccase->user_id = Auth::user()->id;

        $cliniccase->save();

        return redirect()->route('/lab')->with('message', 'Clinic case saved successfully');
    }

    public function getSexOptions()
    {
        return ['Male', 'Female'];
    }

    public function getLocOptions()
    {
        return ['loc1example', 'loc2example'];
    }

    public function getStatusOptions()
    {
        return ['In progress', 'Finished'];
    }

    public function getBacterialOptions()
    {
        return ['bacterial1', 'bacterial2'];
    }

    public function getFungiOptions()
    {
        return ['fungi1', 'fungi2'];
    }

    public function getSenOptions()
    {
        return ['med1', 'med2'];
    }

    public function getIntOptions()
    {
        return ['med1', 'med2'];
    }

    public function getResOptions()
    {
        return ['med1', 'med2'];
    }
}
