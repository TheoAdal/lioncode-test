<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;
    protected $table = 'events';

    public function user()
    {
        return $this->belongsToMany(User::class, 'event_user', 'event_id', 'user_id');
    }

    public function eventTopicLessonInstructors()
    {
        return $this->hasMany(EventTopicLessonInstructor::class);
    }

    public function topics()
    {
        return $this->belongsToMany(Topic::class, 'event_topic_lesson_instructor')
                    ->distinct();
    }

    public function lessons()
    {
        return $this->hasMany(EventTopicLessonInstructor::class, 'event_id')->with('lesson');
    }

    public function instructors()
    {
        return $this->hasMany(EventTopicLessonInstructor::class, 'event_id')->select('instructor_id')->distinct();
    }

}
