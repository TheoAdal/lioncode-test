<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Instructor extends Model
{
    use HasFactory;
    protected $table = 'instructors';

    public function eventTopicLessonInstructors()
    {
        return $this->hasMany(EventTopicLessonInstructor::class);
    }
    
    public function lessons()
    {
        return $this->belongsToMany(Lesson::class, 'event_topic_lesson_instructor', 'instructor_id', 'lesson_id')
                    ->distinct();
    }
}
