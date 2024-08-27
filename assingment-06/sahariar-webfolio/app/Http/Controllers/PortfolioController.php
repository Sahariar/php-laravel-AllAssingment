<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class PortfolioController extends Controller
{
    //
    public function index()
    {
        return view('home');
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
