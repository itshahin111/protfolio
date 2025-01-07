<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProjectResource;
use Inertia\Inertia;
use App\Models\Skill;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // return inertia('Projects/Index', [
        //     'projects' => auth()->user()->projects,
        // ]);
        $projects = ProjectResource::collection(Project::with('skill')->get());
        return Inertia::render('Projects/Index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $projects = ProjectResource::collection(Project::all());
        return Inertia::render('Projects/Create', compact('skills'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'image' => ['required', 'file', 'max:4048', 'mimes:png,jpeg'], // Fixed image validation
            'skill_id' => ['required'], // Ensure this is a single value, or use 'array' for multiple
            'project_url' => ['required'], // Added project URL validation
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $name = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/skills', $name);

            // Ensure correct model and fields
            Project::create([
                'skill_id' => $request->skill_id,
                'name' => $request->name,
                'image' => $name,
                'project_url' => $request->project_url,
                'user_id' => auth()->user()->id,
            ]);

            // Attach skill(s)
            // $project->skills()->attach($request->skill_id); // Ensure skill_id is processed correctly

            return redirect()->route('projects.index');
        }

        return redirect()->back()->withErrors(['image' => 'Image upload failed.']);
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
