<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use \StudioKaa\Amoclient\Facades\AmoAPI;
use Auth;

use App\Course;
use App\Lesson;
use App\User;
use App\Mail\NewMessage;

class MessageController extends Controller
{
    public function save(Course $course, Lesson $lesson, Request $request)
    {
    	foreach($request->users as $u)
    	{
    		$user = User::find($u['id']);
    		if(!$user)
			{
				$user = new User();
				$user->id = $u['id'];
				$user->name = $u['name'];
				$user->email = "D" . $u['id'] . "@edu.rocwb.nl";
				$user->type = "student";
				$user->save();
			}

    		$lesson->users()->syncWithoutDetaching([$user->id => [
    			"message" => $u['message'],
    			"options" => json_encode(array_map('trim', $u['options'] ?? array()))
    		]]);

    		if($request->submit == 'close')
    		{
				Mail::to($user->email)->send(new NewMessage(Auth::user(), $user, $u, $course, $lesson));
    		}
    		
    	}

    	if($request->submit == 'close')
    	{
	   		$lesson->active = false;
    		$lesson->save();
    	}

    	return redirect()->back();
    }

    public function overview(Course $course)
    {
    	//Let's assume user-list of the last lesson is correct
    	$users = $course->lessons->last()->users;

    	//Get all lessons, ordered by date
        $lessons = $course->lessons()->orderBy('date')->get();

        //Loop through all users
        foreach($users as $user)
        {
        	//Load all the users lessons in this course, orderd by date
        	$user->data = $user->lessons()->where('course_id', $course->id)->orderBy('date')->get();

        	//Set-up counter variable
        	$counter = array();
        	foreach($course->options as $option)
        	{
        		$counter[$option] = 0;
        	}

        	//Add-up all my options across the lessons in this course
        	foreach($user->data as $lesson)
        	{
        		foreach($lesson->pivot->options as $option)
				{
					$counter[$option] = ($counter[$option] ?? 0) + 1;
				}
        	}
        	$user->counter = $counter;
        }

    	return view('courses.overview')
    		->with(compact('course'))
    		->with(compact('users'))
    		->with(compact('lessons'));
    }
}
