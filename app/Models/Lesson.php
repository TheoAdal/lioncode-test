<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    protected $table = 'lessons';

    public function eventTopicLessonInstructors()
    {
        return $this->hasMany(EventTopicLessonInstructor::class);
    }
    
    public function topics()
    {
        return $this->belongsToMany(Topic::class, 'event_topic_lesson_instructor', 'lesson_id', 'topic_id')
                    ->distinct();
    }
    
    public function instructors()
    {
        return $this->belongsToMany(Instructor::class, 'event_topic_lesson_instructor', 'lesson_id', 'instructor_id')
                    ->distinct();
    }
    
}
