<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Course,Category,InstructionLevel};
use DB;
class HomeController extends Controller
{
    //

    public function home($course_id = '',Request $request)
    {
        $paginate_count = 10;

        // dd(\Auth::user());
        // $instructor_id = \Auth::user()->id;
        if($request->has('search')){
            $search = $request->input('search');

            $courses = DB::table('courses')
                        ->select('courses.*','course_videos.*', 'categories.name as category_name')
                        ->leftJoin('categories', 'categories.id', '=', 'courses.category_id')
                        ->leftJoin('course_videos', 'course_videos.id', '=', 'courses.id')
                        // ->where('courses.instructor_id', $instructor_id)
                        ->where('courses.course_title', 'LIKE', '%' . $search . '%')
                        ->orWhere('courses.course_slug', 'LIKE', '%' . $search . '%')
                        ->orWhere('categories.name', 'LIKE', '%' . $search . '%')
                        ->paginate($paginate_count);
        }
        else {
            $courses = DB::table('courses')
                        ->select('courses.*','course_videos.*')
                        ->leftJoin('categories', 'categories.id', '=', 'courses.category_id')
                        ->leftJoin('course_videos', 'course_videos.course_id', '=', 'courses.id')
                        // ->where('courses.instructor_id', $instructor_id)
                        ->paginate($paginate_count);
        }
        // dd($courses);
        return view('home',compact('courses'));
    }
}
