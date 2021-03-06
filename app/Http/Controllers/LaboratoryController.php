<?php

namespace App\Http\Controllers;

use App\Antibiotic;
use App\ClinicCase;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Validator;
use TCG\Voyager\Facades\Voyager;
use TCG\Voyager\Traits\AlertsMessages;
use Mail;
use App\Mail\ClinicCaseSent;

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

    public function indexC(Request $request)
    {
        $rows = collect([
            'number_clinic_history' => 'Nº Caso',
            'ref_animal' => 'Ref. Animal',
            'specie' => 'Especie',
            'breed' => 'Raza',
            'age' => 'Edad',
            'localization' => 'Localización',
            'clinic_case_status' => 'Estado',
            'comment' => 'Comentarios',
        ]);

        $filters = LaboratoryController::getFilters();

        $model = $request->all();

        $only = ['filter', 'localization', 'number_clinic_history'];

        $loc = LaboratoryController::getLocOptions();

        if (isset($request->filter)) {
            if (($request->filter == 'inprogress') ||($request->filter == 'finished')){ //filter status
                $clinics = DB::table('clinic_cases')->where('clinic_case_status', $request->filter)->orderBy('number_clinic_history', 'DESC')->paginate(15);
            }elseif (($request->filter == 'bacterial_isolate') || ($request->filter == 'fungi_isolate')) { //filter status
                $clinics = DB::table('clinic_cases')->whereNotNull($request->filter)->orderBy('number_clinic_history', 'DESC')->paginate(15);
            }elseif ($request->filter == 'localization'){
                $clinics = DB::table('clinic_cases')->where('localization', $request->localization)->orderBy('number_clinic_history', 'DESC')->paginate(15);
            }elseif ($request->filter == 'number_clinic_history'){
                $clinics = DB::table('clinic_cases')->where('number_clinic_history', $request->number_clinic_history)->orWhere('number_clinic_history', 'like', '%' . $request->number_clinic_history . '%')->orderBy('number_clinic_history', 'DESC')->paginate(15);
            }
            // more filters
            return view('laboratory.clinicCase.index', compact('clinics', 'rows', 'filters', 'model', 'only', 'loc'));
        }else {
            $clinics = DB::table('clinic_cases')->paginate(15); //without filter
            return view('laboratory.clinicCase.index', compact('clinics', 'rows', 'filters', 'model', 'only', 'loc'));
        }
    }

    public function indexA()
    {
        $rows = collect([
            'antibiotic_name' => 'Name',
            'description' => 'Description'
        ]);

        $antibiotics = DB::table('antibiotics')->paginate(15);

        return view('laboratory.antibiotic.index')->with('antibiotics', $antibiotics)->with('rows', $rows);
    }

    public function create()
    {
        if (Voyager::can('add_clinic_cases')) {
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
        if (Voyager::can('add_antibiotics')) {
            return view('laboratory.antibiotic.create');
        } else {
            return Redirect::to('/lab/antibiotic');
        }
    }

    public function store(Request $request)
    {
        if (LaboratoryController::validateClinicCase($request)->fails()) {
            return redirect('/lab/clinic-case/create')
                ->withErrors(LaboratoryController::validateClinicCase($request))
                ->withInput();
        }elseif (Voyager::can('add_clinic_cases')) {
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
            Session::flash('suc', 'Caso clínico creado correctamente');
            return Redirect::to('/lab/clinic-case');
        } else {
            Session::flash('fail', 'Caso clínico no se pudo crear correctamente');
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
        }elseif (Voyager::can('add_antibiotics')) {
            $antibiotic = new Antibiotic();
            $antibiotic->create($request->all());
            Session::flash('suc', 'Antibiótico creado correctamente');
            return Redirect::to('/lab/antibiotic');
        } else {
            Session::flash('fail', 'Antibiótico no se pudo crear correctamente');
            return Redirect::to('/lab/antibiotic');
        }
    }

    public function edit($id)
    {
        $clinic = ClinicCase::find($id);
        $sex = LaboratoryController::getSexOptions();
        $loc = LaboratoryController::getLocOptions();
        $sta = LaboratoryController::getStatusOptions();
        $data = collect([
            'sex' => $sex,
            'localization' => $loc,
            'status' => $sta
        ]);

        $antibiotics = DB::table('antibiotics')->pluck('antibiotic_name')->all();
        $antibioticsid = DB::table('antibiotics')->pluck('id')->all();          //array with antibiotic ids

        $arrayrel = array();    //checked relations between clinic cases and antibiotics

        foreach ($antibiotics as $antibiotic){      //array filled nulls for checkboxes in edit view, nº antibiotics x 3
            $arrayrel = null;
            $arrayrel = null;
            $arrayrel = null;
        }

        $clinicantibiotics = DB::table('clinic_cases_antibiotics')->where('clinic_case_id', $clinic->id)->get();

        $i = 0;
        foreach ($clinicantibiotics as $rel){       //checked checkboxes for the relationship
            if ($rel->antibiotic_id == $antibioticsid[$i]) {
                $arrayrel[] = $rel->sensitive;
                $arrayrel[] = $rel->intermediate;
                $arrayrel[] = $rel->resistant;
            }
            $i++;
        }
        // show the edit form
        return View::make('laboratory.clinicCase.edit', compact('clinic', 'data', 'antibiotics', 'arrayrel'));
    }

    public function editAntibiotic($id)
    {
        $antibiotic = Antibiotic::find($id);

        // show the edit form
        return View::make('laboratory.antibiotic.edit', compact('antibiotic'));
    }

    public function update(Request $request){
        if (LaboratoryController::validateClinicCase($request)->fails()) {
            return redirect('/lab/clinic-case/'.$request->id.'/edit')
                ->withErrors(LaboratoryController::validateClinicCase($request))
                ->withInput();
        }elseif (Voyager::can('edit_clinic_cases')) {
            $cliniccase = ClinicCase::find($request->id);
            $cliniccase->update($request->all());
            $antibiotics = DB::table('antibiotics')->get()->all();
            $cliniccase->antibiotics()->detach();
            foreach ($antibiotics as $antibiotic) {
                $sensitive = $antibiotic->antibiotic_name . '-1';
                $intermediate = $antibiotic->antibiotic_name . '-2';
                $resistant = $antibiotic->antibiotic_name . '-3';
                $cliniccase->antibiotics()->attach($antibiotic->id, ['sensitive' => $request->$sensitive,'intermediate' => $request->$intermediate,'resistant' => $request->$resistant]);
            }
            Session::flash('suc', 'Caso clínico '.$request->number_clinic_history.' editado correctamente');
            return Redirect::to('/lab/clinic-case');
        } else {
            Session::flash('fail', 'Caso clínico '.$request->number_clinic_history.' no se pudo editar correctamente');
            return Redirect::to('/lab/clinic-case');
        }
    }

    public function updateAntibiotic(Request $request){
        $validator = Validator::make($request->all(), [
            'antibiotic_name' => 'required|unique:antibiotics|max:30',
            'description' => 'required|max:190',
        ]);

        if ($validator->fails()) {
            return redirect('/lab/antibiotic/create')
                ->withErrors($validator)
                ->withInput();
        }elseif (Voyager::can('edit_antibiotics')) {
            $antibiotic = Antibiotic::find($request->id);
            $antibiotic->update($request->all());
            Session::flash('suc', 'Antibiótico editado correctamente');
            return Redirect::to('/lab/antibiotic');
        } else {
            Session::flash('fail', 'Antibiótico no se pudo editar correctamente');
            return Redirect::to('/lab/antibiotic');
        }
    }

    public function show($id)
    {
        $clinic = ClinicCase::find($id);

        $clinicantibiotics = DB::table('antibiotics')
            ->join('clinic_cases_antibiotics', 'antibiotics.id', '=', 'clinic_cases_antibiotics.antibiotic_id')
            ->select('antibiotics.id' ,'antibiotics.antibiotic_name', 'clinic_cases_antibiotics.resistant', 'clinic_cases_antibiotics.intermediate', 'clinic_cases_antibiotics.sensitive')
            ->where('clinic_cases_antibiotics.clinic_case_id', $id)
            ->get();
        // show
        return View::make('laboratory.clinicCase.show')
            ->with('clinic', $clinic)->with('clinicantibiotics', $clinicantibiotics);
    }

    public function showAntibiotic($id)
    {
        $antibiotic = Antibiotic::find($id);
        // show
        $clinicantibiotics = DB::table('clinic_cases')
            ->join('clinic_cases_antibiotics', 'clinic_cases.id', '=', 'clinic_cases_antibiotics.clinic_case_id')
            ->select('clinic_cases.id' ,'clinic_cases.number_clinic_history', 'clinic_cases.specie', 'clinic_cases.breed', 'clinic_cases.age', 'clinic_cases_antibiotics.resistant', 'clinic_cases_antibiotics.intermediate', 'clinic_cases_antibiotics.sensitive')
            ->where('clinic_cases_antibiotics.antibiotic_id', $id)
            ->get();
        return View::make('laboratory.antibiotic.show')
            ->with('antibiotic', $antibiotic)->with('clinicantibiotics', $clinicantibiotics);
    }

    public function destroy($id)
    {
      if (Voyager::can('delete_clinic_cases')) {
        ClinicCase::destroy($id);
      }else{
        Session::flash('fail', 'No tienes los permisos necesarios.');
        return Redirect::to('/lab/clinic-case');
      }
    }

    public function destroyAntibiotic($id)
    {
      if (Voyager::can('delete_antibiotics')) {
        Antibiotic::destroy($id);
      }else{
        Session::flash('fail', 'No tienes los permisos necesarios.');
        return Redirect::to('/lab/antibiotic');
      }
    }

    //Helpers

    public function getSexOptions()
    {
        return ['male' => 'Macho', 'female' => 'Hembra'];
    }

    public function getLocOptions()
    {
        return [
            'skin' => 'Piel',
            'eye' => 'Ojo',
            'mouth' => 'Boca',
            'nose' => 'Nariz',
            'nail' => 'Uña',
            'hair' => 'Pelo',
            'ear' => 'Oreja',
            'blood' => 'Sangre',
            'biopsy' => 'Biopsia',
            'bodyfluids' => 'Fluidos corporales',
            'feces' => 'Heces',
            'urine' => 'Orina',
            'others' => 'Otros',
        ];
    }

    public function validateClinicCase($request)
    {
        return Validator::make($request->all(), [
            'number_clinic_history' => 'required|digits_between:1,30',
            'ref_animal' => 'required|digits_between:1,30',
            'specie' => 'required|max:30',
            'clinic_history' => 'required|max:500',
            'owner' => 'required|max:50',
            'owner_email' => 'nullable|email',
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
    }

    public function getStatusOptions()
    {
        return ['inprogress' => 'En progreso','finished' => 'Terminado'];
    }

    public function getFilters()
    {
        return [
            'inprogress' => 'En progreso',
            'finished' => 'Terminado',
            'bacterial_isolate' => 'Aislamiento Bacteriano',
            'fungi_isolate' => 'Aislamiento Fúngico',
            'localization' => 'Localización',
            'number_clinic_history' => 'Nº Caso'
        ];
    }

    public function email($id)
    {
        $clinic = ClinicCase::find($id);
        if ($clinic->clinic_case_status == 'finished') {
            $clinicantibiotics = DB::table('antibiotics')
                ->join('clinic_cases_antibiotics', 'antibiotics.id', '=', 'clinic_cases_antibiotics.antibiotic_id')
                ->select('antibiotics.antibiotic_name', 'clinic_cases_antibiotics.resistant', 'clinic_cases_antibiotics.intermediate', 'clinic_cases_antibiotics.sensitive')
                ->where('clinic_cases_antibiotics.clinic_case_id', $id)
                ->get();
            Mail::to($clinic->owner_email)->send(new ClinicCaseSent($clinic, $clinicantibiotics));
            Session::flash('suc', 'Email enviado correctamente');
            return Redirect::back()->with('suc', 'Email enviado correctamente');
        }else{
            Session::flash('fail', 'Caso clínico todavía en progreso');
            return Redirect::back()->with('fail', 'Caso clínico todavía en progreso');
        }
    }
}
