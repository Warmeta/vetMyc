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
        $projects = DB::table('projects')->get()->all();
        $collection = collect($projects);
        return view('projectManager.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Voyager::can('browse_projects')) {
            $sta = ProjectController::getStatusOptions();
            $data = collect([
                'status' => $sta
            ]);
            return view('projectManager.create')->with('data', $data);
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
        } else if (Voyager::can('browse_projects')) {
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
        session(['project_id' => $id]);

        $project = Project::find($id);
        $user = User::where('id', $project->author_id)->first();
        $user = $user->name;
        // show
        return View::make('projectManager.show')
            ->with('project', $project)->with('user', $user);
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
        $data = collect([
            'status' => $sta
        ]);

        // show the edit form
        return View::make('projectManager.edit', compact('project', 'data'));
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
        } else if (Voyager::can('browse_projects')) {
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
        Project::destroy($id);
        Session::flash('suc', 'Proyecto borrado correctamente');
    }

    public function validateProject($request)
    {
        return Validator::make($request->all(), [
            'project_name' => 'required|max:200',
            'description' => 'required|max:200',
            'image' => 'nullable|image|max:1000',
            'project_type' => 'required|max:50',
            'research_line' => 'required|max:120',
            'publication_date' => 'required',
            'entity' => 'required|max:120',
            'project_status' => 'required|max:30',
            'link' => 'nullable|max:200',
            'file' => 'nullable|max:6000',
        ]);
    }

    public function randStr() {

        $length = 12;

        return substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length);
    }

    public function getStatusOptions()
    {
        return ['inprogress' => 'In progress','finished' => 'Finished'];
    }

}
