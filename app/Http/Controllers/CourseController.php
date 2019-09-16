<?php

namespace App\Http\Controllers;

use App\Course;
use App\Lesson;
use Illuminate\Http\Request;
use Auth;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $courses = Course::where('creator', Auth::user()->id)
            ->orderBy('active', 'DESC')
            ->orderBy('title', 'ASC')
            ->orderBy('group', 'ASC')
            ->get();
        
        return view('courses.index')
            ->with(compact('courses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $course = new Course();
        return view('courses.form')
            ->with(compact('course'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate(request(), [
            'title' => 'required|string',
            'year' => 'required|string',
            'group' => 'required|string',
            'options' => 'nullable'
        ]);

        $course = new Course();
        $course->title = $request->title;
        $course->year = $request->year;
        $course->group = $request->group;
        $course->options = $request->options == null
                                                ? null
                                                : json_encode(array_map('trim', explode(',', $request->options)));
        $course->creator = Auth::user()->id;
        $course->save();

        return redirect()->route('courses.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function show(Course $course)
    {
        $lessons = $course->lessons()->orderBy('date')->get();
        return view('courses.show')
            ->with(compact('course'))
            ->with(compact('lessons'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function edit(Course $course)
    {
        return view('courses.form')
            ->with(compact('course'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Course $course)
    {
        $this->validate(request(), [
            'title' => 'required|string',
            'year' => 'required|string',
            'group' => 'required|string',
            'options' => 'nullable'
        ]);

        $course->title = $request->title;
        $course->year = $request->year;
        $course->group = $request->group;
        $course->options = $request->options == null
                                                ? null
                                                : json_encode(array_map('trim', explode(',', $request->options)));
        $course->save();

        return redirect()->route('courses.index');
    }

    public function delete(Course $course)
    {
        return view('courses.delete')
            ->with(compact('course'));
    }

    public function destroy(Course $course)
    {
        $course->delete();
        return redirect()->route('courses.index');
    }

    public function close(Course $course)
    {
        $course->active = false;
        $course->save();
        return redirect()->route('courses.index');
    }
}
