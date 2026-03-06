<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\ProjectFile;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::with('files')->latest()->get();
        return view('welcome', compact('projects'));
    }

    public function create()
    {
        return view('create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'url'         => 'nullable|url|max:255',
            'github'      => 'nullable|url|max:255',
            'tags'        => 'nullable|string|max:255',
            'files.*'     => 'nullable|file|max:20480', // 20Mo par fichier
            'is_featured' => 'nullable|boolean',
        ]);

        // 1. Créer le projet
        $project = Project::create([
            'title'       => $request->title,
            'description' => $request->description,
            'url'         => $request->url,
            'github'      => $request->github,
            'tags'        => $request->tags,
            'is_featured' => $request->boolean('is_featured'),
        ]);

        // 2. Enregistrer chaque fichier uploadé
        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $file) {
                $path = $file->store('projects', 'public');
                $project->files()->create([
                    'file_path'  => $path,
                    'file_name'  => $file->getClientOriginalName(),
                    'file_type'  => $file->getClientMimeType(),
                    'file_size'  => $file->getSize(),
                ]);
            }
        }

        return redirect()->route('projects.index')->with('success', 'Projet ajouté avec succès !');
    }

    public function destroy(Project $project)
    {
        // Supprimer les fichiers physiques
        foreach ($project->files as $file) {
            \Storage::disk('public')->delete($file->file_path);
        }
        $project->delete();

        return redirect()->route('projects.index')->with('success', 'Projet supprimé.');
    }
}
