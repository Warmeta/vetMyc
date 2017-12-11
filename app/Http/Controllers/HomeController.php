<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Mail;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function contact(Request $request) {
      $validator = Validator::make($request->all(), [
        'name' => 'required',
        'email' => 'required|email',
        'subject' => 'required',
        'message' => 'required'
      ]);

      if ($validator->fails()) {
        Session::flash('fail', 'Error al enviar');

        return redirect('/#contact');
      }

      Mail::raw($request->message, function($message) use ($request) {
        $message->to('admin@vetMyc.com', 'vetMyc')->subject($request->subject);
        $message->replyTo($request->email, $request->name);
      });

      Session::flash('suc', 'Email enviado con éxito');

      return redirect('/#contact');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexProjects()
    {
        $projects = DB::table('projects')->where("project_type", "=", "Proyecto de investigación")->get();
        $publications = DB::table('projects')->where("project_type", "=", "Publicación")->get();
        $tfgs = DB::table('projects')->where("project_type", "=", "Trabajo fin grado")->get();
        $tpgs = DB::table('projects')->where("project_type", "=", "Trabajo Post-grado")->get();
        $tesis = DB::table('projects')->where("project_type", "=", "Tesis")->get();
        $congresos = DB::table('projects')->where("project_type", "=", "Congreso")->get();
        return view('research.projects', compact('projects', 'publications', 'tesis', 'tfgs', 'tpgs', 'congresos'));
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexPublications()
    {
        $projects = DB::table('projects')->where("project_type", "=", "Publicación")->get();
        return view('research.publications', compact('projects'));
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexTfg()
    {
        $projects = DB::table('projects')->where("project_type", "=", "Trabajo fin grado")->get();
        return view('research.tfg', compact('projects'));
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexProj()
    {
        $projects = DB::table('projects')->where("project_type", "=", "Proyecto de investigación")->get();
        return view('research.proj', compact('projects'));
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexTpg()
    {
        $projects = DB::table('projects')->where("project_type", "=", "Trabajo Post-grado")->get();
        return view('research.tpg', compact('projects'));
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexCongresos()
    {
        $projects = DB::table('projects')->where("project_type", "=", "Congreso")->get();
        return view('research.congreso', compact('projects'));
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexTesis()
    {
        $projects = DB::table('projects')->where("project_type", "=", "Tesis")->get();
        return view('research.tesis', compact('projects'));
    }

}
