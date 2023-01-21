<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class StudentController extends Controller {

    public function index() {
        // dd('aa');

        $students = User::where('is_active', '1')->get()->toArray();
        $update = User::update(['is_verified' => 1]);
        return view('admin.student.index', compact('students'));
    }

}
