<?php

namespace App\Http\Controllers;

use App\Course;
use App\Lesson;
use Illuminate\Http\Request;
use \StudioKaa\Amoclient\Facades\AmoAPI;

class LessonController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Course $course)
    {
        $lesson = new Lesson();
        return view('lessons.form')
            ->with(compact('course'))
            ->with(compact('lesson'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Course $course, Request $request)
    {
        $this->validate(request(), [
            'title' => 'nullable|string',
            'date' => 'required|string'
        ]);

        $lesson = new Lesson();
        $lesson->title = $request->title;
        $lesson->date = $request->date;
        $course->lessons()->save($lesson);

        return redirect()->route('courses.lessons.show', [$course, $lesson]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Lesson  $lesson
     * @return \Illuminate\Http\Response
     */
    public function show(Course $course, Lesson $lesson)
    {
        $users = $lesson->users;

        if(!$lesson->active)
        {
            return view('lessons.closed')
                ->with(compact('course'))
                ->with(compact('lesson'))
                ->with(compact('users'));
        }

        if($users->count() < 1)
        {
            $group = AmoAPI::get('groups/find/' . $course->group);
            $users = $group['users'];
            usort($users, function($a, $b){return strcmp($a['name'], $b['name']); }); 
        }

        return view('lessons.show')
            ->with(compact('course'))
            ->with(compact('lesson'))
            ->with(compact('users'));
    }

    public function delete(Course $course, Lesson $lesson)
    {
        return view('lessons.delete')
            ->with(compact('course'))
            ->with(compact('lesson'));
    }

    public function destroy(Course $course, Lesson $lesson)
    {
        $lesson->delete();
        return redirect()->route('courses.show', $course);
    }
}
