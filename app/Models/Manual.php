<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Manual extends Model
{
    use HasFactory;

    // Returns the filesize in a human readable format
    public function getFilesizeHumanReadableAttribute()
    {
        $size = $this->filesize;
        $unit = "";

        if((!$unit && $size >= 1<<30) || $unit == "GB")
            $value = number_format($size/(1<<30),2)."GB";
        elseif((!$unit && $size >= 1<<20) || $unit == "MB")
            $value = number_format($size/(1<<20),2)."MB";
        elseif((!$unit && $size >= 1<<10) || $unit == "KB")
            $value = number_format($size/(1<<10),2)."KB";
        else
            $value = number_format($size)." bytes";

        return $value;
    }

    // Returns true if the file is locally available
    public function getLocallyAvailableAttribute()
    {
        return false;
    }

    public function getUrlAttribute()
    {
        return $this->originUrl;
    }

    // Get the visitor count for this manual
    public function getVisitorCountAttribute()
    {
        $visitorRecord = DB::table('visitors_manual')->where('name_manual', $this->name)->first();
        return $visitorRecord ? $visitorRecord->visitors_count : 0;
    }

    // RELATIE: manual behoort tot een merk
    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }
}
