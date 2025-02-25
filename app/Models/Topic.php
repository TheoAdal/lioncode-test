<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Topic extends Model
{
    use HasFactory;

    protected $table = 'topics';

    public function lessons()
    {
        return $this->hasManyThrough(
            Lesson::class,
            EventTopicLessonInstructor::class,
            'topic_id',
            'id',
            'id',
            'lesson_id'
        );
    }

////////////////////////////////////
    // public function instructors()
    // {
    //     return $this->belongsToMany(Instructor::class, 'event_topic_lesson_instructor', 
    //     'topic_id', 'instructor_id');
    // }

    // public function lessons()
    // {   /**
    //     * The lessons that belong to the topic.
    //     */
    //     return $this->belongsToMany(Lesson::class, 'event_topic_lesson_instructor', 
    //     'topic_id', 'lesson_id');
    // }

}

