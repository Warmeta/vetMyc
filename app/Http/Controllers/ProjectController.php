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
        }elseif (Voyager::can('browse_projects')) {
            $project = new Project();
            $project->fill(['project_name' => $request->project_name]);
            $project->fill(['description' => $request->description]);
            $project->fill(['project_type' => $request->project_type]);
            $project->fill(['research_line' => $request->research_line]);
            $project->fill(['project_status' => $request->project_status]);
            $project->fill(['publication_date' => $request->publication_date]);
            $project->fill(['entity' => $request->entity]);
            $project->fill(['link' => $request->link]);
            $project->fill(['file' => $request->file]);
            $project->fill(['author_id' => Auth::user()->id]);
            if (Input::hasFile('image')) {
                $file = $request->image;
                $random_name = str_random(8);
                $destinationPath = 'storage/projects';
                $extension = $file->getClientOriginalExtension();
                $filename= $random_name.'_proj_img.'.$extension;
                $uploadSuccess = Input::file('image')->move($destinationPath, $filename);
            }
            $project->fill(['image' => 'projects/'.$filename]);
              $array = $project->toArray();
            $project = Project::create($array);
          
            return Redirect::to('/project-manager')->with('message', 'Project created successfully.');
        } else {
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
                ->withErrors(ProjectController::validateClinicCase($request))
                ->withInput();
        }elseif (Voyager::can('browse_projects')) {
            $project = Project::find($request->id);
            $project->update($request->all());

            return Redirect::to('/project-manager')->with('message', 'Project '.$request->number_clinic_history.' updated successfully.');
        } else {
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
    }
    
    public function validateProject($request)
    {
        return Validator::make($request->all(), [
            'project_name' => 'required|max:30',
            'description' => 'required|max:190',
            'image' => 'required|max:50',
            'project_type' => 'required|max:50',
            'research_line' => 'required|max:50',
            'publication_date' => 'required',
            'entity' => 'required|max:30',
            'project_status' => 'required|max:30',
            'link' => 'nullable|max:50',
            'file' => 'nullable|max:190',
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