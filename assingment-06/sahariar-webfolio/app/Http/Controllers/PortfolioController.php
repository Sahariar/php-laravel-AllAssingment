<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class PortfolioController extends Controller
{
    //
    public function index()
    {
        $allProjects = json_decode(File::get(storage_path('data/projects.json')), true);
                // Limit the number of projects displayed on the homepage (e.g., show only 6)
                $projects = array_slice($allProjects, 0, 4);

                // Pass the limited projects data to the homepage view
                return view('home', compact('projects'));
    }
    public function projects()
    {
    $projects = json_decode(File::get(storage_path('data/projects.json')), true);
    return view('project.index',compact('projects'));
    }
    public function projectDetails($id)
    {
    $projects = json_decode(File::get(storage_path('data/projects.json')), true);
    $project = collect($projects)->firstWhere('id', $id);
    // dd($project);
    if ($project) {
        return view('project.single', compact('project'));
    } else {
        return abort(404, 'Project not found');
    }
    }
}
