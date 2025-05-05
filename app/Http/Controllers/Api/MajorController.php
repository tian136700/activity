<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Major;

class MajorController extends Controller
{
    // GET /api/majors/{id}/classes
    public function classes($id)
    {
        return Major::findOrFail($id)
            ->classes()
            ->select('id', 'year', 'class_number')
            ->get();
    }


}
