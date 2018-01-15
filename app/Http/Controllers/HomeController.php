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

        return redirect('/#contact')->with('fail', 'Error al enviar');
      }

      Mail::raw($request->message, function($message) use ($request) {
        $message->to('warmeta@gmail.com', 'vetMyc')->subject($request->subject);
        $message->replyTo($request->email, $request->name);
      });

      Session::flash('suc', 'Email enviado con éxito');

      return redirect('/#contact')->with('suc', 'Email enviado con éxito');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexProjects()
    {
        $projectsCol = $this->getCollaboratorsProjects("Proyecto de investigación");

        $publicationsCol = $this->getCollaboratorsProjects("Publicación");

        $tesisCol = $this->getCollaboratorsProjects("Tesis");

        $tfgsCol = $this->getCollaboratorsProjects("Trabajo fin grado");

        $tpgsCol = $this->getCollaboratorsProjects("Trabajo Post-grado");

        $congresosCol = $this->getCollaboratorsProjects("Congreso");

        $projects = DB::table('projects')->where("project_type", "=", "Proyecto de investigación")->get();
        $publications = DB::table('projects')->where("project_type", "=", "Publicación")->get();
        $tfgs = DB::table('projects')->where("project_type", "=", "Trabajo fin grado")->get();
        $tpgs = DB::table('projects')->where("project_type", "=", "Trabajo Post-grado")->get();
        $tesis = DB::table('projects')->where("project_type", "=", "Tesis")->get();
        $congresos = DB::table('projects')->where("project_type", "=", "Congreso")->get();
        return view('research.projects', compact('projects', 'publications', 'tesis', 'tfgs', 'tpgs', 'congresos', 'projectsCol', 'publicationsCol', 'tesisCol', 'tfgsCol', 'tpgsCol', 'congresosCol'));
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexPublications()
    {
        $projectsCol = $this->getCollaboratorsProjects("Publicación");
        $projects = DB::table('projects')->where("project_type", "=", "Publicación")->get();
        return view('research.publications', compact('projects', 'projectsCol'));
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexTfg()
    {
        $projectsCol = $this->getCollaboratorsProjects("Trabajo fin grado");
        $projects = DB::table('projects')->where("project_type", "=", "Trabajo fin grado")->get();
        return view('research.tfg', compact('projects', 'projectsCol'));
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexProj()
    {
        $projectsCol = $this->getCollaboratorsProjects("Proyecto de investigación");
        $projects = DB::table('projects')->where("project_type", "=", "Proyecto de investigación")->get();
        return view('research.proj', compact('projects', 'projectsCol'));
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexTpg()
    {
        $projectsCol = $this->getCollaboratorsProjects("Trabajo Post-grado");
        $projects = DB::table('projects')->where("project_type", "=", "Trabajo Post-grado")->get();
        return view('research.tpg', compact('projects', 'projectsCol'));
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexCongresos()
    {
        $projectsCol = $this->getCollaboratorsProjects("Congreso");
        $projects = DB::table('projects')->where("project_type", "=", "Congreso")->get();
        return view('research.congreso', compact('projects', 'projectsCol'));
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexTesis()
    {
        $projectsCol = $this->getCollaboratorsProjects("Tesis");
        $projects = DB::table('projects')->where("project_type", "=", "Tesis")->get();
        return view('research.tesis', compact('projects', 'projectsCol'));
    }

    public function getCollaboratorsProjects(string $type)
    {
      return DB::table('users')
          ->join('project_collaborators', 'users.id', '=', 'project_collaborators.collaborator_id')
          ->join('projects', 'project_collaborators.project_id', '=', 'projects.id')
          ->select('name', 'project_id', 'users.link')
          ->where("projects.project_type", "=", $type)
          ->get();
    }

}
