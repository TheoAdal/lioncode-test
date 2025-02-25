<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    protected $table = 'lessons';

    public function instructor()
    {
        return $this->belongsTo(Instructor::class, 'instructor_id');
    }
//////////////////////////////////////////////

    // public function instructors()
    // {
    //     return $this->belongsToMany(Instructor::class, 'event_topic_lesson_instructor', 
    //     'topic_id', 'instructor_id');
    // }
}
