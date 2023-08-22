<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Banner;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ArticleController extends Controller
{
    public function index()
    {
        return Inertia::render('Article/Index', [
            'categories' => Article::categories(),
        ]);

    }
}
