<?php

namespace App\Http\Controllers;

use App\Http\Resources\ApplicationsResource;
use App\Http\Resources\ProjectResource;
use App\Http\Resources\SkillResource;
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
        $applications = ApplicationsResource::collection(Applications::with('project')->get());
        return Inertia::render('Applications/index', compact('applications'));
    }

    public function download(Request $request)
    {
        // @TODO add this to Storage controller
        // call this with {url : application.cv}
        // in Vue, gotta do smt like window.redirect('download', {url: application.cv});
        Storage::download($request->url);
    }

    public function applicationsJobs()
    {
        $skills = SkillResource::collection(Skill::all());
        $projects = ProjectResource::collection(Project::with('skill')->get());
        return Inertia::render('Applications/Applications', compact('projects', 'skills'));
    }

    public function create()
    {
        $skills = Skill::all();
        $projects = Project::all();
        return Inertia::render('Applications/create', compact('skills', 'projects'));
    }

    /**
     * Display the resource.
     * @param  Applications  $applications
     * @return \Inertia\Response
     */
    public function show(Applications $applications) {
        return Inertia::render('Applications/show', compact('applications'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {

        $validated = $request->validate([
            'skills' => ['required'],
            'name' => ['required', 'min:3'],
            'cv'=> ['required', 'file'],
            'cover_letter' => ['required', 'file'],
            'project_id' => ['required', 'int'],
        ]);
        $route = auth()->user()->is_recruiter ? 'applications.index' : 'welcome';
        if($request->hasFile('cv') && $request->hasFile('cover_letter')){
            $cv = $request->file('cv')->store('applications');
            $cover_letter = $request->file('cover_letter')->store('applications');

            $application = Applications::create([
                'skills' => $validated['skills'],
                'name' => $validated['name'],
                'cv' => $cv,
                'cover_letter' => $cover_letter,
                'project_id' => $validated['project_id'],
            ]);
            return Redirect::route($route)->with('message', 'Application created successfully.');
        }
        return Redirect::back();
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Applications  $applications
     * @return \Inertia\Response
     */

    public function edit(Applications $application)
    {
        $skills = Skill::all();
        $project = $application->project;
        return Inertia::render('Applications/edit', compact('project', 'skills','application'));
    }

    public function update(Request $request, Applications $application)
    {
        // @TODO change $projcet to $application
        $cv = $application->cv;
        $cover_letter = $application->cover_letter;
        $request->validate([
            'name' => ['required', 'min:3'],
            'skills' => ['required'],
        ]);
        if($request->hasFile('cv')){
            Storage::delete($application->cv);
            $cv = $request->file('cv')->store('applications');
        }

        if($request->hasFile('cover_letter')){
            Storage::delete($application->cover_letter);
            $cover_letter = $request->file('cover_letter')->store('applications');
        }
        $application->update([
            'name' => $request->name,
            'skills' => $request->skills,
            'cv' => $cv,
            'cover_letter' =>$cover_letter,
        ]);
        return Redirect::route('applications.index')->with('message', 'Application updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Applications  $applications
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Applications $application)
    {
        Storage::delete($application->cv);
        Storage::delete($application->cover_letter);
        $application->delete();
        return Redirect::back()->with('message', 'Application deleted successfully.');
    }
}
