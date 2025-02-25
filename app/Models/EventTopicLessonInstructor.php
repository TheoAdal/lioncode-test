<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EventTopicLessonInstructor extends Model
{
    protected $table = 'event_topic_lesson_instructor';
    public $timestamps = false;

    protected $fillable = ['event_id', 'topic_id', 'lesson_id', 'instructor_id'];

    public function event()
    {
        return $this->belongsTo(Event::class, 'event_id');
    }

    public function topic()
    {
        return $this->belongsTo(Topic::class, 'topic_id');
    }

    public function lesson()
    {
        return $this->belongsTo(Lesson::class, 'lesson_id');
    }

    public function instructor()
    {
        return $this->belongsTo(Instructor::class, 'instructor_id');
    }
}
