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
        $applications = ApplicationsResource::collection(Applications::with('project')->get());
        return Inertia::render('Applications/index', compact('applications'));
    }

    public function create()
    {
        $skills = Skill::all();
        $projects = Project::with('applications')->whereHas('applications')->get();
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
            'name' => ['required', 'min:3'],
            'skills' => ['required', 'array'],
            'cv'=> ['required', 'file'],
            'cover_letter' => ['required', 'file'],
            'project_id' => ['nullable', 'string']
        ]);

        if($request->hasFile('cv') && $request->hasFile('cover_letter')){
            $cv = $request->file('cv')->store('applications');
            $cover_letter = $request->file('cover_letter')->store('applications');
            Applications::create([
                'skills' => $validated['skills'],
                'name' => $validated['name'],
                'project_url' => $validated['project_url'],
                'cv' => $validated['cv'],
                'cover_letter' => $validated['cover_letter'],
            ]);

            return Redirect::route('Applications.index')->with('message', 'Application created successfully.');
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
        // @TODO change $projcet to $applications
        $cv = $applications->cv;
        $cover_letter = $applications->cover_letter;
        $request->validate([
            'name' => ['required', 'min:3'],
            'skill_id' => ['required'],
            'project_id' => ['required'],
        ]);
        if($request->hasFile('cv')){
            Storage::delete($applications->cv);
            $cv = $request->file('cv')->store('applications');
        }

        if($request->hasFile('cover_letter')){
            Storage::delete($applications->cover_letter);
            $cover_letter = $request->file('cover_letter')->store('applications');
        }

        $applications->update([
            'name' => $request->name,
            'skill_id' => $request->skill_id,
            'project_id' => $request->project_id,
            'cv' => $cv,
            'cover_letter' =>$cover_letter,
        ]);
        return Redirect::route('Applications.index')->with('message', 'Application updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Applications  $applications
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Applications $applications)
    {
        Storage::delete($applications->cv);
        Storage::delete($applications->cover_letter);
        $applications->delete();
        return Redirect::back()->with('message', 'Application deleted successfully.');
    }
}
