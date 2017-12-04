<?php

namespace App\Http\Controllers;

use App\Project;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Validator;
use TCG\Voyager\Facades\Voyager;
use Mail;
use App\Mail\ClinicCaseSent;
use Arrilot\Widgets\Facade as Widget;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Constraint;
use Intervention\Image\Facades\Image;
use TCG\Voyager\Traits\AlertsMessages;
use Illuminate\Support\Facades\Input;

class ProjectController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      if (Voyager::can('browse_admin')) {
        $projects = DB::table('projects')->get()->all();
        return view('projectManager.index', compact('projects'));
      }else if (Voyager::can('browse_projects')){
        $projects = $this->getUserProjects();
        return view('projectManager.index', compact('projects'));
      }else{
        Session::flash('fail', 'No tienes los permisos necesarios.');
        return Redirect::to('/');
      }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Voyager::can('add_projects')) {
            $sta = ProjectController::getStatusOptions();
            $researchers = ProjectController::getResarchersUsers();
            return view('projectManager.create')->with('data', [
                'status' => $sta,
                'researchers' => $researchers
            ]);
        } else {
            return Redirect::to('/project-manager');
        }
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (ProjectController::validateProject($request)->fails()) {
            return redirect('/project-manager/create')
                ->withErrors(ProjectController::validateProject($request))
                ->withInput();
        } else if (Voyager::can('add_projects')) {
            $project = new Project();
            $project->author_id = Auth::user()->id;
            $project->fill($request->all());

            if ($request->hasFile('image')) {
              $name = md5(time()).'.'.$request->image->getClientOriginalExtension();
              $filePath =  'projects/'.$name;
              \Storage::disk('s3')->put($filePath, file_get_contents($request->image), 'public');
              $project->image = \Storage::disk('s3')->url($filePath);
            }else{
              $project->image = '/images/portfolio/portfolio8.jpg';
            }
            if ($request->hasFile('file')) {
              $name = md5(time()).'.'.$request->file->getClientOriginalExtension();
              $filePath =  'projects/'.$name;
              \Storage::disk('s3')->put($filePath, file_get_contents($request->file), 'public');
              $project->file = \Storage::disk('s3')->url($filePath);
            }
            $project->save();

            $project->collaborators()->attach($request->researchers, ['rol' => 'Investigador']);
            $project->collaborators()->attach($request->collaborators, ['rol' => 'Colaborador']);

            Session::flash('suc', 'Proyecto creado correctamente');
            return Redirect::to('/project-manager');
        } else {
            Session::flash('fail', 'Proyecto no se ha podido crear');
            return Redirect::to('/project-manager');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      if (Voyager::can('read_projects')) {
        session(['project_id' => $id]);

        $project = Project::find($id);
        $user = User::where('id', $project->author_id)->first();
        $user = $user->name;
        // show
        return View::make('projectManager.show')
        ->with('project', $project)->with('user', $user);
      }else{
        Session::flash('fail', 'No tienes los permisos necesarios.');
        return Redirect::to('/project-manager');
      }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $project = Project::find($id);
        $sta = ProjectController::getStatusOptions();
        $researchers = ProjectController::getResarchersUsers();

        $data = collect([
            'status' => $sta,
            'researchers' => $researchers
        ]);

        $projcoll = DB::table('project_collaborators')->where('project_id', $project->id)->get();
        $researchers = [];
        $collaborators = [];

        foreach ($projcoll as $rel){
            if ($rel->rol == 'Colaborador') {
              $collaborators[] = $rel;
            }
            if ($rel->rol == 'Investigador') {
              $researchers[] = $rel;
            }
        }

        $researchers = collect($researchers)->pluck('collaborator_id')->all();
        $collaborators = collect($collaborators)->pluck('collaborator_id')->all();

        return View::make('projectManager.edit', compact('project', 'data', 'researchers', 'collaborators'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request){
        if (ProjectController::validateProject($request)->fails()) {
            return redirect('/project-manager/'.$request->id.'/edit')
                ->withErrors(ProjectController::validateProject($request))
                ->withInput();
        } else if (Voyager::can('edit_projects')) {
            $project = Project::find($request->id);
            $project->fill($request->all());
            if ($request->hasFile('image')) {
              $name = md5(time()).'.'.$request->image->getClientOriginalExtension();
              $filePath =  'projects/'.$name;
              \Storage::disk('s3')->put($filePath, file_get_contents($request->image), 'public');
              $project->image = \Storage::disk('s3')->url($filePath);
            }
            if ($request->hasFile('file')) {
              $name = md5(time()).'.'.$request->file->getClientOriginalExtension();
              $filePath =  'projects/'.$name;
              \Storage::disk('s3')->put($filePath, file_get_contents($request->file), 'public');
              $project->file = \Storage::disk('s3')->url($filePath);
            }
            $project->save();

            $project->collaborators()->detach();
            $project->collaborators()->attach($request->researchers, ['rol' => 'Investigador']);
            $project->collaborators()->attach($request->collaborators, ['rol' => 'Colaborador']);

            Session::flash('suc', 'Proyecto editado correctamente');
            return Redirect::to('/project-manager');
        } else {
            Session::flash('fail', 'Proyecto no se ha editado correctamente');
            return Redirect::to('/project-manager');
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      if (Voyager::can('delete_projects')) {
        $project = Project::find($id);
        $project->collaborators()->detach();
        $project->delete();

        return response()->json(['success' => true]);
      }else{
        Session::flash('fail', 'No tienes los permisos necesarios.');
        return Redirect::to('/project-manager');
      }
    }

    public function validateProject($request)
    {
        return Validator::make($request->all(), [
            'project_name' => 'required|max:200',
            'description' => 'required|max:200',
            'image' => 'sometimes|mimes:jpeg,jpg,png,gif|max:1000',
            'project_type' => 'required|max:50',
            'research_line' => 'required|max:120',
            'publication_date' => 'required',
            'entity' => 'required|max:120',
            'project_status' => 'required|max:30',
            'link' => 'sometimes|max:200',
            'file' => 'sometimes|max:6000',
        ]);
    }

    public function randStr() {

        $length = 12;

        return substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length);
    }

    public function getStatusOptions()
    {
        return ['inprogress' => 'En progreso','finished' => 'Terminado'];
    }

    public function getResarchersUsers()
    {
        $researcher_role = DB::table('roles')->where('name', 'investigador')->first();
        $researchers = DB::table('users')->where('role_id', $researcher_role->id)->get();
        $researchers = $researchers->toArray();

        return $researchers;
    }

    public function getUserProjects()
    {
        $user_id = Auth::user()->id;
        $projects_id = DB::table('project_collaborators')->where('collaborator_id', $user_id)->get();
        $collection = collect([]);
        foreach ($projects_id as $project_id) {
          $project = DB::table('projects')->where('id', $project_id->project_id)->first();
          $collection->push($project);
        }
        return $collection;
    }

}
