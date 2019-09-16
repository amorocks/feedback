<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\User;
use App\Course;
use App\Lesson;

class NewMessage extends Mailable
{
    use Queueable, SerializesModels;

    protected $sender, $recipient, $data, $course, $lesson;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $sender, User $recipient, $data, Course $course, Lesson $lesson)
    {
        $this->sender = $sender;
        $this->recipient = $recipient;
        $this->data = $data;
        $this->course = $course;
        $this->lesson = $lesson;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $this->data['firstname'] = explode(' ', $this->data['name'])[0];
        $this->from($this->sender->email, $this->sender->name);
        $this->subject('Nieuwe feedback voor ' . $this->course->title . ' - ' . ($this->lesson->title ?? $this->lesson->date));

        return $this->view('emails.newmessage')
                ->with('data', $this->data)
                ->with('sender', $this->sender)
                ->with('course', $this->course)
                ->with('lesson', $this->lesson);
    }
}
