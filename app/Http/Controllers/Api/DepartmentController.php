<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    // GET /api/departments
    public function index()
    {
        return Department::select('id', 'name')->get();
    }

    // GET /api/departments/{id}/majors
    public function majors($id)
    {
        return Department::findOrFail($id)
            ->majors()
            ->select('id', 'name')
            ->get();
    }
}
