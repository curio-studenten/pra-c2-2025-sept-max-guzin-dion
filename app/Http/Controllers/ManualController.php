<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Brand;
use App\Models\Manual;

class ManualController extends Controller
{
    public function show($brand_id, $brand_slug, $manual_id )
    {
        $brand = Brand::findOrFail($brand_id);
        $manual = Manual::findOrFail($manual_id);

        $this->visitorCount($manual_id);

        return view('pages.manual_view', [
            "manual" => $manual,
            "brand" => $brand,
        ]);
    }

    public function visitorCount($manual_id)
    {
        // Get the manual to ensure it exists
        $manual = Manual::findOrFail($manual_id);
        
        // Check if there's already a record in visitors_manual for this manual
        $visitorRecord = DB::table('visitors_manual')->where('name_manual', $manual->name)->first();
        
        if ($visitorRecord) {
            // If record exists, increment the count
            DB::table('visitors_manual')
                ->where('name_manual', $manual->name)
                ->increment('visitors_count');
            $newCount = $visitorRecord->visitors_count + 1;
        } else {
            // If no record exists, create one with count = 1
            DB::table('visitors_manual')->insert([
                'name_manual' => $manual->name,
                'visitors_count' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ]);
            $newCount = 1;
        }

        return $newCount;
    }

    public function getVisitorCount($manual_id)
    {
        $manual = Manual::findOrFail($manual_id);
        $visitorRecord = DB::table('visitors_manual')->where('name_manual', $manual->name)->first();
        
        return $visitorRecord ? $visitorRecord->visitors_count : 0;
    }

    public function incrementCount(Request $request, $manual_id)
    {
        $newCount = $this->visitorCount($manual_id);
        return response()->json(['success' => true, 'visitors_count' => $newCount]);
    }
}
