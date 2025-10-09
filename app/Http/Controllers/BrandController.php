<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand;
use App\Models\Manual;
use App\Models\Category;
use Illuminate\Support\Facades\DB;

class BrandController extends Controller
{
    public function show($brand_id, $brand_slug)
    {
        $brand = Brand::findOrFail($brand_id);
        $manuals = Manual::where('brand_id', $brand_id)->get();
        
        // Haal de 5 populairste handleidingen op voor dit merk
        $popularManuals = Manual::where('brand_id', $brand_id)
            ->join('visitors_manual', 'manuals.id', '=', 'visitors_manual.name_manual')
            ->orderBy('visitors_manual.visitors_count', 'desc')
            ->select('manuals.*', 'visitors_manual.visitors_count')
            ->take(5)
            ->get();

        $visitorCounts = DB::table('visitors_manual')
            ->where('name_manual', $brand_id)
            ->pluck('visitors_count');

        if ($visitorCounts->isEmpty()) {
            $visitorCounts = [];
        } else {
            $visitorCounts = $visitorCounts->toArray();
        }

        return view('pages.manual_list', [
            'brand' => $brand,
            'manuals' => $manuals,
            'popularManuals' => $popularManuals,
            'visitorCounts' => $visitorCounts,
        ]);
    }

    public function showCategories()
    {
        $categories = Category::with('brands.models')->get();
        return view('pages.categories', compact('categories'));
    }
}
