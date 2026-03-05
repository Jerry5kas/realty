<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Property;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $banners = Banner::active()
            ->forPage('home')
            ->forSection('hero')
            ->ordered()
            ->get();
        
        return view('home', compact('banners'));
    }
}
