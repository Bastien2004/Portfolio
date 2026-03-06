<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::all();
        return view('welcome', compact('projects'));
    }

    public function create()
    {
        return view('create');
    }

    public function store(Request $request)
    {
        // 1. On vérifie les données
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'file' => 'nullable|file|max:20480', // 20Mo max
        ]);

        // 2. On gère l'upload du fichier
        $path = null;
        if ($request->hasFile('file')) {
            $path = $request->file('file')->store('projects', 'public');
        }

        // 3. On enregistre en base de données
        Project::create([
            'title' => $request->title,
            'description' => $request->description,
            'file_path' => $path,
        ]);

        return redirect()->route('projects.index');
    }
}
