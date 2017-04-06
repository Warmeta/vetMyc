<?php

namespace App\Http\Controllers;

use App\Antibiotic;
use App\ClinicCase;
use Illuminate\Database\Eloquent\Model;
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
        'comment'
        ];

        $clinics = DB::table('clinic_cases')->paginate(15);

        return view('laboratory.clinicCase.index')->with('clinics', $clinics)->with('rows', $rows);
    }

    public function indexA()
    {
        $rows = [
            'antibiotic_name',
            'description'
        ];

        $antibiotics = DB::table('antibiotics')->paginate(15);

        return view('laboratory.antibiotic.index')->with('antibiotics', $antibiotics)->with('rows', $rows);
    }

    public function create()
    {
        if (Voyager::can('browse_clinic_cases')) {
            $sex = LaboratoryController::getSexOptions();
            $loc = LaboratoryController::getLocOptions();
            $sta = LaboratoryController::getStatusOptions();
            $data = collect([
                'sex' => $sex,
                'localization' => $loc,
                'status' => $sta
            ]);
            $antibiotics = DB::table('antibiotics')->pluck('antibiotic_name')->all();
            return view('laboratory.clinicCase.create')->with('data', $data)->with('antibiotics', $antibiotics);
        } else {
            return Redirect::to('/lab/clinic-case');
        }
    }

    public function createAntibiotic()
    {
        if (Voyager::can('browse_antibiotics')) {
            return view('laboratory.antibiotic.create');
        } else {
            return Redirect::to('/lab/antibiotic');
        }
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'number_clinic_history' => 'required|unique:clinic_cases|digits_between:1,30',
            'ref_animal' => 'required|digits_between:1,30',
            'specie' => 'required|max:30',
            'clinic_history' => 'required|max:500',
            'owner' => 'required|max:50',
            'breed' => 'required|max:30',
            'sex' => 'required|max:30',
            'age' => 'required|digits_between:1,3',
            'localization' => 'required|max:255',
            'clinic_case_status' => 'required|max:255',
            'sample' => 'nullable|max:255',
            'bacterioscopy' => 'nullable|max:255',
            'trichogram' => 'nullable|max:255',
            'culture' => 'nullable|max:255',
            'bacterial_isolate' => 'nullable|max:255',
            'fungi_isolate' => 'nullable|max:255',
            'comment' => 'nullable|max:500',
        ]);

        if ($validator->fails()) {
            return redirect('/lab/clinic-case/create')
                ->withErrors($validator)
                ->withInput();
        }elseif (Voyager::can('browse_clinic_cases')) {
            $cliniccase = new ClinicCase();
            $cliniccase->fill(['author_id' => Auth::user()->id]);
            $cliniccase = ClinicCase::create($request->all());
            $antibiotics = DB::table('antibiotics')->get()->all();
            foreach ($antibiotics as $antibiotic) {
                $sensitive = $antibiotic->antibiotic_name . '-1';
                $intermediate = $antibiotic->antibiotic_name . '-2';
                $resistant = $antibiotic->antibiotic_name . '-3';
                $cliniccase->antibiotics()->attach($antibiotic->id, ['sensitive' => $request->$sensitive,'intermediate' => $request->$intermediate,'resistant' => $request->$resistant]);
            }

            return Redirect::to('/lab/clinic-case')->with('message', 'Clinic case created successfully.');
        } else {
            return Redirect::to('/lab/clinic-case');
        }
    }

    public function storeAntibiotic(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'antibiotic_name' => 'required|unique:antibiotics|max:30',
            'description' => 'required|max:190',
        ]);

        if ($validator->fails()) {
            return redirect('/lab/antibiotic/create')
                ->withErrors($validator)
                ->withInput();
        }elseif (Voyager::can('browse_antibiotics')) {
            $antibiotic = new Antibiotic();
            $antibiotic->create($request->all());

            return Redirect::to('/lab/antibiotic')->with('message', 'Antibiotic created successfully.');
        } else {
            return Redirect::to('/lab/antibiotic');
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
        $antibiotic = Antibiotic::find($id);
        // show
        return View::make('laboratory.clinicCase.show')
            ->with('antibiotic', $antibiotic);
    }

    public function showAntibiotic($id)
    {
        $antibiotic = Antibiotic::find($id);
        // show
        return View::make('laboratory.antibiotic.show')
            ->with('antibiotic', $antibiotic);
    }

    public function destroy($id)
    {
        ClinicCase::destroy($id);
    }

    public function destroyAntibiotic($id)
    {
        Antibiotic::destroy($id);
    }

    //Helpers

    public function getSexOptions()
    {
        return ['male' => 'Male', 'female' => 'Female'];
    }

    public function getLocOptions()
    {
        return [
            'skin' => 'Skin',
            'eye' => 'Eye',
            'mouth' => 'Mouth',
            'nose' => 'Nose',
            'nail' => 'Nail',
            'hair' => 'Hair',
            'ear' => 'Ear',
            'blood' => 'Blood',
            'biopsy' => 'Biopsy',
            'bodyfluids' => 'Body Fluids',
            'feces' => 'Feces',
        ];
    }

    public function getStatusOptions()
    {
        return ['inprogress' => 'In progress','finished' => 'Finished'];
    }
}
