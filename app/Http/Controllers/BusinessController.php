<?php

namespace App\Http\Controllers;

use App\Models\Business;
use App\Models\Category;
use App\Models\County;
use App\Models\Province;
use Illuminate\Http\Request;
use Inertia\Inertia;

class BusinessController extends Controller
{
    public function index()
    {
        return Inertia::render('Business/Index', [
            'provinces' => Province::all(),
            'counties' => County::all(),
            'categories' => Business::categories(),
        ]);

    }
}
