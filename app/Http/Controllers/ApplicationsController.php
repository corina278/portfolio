<?php

namespace App\Http\Controllers;

use App\Http\Resources\ApplicationsResource;
use App\Models\Applications;
use App\Models\Project;
use App\Models\Skill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class ApplicationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */
    public function index()
    {
        $applications = ApplicationsResource::collection(Applications::with('project_url')->get());
        return Inertia::render('applications/index', compact('applications'));
    }

//    public function applications()
//    {
//
//        return Inertia::render('Applications', compact('skills', 'projects'));
//    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Inertia\Response
     */
    public function create()
    {
        $projects = Project::with('project_url')->get();
        return Inertia::render('applications/create', compact('projects'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'min:3'],
            'skill_id' => ['required'],
            'project_url' => ['required'],
            'project_id' => ['required']
        ]);

        if($request->hasFile('image')){
            $image = $request->file('image')->store('applications');
            Applications::create([
                'skill_id' => $request->skill_id,
                'name' => $request->name,
                'project_url' => $request->project_url,
                'project_id' => $request->project_id,
                'cv' => $request->cv,
                'cover_letter' => $request->cover_letter
            ]);

            return Redirect::route('applications/index')->with('message', 'Application created successfully.');
        }
        return Redirect::back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Inertia\Response
     */
    public function edit(Applications $applications)
    {
        $projects = Project::with('project_url')->get();
        return Inertia::render('applications/Edit', compact('applications', 'projects'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Applications $applications)
    {
        $image = $project->image;
        $request->validate([
            'name' => ['required', 'min:3'],
            'skill_id' => ['required']
        ]);
        if($request->hasFile('image')){
            Storage::delete($project->image);
            $image = $request->file('image')->store('projects');
        }

        $project->update([
            'name' => $request->name,
            'skill_id' => $request->skill_id,
            'project_url' => $request->project_url,
            'image' => $image
        ]);
        return Redirect::route('projects.index')->with('message', 'Project updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
