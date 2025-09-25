<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VisitorsManual extends Model
{
    protected $table = 'visitors_manual';
    protected $fillable = ['name_manual', 'visitors_count'];

    // Accessor to encode the name for URLs
    public function getNameUrlEncodedAttribute()
    {
        return urlencode($this->name_manual);
    }
}
