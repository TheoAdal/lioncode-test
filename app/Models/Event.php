<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;
    protected $table = 'events';

    public function users()
    {
        return $this->belongsToMany(User::class, 'event_user', 'event_id', 'user_id');
    }

    public function eventTopics()
    {
        return $this->hasMany(EventTopicLessonInstructor::class, 'event_id');
    }

    public function topics()
    {
        return $this->hasManyThrough(
            Topic::class,
            EventTopicLessonInstructor::class,
            'event_id',
            'id',
            'id',
            'topic_id'
        );
    }

    // public function lessons()
    // {
    //     return $this->hasManyThrough(
    //         Lesson::class,
    //         EventTopicLessonInstructor::class,
    //         'event_id',
    //         'id',
    //         'id',
    //         'lesson_id'
    //     );
    // }

    // public function instructors()
    // {
    //     return $this->hasManyThrough(
    //         Instructor::class,
    //         EventTopicLessonInstructor::class,
    //         'event_id',
    //         'id',
    //         'id',
    //         'instructor_id'
    //     );
    // }

/////////////////////////////////////

    // public function topics()
    // {   /**
    //     * The topics that belong to the event. 
    //     */
    //     return $this->belongsToMany(Topic::class, 'event_topic_lesson_instructor', 'event_id',  'topic_id');
    // }
}
