<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand;
use App\Models\Manual;
use DB;

class BrandController extends Controller
{
    public function show($brand_id, $brand_slug)
    {

        $brand = Brand::findOrFail($brand_id);
        $manuals = Manual::all()->where('brand_id', $brand_id);

        $visitorCounts = DB::table('visitors_manual')
            ->where('name_manual', $brand_id)
            ->pluck('visitors_count');

        if($visitorCounts->isEmpty()) {
            $visitorCounts = [];
        } else {
            $visitorCounts = $visitorCounts->toArray();
        }

        return view('pages.manual_list', [
            "brand" => $brand,
            "manuals" => $manuals,
            "visitorCounts" => $visitorCounts
        ]);
    }
}
