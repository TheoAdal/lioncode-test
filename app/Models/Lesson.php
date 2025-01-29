<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    protected $table = 'lessons';

    protected $fillable = ['name', 'topic_id', 'instructor_id'];

    public function topic()
    {
        return $this->belongsTo(Topic::class);
    }

    public function instructor()
    {
        // return $this->belongsTo(Instructor::class);
        return $this->belongsToMany(Lesson::class, 'event_topic_lesson_instructor', 'topic_id', 'lesson_id')
                    ->withPivot( 'instructor_id')
                    ->withTimestamps();
    }

    public function topics()
    {
        return $this->hasManyThrough(Topic::class, EventTopicLessonInstructor::class, 'lesson_id', 'id');
    }
}
