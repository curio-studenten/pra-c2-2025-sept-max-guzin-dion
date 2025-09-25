<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VisitorsManual;

class manualvisitorscontroller extends Controller
{
    public function index()
    {
        $brands = VisitorsManual::orderBy('name_manual')->get();
        $topBrands = VisitorsManual::orderByDesc('visitors_count')->take(10)->get();

        return view('pages.homepage', compact('brands', 'topBrands'));
    }
}
