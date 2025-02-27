<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Topic extends Model
{
    use HasFactory;

    protected $table = 'topics';

    public function eventTopicLessonInstructors()
    {
        return $this->hasMany(EventTopicLessonInstructor::class);
    }
    
    public function events()
    {
        return $this->belongsToMany(Event::class, 'event_topic_lesson_instructor')
                    ->distinct();
    }
    
    public function lessons()
    {
        return $this->belongsToMany(Lesson::class, 'event_topic_lesson_instructor', 'topic_id', 'lesson_id')
                    ->distinct();
    }

}

