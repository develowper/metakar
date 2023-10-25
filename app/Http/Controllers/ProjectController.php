<?php

namespace App\Http\Controllers;

use App\Http\Helpers\Variable;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ProjectController extends Controller
{
    public function new(Request $request)
    {

        return Inertia::render('Project/Create', [
            'items' => Variable::PROJECT_ITEMS,
        ]);
    }
}
