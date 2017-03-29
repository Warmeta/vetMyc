<?php

namespace App\Http\Controllers;

use App\ClinicCase;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Validator;
use TCG\Voyager\Facades\Voyager;
use TCG\Voyager\Traits\VoyagerUser;

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

    public function indexC()
    {
        $rows = [
        'number_clinic_history',
        'ref_animal',
        'specie',
        'breed',
        'age',
        'localization',
        'clinic_case_status',
        'bacterioscopy',
        'trichogram',
        'culture',
        'comment'
        ];

        $clinics = DB::table('clinic_cases')->paginate(15);

        return view('laboratory.clinicCase.index')->with('clinics', $clinics)->with('rows', $rows);
    }


    public function create()
    {
        if (Voyager::can('browse_clinic_cases')) {
            $sex = LaboratoryController::getSexOptions();
            $loc = LaboratoryController::getLocOptions();
            $sta = LaboratoryController::getStatusOptions();
            $bac = LaboratoryController::getBacterialOptions();
            $fun = LaboratoryController::getFungiOptions();
            $sen = LaboratoryController::getSenOptions();
            $int = LaboratoryController::getIntOptions();
            $res = LaboratoryController::getResOptions();
            $data = collect([
                'sex' => $sex,
                'localization' => $loc,
                'status' => $sta,
                'bac' => $bac,
                'fun' => $fun,
                'sensitive' => $sen,
                'intermediate' => $int,
                'resistant' => $res
            ]);
            return view('laboratory.clinicCase.create')->with('data', $data);
        } else {
            return Redirect::to('/lab/clinic-case');
        }
    }

    public function store(Request $request)
    {
        if (Voyager::can('browse_clinic_cases')) {
            $cliniccase = new ClinicCase();
            $cliniccase->fill(['author_id' => Auth::user()->id]);
            $cliniccase->create($request->all());

            return Redirect::to('/lab/clinic-case')->with('message', 'Clinic case created successfully.');
        } else {
            return Redirect::to('/lab/clinic-case');
        }
    }

    public function edit($id)
    {
        $clinic = ClinicCase::find($id);

        // show the edit form
        return View::make('laboratory.clinicCase.edit')
            ->with('clinicCase.edit', $clinic);
    }

    public function show($id)
    {
        $clinic = ClinicCase::find($id);
        // show
        return View::make('laboratory.clinicCase.show')
            ->with('clinic', $clinic);
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
