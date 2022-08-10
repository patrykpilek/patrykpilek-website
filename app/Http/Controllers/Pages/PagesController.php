<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PagesController extends Controller
{
    public function home()
    {
        return Inertia::render('Home/Show');
    }

    public function blog()
    {
        return Inertia::render('Blog/Show');
    }

    public function contact()
    {
        return Inertia::render('Contact/Show');
    }
}
