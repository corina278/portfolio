<?php

namespace App\Http\Controllers;

use App\Http\Resources\ApplicationsResource;
use App\Http\Resources\ProjectResource;
use App\Http\Resources\SkillResource;
use App\Models\Applications;
use App\Models\Project;
use App\Models\Skill;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ReportsController extends Controller
{
    public function skillsReport(){
        return Inertia::render('Reports/SkillsReport');
    }

    public function getSkills(Request $request) {

        $start = date('Y-m-d', strtotime("+1 months", strtotime($request->get('startDate'))));
        $end = date('Y-m-d', strtotime("+1 months", strtotime($request->get('endDate'))));
        $dates = [$start, $end];
        $skills = Skill::whereBetween('updated_at', $dates)->get();

        return response()->json(SkillResource::collection($skills));
    }

    public function projectReport(){
        return Inertia::render('Reports/ProjectsReport');
    }

    public function getProjects(Request $request){
        $start = date('Y-m-d', strtotime("+1 months", strtotime($request->get('startDate'))));
        $end = date('Y-m-d', strtotime("+1 months", strtotime($request->get('endDate'))));
        $dates = [$start, $end];

        $projects = Project::whereBetween('updated_at', $dates)->get();

        return response()->json(ProjectResource::collection($projects));

    }

    public function applicationsReport(){
        return Inertia::render('Reports/ApplicationsReport');
    }

    public function getApplications(Request $request) {
        $start = date('Y-m-d', strtotime("+1 months", strtotime($request->get('startDate'))));
        $end = date('Y-m-d', strtotime("+1 months", strtotime($request->get('endDate'))));
        $dates = [$start, $end];

        $project = $request->has('project') ? $request->get('project') : null;

        $applications = Applications::whereBetween('updated_at', $dates)
                ->with('project')
                ->when($project, function($query) use ($project) {
                    $query->where('project_id', $project);
                })->get();

        return response()->json(ApplicationsResource::collection($applications));
    }

}
