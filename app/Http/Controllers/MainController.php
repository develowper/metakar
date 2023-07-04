<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class MainController extends Controller
{
    public function makeMoneyPage()
    {

        return Inertia::render('MakeMoney', [
        ]);

    }
}
