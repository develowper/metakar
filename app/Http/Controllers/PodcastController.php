<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class PodcastController extends Controller
{
    public function index()
    {
        return Inertia::render('Podcast/Index', [
        ]);

    }
}
