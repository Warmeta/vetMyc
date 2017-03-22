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
        //   $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('laboratory.clinicCase');
    }

    public function store()
    {
        //validator
        $rules = array(
            'number_clinic_history' => 'required|max:30',
            'ref_animal' => 'required|numeric|max:30',
            'specie' => 'required',
            'clinic_history' => 'required|max:255',
            'owner' => 'required|email|max:255',
            'breed' => 'required|max:255',
            'sex' => 'required',
            'clinic_case_status' => 'required',
            'sample' => 'required|min:6|confirmed',
            'bacterioscopy' => 'max:255',
            'trichogram' => 'max:255',
            'culture' => 'max:255',
            'bacterial' => 'max:255',
            'fungus' => 'max:255',
            'comment' => 'max:255',
        );
        $validator = Validator::make(Input::all(), $rules);
        // process the login
        if ($validator->fails()) {
            return Redirect::to('/lab')
                ->withErrors($validator)
                ->withInput();
        } else {
            // store
            $cliniccase = new ClinicCase();
            $cliniccase->author_id = Auth::user()->id;
            $cliniccase->number_clinic_history = Input::get('number_clinic_history');
            $cliniccase->ref_animal = Input::get('ref_animal');
            $cliniccase->specie = Input::get('specie');
            $cliniccase->ref_animal = Input::get('ref_animal');
            $cliniccase->clinic_history = Input::get('clinic_history');
            $cliniccase->owner = Input::get('owner');
            $cliniccase->breed = Input::get('breed');
            $cliniccase->sex = Input::get('sex');
            $cliniccase->clinic_case_status = Input::get('clinic_case_status');
            $cliniccase->bacterioscopy = Input::get('bacterioscopy');
            $cliniccase->trichogram = Input::get('trichogram');
            $cliniccase->culture = Input::get('culture');
            $cliniccase->bacterial = Input::get('bacterial');
            $cliniccase->fungus = Input::get('fungus');
            $cliniccase->comment = Input::get('comment');
            $cliniccase->save();
            return redirect()->route('/lab')->with('message', 'Clinic case saved successfully');
        }
    }
}
